<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct() {
   		parent::__construct();
   		$this->load->library('session');
   		$this->load->helper('captcha');       
 	}
	public function index() {
		$data = array();
		$data['pagename'] = "home";
		if( $this->session->has_userdata('msg') ){
			$data['msg'] = $this->session->userdata( 'msg' );
			$this->session->unset_userdata( 'msg' );
		}
		else {
			$data['msg'] = "";
		}
		$random_number = substr(number_format(time() * rand(),0,'',''),0,6);
		$vals = array(
			'word' => $random_number,
			'img_path' => './captcha/',
			'img_url' => 'captcha/',
			'img_width' => 200,
			'img_height' => 50,
			'expiration' => 7200,
			'class' => 'cicapimage'
        );
        $data['captcha'] = create_captcha($vals);
        //print_r( $data['captcha'] );
      	$this->session->set_userdata('captchaWord',$data['captcha']['word']);
		$this->load->view('home', $data);
	}
}
