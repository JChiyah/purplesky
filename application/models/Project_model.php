<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_model extends CI_Model {

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
	 * @return mixed boolean / object(description, date)
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
	 * Search for a project
	 *
	 * @param $project_id
	 * @return mixed boolean / array of db project object()
	 * @author JChiyah
	 */
	public function search_projects($keyword = FALSE, $location = FALSE) {

		// Check if there is a manager name associated with the keyword provided
		$keyword = trim($keyword);
		$manager_id = $this->User_model->get_user_by_name($keyword);

		// Check if there is a location associated with the keyword
		$location = $this->System_model->get_location_id($location);

		/** Start the search **/
		$query = $this->db->select();

		/** Filter by project location **/
		if(isset($location) && $location) {
			$query = $query->where('location', $location);
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

}
