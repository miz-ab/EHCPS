<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

  class Guiders_model extends CI_Model {
      public function __construct(){
      	parent::__construct();
          $this->load->database();
      }

      public function api_get_all_guiders(){
          //$query = $this->db->get('tour_guider_table');
          $query = $this->db->query("SELECT * from tour_guider_table WHERE status='1'");
          return $query;
      }
      
      public function api_get_ratting_value_of_guider($id){
        //$query = $this->db->query("SELECT * from rating_table WHERE guider_id  = $id");
        //$query = $this->db->query("SELECT SUM(value) from rating_table");
        //return $query->row_array();
        $this->db->select_sum('value');
        $this->db->from('rating_table');
        $this->db->where('guider_id',$id);
        $query = $this->db->get();

        return $query->row()->value;
      }

      public function api_get_no_of_count_ratting_value($id){
        $query = $this->db->query("SELECT * from rating_table WHERE guider_id  = $id");
        if($query->num_rows() > 0){
          return $query->num_rows();
        }else{
          return 1;
        }
        
      }

      public function api_check_if_ratting_id_exist($id){
        $query = $this->db->get_where('rating_table',array('rating_table.user_id' => $id));
        if(empty($query->row_array())){
            return false;
        }else {
            return true;
        }
      }

      /*
        update the current rate value if it exist
      */

      public function api_update_ratting_value($data){
        $this->db->where('user_id',$this->input->post('user_id'));
        $result = $this->db->update('rating_table',$data);

        if($result){
          return true;
        }else{
          return false;
        }
      }

      /*
        insert new value if it dose not exist
      */

      public function api_insert_new_rate_value($full_data){
        $query = $this->db->insert('rating_table',$full_data);

        if($query){
          return true;
        }else{
          return false;
        }
      }

      public function api_update_profile($data){
        $this->db->where('tour_guider_id',$this->input->post('user_id'));
        $result = $this->db->update('tour_guider_table',$data);

        if($result){
          return true;
        }else{
          return false;
        }
      }

      public function api_get_single_guider($id){
        $query = $this->db->query("SELECT * from tour_guider_table WHERE tour_guider_id = $id");
        return $query;
      }

      // Bete Begin

      public function check_guider_username_exists_model($username){
      $query = $this->db->get_where('tour_guider_table',array('tour_guider_table.username' => $username));
        if(empty($query->row_array())){
            return true;
        }else {
            return false;
        }
      }

      public function tour_guide_registration_model($data){
      $query = $this->db->insert('tour_guider_table',$data);
    }

    // Bete End
  }