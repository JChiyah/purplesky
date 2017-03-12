<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model {

	public function __construct()
	{
		$this->load->model("User_model");
		$this->load->model("System_model");
	}

	/**
	 * Get project by id
	 *
	 * @param $id
	 * @return mixed boolean / db project object()
	 * @author JChiyah
	 */
	public function get_project_by_id($id) {

		$query = $this->db->select('project_id, title, description, priority, CONCAT(first_name, " ", last_name) AS manager, location.name AS location, budget, start_date, end_date, status')
						->where('project_id', $id)
						->limit(1)
						->join('account', 'account.id=project.manager_id')
						->join('location', 'location.location_id=project.location')
						->get('project');

		$result = $query->row();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Returns a list of projects
	 *
	 * @param $limit - amount of projects to return
	 * @return mixed boolean / array of db project objects
	 * @author JChiyah
	 */
	public function get_projects($limit = FALSE) {

		$query = $this->db->select()
						->limit($limit)
						->get('project');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Get list of staff working for a project
	 *
	 * @param $project_id
	 * @return mixed boolean / array of object(id, name, role, assigned_at, pay_rate)
	 * @author JChiyah
	 */
	public function get_project_staff($project_id) {

		$query = $this->db->select('project_staff.staff_id AS id, CONCAT(first_name, " ", last_name) AS name, role, assigned_at, start_date, end_date, pay_rate, skills, location.name AS location')
						->where('project_id', $project_id)
						->join('staff', 'staff.staff_id=project_staff.staff_id')
						->join('account', 'account.id=staff.staff_id')
						->join('location', 'location.location_id=staff.current_location')
						->get('project_staff');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			foreach($result as $employee) {
				$employee->skills = $this->System_model->get_skill_names($employee->skills);
			}
			
			return $result;
		}
		return FALSE;
	}

	/**
	 * Returns the project's latest dashboard entries
	 *
	 * @param $project_id
	 * @param $limit - amount of entries to return
	 * @return mixed boolean / array of object(description, date)
	 * @author JChiyah
	 */
	public function get_project_dashboard($id, $limit = FALSE) {

		$query = $this->db->select('description, at_date AS date')
						->where('project_id', $id)
						->limit($limit)
						->order_by('entry_id', 'desc')
						->get('project_dashboard');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Creates a new entry in the project dashboard
	 *
	 * @param $user_id
	 * @param $project_id
	 * @param $description
	 * @return mixed boolean
	 * @author JChiyah
	 */
	public function add_dashboard_entry($user_id, $project_id, $description) {

		if(!$this->is_manager($project_id, $user_id)) {
			return FALSE;
		}

		$entry = array(
			'project_id'	=> $project_id,
			'description'	=> $description,
			'at_date'		=> date("Y-m-d H:i:s")
		);

		if($this->db->insert('project_dashboard', $entry)) {

			// Find project title
			$title = $this->get_project_by_id($project_id)->title;
			
			$des = "New manager post on <a href='dashboard/$project_id'>$title</a>";

			return $this->notify_project_staff($project_id, $des);
		}
		return FALSE;
	}

	/**
	 * Shortcut to create a new notification for all staff in a project
	 *
	 * @param $project_id
	 * @param $description
	 * @author JChiyah
	 */
	public function notify_project_staff($project_id, $description) {

		$this->db->trans_start(); 	// Start transaction

		$staff = $this->get_project_staff($project_id);

		if(isset($staff) && $staff) {

			foreach($staff as $employee) {
				$this->User_model->add_user_activity($employee->id, $description);
			}

		}

		$this->db->trans_complete(); // Close transaction

		return TRUE;
	}

	/**
	 * Returns whether the user is the project's manager
	 *
	 * @param $project_id
	 * @param $manager_id
	 * @return boolean
	 * @author JChiyah
	 */
	public function is_manager($project_id, $manager_id) {

		$query = $this->db->select('manager_id')
						->where('project_id', $project_id)
						->limit(1)
						->get('project');

		$result = $query->row();

		if(isset($result) && !empty($result)) {
			return $result->manager_id == $manager_id;
		}
		return FALSE;
	}

	/**
	 * Allocates staff to a project
	 *
	 * @param $project_id
	 * @param $staff (staff_id, start_date, end_date, role, skills)
	 * @return mixed boolean / array of db project object()
	 * @author JChiyah
	 */
	public function allocate_staff($project_id, $staff) {
		
		// for use with single or multiple staff at the same time
		if(isset($staff['staff_id']) || $staff['staff_id']) { 
			$staff = array($staff);
		}

		$availability = array();
		$project_staff = array();

		$this->db->trans_start(); 	// Start transaction
		
		foreach($staff as $s) {

			array_push($availability, array(
				'staff_id' 		=> $s['staff_id'],
				'start_date' 	=> $s['start_date'],
				'end_date' 		=> $s['end_date'],
				'type'			=> 2
			));

			array_push($project_staff, array(
				'project_id' 	=> $project_id,
				'staff_id' 		=> $s['staff_id'],
				'role' 			=> $s['role'],
				'assigned_at' 	=> date("Y-m-d H:i:s"),
				'start_date' 	=> $s['start_date'],
				'end_date' 		=> $s['end_date'],
				'skills'		=> $this->System_model->compress_skills($s['skills'])
			));

			// Handle a staff notifications
			$this->User_model->add_assign_employee_activity($s['staff_id'],$project_id);
		}

		// Handle staff availability
		$this->db->insert_batch('availability', $availability);

		// Handle role allocation
		$this->db->insert_batch('project_staff', $project_staff);

		$this->db->trans_complete(); 	// Close transaction

		return TRUE;
	}

	/**
	 * Search for a project
	 *
	 * @param $keyword
	 * @param $filters
	 * @param $limit
	 * @return mixed boolean / array of db project object()
	 * @author JChiyah
	 */
	public function search_projects($keyword = '', $filters = FALSE, $limit = FALSE) {

		// Check if there is a manager name associated with the keyword provided
		if(isset($keyword) && $keyword) {
			$manager_id = $this->User_model->get_project_manager_by_name($keyword);
		}

		/** Start the search **/
		$query = $this->db->select('project_id, title, description, priority, CONCAT(first_name, " ", last_name) AS manager, location.name AS location, budget, start_date, end_date')
						->join('account', 'account.id=project.manager_id')
						->join('location', 'location.location_id=project.location');

		/** Filter by project location **/
		if(isset($filters['location']) && $filters['location']) {
			$query = $query->where('location_id', $filters['location']);
		}

		/** Filter by project start date **/
		if(isset($filters['start_date']) && $filters['start_date']) {
			$query = $query->where('start_date >=', $filters['start_date']);
		}

		/** Filter by project end date **/
		if(isset($filters['end_date']) && $filters['end_date']) {
			$query = $query->where('end_date <=', $filters['end_date']);
		}

		/** Filter by manager **/
		if(isset($manager_id) && $manager_id) {
			$query = $query->where('manager_id', $manager_id);
		}

		/** Filter by keyword **/
		else if(isset($keyword) && $keyword) {
			$query = $query->like('title', $keyword);
			$query = $query->or_like('description', $keyword);
		}

		$query = $query->limit($limit)->get('project');
		$result = $query->result();

		if(isset($result) && !empty($result)) {

			if(sizeof($result) < $limit && isset($limit) && $limit) {

				return $this->repeat_search($result, $keyword, $filters, $limit);

			} else {

				return $result;

			}
		} else if(isset($limit) && $limit) {
			return $this->repeat_search($result, $keyword, $filters, $limit);
		}
		return FALSE;
	}

	/**
	 * Repeats a search based on some conditions
	 *
	 * @param $keyword
	 * @param $filters
	 * @param $limit
	 * @return mixed boolean / project_id
	 * @author JChiyah
	 */
	protected function repeat_search($result, $keyword = '', $filters = FALSE, $limit = 10) {

		/* Get other projects in different locations **/
		for($i = 1; $i < 5; $i++) {
			$filters['location'] = $this->System_model->get_closest_location($filters['location']);

			$tmp = $this->search_projects('Project');

			if($tmp) {
				$result = array_merge($result, $tmp);
			}

			if(sizeof($result) >= $limit) {
				break;
			}
		}

		return array_slice($result, 0, $limit);
	}

	/**
	 * Creates a new project
	 *
	 * @param $manager_id
	 * @param $project_info
	 * @param $staff
	 * @return mixed boolean / project_id
	 * @author JChiyah
	 */
	public function create_project($manager_id, $project_info, $staff) {

		// Add other project info
		$project_info = array_merge(array('manager_id' => $manager_id), $project_info);

		$this->db->trans_start(); 	// Start transaction

		// Insert new project
		$project = $this->db->insert('project', $project_info);

		if($project) {

			// Get id of inserted project
			$project_id = $this->db->insert_id();

			// New project notification
			$entry = array(
				'project_id' 	=> $project_id,
				'description'	=> 'Welcome to the project!',
				'at_date'		=> date("Y-m-d H:i:s")
			);

			$this->db->insert('project_dashboard', $entry);

			$this->User_model->add_manager_activity($manager_id, $project_id);

			$this->db->trans_complete(); // Close transaction

			// Return id of the inserted project
			return $project_id;
		}
		return FALSE;
	}

	/**
	 * Update project details
	 *
	 * @param $manager_id
	 * @param $project_id
	 * @param $project_info
	 * @return mixed boolean / project_id
	 * @author JChiyah
	 */
	public function update_project($manager_id, $project_id, $project_info) {

		if(!$this->is_manager($project_id, $manager_id)) {
			return FALSE;
		}

		$query = $this->db->select()
						->where('project_id', $project_id)
						->where('manager_id', $manager_id)
						->limit(1)
						->get('project');

		$old_data = $query->row();

		if(!isset($old_data) || !$old_data) {
			return FALSE;
		}

		if($this->db->update('project', $project_info, 
			array('project_id' => $project_id, 'manager_id' => $manager_id))) {

			// All okay, get data from db
			$query = $this->db->select()
						->where('project_id', $project_id)
						->where('manager_id', $manager_id)
						->limit(1)
						->get('project');

			$new_data = $query->row();

			// Check changes
			$changes = array();
			foreach($new_data as $key => $value) {

				if($value != $old_data->$key) {
					$changes[$key]['old'] = $old_data->$key;
					$changes[$key]['new'] = $value;
				}

			}

			// Do something with the list of changes

			return TRUE;

		}

	}


}
