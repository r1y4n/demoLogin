<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
   		parent::__construct();
 	}
	public function index() {
		$data = array();
		$data['pagename'] = "home";
		$this->load->view('home', $data);
	}
	public function login() {
		$this->load->view('login');
	}
	public function register() {
		$this->load->view('register');
	}
}
