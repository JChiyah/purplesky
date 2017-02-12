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