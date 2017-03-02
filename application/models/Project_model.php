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

		$query = $this->db->select('title, description, priority, CONCAT(first_name, " ", last_name) AS manager, location.name AS location, budget, start_date, end_date')
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
	public function get_project_staff($id) {

		$query = $this->db->select('project_staff.staff_id AS id, CONCAT(first_name, " ", last_name) AS name, role, assigned_at, pay_rate')
						->where('project_id', $id)
						->join('staff', 'staff.staff_id=project_staff.staff_id')
						->join('account', 'account.id=staff.staff_id')
						->get('project_staff');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
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

		$query = $this->db->select('description, at_date')
						->where('project_id', $id)
						->limit($limit)
						->get('project_dashboard');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Allocates staff to a project
	 *
	 * @param $project_id
	 * @return mixed boolean / array of db project object()
	 * @author JChiyah
	 */
	public function allocate_staff($project_id, $staff) {

		if(!is_array($staff)) { // for use with single or multiple staff at the same time
			$staff = array($staff);
		}

		$availability = array();
		$project_staff = array();
		
		foreach($staff as $s) {

			array_push($availability, array(
				'staff_id' => $s['id'],
				'start_date' => $s['start_date'],
				'end_date' => $s['end_date'],
				'type' => 2
			));

			array_push($project_staff, array(
				'project_id' 	=> $project_id,
				'staff_id' 		=> $s['id'],
				'role' 			=> 'General Staff',
				'assigned_at' 	=> date("Y-m-d H:i:s"),
				'start_date' 	=> $s['start_date'],
				'end_date' 		=> $s['end_date'],
				'skills'		=> $this->System_model->compress_skills($s['skills'])
			));

			// Handle a staff notifications
			$this->User_model->add_user_activity($s['id'],'',$project_id);
		}

		// Handle staff availability
		$this->db->insert_batch('availability', $availability);

		// Handle role allocation
		$this->db->insert_batch('project_staff', $project_staff);

	}

	/**
	 * Search for a project
	 *
	 * @param $project_id
	 * @return mixed boolean / array of db project object()
	 * @author JChiyah
	 */
	public function search_projects($keyword = FALSE, $filters = FALSE) {

		// Check if there is a manager name associated with the keyword provided
		$manager_id = $this->User_model->get_user_by_name($keyword);

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

		$query = $query->get('project');
		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Creates a new project
	 *
	 * @param $manager_id
	 * @param $project_id
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

			if(isset($staff) && $staff) {
				// Allocate staff
				$this->allocate_staff($project_id, $staff);
			}

			$this->User_model->add_user_activity($manager_id,'',$project_id);

			$this->db->trans_complete(); // Close transaction

			// Return id of the inserted project
			return $project_id;
		}
		return FALSE;
	}


}
