<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->model("Project_model");
		//$this->load->model("System_model");
	}

	/**
	 * Returns the user id by name
	 * Names with two or more words should be formed like aaa%20aa b%20bbb
	 *
	 * @param $name = first_name last_name
	 * @return mixed boolean / int
	 * @author JChiyah
	 */
	public function get_user_by_name($name) {
		
		$name = trim($name);
		$name = explode(' ', $name);
		if(sizeof($name) != 2) {
			// Bad formed name
			return FALSE;
		}
		$name[0] = str_replace('%20', ' ', $name[0]);
		$name[1] = str_replace('%20', ' ', $name[1]);

		$query = $this->db->select('id')
						->where('first_name', $name[0])
						->where('last_name', $name[1])
						->limit(1)
						->get('account');

		$result = $query->row();

		if(isset($result) && $result) {
			return $result->id;
		}
		return FALSE;
	}

	/**
	 * Returns the Project Manager id by name
	 *
	 * @param $name = first_name || last_name
	 * @return mixed boolean / int
	 * @author JChiyah
	 */
	public function get_project_manager_by_name($name) {
		
		$name = trim($name);

		$name_arr = explode(' ', $name);
		if(sizeof($name_arr) == 2) {

			return $this->get_user_by_name($name);
		} else if(sizeof($name_arr) > 2) {
			// Bad formed name
			return FALSE;
		}

		$query = $this->db->select('account.id')
						->join('account_group','user_id=account.id')
						->like('first_name', $name)
						->or_like('last_name', $name)
						//->where('group_id', 2)
						//->or_where('group_id', 1)
						->limit(1)
						->get('account');

		$result = $query->row();

		if(isset($result) && $result) {
			return $result->id;
		}
		return FALSE;
	}

	/**
	 * Returns the user information by id
	 *
	 * @param $user_id
	 * @return mixed boolean / object(email, name, location, pay_rate) / object(email, name)
	 * @author JChiyah
	 */
	public function get_user_by_id($id = FALSE) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$query = $this->db->select('email, CONCAT(first_name, " ", last_name) AS name, user_group.name AS group, location.name AS location, pay_rate')
						->where('account.id', $id)
						->limit(1)
						->join('staff', 'staff.staff_id=account.id')
						->join('location', 'location.location_id=staff.current_location')
						->join('account_group', 'account_group.user_id=account.id')
						->join('user_group', 'user_group.id=account_group.group_id')
						->get('account');

		$result = $query->row();

		if(isset($result) && $result) {
			return $result;
		} else {
			// User is not staff, thus it is an admin group -> return SOME account info 
			$query = $this->db->select('email, CONCAT(first_name, " ", last_name) AS name, user_group.name AS group')
							->where('account.id', $id)
							->limit(1)
							->join('account_group', 'account_group.user_id=account.id')
							->join('user_group', 'user_group.id=account_group.group_id')
							->get('account');

			$result = $query->row();

			if(isset($result) && $result) {
				return $result;
			}
			// Something is wrong with the search -> wrong id / problem connecting to the DB
			return FALSE;
		}
	}

	/**
	 * Returns the user's location name
	 *
	 * @param $user_id
	 * @return mixed boolean / string
	 * @author JChiyah
	 */
	public function get_user_location($user_id = FALSE) {
		// if no id was passed use the current users id
		$user_id = isset($user_id) ? $user_id : $this->session->userdata('user_id');

		$query = $this->db->select('location.name AS name')
						->where('staff_id', $user_id)
						->limit(1)
						->join('location', 'location.location_id=staff.current_location')
						->get('staff');

		$result = $query->row();

		if(isset($result) && $result) {
			return $result->name;
		}
		return FALSE;
	}

	/**
	 * Returns the user's location id
	 *
	 * @param $user_id
	 * @return mixed boolean / string
	 * @author JChiyah
	 */
	public function get_user_location_id($user_id) {
		// if no id was passed use the current users id

		$query = $this->db->select('location_id AS id')
						->where('staff_id', $user_id)
						->limit(1)
						->join('location', 'location.location_id=staff.current_location')
						->get('staff');

		$result = $query->row();

		if(isset($result) && $result) {
			return $result->id;
		}
		return FALSE;
	}

	/**
	 * Returns the user's skills
	 *
	 * @param $user_id
	 * @return mixed boolean / object
	 * @author JChiyah
	 */
	public function get_user_skills($id = FALSE) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$query = $this->db->select()
						->where('staff_id', $id)
						->join('skill', 'skill.skill_id=staff_skill.skill_id')
						->get('staff_skill');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Add a user' skill
	 *
	 * @param $skill_name
	 * @param $user_id
	 * @return boolean
	 * @author JChiyah
	 */
	public function add_user_skill($skill_name, $id) {
		
		if(!isset($skill_name) && $skill_name) {
			return FALSE;
		}

		$skill_id = $this->System_model->get_skill_id($skill_name);

		$query = $this->db->select()
						->where('staff_id', $id)
						->where('skill_id', $skill_id)
						->get('staff_skill');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			// Duplicated entry
			return FALSE;
		}

		$data = array(
			'staff_id'      => $id,
			'skill_id'      => $skill_id,
			'skill_level'   => 0
		);

		return $this->db->insert('staff_skill', $data);
	}

	/**
	 * Delete a user' skill
	 *
	 * @param $skill_name
	 * @param $user_id
	 * @return boolean
	 * @author JChiyah
	 */
	public function delete_user_skill($skill_name, $id = FALSE) {

		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$skill_id = $this->System_model->get_skill_id($skill_name);

		$data = array(
			'staff_id' => $id,
			'skill_id' => $skill_id
		);

		return $this->db->delete('staff_skill', $data);
	}

	/**
	 * Returns the user's experiences
	 *
	 * @param $user_id
	 * @return mixed boolean / object(id, start_date, end_date, project_id, title, description, role)
	 * @author JChiyah
	 */
	public function get_user_experiences($id = FALSE) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$query = $this->db->select('experience_id, start_date, end_date, project_id, institution, description, role, skills')
						->where('staff_id', $id)
						->where('active', 1)
						->order_by('end_date', 'desc')
						->get('experience');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			foreach($result as $experience) {
				$experience->skills = $this->System_model->get_skill_names($experience->skills);
			}
			
			return $result;
		}
		return FALSE;
	}

	/**
	 * Add a new user's experience
	 *
	 * @param $user_id
	 * @return mixed boolean / object(start_date, end_date, project_id, title, description, role)
	 * @author JChiyah
	 */
	public function add_user_experiences($id, $additional_data) {

		if(isset($additional_data['project_id']) && $additional_data['project_id']) {
			// TO-DO
		} else {

			$data = array_merge(array('staff_id' => $id), $additional_data);

			$data['skills'] = $this->System_model->compress_skills($data['skills']);

			return $this->db->insert('experience', $data);
		}
	}

	/**
	 * Delete a user' experience
	 *
	 * @param $experience_id
	 * @param $user_id
	 * @return boolean
	 * @author JChiyah
	 */
	public function delete_user_experience($experience_id, $user_id) {

		// Check we are deleting the right experience
		$query = $this->db->select('experience_id, staff_id')
						->where('experience_id', $experience_id)
						->limit(1)
						->get('experience');

		$result = $query->row();

		if(isset($result) && !empty($result)) {
			
			// Check if the staff_id is the same as the one provided
			if($result->staff_id == $user_id) {
				// Delete experience

				return $this->db->update('experience', array('active' => 0), array('experience_id' => $experience_id));
			}
			// Else trying to delete another's user data
		}
		return FALSE;
	}

	/**
	 * Returns the user's latest 10 notifications
	 *
	 * @param $user_id
	 * @return mixed boolean / object(description, date)
	 * @author JChiyah
	 */
	public function get_user_activity($user_id, $limit = FALSE) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$query = $this->db->select('description, at_date')
						->where('user_id', $id)
						->order_by('activity_id', 'desc')
						->limit($limit)
						->get('activity');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Creates a new notification for the user
	 *
	 * @param $user_id
	 * @param $description
	 * @param $project_id
	 * @return mixed boolean
	 * @author JChiyah
	 */
	public function add_user_activity($user_id, $description) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$notification = array(
			'user_id'		=> $user_id,
			'description'	=> $description,
			'at_date'		=> date("Y-m-d H:i:s")
		);

		return $this->db->insert('activity', $notification);
	}

	/**
	 * Shortcut to create a new notification for employees when assigned to a project
	 *
	 * @param $user_id
	 * @param $project_id
	 * @return mixed boolean
	 * @author JChiyah
	 */
	public function add_assign_employee_activity($user_id, $project_id) {

		// Find project title
		$title = $this->Project_model->get_project_by_id($project_id)->title;

		$description = "You have been assigned to: <a href='dashboard/$project_id'>$title</a>";

		return $this->add_user_activity($user_id, $description);
	}

	/**
	 * Shortcut to create a new notification for project managers
	 *
	 * @param $manager_id
	 * @param $project_id
	 * @return mixed boolean
	 * @author JChiyah
	 */
	public function add_project_manager_activity($manager_id, $project_id) {

		// Find project title
		$title = $this->Project_model->get_project_by_id($project_id)->title;

		$description = "You have created a new project <a href='dashboard/$project_id'>$title</a>";

		return $this->add_user_activity($manager_id, $description);
	}

	/**
	 * Returns whether the user is available to work or a string code when it is not
	 *
	 * @param $project_id
	 * @return boolean
	 * @author JChiyah
	 */
	public function is_available($user_id, $start_date, $end_date) {

		$query = $this->db->select('type')
						->where('staff_id', $user_id)
						->where("((start_date BETWEEN '$start_date' AND '$end_date') OR (end_date BETWEEN '$start_date' AND '$end_date'))")
						->limit(1)
						->get('availability');

		$result = $query->row();

		if(isset($result) && !empty($result)) {
			return $result->type;
		}
		return TRUE;
	}

	/**
	 * Returns the user's most recent projects
	 *
	 * @param $user_id
	 * @param $limit - amount of projects to return
	 * @return mixed boolean / array of db project object(manager, title, description, priority, location, start_date, end_date)
	 * @author JChiyah
	 */
	public function get_user_projects($user_id, $limit = FALSE) {

		$query = $this->db->select('project.project_id, CONCAT(first_name, " ", last_name) AS manager, title, description, priority, location.name AS location, project.start_date, project.end_date, skills')
						->where('project_staff.staff_id', $user_id)
						->join('project_staff', 'project_staff.project_id=project.project_id')
						->join('account', 'account.id=project.manager_id')
						->join('location', 'location.location_id=project.location')
						->limit($limit)
						->order_by('project.end_date', 'desc')
						->get('project');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			foreach($result as $project) {
				$project->skills = $this->System_model->get_skill_names($project->skills);
			}
			return $result;
		}
		return FALSE;
	}

	/**
	 * Returns projects in which the user is a project manager
	 *
	 * @param $user_id
	 * @param $limit - amount of projects to return
	 * @return mixed boolean / array of db project object(manager, title, description, priority, location, start_date, end_date)
	 * @author JChiyah
	 */
	public function get_manager_projects($user_id, $limit = FALSE) {

		$query = $this->db->select('project.project_id, CONCAT(first_name, " ", last_name) AS manager, title, description, priority, location.name AS location, project.start_date, project.end_date')
						->where('project.manager_id', $user_id)
						->join('account', 'account.id=project.manager_id')
						->join('location', 'location.location_id=project.location')
						->limit($limit)
						->order_by('project.end_date', 'desc')
						->get('project');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Returns the user's most recent projects
	 *
	 * @param $user_id
	 * @param $limit - amount of projects to return
	 * @return mixed boolean / array of db project object(manager, title, description, priority, location, start_date, end_date)
	 * @author JChiyah
	 */
	public function search_staff($filters) {

		// Start the query
		$query = $this->db->select('staff.staff_id AS id, CONCAT(first_name, " ", last_name) AS name, user_group.description AS group, location.name AS location, pay_rate')
						->join('location', 'location.location_id=staff.current_location')
						->join('account', 'account.id=staff.staff_id')
						->join('account_group', 'account_group.user_id=staff.staff_id')
						->join('user_group', 'user_group.id=account_group.group_id')
						->group_by('staff.staff_id')
						->limit(10);

		/** Filter by location **/
		if(isset($filters['location']) && $filters['location']) {
			$query = $query->where('location_id', $filters['location']);
		}
		
		/** Filter by skills **/
		if(isset($filters['skills']) && $filters['skills']) {
			$query = $query->join('staff_skill', 'staff_skill.staff_id=staff.staff_id');
			if(is_array($filters['skills'])) {
				foreach ($filters['skills'] as $skill) {
					$query = $query->where("EXISTS(SELECT 1 FROM staff_skill WHERE staff_skill.staff_id = staff.staff_id AND staff_skill.skill_id = $skill) AND 1 = ", 1);
				}
			} else {
				$query = $query->where('skill_id', $filters['skills']);	
			}
		}
		
		/*
		// Do not show staff already added to project
		if(isset($filters['staff_ids']) && $filters['staff_ids']) {
			if(is_array($filters['staff_ids'])) {
				foreach ($filters['staff_ids'] as $id) {
					$query = $query->where('staff.staff_id != ', $id);
				}
			} else {
				$query = $query->where('staff.staff_id != ', $filters['staff_ids']);	
			}
		}
		
		/** Filter by name **/
		if(isset($filters['name']) && $filters['name']) {

			if(count(explode(' ', $filters['name'])) > 1) {
				$name = explode(' ', $filters['name']);
				$query = $query->group_start()->like('first_name', $name[0]);
				$query = $query->or_like('last_name', $name[1])->group_end();
			} else {
				$query = $query->group_start()->like('first_name', $filters['name']);
				$query = $query->or_like('last_name', $filters['name'])->group_end();
			}
		} else {
			if(isset($filters['start_date']) && $filters['start_date'] && isset($filters['end_date']) && $filters['end_date']) {

				$query = $query->where("NOT EXISTS(SELECT 1 FROM availability 
						WHERE staff.staff_id = availability.staff_id AND
							((availability.start_date BETWEEN '{$filters['start_date']}' AND '{$filters['end_date']}') OR
							(availability.end_date BETWEEN '{$filters['start_date']}' AND '{$filters['end_date']}'))
						) AND 1 = ", 1);
			}
		}

		// End search
		$query = $query->get('staff');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

}
