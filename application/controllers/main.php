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
		$this->load->model("System_model");
		$this->load->model("User_model");
		$this->load->model("Project_model");

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	
	public function index()
	{
		$this->load->helper('url_helper');
	 
		$data['body'] = 'home';
		$data['title'] = 'Home';
		$data['des'] = 'Homepage with dashboard';
		$this->load->view('html', $data);
	}

	public function profile_view()
	{
		$data['body'] = 'profile';
		$data['title'] = 'Profile';
		$data['des'] = 'User profile';

		$data['skill_select'] = array(
			'name'  => 'skill_select',
			'id'    => 'skill_select',
			'value' => $this->form_validation->set_value('skill_select'),
		);
		$data['skills'] = $this->System_model->get_skills();

		// User-related data
		$user_id = $this->session->userdata('user_id');

		$data['user'] = $this->User_model->get_user_by_id($user_id);
		$data['user_skills'] = $this->User_model->get_user_skills($user_id);
		$data['user_experiences'] = $this->User_model->get_user_experiences($user_id);

		$this->load->view('html', $data);
	}

	public function create_project_view()
	{
		// Check if user has privileges to access this page
		$user_groups = $this->ion_auth->get_users_groups($this->session->userdata('user_id'))->row();
		if($user_groups->id != 1 && $user_groups->id != 2) {
			redirect('index');
		}

		$data['body'] = 'create-project';
		$data['title'] = 'Create project';
		$data['des'] = 'Enter new project details';
		$this->load->view('html', $data);
	}

	public function search_view()
	{
		$data['body'] = 'search';
		$data['title'] = 'Search projects';
		$data['des'] = 'Search projects';

		var_dump($this->Project_model->search_projects('aaaaa aaaaa', 'Glasgow'));

		$this->load->view('html', $data);
	}

	public function projects_view()
	{
		$data['body'] = 'projects';
		$data['title'] = 'My projects';
		$data['des'] = 'List of your current projects';
		$data['projects'] = $this->User_model->get_user_projects($this->session->userdata('user_id'));
		$this->load->view('html', $data);
	}

	public function project_dashboard_view()
	{
		$data['body'] = 'project-dashboard';
		$data['title'] = 'Project dashboard';
		$data['des'] = 'Dashboard for the project containing relevant details';
		// get_project_dashboard()
		$this->load->view('html', $data);
	}

	public function register_view()
	{
		$dataata = $this->create_user_form();

		$this->load->view('register', $this->data);
	}

   /**
	 * Change user's password 
	 *
	 * @author JChiyah
	 */
  	public function change_password() {
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}

	 	$user = $this->ion_auth->user()->row();

	 	if ($this->form_validation->run() == false) {
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
			  'name' => 'old',
			  'id'   => 'old',
			  'type' => 'password',
			);
			$this->data['new_password'] = array(
			  'name'    => 'new',
			  'id'      => 'new',
			  'type'    => 'password',
			  'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
			  'name'    => 'new_confirm',
			  'id'      => 'new_confirm',
			  'type'    => 'password',
			  'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
			  'name'  => 'user_id',
			  'id'    => 'user_id',
			  'type'  => 'hidden',
			  'value' => $user->id,
			);

			// render
			$this->data['body'] = 'auth/change_password';
			$this->load->view('html', $this->data);
	 	}
		else {
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change) {
			  	// the password was successfully changed
			  	/*
			  	$this->session->set_flashdata('message', $this->ion_auth->messages());
			  	$this->logout();*/
			  	redirect('profile', 'refresh');
			} else {
			  	$this->session->set_flashdata('message', $this->ion_auth->errors());
			  	// render
			   redirect('password', 'refresh');
			}
	 	}
  	}

  	// forgot password
  	public function forgot_password()
  	{       
	 	$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');

	 	if ($this->form_validation->run() == false) {
			$this->data['type'] = $this->config->item('identity','ion_auth');
			// setup the input
			$this->data['identity'] = array('name' => 'identity',
			  'id' => 'identity',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
			  $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
			  $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
			// render
			$this->data['body'] = 'auth/forgot_password';
			$this->load->view('html', $this->data);
	 	}
	 	else {
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if(empty($identity)) {
				if($this->config->item('identity', 'ion_auth') != 'email') {
				  	$this->ion_auth->set_error('forgot_password_identity_not_found');
				} else {
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("passforgot", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten) {
			  // if there were no errors
			  $this->session->set_flashdata('message', $this->ion_auth->messages());
			  //redirect("login", 'refresh'); //we should display a confirmation page here instead of the login page
			} else {
			  $this->session->set_flashdata('message', $this->ion_auth->errors());
			  redirect("passforgot", 'refresh');
			}
		}
   }

	/**
	 * Helper function to create a registration form
	 *
	 * @return array
	 * @author JChiyah
	 */
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

	/**
	 * Creates a new user from a registration form
	 *
	 * @param registration form
	 * @author JChiyah
	 */
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

			$this->load->view('register', $data);
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

}
