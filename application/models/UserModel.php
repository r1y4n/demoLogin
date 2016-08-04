<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    function __construct() {
        parent::__construct();                
    }

    public function insertUser( $userData ) { 
    	$string = array(
        	'id' => '',
            'f_name' => $userData['form-first-name'],
            'l_name' => $userData['form-last-name'],
            'email' => $userData['form-email'],
            'mobile' => $userData['form-mobile'],
            'dob' =>$userData['form-dob'],
            'nationality' =>$userData['form-nationality'],
            'gender' =>$userData['form-gender'],
            'creation_time' => date( 'Y-m-d H:i:s' ),
        );
        $q = $this->db->insert_string( 'user', $string );             
        $this->db->query( $q );

        $this->db->select_max( 'id' );
		$q = $this->db->get( 'user' );
		$row = $q->row();
        return $row->id; 
    }

    public function addLoginCredentials( $userData, $userID, $credentials ) {
    	$string = array(
    		'id' => '',
    		'user_id' => $userID,
    		'username' => $credentials['username'],
    		'password' => SHA1( $credentials['password'] ),
    		'email' => $userData['form-email'],
    		'last_login' => date( 'Y-m-d H:i:s' )
    	);
    	$q = $this->db->insert_string( 'login', $string );             
        $this->db->query( $q );
        if( $this->db->affected_rows() == 1 ) {
        	return TRUE;
        }
        else {
        	return FALSE;
        }
    }

    public function isDuplicateEmail( $email ) {     
        $this->db->get_where( 'user', array( 'email' => $email ), 1 );
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;         
    }  
    
    public function isValidUser( $username, $password ) {
    	$this->db->select( 'user_id' );
    	$this->db->where( array( 'username' => $username, 'password' => SHA1( $password ) ) );
    	$query = $this->db->get( 'login' );
    	if( $this->db->affected_rows() == 1 ) {
    		$row = $query->row();
    		$data = array(
		        'last_login' => date( 'Y-m-d H:i:s' )
			);
			$this->db->where( 'id', $row->user_id );
			$this->db->update( 'login', $data );
    		return $row->user_id;
    	}
    	else {
    		return FALSE;
    	}
    }

    public function getUserData( $userID ) {
		$q = $this->db->get_where( 'user', array( 'id' => $userID ) );
    	$row = $q->row();
    	$data = array();
    	//print_r( $rows );
    	//echo $rows->id;
    	//echo $rows->f_name;
    	//foreach( $rows as $row ) {
    		//echo $row;
    		$data['userID'] = $row->id;
	    	$data['fname'] = $row->f_name;
	    	$data['lname'] = $row->l_name;
	    	$data['email'] = $row->email;
	    	$data['mobile'] = $row->mobile;
	    	$data['nationality'] = $row->nationality;
	    	$data['gender'] = $row->gender;

	    	$dobt = new DateTime( trim( $row->dob ) );
	    	$data['dob'] = $dobt->format( 'd F Y' );

	    	$dobt = new DateTime( trim( $row->creation_time ) );
	    	$data['creation_time'] = $dobt->format( 'd F Y h:i:s A' );
	    //}
	    //print_r( $data );
    	return $data;
    }
} 