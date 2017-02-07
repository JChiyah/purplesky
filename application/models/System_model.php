<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_model extends CI_Model {

	/**
	 * Get all the current skills in the db
	 *
	 * @return array
	 * @author JChiyah
	 */
	public function get_skills() {

		$query = $this->db->select('name')->order_by('skill_id', 'desc')->get('skill');

		$array = array();
		foreach ($query->result() as $row) {
			$array[] = $row->name;
		}

		return array_reverse($array);
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

}
