<?php

class Test_controller extends CI_Controller {

	/* See main controller for more help - Javier */

	public function index() {
		$this->load->helper('url_helper');
		$this->load->view('test-view');
	}

}