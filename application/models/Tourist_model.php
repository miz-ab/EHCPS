<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

  class Tourist_model extends CI_Model {
      public function __construct(){
      	parent::__construct();
          $this->load->database();
      }    

      // Bete Begin

      public function check_tourist_username_exists_model($username){
      $query = $this->db->get_where('tourist_table',array('tourist_table.username' => $username));
        if(empty($query->row_array())){
            return true;
        }else {
            return false;
        }
      }

      public function tourist_registration_model($data){
      $query = $this->db->insert('tourist_table',$data);
    }

    // Bete End
  }