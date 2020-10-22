<?php


  class Setting_model extends CI_Model {
      public function __construct(){
      	parent::__construct();
          $this->load->database();
      }

      public function current_lang_setting(){
      	if($this->session->userdata('user_id')){
      	   $user_id = $this->session->userdata('user_id');
      	   $this->db->where('user_id', 1);
      	   $res = $this->db->get('language_setting')->row_array();
      	 if($res['lang'] == '1'){
      	 	return true;
      	 }else{
      	 	return false;
      	 }

      	}else{
      		return false;
      	}
      	 

      }

      public function load_language(){
      	
      	if($this->current_lang_setting()){
      		$this->lang->load('amharic','amharic');
      	}else{
      		$this->lang->load('english','english');
      	}

      }
  }