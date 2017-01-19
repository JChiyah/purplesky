<?php


class User_model extends CI_Model {

	/* Validates a user and retrieves its details based on an email and password */
	function validate_user( $email, $password ) {
        $this->db->from('account');
        $this->db->where('email',$email );
        $this->db->where( 'password', sha1($password) );
        
        // Results of the query
        $login = $this->db->get()->result();

        // If a value exists, then the user account exists and is validated
        if ( is_array($login) && count($login) == 1 ) {
            // Set the users details into the $details property of this class
            $this->details = $login[0];
            // Call set_session to set the user's session vars via CodeIgniter
            $this->set_session();
            return true;
        }

        return false;
    }

    public function get_user_location($id=FALSE) {
        // if no id was passed use the current users id
        $id = isset($id) ? $id : $this->session->userdata('user_id');

        $query = $this->db->select()
                        ->where('staff_id', $id)
                        ->join('location', 'location.location_id=staff.current_location')
                        ->get('staff');

        $result = $query->row();

        if(isset($result) && !empty($result)) {
            return $result;
        }
        return FALSE;
    }

    public function get_skills() {

        $query = $this->db->select('name')->order_by('skill_id', 'desc')->get('skill');

        $array = array();
        foreach ($query->result() as $row) {
            $array[] = $row->name;
        }

        return array_reverse($array);

    }

    public function add_skill($skill_name, $id=FALSE) {
        // if no id was passed use the current users id
        $id = isset($id) ? $id : $this->session->userdata('user_id');

        if(!isset($skill_name)) {
            return FALSE;
        }

        $skill_id = $this->get_skill_id($skill_name);

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

    public function delete_user_skill($skill_name, $id=FALSE) {

        // if no id was passed use the current users id
        $id = isset($id) ? $id : $this->session->userdata('user_id');

        $skill_id = $this->get_skill_id($skill_name);

        $data = array(
            'staff_id' => $id,
            'skill_id' => $skill_id
        );

        return $this->db->delete('staff_skill', $data);
    }

    // Helper function that gets a skill id from the db
    public function get_skill_id($skill) {
        $skill = str_replace(' ', '', $skill);

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
