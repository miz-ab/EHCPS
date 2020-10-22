<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

  class Employee_model extends CI_Model {
      public function __construct(){
      	parent::__construct();
          $this->load->database();
      }


      public function load_region(){
         $query = $this->db->get('region_table');
         return $query->result_array();
    }

    public function dependent_load_zone($id){
      $this->db->where('region_id',$id);
      $this->db->order_by('zone_name','ASC');
      $query = $this->db->get('zone_table');
      $output = '<option value="">Select Zone</option>';

      foreach ($query->result() as $row) {
        $output .= '<option value="'.$row->zone_id.'">'.$row->zone_name.'</option>';
      }
      return $output;
    }

    public function dependent_load_woreda($id){
      $this->db->where('zone_id',$id);
      $this->db->order_by('woreda_name','ASC');
      $query = $this->db->get('woreda_table');
      $output = '<option value="">Select Woreda</option>';

      foreach ($query->result() as $row) {
        $output .= '<option value="'.$row->woreda_id.'">'.$row->woreda_name.'</option>';
      }
      return $output;
    }

    public function dependent_load_kebele($id){
      $this->db->where('woreda_id',$id);
      $this->db->order_by('kebele_name','ASC');
      $query = $this->db->get('kebele_table');
      $output = '<option value="">Select kebele</option>';

      foreach ($query->result() as $row) {
        $output .= '<option value="'.$row->kebele_id.'">'.$row->kebele_name.'</option>';
      }
      return $output;
    }

    public function get_last_user_from_db(){
    	$query = $this->db->query("SELECT * FROM employee_table ORDER BY emp_id DESC LIMIT 1");
    	return $query->row();
    }
    
    public function logic_employee_registration_one($data){
    	$query = $this->db->insert('employee_table',$data);
    }

    public function logic_ac_admin_registration_one($data){
      $query = $this->db->insert('employee_table',$data);
    }

    public function logic_employee_registration_last($data){
      $query = $this->db->insert('user_address_table',$data);
    }

    //Bete Begin

    public function language_data($langData){
      $query = $this->db->insert('language_setting',$langData);
    }

    public function register_region_model($data){
      $query = $this->db->insert('region_table',$data);
    }

    public function register_zone_model($data){
      $query = $this->db->insert('zone_table',$data);
    }

    public function register_woreda_model($data){
      $query = $this->db->insert('woreda_table',$data);
    }

    public function register_kebele_model($data){
      $query = $this->db->insert('kebele_table',$data);
    }

    public function check_user_username_exists($username){
      $query = $this->db->get_where('employee_table',array('employee_table.username' => $username));
        if(empty($query->row_array())){
            return true;
        }else {
            return false;
        }
    }

    function federal_instruction_announcement_model($data){            
        
      $this->db->insert('instruction_announcement_table',$data);                        

  }

  function list_of_instruction_model(){

    $user_id = $this->session->userdata('user_id');
    $user_region_id = $this->session->userdata('user_region_id');
    $query = $this->db->query("SELECT title, 
                                      body,
                                      i_a_t.date,
                                      roll,
                                      attachment                                      
     FROM instruction_announcement_table i_a_t, user_address_table u_a_t, employee_table e_t where 
     i_a_t.rd_id = '$user_region_id' and u_a_t.emp_id = '$user_id' and e_t.emp_id = i_a_t.federal_id 
     ORDER BY id DESC");

   return $query->result_array();
 }

    function list_of_employee_model(){

      $user_region_id   = $this->session->userdata('user_region_id');
      

       $query = $this->db->query("SELECT first_name, 
                                         middle_name,
                                         roll,
                                         username,
                                         status
        FROM employee_table e_t, user_address_table u_a_t WHERE e_t.roll != 'AC_Admin' AND e_t.roll != 'RD' AND e_t.roll != 'registrar' AND e_t.roll != 'FHRA' AND e_t.roll != 'FHSA' AND e_t.roll != 'FTDD' AND e_t.emp_id = u_a_t.emp_id AND u_a_t.region_id = '$user_region_id'");

      return $query->result_array();
    }

    function list_of_icadmin_model(){

      $user_region_id   = $this->session->userdata('user_region_id');
      

       $query = $this->db->query("SELECT first_name, 
                                         middle_name,
                                         roll,
                                         username,
                                         status
        FROM employee_table e_t, user_address_table u_a_t WHERE e_t.roll = 'AC_Admin' AND e_t.roll != 'RD' AND e_t.emp_id = u_a_t.emp_id AND u_a_t.region_id = '$user_region_id'");

      return $query->result_array();
    }

    function roll_management_model($username,$data){            
        
        $this->db->where('username',$username);
        if($this->db->update('employee_table',$data))
        {            
          return true;
        }
        return false;                                

    }

    function status_management_model($username,$data){            
        
        $this->db->where('username',$username);
        if($this->db->update('employee_table',$data))
        {            
          return true;
        }
        return false;                                

    }

    function user_profile_model($empID){    
      

       $query = $this->db->query("SELECT first_name, 
                                         middle_name,
                                         roll,
                                         username,
                                         email,
                                         user_photo
        FROM employee_table WHERE emp_id = '$empID'");

      return $query->row_array();
    }

    function change_profile_picture_model($empID,$data){            
        
        $this->db->where('emp_id',$empID);
        if($this->db->update('employee_table',$data))
        {            
          return true;
        }
        return false;                                

    }

    function change_email_model($empID,$data){            
        
        $this->db->where('emp_id',$empID);
        if($this->db->update('employee_table',$data))
        {            
          return true;
        }
        return false;                                

    }

    public function old_password_model($empID,$oldpass) {

        $this->db->where('emp_id',$empID);
        $this->db->where('password',$oldpass);        
        $result = $this->db->get('employee_table');
        if($result->num_rows()>0){
             return true;

        }else {
            return false;
        }
        
    }

    function change_password_model($empID,$data){            
        
        $this->db->where('emp_id',$empID);
        if($this->db->update('employee_table',$data))
        {            
          return true;
        }
        return false;                                

    }

    //Bete End

  } //end of class