<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model {

	/**
	 * Get all the skills in the db
	 *
	 * @return array
	 * @author JChiyah
	 */
	public function get_skills() {

		$query = $this->db->select()->get('skill');

		$result = $query->result_array();

		if(isset($result) && $result) {
			
			// format array properly
			$skills = array();
			foreach ($result as $key => $value){
				$skills[$value['skill_id']] = $value['name'];
			}

			return $skills;
		}
		return FALSE;
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
	 * Get all the locations in the db
	 *
	 * @return array
	 * @author JChiyah
	 */
	public function get_locations() {

		$query = $this->db->select()->get('location');

		$result = $query->result_array();

		if(isset($result) && $result) {

			// format array properly
			$locations = array();
			foreach ($result as $key => $value){
				$locations[$value['location_id']] = $value['name'];
			}

			return $locations;
		}
		return FALSE;
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

	/**
	 * This function compresses skills ids into one string
	 * It is used to simplify the DB architecture and speed up queries by x10
	 *
	 * @param $skills
	 * @return string
	 * @author JChiyah
	 */
	public function compress_skills($skills) {

		if(!is_array($skills)) {
			$skills = array($skills);
		}

		$string = '';
		foreach($skills as $skill) {
			if(empty($string)) {
				$string = $skill;
			} else {
				$string = $string . ',' . $skill;
			}

		}

		return $string;
	}
	

	/**
	 * This function decompresses a string into an array of skill ids
	 * It is used to simplify the DB architecture and speed up queries by x10
	 *
	 * @param $string
	 * @return array of skill ids
	 * @author JChiyah
	 */
	public function decompress_skills($string) {

		return explode(',',$string);
	}

}
