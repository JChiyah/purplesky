<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('Base.php');
class Main extends Base {

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

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	
	public function index()
	{
		$this->load->helper('url_helper');

		$user_id = $this->session->userdata('user_id');

		// General stuff
		$data['activity'] = $this->User_model->get_user_activity($this->session->userdata('user_id'));
		$data['current_projects'] = $this->User_model->get_user_projects($user_id, 3);

		$filters = array( 
			'location' => $this->User_model->get_user_location_id($user_id)
		);
		$data['recommended_projects'] = $this->Project_model->search_projects('', $filters, 3);

		$data['page_body'] = 'home';
		$data['page_title'] = 'Home';
		$data['page_description'] = 'Homepage with dashboard';
		$this->load->view('html', $data);
	}

	public function profile_view()
	{
		$data = $this->experience_form();
		$data['page_body'] = 'profile';
		$data['page_title'] = 'Profile';
		$data['page_description'] = 'User profile';

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
		
		$data['page_body'] = 'create-project';
		$data['page_title'] = 'Create project';
		$data['page_description'] = 'Enter new project details';
		$this->load->view('html', $data);
	}

	public function search_view()
	{
		$data['page_body'] = 'search';
		$data['page_title'] = 'Search projects';
		$data['page_description'] = 'Search projects';
		$data['locations'] = $this->System_model->get_locations();
		$data['projects'] = $this->Project_model->search_projects();

		$data['keyword'] = array(
			'name'  => 'keyword',
			'id'    => 'keyword',
			'value' => $this->form_validation->set_value('keyword'),
		);
		$data['start_date'] = array(
			'name'  => 'start_date',
			'id'    => 'start_date',
			'value' => $this->form_validation->set_value('start_date'),
		);
		$data['end_date'] = array(
			'name'  => 'end_date',
			'id'    => 'end_date',
			'value' => $this->form_validation->set_value('end_date'),
		);
		$data['location'] = array(
			'name'  => 'location',
			'id'    => 'location',
			'value' => $this->form_validation->set_value('location'),
		);

		$this->load->view('html', $data);
	}

	public function projects_view()
	{
		$data['page_body'] = 'projects';
		$data['page_title'] = 'My projects';
		$data['page_description'] = 'List of your current projects';

		$user_id = $this->session->userdata('user_id');

		$data['projects'] = $this->User_model->get_user_projects($user_id);

		$user_groups = $this->ion_auth->get_users_groups($user_id)->row();
		if($user_groups->id == 1 || $user_groups->id == 2) {
			$data['own_projects'] = $this->User_model->get_manager_projects($user_id);
		}

		$this->load->view('html', $data);
	}

	public function project_dashboard_view($project_id)
	{
		$data['page_body'] = 'project-dashboard';
		$data['page_title'] = 'Project dashboard';
		$data['page_description'] = 'Dashboard for the project containing relevant details';

		$data['is_manager'] = $this->Project_model->is_manager($project_id, $this->session->userdata('user_id'));
		$data['project'] = $this->Project_model->get_project_by_id($project_id);
		$data['staff'] = $this->Project_model->get_project_staff($project_id);
		$data['dashboard'] = $this->Project_model->get_project_dashboard($project_id);

		$this->load->view('html', $data);
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
			$this->data['page_body'] = 'auth/forgot_password';
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

	public function experience_form() {
		// display the new experience form
		  // set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['start_date'] = array(
			'name'  => 'start_date',
			'id'    => 'start_date',
			'type'  => 'date',
			'value' => $this->form_validation->set_value('start_date'),
		);
		$this->data['end_date'] = array(
			'name'  => 'end_date',
			'id'    => 'end_date',
			'type'  => 'date',
			'value' => $this->form_validation->set_value('end_date'),
		);
		$this->data['title'] = array(
			'name'  => 'title',
			'id'    => 'title',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('page_title'),
		);
		$this->data['description'] = array(
			'name'  => 'description',
			'id'    => 'description',
			'type'  => 'textarea',
			'value' => $this->form_validation->set_value('description'),
		);
		$this->data['role'] = array(
			'name'  => 'role',
			'id'    => 'role',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('role'),
		);

		return $this->data;
	}
}
