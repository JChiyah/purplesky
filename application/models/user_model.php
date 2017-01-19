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

    public function get_user_skills($id=FALSE) {

        // if no id was passed use the current users id
        $id = isset($id) ? $id : $this->session->userdata('user_id');

        $this->limit(1);
        $this->order_by('skill.skill_id', 'desc');
        $this->where('staff_skill.staff_id', $id);

        $this->users();

        return $this;
    }

    public function add_skill($skill_name, $id=FALSE) {
        // if no id was passed use the current users id
        $id = isset($id) ? $id : $this->session->userdata('user_id');

        if(!isset($skill_name)) {
            return FALSE;
        }

        $query = $this->db->select('skill_id')
                ->where('name', $skill_name)
                ->get('skill');

        $skill = $query->row();

        if(!isset($skill)) {
            return FALSE;
        }

        $data = array(
            'staff_id'      => 2,
            'skill_id'      => 2,
            'skill_level'   => 0
        );

        /**** ERROR HERE ****/
        return $this->db->insert('staff_skill', $data);

        return TRUE;
    }

    public function get_skills() {

        $query = $this->db->select('name')->order_by('skill_id', 'desc')->get('skill');

        $array = array();
        foreach ($query->result() as $row) {
            $array[] = $row->name;
        }

        return array_reverse($array);

    }


}
