<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('Base.php');
class User extends Base {

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
		$user_id = $this->session->userdata('user_id');

		// send value to database
		if ($this->User_model->add_user_skill($skill, $user_id)) {
			// Print value
			return $this->display_user_skills($user_id);
		} else {
			echo 'duplicated';
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
		$user_id = $this->session->userdata('user_id');

		if($this->User_model->delete_user_skill($skill, $user_id)) {
			return $this->display_user_skills($user_id);
		}
	}

	/**
	 * Displays user' skills
	 *
	 * @param user_id
	 * @author JChiyah
	 */
	public function display_user_skills($user_id) {

		$data['user_skills'] = $this->User_model->get_user_skills($user_id);

		return $this->load->view('displays/user-skills.php', $data);
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
		$user_id = $this->session->userdata('user_id');
		$skills = $this->input->post('skills');
		
		$additional_data = array(
			'start_date' 	=> $this->input->post('start_date'),
			'end_date'		=> $this->input->post('end_date'),
			'institution'	=> $this->parse_input($this->input->post('title')),
			'description' 	=> $this->parse_input($this->input->post('description')),
			'role'			=> $this->parse_input($this->input->post('role'))
		);

		if($this->System_model->check_skills_format($skills)) {
			$additional_data['skills'] = $skills;
		}

		if($this->User_model->add_user_experiences($user_id, $additional_data)) {
			return $this->display_user_experiences($user_id);
		} else {
			echo 'Error adding experience';
		}
	}

	/**
	 * Deletes a user' experience
	 * Call from a form post using AJAX
	 *
	 * @param post('delete_experience')
	 * @author JChiyah
	 */
	public function delete_user_experience() {
		$experience_id = $this->input->post('delete_experience');

		// find the current users id
		$user_id = $this->session->userdata('user_id');

		if($this->User_model->delete_user_experience($experience_id, $user_id)) {
			return $this->display_user_experiences($user_id);
		}
	}

	/**
	 * Displays user' experiences
	 *
	 * @param $user_id
	 * @author JChiyah
	 */
	public function display_user_experiences($user_id) {

		$data['user_experiences'] = $this->User_model->get_user_experiences($user_id);

		return $this->load->view('displays/user-experiences.php', $data);
	}

	/**
	 * Gets all users with a certain skill
	 * Call from a form post using AJAX
	 *
	 * @param post('skill')
	 * @author JChiyah
	 */
	public function search_staff() {
		$skills = $this->input->post('skill');
		$project_id = $this->input->post('project_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$staff_name = $this->input->post('staff_name');
		$location = $this->input->post('location');

		$filters = array(
			'start_date'=> $start_date,
			'end_date'  => $end_date
		);

		if(isset($skills) && $skills) {
			$filters['skills'] = $skills;
		}

		if(isset($staff_name) && $staff_name) {
			$filters['name'] = $staff_name;
		}

		if(isset($location) && $location) {
			$filters['location'] = $location;
		}

		if(isset($project_id) && $project_id) {
			$filters['project_id'] = $project_id;
		}
		
		$staff = $this->User_model->search_staff($filters);

		if($staff) {

			if(isset($skills) && $skills) {

				$s = array();
				foreach($skills as $skill_id) {
					array_push($s, $this->System_model->get_skill_name($skill_id));
				}

				$data['skills'] = $s;

			}
			if(isset($staff_name) && $staff_name) {
				$tmp = array();
				foreach($staff as $s) {
					// Check whether the staff is available and the reason why
					$busy = $this->User_model->is_available($s->id, $start_date, $end_date);
					echo $s->name . " " . $busy;

					if(is_string($busy)) {
						$s = (array)$s;
						
						if($this->Project_model->is_staff($project_id, $s['id'])) {
							$s['busy'] = 'lol';
						} else {
							$s['busy'] = $busy;
						}

						$s = (object)$s;
					}
					array_push($tmp, $s);
				}

				$data['staff'] = $tmp;
			} else {
				$data['staff'] = $staff;
			}
			return $this->load->view('displays/project-staff-search.php', $data);
		}

	}

}