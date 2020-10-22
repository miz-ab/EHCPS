<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

  class Login_model extends CI_Model {
      public function __construct(){
      	parent::__construct();
          $this->load->database();
      }

      public function api_login_as_employee($username,$password){

      	$this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('status','active');
        $result = $this->db->get('employee_table');
        if($result->num_rows() == 1){
            return $result->row(0)->emp_id.".".$result->row(0)->flag.".".$result->row(0)->username.".".$result->row(0)->user_photo;
        }else {
            return false;
        }

      }// end of api_login_as_employee

      public function api_login_as_guider($username,$password){

      	$this->db->where('username',$username);
        $this->db->where('password',$password);
        $result = $this->db->get('tour_guider_table');
        if($result->num_rows() == 1){
            return $result->row(0)->tour_guider_id.".".$result->row(0)->flag.".".$result->row(0)->username.".".$result->row(0)->photo;
        }else {
            return false;
        }

      }//end of api_login_as_guider

      public function api_login_as_tourist($username,$password){

      	$this->db->where('username',$username);
        $this->db->where('password',$password);
        $result = $this->db->get('tourist_table');
        if($result->num_rows() == 1){
            return $result->row(0)->tour_id.".".$result->row(0)->flag.".".$result->row(0)->username.".".$result->row(0)->photo;
        }else {
            return false;
        }	
      }// end api_login_as_tourist

      public function login_as_emp($username,$password) {

        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $this->db->where('status','active');
        //$this->db->where('status',$status);
        $result = $this->db->get('employee_table');
        if($result->num_rows() == 1){
             $user_id = $result->row(0)->emp_id;
             //$result->row(0)->emp_id.".".$result->row(0)->roll.".".$result->row(0)->user_photo;

             $rid = $this->user_region_id($user_id);
             $zid = $this->user_zone_id($user_id);
             $wid = $this->user_woreda_id($user_id);
             $kid = $this->user_kebele_id($user_id);


             $r_name = $this->user_region_name($rid); //get the value and retun to set session
             $z_name = $this->user_zone_name($zid);
             $w_name = $this->user_woreda_name($wid);
             $k_name = $this->user_kebele_name($kid);

            return $result->row(0)->emp_id.".".$result->row(0)->roll.
                              ".".$result->row(0)->user_photo.".".
                              $rid.".".$zid.".".$wid;

        }else {
            return false;
        }
        
    }

    //load user region id 

    function user_region_id($user_id){
      $query = $this->db->query("SELECT region_id FROM user_address_table WHERE emp_id = '$user_id'");
      return $query->row()->region_id;
    }

    function user_zone_id($user_id){
      $query = $this->db->query("SELECT zone_id FROM user_address_table WHERE emp_id = '$user_id'");
      return $query->row()->zone_id;
    }

    function user_woreda_id($user_id){
      $query = $this->db->query("SELECT wereda_id FROM user_address_table WHERE emp_id = '$user_id'");
      return $query->row()->wereda_id;
    }

    function user_kebele_id($user_id){
      $query = $this->db->query("SELECT kebele_id FROM user_address_table WHERE emp_id = '$user_id'");
      return $query->row()->kebele_id;
    }

    function user_region_name($user_region_id){
      $query = $this->db->query("SELECT region_name FROM region_table WHERE region_id = '$user_region_id'");
      return $query->row()->region_name;
    }

    function user_zone_name($user_zone_id){
      $query = $this->db->query("SELECT zone_name FROM zone_table WHERE zone_id = '$user_zone_id'");
      return $query->row()->zone_name;
    }

    function user_woreda_name($user_woreda_id){
      $query = $this->db->query("SELECT woreda_name FROM woreda_table WHERE woreda_id = '$user_woreda_id'");
      return $query->row()->woreda_name;
    }

    function user_kebele_name($user_kebele_id){
      $query = $this->db->query("SELECT kebele_name FROM kebele_table WHERE kebele_id = '$user_kebele_id'");
      return $query->row()->kebele_name;
    }

    //for ajax request 

    public function authenticate_user($username,$password){
      $this->db->where('username',$username);
        $this->db->where('password',md5($password));
        $result = $this->db->get('employee_table');
        if($result->num_rows() == 1){
            //return true;
            return $result->row(0)->emp_id;
        }else {
            return false;
        }
    }

    public function load_language_val($user_id){
      $query = $this->db->query("SELECT * FROM language_setting WHERE user_id = '$user_id'");
      return $query->row_array();
    }

    public function current_lang_val($user_id){
      $query = $this->db->query("SELECT * FROM language_setting WHERE user_id = '$user_id'");
      return $query->row_array();
    }

    public function set_lang_setting(){
      //die($this->input->post('lang'));
      $data = array(
     'lang' =>  $this->input->post('lang')
      );

      $this->db->where('user_id',$this->session->userdata('user_id'));
        $this->db->update('language_setting',$data);
     
      
    }



  }