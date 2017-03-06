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



}