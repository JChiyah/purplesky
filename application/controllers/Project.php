<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('Base.php');
class Project extends Base {

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
	 * Adds a project dashboard entry
	 * Call from a form post using AJAX
	 *
	 * @param project notification form
	 * @author JChiyah
	 */
	public function add_dashboard_entry() {
		// get and format input
		$user_id = $this->session->userdata('user_id');
		$project_id = $this->input->post('project_id');
		$description = $this->parse_input($this->input->post('description'));

		if($this->Project_model->add_dashboard_entry($user_id, $project_id, $description)) {
			$data['dashboard_entries'] = $this->Project_model->get_project_dashboard($project_id);
			return $this->load->view('displays/project-dashboard-entries.php', $data);
		} else {
			echo 'Error adding activity';
		}
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
			if($location == 0 && !$start_date && !$end_date && !$keyword) {
				echo '<p>Please, fill out some filters to search</p>';
				return ;
			}
			$filters = array();

			if(isset($start_date) && $start_date) {
				$filters['start_date'] = $start_date;
			}
			if(isset($end_date) && $end_date) {
				$filters['end_date'] = $end_date;
			}
			if(isset($location) && $location && $location != 0) {
				$filters['location'] = $location;
			}

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
		if(!isset($result) || !$result)  {
			// If we are here it means there were no results

			echo '<p>Nothing matches your search. Try to broaden your criteria.</p>';
			echo '<br/><h2>Other Recommended Projects:</h2><hr>';

			// Perform a "recommended search"

			if(!isset($filters['location']) || !$filters['location']) { // No location

				// Get user location
				$location = $this->User_model->get_user_location_id($this->ion_auth->user()->row()->id);

				if(isset($location) && $location) {
					$filters['location'] = $location;
				} else {
					$filters['location'] = 1; // Default -> Edinburgh
				}
			}

			$result = $this->Project_model->search_projects('', $filters, 5);

			if(!isset($result) || !$result)  {

				$location = $this->User_model->get_user_location_id($this->ion_auth->user()->row()->id);
				
				$result = $this->Project_model->search_projects($keyword, array('location' => $location), 5);

			}
			
		}

		// Print results
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
							<button>View</button>
						</div>
					</div>
				</a>';
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

		// Check user is logged in
		if (!$this->ion_auth->logged_in()) {
			redirect('index');
		}

		// Check if user has privileges to access this page
		if(!in_array(2, $_SESSION['access_level'])) {
			redirect('index');
		}

		// Setting validation rules
		$this->form_validation->set_rules('title', 'title', 'required|trim|min_length[3]|alpha_numeric_spaces');
		$this->form_validation->set_rules('description', 'description', 'required|trim|min_length[3]|max_length[250]|alpha_numeric_spaces');
		$this->form_validation->set_rules('start_date', 'start date', 'trim|exact_length[10]|callback_check_date');
		$this->form_validation->set_rules('end_date', 'end date', 'trim|exact_length[10]|callback_check_date');
		$this->form_validation->set_rules('location', 'location', 'is_natural_no_zero', array( 'is_natural_no_zero' => 'You have to assign a location for the project'));
		
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
				'min'	=> date('Y-m-d', strtotime('tomorrow')),
				'max'	=> '2024-12-30',
				'value' => $this->form_validation->set_value('start_date')
			);
			$this->data['end_date'] = array(
				'name'  => 'end_date',
				'id'    => 'end_date',
				'required' => 'required',
				'min'	=> date('Y-m-d', time()+172800),
				'max'	=> '2024-12-31',
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
				'value' => '1',
			);
			$this->data['high_priority'] = array(
				'name'  => 'priority',
				'id'    => 'high',
				'value' => '2',
			);

			/*
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
			*/
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
	// "/(0[1-9]|[1-2][0-9]|3[0-1]\/(0[1-9]|1[0-2])\/^[0-9]{4})$/"
	public function check_date($date) {
		$regex = "/([0-9]{4}-(0[1-9]|1[0-2])-0[1-9]|[1-2][0-9]|3[0-1])$/";

		if(preg_match($regex, $date)) {
			// Date is now yyyy-mm-dd
			// Using checkdate(mm, dd, yyyy)
			$date_arr = explode('-', $date);
			if(count($date_arr) == 3) {
				if(checkdate($date_arr[1], $date_arr[2], $date_arr[0])) {
					return TRUE;
				}
			}
		}
		$this->form_validation->set_message('check_date', "The {field} is not a valid date");
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