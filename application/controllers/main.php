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
	public function index()
	{
		$this->load->helper('url_helper');
    
		$d['body'] = 'home';
		$d['title'] = 'Home';
		$d['des'] = 'Homepage with dashboard';
		$this->load->view('html', $d);
		//using the pdo config

		//$query = $this->db->query("SELECT * FROM account");
		//var_dump($query->result());
	}

	public function profile_view()
	{
		$d['body'] = 'profile';
		$d['title'] = 'Profile';
		$d['des'] = 'User profile';
		$this->load->view('html', $d);

	}

	public function register_view()
	{
		$d['body'] = 'register';
		$d['title'] = 'Registration';
		$d['des'] = 'Register a new user';
		$this->load->view('html', $d);

	}
}
