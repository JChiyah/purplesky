<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language'));
		//$this->load->model("System_model");
		//$this->load->model("User_model");
		$this->load->model("Project_model");

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Searches for projects
	 * Call from a form post using AJAX
	 *
	 * @param post('keyword')
	 * @param post('location')
	 * @param post('start_date')
	 * @param post('end_date')
	 * @param post('filter')
	 * @author JChiyah
	 */
	public function search_projects() {
		$keyword = $this->parse_input($this->input->post('keyword'));
		$location = $this->input->post('location');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$filter = ($this->input->post('filter') === 'true');

		// find the current users id
		$user_id = $this->session->userdata('user_id');

		if($filter) { // Advanced search

			// return if location is not valid
			if($location == 0 && !$start_date && !$end_date) {
				echo '<p>Please, fill out some filters to search</p>';
				return ;
			}

			$filters = array(
				'location'		=> $location,
				'start_date'	=> $start_date,
				'end_date'		=> $end_date
			);

			$result = $this->Project_model->search_projects($keyword, $filters);

		} else {
			// Simple search -> search by keyword and no need to filter 
			if($keyword) {

				$result = $this->Project_model->search_projects($keyword);

			} else {
				echo '<p>Enter at least a keyword</p>';
				return ;
			}
		}
		
		// Check result and output appropiately
		if(isset($result) && $result)  {
			foreach($result as $project) {
				echo '<div class="project-result">
						<a href="dashboard/' . $project->project_id . '">
						<h3>' . $project->title . '</h3></a>
						<span>' . $project->manager . '</span>
						<p class="location">' . $project->location . '</p>
						<p class="date">' . $project->start_date . ' until ' . $project->end_date . '</p>
						<p class="description">' . $project->description . '</p>
						<button class="apply-button" id="apply-' . $project->project_id . '">Apply</button>
					</div>';
			}
		}
	}

	public function create_project() {
		
		// Check if user has privileges to access this page
		$user_groups = $this->ion_auth->get_users_groups($this->session->userdata('user_id'))->row();
		if($user_groups->id != 1 && $user_groups->id != 2) {
			redirect('index');
		}

		// set rules

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('index', 'refresh');
		}

		$user_id = $this->ion_auth->user()->row()->id;

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['title'] = array(
				'name'  => 'title',
				'id'    => 'title',
				'value' => $this->form_validation->set_value('title'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'value' => $this->form_validation->set_value('description'),
			);
			$this->data['start_date'] = array(
				'name'  => 'start_date',
				'id'    => 'start_date',
				'value' => $this->form_validation->set_value('start_date'),
			);
			$this->data['end_date'] = array(
				'name'  => 'end_date',
				'id'    => 'end_date',
				'value' => $this->form_validation->set_value('end_date'),
			);
			$this->data['location'] = array(
				'name'  => 'location',
				'id'    => 'location',
				'value' => $this->form_validation->set_value('location'),
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user_id,
			);

			$this->data['locations'] = $this->System_model->get_locations();
			// render
			$this->data['page_body'] = 'create-project';
			$this->data['page_title'] = 'Create project';
			$this->data['page_description'] = 'Enter new project details';
			$this->load->view('html', $this->data);
		}
		else
		{
			/*$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				redirect('profile', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				// render
				redirect('change-password', 'refresh');
			}*/
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