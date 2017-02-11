<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language'));
		$this->load->model("System_model");
		$this->load->model("User_model");
		$this->load->model("Project_model");

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Adds a user' skill
	 * Call from a form post using AJAX
	 *
	 * @param post('skill')
	 * @author JChiyah
	 */
	public function add_user_skill() {
		$skill = $this->input->post('skill');

		// find the current users id
		$id = $this->session->userdata('user_id');

		// send value to database
		if ($this->User_model->add_user_skill($skill, $id)) {
			// Print value
			echo '<span class="skill-span">' . $skill . '<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>';
		} else {
			// Failed to add -> Duplicated entry

		}
	}

	/**
	 * Deletes a user' skill
	 * Call from a form post using AJAX
	 *
	 * @param post('delete_skill')
	 * @author JChiyah
	 */
	public function delete_user_skill() {
		$skill = $this->input->post('delete_skill');

		// find the current users id
		$id = $this->session->userdata('user_id');

		if($this->User_model->delete_user_skill($skill, $id)) {
			echo 'success';
		}
	}

	/**
	 * Adds a user' experience
	 * Call from a form post using AJAX
	 *
	 * @param experience form
	 * @author JChiyah
	 */
	public function add_user_experience() {

		// get and format input
		$id = $this->session->userdata('user_id');
		
		// TO-DO - protect from injection
		$additional_data = array(
			'start_date' => $this->input->post('start_date'),
			'end_date'	=> $this->input->post('end_date'),
			'title'		=> $this->parse_input($this->input->post('title')),
			'description' => $this->parse_input($this->input->post('description')),
			'role'		=> $this->parse_input($this->input->post('role'))
		);

		/*** HERE ***/

		if($this->User_model->add_user_experiences($id, $additional_data)) {
			echo 'okay';
		} else {
			echo 'nope';
		}
		
	}

	/**
	 * Helper function to parse any simple text input
	 *
	 * @param $input
	 * @author JChiyah
	 */
	protected function parse_input($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

}