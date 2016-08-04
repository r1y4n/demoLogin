<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticator extends CI_Controller {
	function __construct() {
   		parent::__construct();
   		parent::__construct();
        $this->load->model( 'UserModel', 'userModel', TRUE );
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper(array('form', 'url', 'captcha'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
 	}
	
	public function login() {
		$this->form_validation->set_rules('form-username', "Username", 'required');
		$this->form_validation->set_rules('form-password', "Password", 'required|callback_checkCredentials');
    	$this->form_validation->set_rules('form-captcha', "Captcha", 'required');
    	$userCaptcha = $this->input->post( 'form-captcha' );
    	$word = $this->session->userdata('captchaWord');
    	//echo $userCaptcha."<br>#".$word."#<br>";
    	if( $this->form_validation->run() == TRUE && strcmp(strtolower($userCaptcha),strtolower($word)) == 0 ) {
    		$this->session->unset_userdata('captchaWord');
    		$msg = '<div class="description alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  						<strong>Welcome!</strong> Your are successfully logged in.
					</div>';
    		$this->session->set_userdata( 'msg', $msg );
    		//echo "logged";
    		redirect( 'profile' );
    	}
    	else {
    		$msg = '<div class="description alert alert-danger alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  						<strong>Sorry!</strong> Your username and password do not match.
					</div>';
    		$this->session->set_userdata( 'msg', $msg );
    		//echo "not login";
			redirect( 'home' );
    	}

	}
	
	public function checkCredentials( $password ) {
		$username = $this->input->post( 'form-username' );
		$userID = $this->userModel->isValidUser( $username, $password );
		if( $userID != FALSE ) {
			$sessionData = $this->userModel->getUserData( $userID );
			$sessionData['username'] = $username;
			$this->session->set_userdata( 'loggedIn', $sessionData );
			return TRUE;
		}
		else {
			return FALSE;
		}
	} 

	public function register() {
		if( isset( $_POST ) ) {
			$userData = array();
			foreach( $_POST as $key => $value ) {
				if( $key == "form-dob" ) {
					$dob = new DateTime( trim( $value ) );
					$userData[$key] = $dob->format( 'Y-m-d' );
				}
				else {
					$userData[$key] = trim( $value );	
				}
				
			}
			/*echo "<pre>";
			print_r( $userData );
			echo "</pre>";*/

			if( $this->userModel->isDuplicateEmail( $userData['form-email'] ) ) {
				$msg = '<div class="description alert alert-danger alert-dismissible" role="alert">
	  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	  							<span aria-hidden="true">&times;</span>
	  						</button>
	  						<strong>Sorry!</strong> Given email address is already registered to us, use another email address.
						</div>';
			}
			else {
				$userID = $this->userModel->insertUser( $userData );
				$credentials = array();
				$credentials['username'] = $this->createUsername( $userData['form-first-name'], $userData['form-dob'] );
				$credentials['password'] = $this->generatePassword();
				echo "<pre>";
				print_r( $credentials );
				echo "</pre>";
				$isCreated = $this->userModel->addLoginCredentials( $userData, $userID, $credentials );
				if( $isCreated ) {
					if( $this->sendSuccessEmail( $userData, $credentials ) ) {
						$msg = '<div class="description alert alert-success alert-dismissible" role="alert">
			  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  							<span aria-hidden="true">&times;</span>
			  						</button>
			  						<strong>Success!</strong> You have signed up with our website. Check your email for login credentials.
								</div>';
					}
				}
				else {
					$msg = '<div class="description alert alert-danger alert-dismissible" role="alert">
		  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  							<span aria-hidden="true">&times;</span>
		  						</button>
		  						<strong>Oh snap!</strong> Something went wrong, try again after sometime.
							</div>';
				}
			}
		}
		else {
			$msg = '<div class="description alert alert-danger alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  						<strong>Oh snap!</strong> Something went wrong, try again after sometime.
					</div>';			
		}
		$this->session->set_userdata( 'msg', $msg );
		//$this->session->keep_flashdata( 'msg' );
		//echo $this->session->flashdata('msg');
		//print_r( $this->session->flashdata() );
		redirect( 'home' );
	}

	function createUsername( $fname, $dob ) {
		$fname = explode( ' ', $fname );
		$fname = strtolower( $fname[0] );
		$dob = explode( '-', $dob );
		$dob = $dob[2];
		return $fname.$dob.rand(10,99);
	}

	function generatePassword() {
		$length = 8;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr( str_shuffle( $chars ), 0, $length );
	}

	function sendSuccessEmail( $userData, $credentials ) {
		$this->load->library( 'email' );
        $this->email->from( 'r1y4n41@gmail.com', 'System Admin' );
        $this->email->to( $userData['form-email'] );
        $this->email->subject( "Demo Registration Successful" );
        $msg = "You have signed up with our website.\n\n";
        $msg = $msg . "Provided user details:\n";
        $msg = $msg . "First Name: " . $userData['form-first-name'] . "\n";
        $msg = $msg . "Last Name: " . $userData['form-last-name'] . "\n";
        $msg = $msg . "Email: " . $userData['form-email'] . "\n";
        $msg = $msg . "Mobile: " . $userData['form-mobile'] . "\n";
        $msg = $msg . "Date of Birth: " . $userData['form-dob'] . "\n";
        $msg = $msg . "Nationality: " . $userData['form-nationality'] . "\n";
        $msg = $msg . "Gender: " . $userData['form-gender'] . "\n\n";
        $msg = $msg . "Please use the following credentials for further sign in:\n";
        $msg = $msg . "Username: " . $credentials['username'] . "\n";
        $msg = $msg . "Password: " . $credentials['password'] . "\n";
        $this->email->message( $msg );
        $result = $this->email->send( FALSE );
        $this->email->print_debugger( array('headers') );
        return $result;
    }

    public function logout() {
    	$this->session->unset_userdata( 'loggedIn' );
    	redirect( 'home', 'refresh' );
    } 
}
