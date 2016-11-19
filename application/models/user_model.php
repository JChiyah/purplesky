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

}
