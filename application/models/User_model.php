<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	/**
	 * Returns the user id by name
	 *
	 * @param $name = first_name last_name
	 * @return mixed boolean / string
	 * @author JChiyah
	 */
	public function get_user_by_name($name) {
		
		$name = trim($name);
		$name = explode(' ', $name);
		if(sizeof($name) != 2) {
			// Bad formed name
			return FALSE;
		}
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
			// User is not staff, thus it is an admin group -> return some account info 
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
	public function get_user_location($id = FALSE) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$query = $this->db->select()
						->where('staff_id', $id)
						->limit(1)
						->join('location', 'location.location_id=staff.current_location')
						->get('staff');

		$result = $query->row();

		if(isset($result) && $result) {
			return $result->name;
		}
		// Dummy value in case it fails (Fix later)
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

		$query = $this->db->select('experience_id, start_date, end_date, project_id, title, description, role')
						->where('staff_id', $id)
						->order_by('experience_id', 'desc')
						->get('experience');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
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

		} else {

			$data = array_merge(array('staff_id' => $id), $additional_data);

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
				return $this->db->delete('experience', array('experience_id' => $experience_id));
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
	public function get_user_activity($id = FALSE) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$query = $this->db->select('description, at_date')
						->where('staff_id', $id)
						->limit(10)
						->get('activity');

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
	public function get_user_projects($id = FALSE, $limit = FALSE) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$query = $this->db->select('CONCAT(first_name, " ", last_name) AS manager, title, description, priority, location.name AS location, start_date, end_date')
						->where('project_staff.staff_id', $id)
						->join('project_staff', 'project_staff.project_id=project.project_id')
						->join('account', 'account.id=project.manager_id')
						->join('location', 'location.location_id=project.location')
						->limit($limit)
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
						->join('staff', 'staff.staff_id=staff_skill.staff_id')
						->join('location', 'location.location_id=staff.current_location')
						->join('account', 'account.id=staff.staff_id')
						->join('account_group', 'account_group.user_id=staff.staff_id')
						->join('user_group', 'user_group.id=account_group.group_id')
						->group_by('staff.staff_id')
						->limit(10);

		// Filter by skills
		if(isset($filters['skills']) && $filters['skills']) {
			if(is_array($filters['skills'])) {
				foreach ($filters['skills'] as $skill) {
					$query = $query->where("EXISTS(SELECT 1 FROM staff_skill WHERE staff_skill.staff_id = staff.staff_id AND staff_skill.skill_id = $skill) AND 1 = ", 1);
				}
			} else {
				$query = $query->where('skill_id', $filters['skills']);	
			}
		}

		// End search
		$query = $query->get('staff_skill');

		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

}
