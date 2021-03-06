<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

	/**
	 *
	 * This controller is only for common controller functions, such as those displaying dynamic views and data
	 *
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('form_validation'));
		$this->load->helper(array('url','language'));
		$this->load->model("System_model");
		$this->load->model("User_model");
		$this->load->model("Project_model");
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
	 * Helper function to get an assigned colour for project status
	 *
	 * @param $status
	 * @author JChiyah
	 */
	protected function get_status_colour($status) {
		switch ($status) {
			case 'active':
				return 'green';
				break;
			case 'scheduled':
				return 'yellow';
				break;
			case 'finished':
				return 'blue';
				break;
			case 'delayed':
				return 'orange';
				break;
			default:
				return 'red';
				break;
		}
	} 

}