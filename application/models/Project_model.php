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

		$query = $this->db->select()
						->where('project_id', $id)
						->limit(1)
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
	 * @return mixed boolean / object()
	 * @author JChiyah
	 */
	public function get_project_staff($id) {

		$query = $this->db->select()
						->where('project_id', $id)
						->join('staff', 'staff.staff_id=project_staff.staff_id')
						->get('project_staff');

		$result = $query->row();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

	/**
	 * Search for a project
	 *
	 * @param $project_id
	 * @return mixed boolean / object()
	 * @author JChiyah
	 */
	public function search_projects($keyword = FALSE, $location = FALSE) {

		/** LOOK FOR:
			- Select statement in pieces, so execute after if statements
		**/

		$query = $this->db->select();

		/** Filter by project location **/
		if(isset($location)) {
			$location = trim($location);
			$location = $this->System_model->get_location_id($location);
			$query = $query->where('location', $location);
		}

		/** Filter by project manager 
		if(isset($keyword)) {
			$keyword = trim($keyword);
			//$keyword = $this->User_model->get_staff_id($location);
			$query = $query->where('location', $location);
		}*/

		$query = $query->get('project');
		$result = $query->result();

		if(isset($result) && !empty($result)) {
			return $result;
		}
		return FALSE;
	}

}
