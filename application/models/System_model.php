<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model {

	/**
	 * Get all the current skills in the db
	 *
	 * @return array
	 * @author JChiyah
	 */
	public function get_skills() {

		$query = $this->db->select('name')->get('skill');

		$array = array();
		foreach ($query->result() as $row) {
			$array[] = $row->name;
		}

		return $array;
	}

	/**
	 * Get a skill id by its name
	 *
	 * @param $skill_name
	 * @return mixed boolean / integer
	 * @author JChiyah
	 */
	public function get_skill_id($skill) {
		// Parse string
		$skill = trim($skill);

		$query = $this->db->select('skill_id')
						->where('name', $skill)
						->limit(1)
						->get('skill');

		$result = $query->row();
		if(!isset($result)) {
			return FALSE;
		}

		return $result->skill_id;
	}

	/**
	 * Get a location id by its name
	 *
	 * @param $location_name
	 * @return mixed boolean / string
	 * @author JChiyah
	 */
	public function get_location_id($location) {
		// Parse string
		$location = trim($location);

		$query = $this->db->select('location_id')
						->where('name', $location)
						->limit(1)
						->get('location');

		$result = $query->row();
		if(!isset($result)) {
			return FALSE;
		}

		return $result->location_id;
	}

	/**
	 * Get a location name by its id
	 *
	 * @param $location_id
	 * @return mixed boolean / integer
	 * @author JChiyah
	 */
	public function get_location_name($id) {

		$query = $this->db->select('name')
						->where('location_id', $id)
						->limit(1)
						->get('location');

		$result = $query->row();
		if(!isset($result)) {
			return FALSE;
		}

		return $result->name;
	}

	
}
