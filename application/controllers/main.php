<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/main
	 *	- or -
	 * 		http://example.com/index.php/main/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/main/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language'));
		$this->load->model("User_model");

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	
	public function index()
	{
		$this->load->helper('url_helper');
    
		$d['body'] = 'home';
		$d['title'] = 'Home';
		$d['des'] = 'Homepage with dashboard';
		$this->load->view('html', $d);
	}

	public function profile_view()
	{
		$d['body'] = 'profile';
		$d['title'] = 'Profile';
		$d['des'] = 'User profile';

		$d['skill_select'] = array(
         'name'  => 'skill_select',
         'id'    => 'skill_select',
         'value' => $this->form_validation->set_value('skill_select'),
      );
      $d['skills'] = $this->User_model->get_skills();

      // User-related data
      $user_id = $this->session->userdata('user_id');
      $user = $this->ion_auth->user($user_id)->row();
      $user_groups = $this->ion_auth->get_users_groups($user_id)->row();

      if($user_groups->id == 1 || $user_groups->id == 2) {
      	redirect('index');
      }

      $d['user'] = array(
      	'name' 		=> $user->first_name . ' ' . $user->last_name,
      	'email'		=> $user->email,
      	'group'		=> $user_groups->description,
      	'location' 	=> $this->User_model->get_user_location($user_id)->name,
      	'skills' 	=> $this->User_model->get_user_skills($user_id)
	   );

		$this->load->view('html', $d);
	}

	public function create_project_view()
	{
		$d['body'] = 'create-project';
		$d['title'] = 'Create project';
		$d['des'] = 'Enter new project details';
		$this->load->view('html', $d);
	}

	public function search_view()
	{
		$d['body'] = 'search';
		$d['title'] = 'Search projects';
		$d['des'] = 'Search projects';
		$this->load->view('html', $d);
	}

	public function register_view()
	{
		$data = $this->create_user_form();

		$this->load->view('register', $this->data);

	}

	// Helper function to create the register form
	public function create_user_form()
	{
		// display the create user form
        // set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

      $this->data['first_name'] = array(
         'name'  => 'first_name',
         'id'    => 'first_name',
         'type'  => 'text',
         'value' => $this->form_validation->set_value('first_name'),
      );
      $this->data['last_name'] = array(
         'name'  => 'last_name',
         'id'    => 'last_name',
         'type'  => 'text',
         'value' => $this->form_validation->set_value('last_name'),
      );
      $this->data['email'] = array(
         'name'  => 'email',
         'id'    => 'email',
         'type'  => 'text',
         'value' => $this->form_validation->set_value('email'),
      );
      $this->data['password'] = array(
         'name'  => 'password',
         'id'    => 'password',
         'type'  => 'password',
         'value' => $this->form_validation->set_value('password'),
      );
      $this->data['password_confirm'] = array(
         'name'  => 'password_confirm',
         'id'    => 'password_confirm',
         'type'  => 'password',
         'value' => $this->form_validation->set_value('password_confirm'),
      );
      $this->data['groups'] = array(
         'name'  => 'groups',
         'id'    => 'groups',
         'value' => $this->form_validation->set_value('groups'),
      );

      return $this->data;
	}

	// create a new user
	public function create_user()
   {
      $this->data['title'] = $this->lang->line('create_user_heading');

      $tables = $this->config->item('tables','ion_auth');
     	$identity_column = $this->config->item('identity','ion_auth');
  		$this->data['identity_column'] = $identity_column;

      // validate form input
      $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
     	$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
     
     	$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
     
     	$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
     	$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

     	if ($this->form_validation->run() == true)
     	{
         $email    = strtolower($this->input->post('email'));
         $password = $this->input->post('password');

         $additional_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
         );

         $groups = array($this->input->post('groups')+1);
     	}
     	if ($this->form_validation->run() == true && $this->ion_auth->register($password, $email, $additional_data, $groups))
     	{
         // check to see if we are creating the user
         // redirect them back to the admin page
         $this->session->set_flashdata('message', $this->ion_auth->messages());
         redirect("login", 'refresh');
     	}
     	else
     	{
         $data = $this->create_user_form();

			$this->load->view('register', $this->data);
     	}
 	}

	public function add_user_skill() {
		$skill = $this->input->post('skill');

      // find the current users id
      $id = $this->session->userdata('user_id');

		// send value to database
		if ($this->User_model->add_skill($skill, $id)) {
			// Print value
			echo '<span class="skill-span">' . $skill . '<i class="fa fa-times fa-lg delete-tag" aria-hidden="true"></i></span>';
		} else {
			// Failed to add -> Duplicated entry


		}

	}

	public function delete_skill() {
		$skill = $this->input->post('delete_skill');

      // find the current users id
      $id = $this->session->userdata('user_id');

      if($this->User_model->delete_user_skill($skill, $id)) {
      	echo 'success';
      }
	}

}
