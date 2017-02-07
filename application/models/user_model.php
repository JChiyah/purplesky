<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	/**
	 * Returns the user's location name
	 *
	 * @param $user_id
	 * @return mixed boolean / object(id, name)
	 * @author JChiyah
	 */
	public function get_user_location($id=FALSE) {
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
		return 'Madrid';
	}

	/**
	 * Returns the user's skills
	 *
	 * @param $user_id
	 * @return mixed boolean / object
	 * @author JChiyah
	 */
	public function get_user_skills($id=FALSE) {
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
	public function add_user_skill($skill_name, $id=FALSE) {
		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		if(!isset($skill_name)) {
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
	public function delete_user_skill($skill_name, $id=FALSE) {

		// if no id was passed use the current users id
		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$skill_id = $this->System_model->get_skill_id($skill_name);

		$data = array(
			'staff_id' => $id,
			'skill_id' => $skill_id
		);

		return $this->db->delete('staff_skill', $data);
	}


}
