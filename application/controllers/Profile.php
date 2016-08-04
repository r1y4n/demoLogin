<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	function __construct() {
   		parent::__construct();
   		$this->load->library('session');
   		//$this->load->helper('captcha'); 
   		$this->load->helper(array('form', 'url', 'captcha'));      
 	}
	public function index() {
		$data = array();
		$data['pagename'] = "profile";
		if( $this->session->has_userdata('loggedIn') ) {
			if( $this->session->has_userdata('msg') ){
				$data['msg'] = $this->session->userdata( 'msg' );
				$this->session->unset_userdata( 'msg' );
			}
			else {
				$data['msg'] = "";
			}
			$data['userData'] = $this->session->userdata('loggedIn');
			$this->load->view('profile', $data);
		}
		else {
			redirect( 'home' );
		}
	}
}
