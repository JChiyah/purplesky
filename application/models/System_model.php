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
	 * Get a skill name by its id
	 *
	 * @param $skill_id
	 * @return mixed boolean / string
	 * @author JChiyah
	 */
	public function get_skill_name($skill_id) {

		$query = $this->db->select('name')
						->where('skill_id', $skill_id)
						->limit(1)
						->get('skill');

		$result = $query->row();
		if(!isset($result)) {
			return FALSE;
		}

		return $result->name;
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
	 * Get a location closest to a given one
	 *
	 * @param $location_id
	 * @return int
	 * @author JChiyah
	 */
	public function get_closest_location($id) {

		/** hardcoded -> change later **/
		switch ($id) {
			case 1:
				return 2;
			case 2:
				return 3;
			case 3:
				return 4;
			case 4:
				return 1;
			case 5:
				return 3;
			default:
				return 1;
		}
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

		if(empty($string)) {
			return array();
		}

		return explode(',',$string);
	}

	/**
	 * This function turns an array of skills (ints) into their corresponding names
	 * It works for arrays of the form [1,2,3] or with strings of the form 1,2,3
	 *
	 * @param $skill_arr
	 * @return array of skill names
	 * @author JChiyah
	 */
	public function get_skill_names($skill_arr) {

		if(!is_array($skill_arr)) {
			$skill_arr = $this->decompress_skills($skill_arr);
		}

		$data = array();
		if(empty($skill_arr)) {
			return $data;
		}

		foreach($skill_arr as $skill) {
			array_push($data, $this->get_skill_name($skill));
		}

		return $data;
	}

}
