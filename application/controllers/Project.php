<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language','form'));
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
				echo '<a class="container-fluid project-result" href="dashboard/' . $project->project_id . '">
						<div class="row">
							<h3 class="col-md-8">' . $project->title . '</h3>
							<span class="col-md-4 date">' . date('d/m/Y', strtotime($project->start_date)) . ' - ' . date('j/n/Y', strtotime($project->end_date)) . '</span>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-10">
								<h5>' . $project->manager . '</h5>
								<p class="description">' . $project->description . '</p>
							</div>
							<div class="col-md-2">
								<p class="location"><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> ' . $project->location . '</p>
								<button>Apply</button>
							</div>
						</div>
					</a>';
			}
		}
	}

	/**
	 * Creates a new project or the form to do so
	 *
	 * @param post('title')
	 * @param post('description')
	 * @param post('start_date')
	 * @param post('end_date')
	 * @param post('location')
	 * @param post('priority')
	 * @author JChiyah
	 */
	public function create_project() {
		
		$user_id = $this->ion_auth->user()->row()->id;

		// Check if user has privileges to access this page
		$user_groups = $this->ion_auth->get_users_groups($user_id)->row();
		if($user_groups->id != 1 && $user_groups->id != 2) {
			redirect('index');
		}
		// Second check just in case...
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('index');
		}

		// Setting validation rules
		$this->form_validation->set_rules('title', 'Project title', 'required|trim|min_length[3]|alpha_numeric_spaces');
		$this->form_validation->set_rules('description', 'Project description', 'required|trim|min_length[3]|max_length[250]|alpha_numeric_spaces');
		$this->form_validation->set_rules('start_date', 'Project start date', 'callback_check_date');
		$this->form_validation->set_rules('end_date', 'Project end date', 'callback_check_date');
		$this->form_validation->set_rules('location', 'Location', 'is_natural_no_zero', array( 'is_natural_no_zero' => 'The project location is not valid.'));
		
		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['title'] = array(
				'name'  => 'title',
				'id'    => 'title',
				'required' => 'required',
				'value' => $this->form_validation->set_value('title')
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'required' => 'required',
				'value' => $this->form_validation->set_value('description')
			);
			$this->data['start_date'] = array(
				'name'  => 'start_date',
				'id'    => 'start_date',
				'required' => 'required',
				'value' => $this->form_validation->set_value('start_date')
			);
			$this->data['end_date'] = array(
				'name'  => 'end_date',
				'id'    => 'end_date',
				'required' => 'required',
				'value' => $this->form_validation->set_value('end_date')
			);
			$this->data['location'] = array(
				'name'  => 'location',
				'id'    => 'location',
				'required' => 'required',
				'value' => $this->form_validation->set_value('location')
			);
			$this->data['normal_priority'] = array(
				'name'  => 'priority',
				'id'    => 'normal',
				'value' => '0',
			);
			$this->data['high_priority'] = array(
				'name'  => 'priority',
				'id'    => 'high',
				'value' => '1',
			);

			// Staff allocation
			$this->data['skill_select'] = array(
				'name'  => 'skill_select',
				'id'    => 'skill_select'
			);
			$this->data['staff_start_date'] = array(
				'name'  => 'staff_start_date',
				'id'    => 'staff_start_date',
				'value' => $this->form_validation->set_value('start_date')
			);
			$this->data['staff_end_date'] = array(
				'name'  => 'staff_end_date',
				'id'    => 'staff_end_date',
				'value' => $this->form_validation->set_value('end_date')
			);
			$this->data['staff_name'] = array(
				'name'  => 'staff_name',
				'id'    => 'staff_name',
				'value' => $this->form_validation->set_value('staff_name')
			);
			$this->data['skills'] = $this->System_model->get_skills();

			$this->data['locations'] = $this->System_model->get_locations();
			$this->data['manager'] = $this->User_model->get_user_by_id($user_id)->name;
			// render
			$this->data['page_body'] = 'create-project';
			$this->data['page_title'] = 'Create project';
			$this->data['page_description'] = 'Enter new project details';

			$this->session->set_flashdata('message', $this->ion_auth->messages());
			$this->load->view('html', $this->data);
		}
		else
		{

			$project_info = array(
				'title'			=> $this->parse_input($this->input->post('title')),
				'description' 	=> $this->parse_input($this->input->post('description')),
				'priority'		=> $this->input->post('priority'),
				'location'		=> $this->input->post('location'),
				'budget' 		=> 850,
				'start_date' 	=> $this->input->post('start_date'),
				'end_date'		=> $this->input->post('end_date')
			);

			$staff = $this->input->post('allocated_staff'); // Array of strings
			if(isset($staff) && $staff) {
				$staff = $this->parse_allocated_staff($staff);
			} else {
				$staff = FALSE;
			}

			$project = $this->Project_model->create_project($user_id, $project_info, $staff);

			if (isset($project))
			{
				//if the project was successfully created
				redirect('dashboard/' . $project, 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('create-project', 'refresh');
			}
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

	/**
	 * Helper function to check if it is a valid date
	 *
	 * @param $date
	 * @author JChiyah
	 */
	public function check_date($date) {
		if(preg_match("/(0[1-9]|[1-2][0-9]|3[0-1]\/(0[1-9]|1[0-2])\/^[0-9]{4})$/", $date)) {
			// Date is now yyyy-mm-dd
			// Using checkdate(mm, dd, yyyy)
			$date_arr = explode('-', $date);
			if(count($date_arr) == 3) {
				if(checkdate($date_arr[1], $date_arr[2], $date_arr[0])) {
					return TRUE;
				}
			}
		}
		$this->form_validation->set_message('check_date', 'The {field} is not a valid date.');
        return FALSE;
	}

	/**
	 * Helper function to parse allocated staff information
	 *
	 * @param $staff (array os strings)
	 * @return array of arrays (3D array :-P)
	 * @author JChiyah
	 */
	public function parse_allocated_staff($staff) {
		if(!is_array($staff)) {
			return FALSE;
		}

		$allocated_staff = array();
		foreach ($staff as $string) {
			$tmp = explode(',', $string);

			$data = array(
				'id'			=> $tmp[0],
				'start_date'	=> $tmp[1],
				'end_date'		=> $tmp[2]
			);

			$tmp = explode('|', $tmp[3]); // Array of skills
			$data['skills'] = $tmp;

			if(sizeof($data) == 4) {
				array_push($allocated_staff, $data);
			}
		}
		return $allocated_staff;

	}


}