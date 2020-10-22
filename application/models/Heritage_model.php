<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

  class Heritage_model extends CI_Model {
      public function __construct(){
      	parent::__construct();
          $this->load->database();
      }

      //load users full address from the session 

      public function api_get_heritage(){
      	//$query = $this->db->get('heritage_table');
        $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         photo,
                                         Description,
                                         LA,
                                         LO
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO  AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND h_t.is_lost = '0'");
          return $query;
      } //get heritage

      public function api_get_single_heritage($id){
        $query = $this->db->get_where('heritage_table',array('NationalRNO' => $id));
        return $query;
    }// get single heritage

    public function api_get_promoted_heritage(){
      $query= $this->db->query("SELECT heritage_table.NationalRNO, heritage_table.Name, heritage_table.LocalName, 
        heritage_table.photo, heritage_table.Description, promot_heritage.date, promot_heritage.description_new, promot_heritage.heritage_id 
        FROM heritage_table INNER JOIN promot_heritage ON promot_heritage.heritage_id = heritage_table.NationalRNO AND promot_heritage.flag = '0'");
      return $query;
    }

    public function api_get_promoted_heritage_notification(){
      $query= $this->db->query("SELECT heritage_table.NationalRNO, heritage_table.Name, heritage_table.LocalName, 
      heritage_table.photo, heritage_table.Description, promot_heritage.date, promot_heritage.description_new, promot_heritage.heritage_id 
      FROM heritage_table INNER JOIN promot_heritage ON promot_heritage.heritage_id = heritage_table.NationalRNO AND promot_heritage.flag = '1'");
    return $query;
    }//end of all notification 
    public function api_get_promoted_heritage_single($id){
        $query = $this->db->query("SELECT heritage_table.NationalRNO, heritage_table.Name, heritage_table.LocalName,
         heritage_table.photo,heritage_table.Description, promot_heritage.description_new, 
         promot_heritage.date FROM heritage_table INNER JOIN promot_heritage ON
          promot_heritage.heritage_id = heritage_table.NationalRNO AND heritage_table.NationalRNO = '$id'");
        return $query;
    }

    public function api_update_promotion_flag(){
      $data = array(
        'flag' => '1'
        );
        $this->db->where('heritage_id',$this->input->post('promotion_id'));
        $this->db->update('promot_heritage',$data);
    }

    public function api_recommend_heritage_status($data){
       $query = $this->db->insert('tourist_recommendation_table',$data);
    }

    public function api_send_heritage_status($data){
       $query = $this->db->insert('send_heritage_status',$data);
    }

    public function check_if_user_recommend_heritage($heritage_id,$user_id){
        $this->db->where('heritage_id',$heritage_id);
        $this->db->where('user_id',$user_id);
        $result = $this->db->get('tourist_recommendation_table');
        if($result->num_rows() == 1){
            return true; 
        }else {
            return false;
        }
    }



    public function logic_register_heritage_one($data){
      $query = $this->db->insert('heritage_table',$data);
    }

    public function logic_register_heritage_three($data){
      $query = $this->db->insert('heritage_address_table',$data);
    }

    public function set_registered_by_woreda_true(){

      $empID = $this->session->userdata('user_id');
      $id = $this->session->userdata('session_NIDN');
      $data = array(
          'heritage_id'               => $id,
          'approved_by_woreda'        => $empID,
          'approved_by_zone'          => '0',
          'approved_by_region'        => '0'
        );

      $query = $this->db->insert('heritage_approved_by',$data);
    }

    //...............................

    public function load_region(){
         $query = $this->db->get('region_table');
         return $query->result_array();
    }
    public function load_zone(){
         $query = $this->db->get('zone_table');
         return $query->result_array();
    }
    public function load_woreda(){
         $query = $this->db->get('woreda_table');
         return $query->result_array();
    }

    public function load_all_possible_kebele(){
        $user_woreda_id = $this->session->userdata('user_woreda_id');
        $query = $this->db->query("SELECT * FROM kebele_table WHERE woreda_id = '$user_woreda_id'");
        return $query->result_array();
    }

    public function dependent_load_zone($id){
      $this->db->where('region_id',$id);
      $this->db->order_by('zone_name','ASC');
      $query = $this->db->get('zone_table');
      $output = '<option value="Select_Zone">Select Zone</option>';

      foreach ($query->result() as $row) {
        $output .= '<option value="'.$row->zone_id.'">'.$row->zone_name.'</option>';
      }
      return $output;
    }

    public function dependent_load_woreda($id){
      $this->db->where('zone_id',$id);
      $this->db->order_by('woreda_name','ASC');
      $query = $this->db->get('woreda_table');
      $output = '<option value="Select_Woreda">Select Woreda</option>';

      foreach ($query->result() as $row) {
        $output .= '<option value="'.$row->woreda_id.'">'.$row->woreda_name.'</option>';
      }
      return $output;
    }

    public function dependent_load_kebele($id){
      $this->db->where('woreda_id',$id);
      $this->db->order_by('kebele_name','ASC');
      $query = $this->db->get('kebele_table');
      $output = '<option value="Select_Kebele">Select Kebele</option>';

      foreach ($query->result() as $row) {
        $output .= '<option value="'.$row->kebele_id.'">'.$row->kebele_name.'</option>';
      }
      return $output;
    }

    function load_region_name($id){
      
        $this->db->where('region_id',$id);
        $query = $this->db->get('region_table');

        foreach($query->result() as $row){
          $output = $row->region_name;
        }
        return $output;
        
    }

    function load_zone_name($id){
      
        $this->db->where('zone_id',$id);
        $query = $this->db->get('zone_table');

        foreach($query->result() as $row){
          $output = $row->zone_name;
        }
        return $output;
        
    }


    function load_woreda_name($id){
      
        $this->db->where('woreda_id',$id);
        $query = $this->db->get('woreda_table');

        foreach($query->result() as $row){
          $output = $row->woreda_name;
        }
        return $output;
        
    }


    function load_kebele_name($id){
      
        $this->db->where('kebele_id',$id);
        $query = $this->db->get('kebele_table');
        $output = '';

        foreach($query->result() as $row){
          $output = $row->kebele_name;
        }
        return $output;
        
    }

    //.................................
    //ajax request 
    //check if heritage id is exist
    public function check_heritage_id_exists($id){

      $query = $this->db->get_where('heritage_table',array('heritage_table.NationalRNO' => $id));
        if(empty($query->row_array())){
            return true;
        }else {
            return false;
        }
        
    } //end of func check heritage status

    function get_heritage_id_value($heritage_id){      
      $query = $this->db->query("SELECT Name,photo,Description                                                                   
        FROM heritage_table h_t, heritage_approved_by h_a_b, heritage_address_table h_a_t
        WHERE h_t.NationalRNO = h_a_b.heritage_id AND h_t.NationalRNO = h_a_t.heritage_id 
        AND h_a_b.approved_by_region !='0' AND regional_approval_status = 'Approved' AND h_t.is_lost = '0' AND h_t.NationalRNO = '$heritage_id'");
      if(empty($query->row())){
        return false;
      }else{
        return $query->row()->Name."`".$query->row()->photo."`".$query->row()->Description;
      }
    }

    // Bete Model Begin

    public function load_heritage_to_update_model($heritage_to_update_id){
      $query = $this->db->query("SELECT h_t.NationalRNO,
                                        h_t.Name,
                                        h_t.LocalName,
                                        h_t.Category,
                                        h_t.CatalogNO,
                                        h_t.Aboundance,
                                        h_t.photo,
                                        h_t.Ownership,
                                        h_t.DateOfAquistion,
                                        h_t.description,
                                        h_t.SiteName,
                                        h_t.SiteCode,
                                        h_t.LA,
                                        h_t.LO,
                                        r.region_name,
                                        z.zone_name,
                                        w.woreda_name,
                                        k.kebele_name
       FROM heritage_table h_t, heritage_address_table h_a_t, region_table r, zone_table z, woreda_table w, kebele_table k WHERE h_t.NationalRNO = '$heritage_to_update_id' AND h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = r.region_id AND h_a_t.zone_id = z.zone_id AND h_a_t.woreda_id = w.woreda_id AND k.kebele_id");

      return $query->row_array();
    }

    function update_heritage_model($id,$data,$dataa){            
  
      

        $this->db->where('NationalRNO',$id);
        if($this->db->update('heritage_table',$data))
        {
            $this->db->where('heritage_id',$id);
           if($this->db->update('heritage_address_table',$dataa))
             return true;
        }
        return false;                                

    }

    public function list_of_heritage_category(){
       $query = $this->db->get('heritage_category');
       return $query->result_array();        
    }

    public function category_model(){

      $query = $this->db->query("SELECT category_name                                                                   
            FROM heritage_category ORDER BY category_name ASC");
          return $query;
    } 
    
     public function dependent_heritage_id_model($empID){

      $user_woreda_id     = $this->session->userdata('user_woreda_id');
      $user_zone_id       = $this->session->userdata('user_zone_id');
      $user_region_id     = $this->session->userdata('user_region_id');

      $query = $this->db->query("SELECT NationalRNO,Name                                                                   
            FROM heritage_table h_t, heritage_approved_by h_a_b, heritage_address_table h_a_t
            WHERE h_t.NationalRNO = h_a_b.heritage_id AND h_t.NationalRNO = h_a_t.heritage_id 
            AND h_a_b.approved_by_region != '0' AND h_a_b.regional_approval_status = 'Approved' AND h_a_t.woreda_id = '$user_woreda_id' AND h_a_t.zone_id = '$user_zone_id' AND h_a_t.region_id = '$user_region_id' AND h_t.empID = '$empID' AND h_t.is_lost = '0' ORDER BY Name ASC");
          return $query;
    }  

    public function dependent_heritage_category_model($id){
      $this->db->where('NationalRNO',$id);
      $this->db->order_by('Name','ASC');
      $query = $this->db->get('heritage_table');

        $this->session->set_userdata('Category',$query->result()[0]->Category);      
        $output .= '<option selected value="'.$query->result()[0]->Category.'">'.$query->result()[0]->Category.'</option>';
      
      return $output;      
    }

    public function send_maintenance_request_model($data){
      $query = $this->db->insert('maintenance_request_table',$data);
    }

    public function set_maintenance_requested_by_woreda_true(){
      $emp_id = $this->session->userdata('user_id');
      $id = $this->session->userdata('requested_heritage_id');      

      $data = array(
          'heritage_id'     => $id,
          'wr_id'           => $emp_id,
          'zme_id'          => '0',
          'rme_id'          => '0',
          'rd_id'           => '0'
        );

      $query = $this->db->insert('maintenance_request_approved_by',$data);
    }

    function list_of_maintenance_request_sent_by_wr_model(){
        
      $user_woreda_id     = $this->session->userdata('user_woreda_id');
      $user_zone_id       = $this->session->userdata('user_zone_id');
      $user_region_id     = $this->session->userdata('user_region_id');      
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         LocalName,
                                         m_r_t.category,
                                         severity,
                                         m_r_a_b.zme_id,
                                         m_r_a_b.rme_id,
                                         m_r_a_b.rd_id,
                                         m_r_a_b.zme_approval_status,
                                         m_r_a_b.rme_approval_status,
                                         m_r_a_b.rd_approval_status
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.woreda_id = $user_woreda_id AND h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0'");

      return $query->result_array();
    }

    function list_of_approved_maintenance_request_for_wr_model(){
              
      $user_woreda_id     = $this->session->userdata('user_woreda_id');
      $user_zone_id       = $this->session->userdata('user_zone_id');
      $user_region_id     = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         Ownership,
                                         m_r_t.category,
                                         severity,
                                         h_t_b_m.status,
                                         m_r_a_b.rd_id
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND h_a_t.woreda_id = $user_woreda_id AND h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.rme_id != '0' AND m_r_a_b.rd_id != '0' AND m_r_a_b.rd_approval_status = 'Approved' INNER JOIN heritage_tobe_maintained_table 
        h_t_b_m ON h_t_b_m.heritage_id = m_r_a_b.heritage_id AND h_t_b_m.status = 'Scheduled'");

      return $query->result_array();
    }

    function list_of_maintenance_request_needs_approvel_by_zme_model(){
        
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         LocalName,
                                         m_r_t.category,
                                         severity
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id = '0'");

      return $query->result_array();
    }    
      
    function list_of_maintenance_request_approved_by_zme_model(){
        
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         Ownership,
                                         m_r_t.category,
                                         severity,
                                         m_r_a_b.rme_id,
                                         m_r_a_b.rd_id,
                                         m_r_a_b.zme_approval_status,
                                         m_r_a_b.rme_approval_status,
                                         m_r_a_b.rd_approval_status
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.zme_approval_status = 'Approved'");

      return $query->result_array();
    }

    function list_of_maintenance_request_rejected_by_zme_model(){
        
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         Ownership,
                                         m_r_t.category,
                                         severity                                         
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.zme_approval_status = 'Rejected'");

      return $query->result_array();
    }    

    function list_of_maintenance_request_needs_approvel_by_rme_model(){
              
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         LocalName,
                                         m_r_t.category,
                                         severity
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.rme_id = '0' AND m_r_a_b.zme_approval_status = 'Approved'");

      return $query->result_array();
    }

    function list_of_maintenance_request_approved_by_rme_model(){
              
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         Ownership,
                                         m_r_t.category,
                                         severity,                                         
                                         m_r_a_b.rd_id,
                                         m_r_a_b.zme_approval_status,
                                         m_r_a_b.rme_approval_status,
                                         m_r_a_b.rd_approval_status
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.rme_id != '0' AND m_r_a_b.rme_approval_status = 'Approved'");

      return $query->result_array();
    }

    function list_of_maintenance_request_rejected_by_rme_model(){
              
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         Ownership,
                                         m_r_t.category,
                                         severity
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.rme_id != '0' AND m_r_a_b.rme_approval_status = 'Rejected'");

      return $query->result_array();
    }

    function list_of_maintenance_request_needs_approvel_by_rd_model(){
              
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         LocalName,
                                         m_r_t.category,
                                         severity
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.rme_id != '0' AND m_r_a_b.rd_id = '0' AND m_r_a_b.rme_approval_status = 'Approved'");

      return $query->result_array();
    }

    function list_of_maintenance_request_approved_by_rd_model(){
              
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         Ownership,
                                         m_r_t.category,
                                         severity
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.rme_id != '0'AND m_r_a_b.rd_id != '0' AND m_r_a_b.rd_approval_status = 'Approved' AND m_r_a_b.is_scheduled ='0'");

      return $query->result_array();
    }

    function list_of_maintenance_request_rejected_by_rd_model(){
              
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         Ownership,
                                         m_r_t.category,
                                         severity
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.rme_id != '0'AND m_r_a_b.rd_id != '0' AND m_r_a_b.rd_approval_status = 'Rejected' AND m_r_a_b.is_scheduled ='0'");

      return $query->result_array();
    }

    function list_of_maintained_heritage_model(){
              
      $user_region_id   = $this->session->userdata('user_region_id');
        
       $query = $this->db->query("SELECT m_r_t.heritage_id, 
                                         Name,
                                         Ownership,
                                         m_r_t.category,
                                         severity,
                                         h_t_b_m.status
        FROM heritage_table h_t INNER JOIN maintenance_request_table 
        m_r_t ON h_t.NationalRNO = m_r_t.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = m_r_t.heritage_id AND 
        h_a_t.region_id = $user_region_id INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_t.heritage_id = m_r_a_b.heritage_id AND  m_r_a_b.wr_id !='0' AND m_r_a_b.zme_id != '0' AND m_r_a_b.rme_id != '0' AND m_r_a_b.rd_id != '0' AND m_r_a_b.rd_approval_status = 'Approved' INNER JOIN heritage_tobe_maintained_table h_t_b_m ON h_t_b_m.heritage_id = m_r_a_b.heritage_id AND h_t_b_m.status = 'Maintained'");

      return $query->result_array();
    }

    public function maintenance_request_detail_model($id){
      $query = $this->db->query("SELECT m_r_t.heritage_id,
                                        h_t.Name,
                                        h_t.LocalName,
                                        m_r_t.category,
                                        m_r_t.photo,
                                        h_t.Ownership,
                                        h_t.DateOfAquistion,
                                        m_r_t.description,
                                        h_t.LA,
                                        h_t.LO,
                                        m_r_t.date,
                                        m_r_t.severity,
                                        m_r_t.empID,
                                        m_r_a_b.zme_id,
                                        m_r_a_b.rme_id
       FROM heritage_table h_t INNER JOIN maintenance_request_table m_r_t ON 
       m_r_t.heritage_id = h_t.NationalRNO AND m_r_t.heritage_id = '$id' 
       INNER JOIN maintenance_request_approved_by m_r_a_b ON m_r_a_b.heritage_id = m_r_t.heritage_id");
      return $query->row_array();
    }  

      function maintenance_request_approval_info($id){
      $query = $this->db->query("SELECT wr_id,zme_id,rme_id,rd_id 
        FROM maintenance_request_approved_by WHERE heritage_id = '$id'");

      return $query->row();
    }

    function system_feedback_model($data){            
  
      $query = $this->db->insert('notification_table',$data);

    }

    function zr_feedback_model($data){            
  
      $query = $this->db->insert('notification_table',$data);

    }

    function rr_feedback_model($data1,$data2){            
  
      $query = $this->db->insert('notification_table',$data1);
      $query = $this->db->insert('notification_table',$data2);

    }

    function wr_feedback_model($data){            
  
      $query = $this->db->insert('notification_table',$data);

    }

    function zme_feedback_model($data){            
  
      $query = $this->db->insert('notification_table',$data);

    }

    function rme_feedback_model($data1,$data2){            
  
      $query = $this->db->insert('notification_table',$data1);
      $query = $this->db->insert('notification_table',$data2);

    }

    function rd_feedback_model($data1,$data2,$data3){            
  
      $query = $this->db->insert('notification_table',$data1);
      $query = $this->db->insert('notification_table',$data2);
      $query = $this->db->insert('notification_table',$data3);

    }

    function schedule_maintenance_model($data){            
  
      $query = $this->db->insert('heritage_tobe_maintained_table',$data);      

    }

    //notification attachement begin

    //zr approval attachement for wr
    public function zr_heritage_approval_attachement_for_wr($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         zone_approval_attachement
                                                                                  
        FROM heritage_approved_by WHERE heritage_id = '$heritage_id' AND approved_by_woreda = '$receiver_id' AND approved_by_zone = '$sender_id'");

      return $query->row_array();
    }

    //zr rejection attachement for wr
    public function zr_heritage_rejection_attachement_for_wr($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         zone_rejection_attachement
                                                                                  
        FROM heritage_approved_by WHERE heritage_id = '$heritage_id' AND approved_by_woreda = '$receiver_id' AND approved_by_zone = '$sender_id'");

      return $query->row_array();
    }

    //rr approval attachement for wr and zr
    public function rr_heritage_approval_attachement_for_wr_and_zr($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         regional_approval_attachement
                                                                                  
        FROM heritage_approved_by WHERE heritage_id = '$heritage_id' AND (approved_by_woreda = '$receiver_id' OR approved_by_zone = '$receiver_id') AND approved_by_region = '$sender_id'");

      return $query->row_array();
    }

    //rr rejection attachement for wr and zr
    public function rr_heritage_rejection_attachement_for_wr_and_zr($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         regional_rejection_attachement
                                                                                  
        FROM heritage_approved_by WHERE heritage_id = '$heritage_id' AND (approved_by_woreda = '$receiver_id' OR approved_by_zone = '$receiver_id') AND approved_by_region = '$sender_id'");

      return $query->row_array();
    }

    //zme maintenance request approval attachement for wr
    public function zme_mr_approval_attachement_for_wr($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         zme_approval_reason_file
                                                                                  
        FROM maintenance_request_approved_by WHERE heritage_id = '$heritage_id' AND wr_id = '$receiver_id' AND zme_id = '$sender_id'");

      return $query->row_array();
    }

    //zme maintenance request rejection attachement for wr
    public function zme_mr_rejection_attachement_for_wr($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         zme_rejection_file
                                                                                  
        FROM maintenance_request_approved_by WHERE heritage_id = '$heritage_id' AND wr_id = '$receiver_id' AND zme_id = '$sender_id'");

      return $query->row_array();
    }

    //rme maintenance request approval attachement for wr and zme
    public function rme_mr_approval_attachement_for_wr_and_zme($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         rme_approval_reason_file
                                                                                  
        FROM maintenance_request_approved_by WHERE heritage_id = '$heritage_id' AND (wr_id = '$receiver_id' OR zme_id = '$receiver_id') AND rme_id = '$sender_id'");

      return $query->row_array();
    }

    //rme maintenance request rejection attachement for wr and zme
    public function rme_mr_rejection_attachement_for_wr_and_zme($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         rme_rejection_file
                                                                                  
        FROM maintenance_request_approved_by WHERE heritage_id = '$heritage_id' AND (wr_id = '$receiver_id' OR zme_id = '$receiver_id') AND rme_id = '$sender_id'");

      return $query->row_array();
    }

    //rd maintenance request approval attachement for wr and zme and rme
    public function rd_mr_approval_attachement_for_wr_and_zme_and_rme($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         rd_approval_reason_file
                                                                                  
        FROM maintenance_request_approved_by WHERE heritage_id = '$heritage_id' AND (wr_id = '$receiver_id' OR zme_id = '$receiver_id' OR rme_id = '$receiver_id') AND rd_id = '$sender_id'");

      return $query->row_array();
    }

    //rd maintenance request rejection attachement for wr and zme and rme
    public function rd_mr_rejection_attachement_for_wr_and_zme_and_rme($heritage_id,$receiver_id,$sender_id){
      $query = $this->db->query("SELECT  
                                         rd_rejection_file
                                                                                  
        FROM maintenance_request_approved_by WHERE heritage_id = '$heritage_id' AND (wr_id = '$receiver_id' OR zme_id = '$receiver_id' OR rme_id = '$receiver_id') AND rd_id = '$sender_id'");

      return $query->row_array();
    }

    //wr maintained heritage attachement for rd
    public function wr_maintained_heritage_attachement_for_rd($heritage_id){
      $query = $this->db->query("SELECT  
                                         maintenance_confirmation_file
                                                                                  
        FROM maintained_heritage_table WHERE heritage_id = '$heritage_id'");

      return $query->row_array();
    }

    //notification attachement end

    public function detail_notification_model($heritage_id,$status,$roll){
      
      $user_id   = $this->session->userdata('user_id');      
      
       $query = $this->db->query("SELECT heritage_id, 
                                         description,
                                         n_t.date,
                                         n_t.status,
                                         n_t.roll                                         
        FROM notification_table n_t WHERE n_t.receiver_id = '$user_id' AND n_t.heritage_id = '$heritage_id' AND n_t.status = '$status' AND n_t.roll = '$roll'");

      return $query->row_array();
    }

    public function feedback_for_wr_model(){
      
      $user_id   = $this->session->userdata('user_id');      
      
       $query = $this->db->query("SELECT heritage_id, 
                                         description,
                                         n_t.date,
                                         n_t.roll,
                                         n_t.status,
                                         n_t.receiver_id,
                                         n_t.sender_id                                         
        FROM notification_table n_t WHERE n_t.receiver_id = '$user_id' AND n_t.flag = '0'");

      return $query->result();
    }

    public function count_notification_model(){
      
      $user_id   = $this->session->userdata('user_id');      
      
       $query = $this->db->query("SELECT heritage_id, 
                                         description,
                                         n_t.date                                         
        FROM notification_table n_t WHERE n_t.receiver_id = '$user_id' AND n_t.flag = '0'");

      return $query->num_rows();
    }

    public function all_notification_model($emp_id){              
      
       $query = $this->db->query("SELECT  description,
                                          status,
                                          roll,
                                          n_t.date                                                     
        FROM notification_table n_t WHERE  n_t.receiver_id = '$emp_id' ");

      return $query->result_array();
    }

    public function attachement_for_all_notification_model($emp_id){              
      
       $query = $this->db->query("SELECT  heritage_id,
                                          receiver_id,
                                          sender_id,
                                          roll,
                                          n_t.date,
                                          status                                                    
        FROM notification_table n_t WHERE  n_t.receiver_id = '$emp_id' ");

      return $query;
    }

    public function notify_not_maintained_heritage_model(){              
      
       $query = $this->db->query("SELECT heritage_id,
                                         Name, 
                                         start_date,
                                         end_date,
                                         status,
                                         scheduler_id,
                                         scheduled_date                                         
        FROM heritage_tobe_maintained_table h_t_b_m, heritage_table h_t WHERE  h_t_b_m.status = 'Scheduled' AND h_t.NationalRNO = h_t_b_m.heritage_id");

      return $query;
    }

    function notify_not_maintained_heritage(){

        $tmrw = date('Y-m-d',strtotime('-1 day'));
            //print_r($tmrw);
            $this->db->where('end_date',$tmrw);
            $this->db->where('status','Scheduled');
            $result = $this->db->get('heritage_tobe_maintained_table');

            if($result->num_rows() > 0){

              $res = $this->heritage_model->notify_not_maintained_heritage_model($tmrw);                      

              foreach($res->result_array() as $not_maintained){
                //print_r($not_maintained['end_date']);
                $data = array(
                'heritage_id' => $not_maintained['heritage_id'],
                'receiver_id' => $not_maintained['scheduler_id'],
                'sender_id'   => 'System',
                'description' => $not_maintained['Name'].' '.' is not maintained as scheduled',
                'roll'        => 'System',
                'date'        => date('Y-m-d'),
                'status'      => 'HR_not_maintained',
                'flag'        => '0'  
                ); 

                $this->heritage_model->system_feedback_model($data);

                $data1 = array(
                  'status' =>'Not_maintained' 
                );

                $this->db->where('heritage_id',$not_maintained['heritage_id']);
                $this->db->update('heritage_tobe_maintained_table',$data1);

                $data2 = array(
                  'is_maintained' =>'1' 
                );

                $this->db->where('heritage_id',$not_maintained['heritage_id']);
                $this->db->update('maintenance_request_approved_by',$data2);
              }            
            }else {
                return false;
            }
                      
          }
      
    function update_zme_approval_model($heritage_id){

             $config['upload_path'] = './assets/heritage/zme_approval_attachement';
             $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
             $config['max_size'] = '2048';
             $config['max_width'] = '2600';
             $config['max_height'] = '2000';
             $this->load->library('upload',$config);

             if(!$this->upload->do_upload()){
              $errors = array('error' => $this->upload->display_errors());              
                }else{
              $data = array('upload_data' => $this->upload->data());
              $zme_approval_attachement = $_FILES['userfile']['name'];
             }
  
      $data = array(
        'zme_id'                        => $this->session->userdata('user_id'),
        'date_zme_approved'             => date('Y-m-d'),
        'zme_approval_reason_file'      => $zme_approval_attachement,
        'zme_approval_status'           => 'Approved'
        );
        $this->db->where('heritage_id',$heritage_id);
        $this->db->update('maintenance_request_approved_by',$data);

    }

    function update_zme_rejection_model($heritage_id){

             $config['upload_path'] = './assets/heritage/zme_rejection_attachement';
             $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
             $config['max_size'] = '2048';
             $config['max_width'] = '2600';
             $config['max_height'] = '2000';
             $this->load->library('upload',$config);

             if(!$this->upload->do_upload()){
              $errors = array('error' => $this->upload->display_errors());              
                }else{
              $data = array('upload_data' => $this->upload->data());
              $zme_rejection_attachement = $_FILES['userfile']['name'];
             }
  
      $data = array(
        'zme_id'                        => $this->session->userdata('user_id'),
        'date_zme_approved'             => date('Y-m-d'),
        'zme_rejection_file'            => $zme_rejection_attachement,
        'zme_approval_status'           => 'Rejected'
        );
        $this->db->where('heritage_id',$heritage_id);
        $this->db->update('maintenance_request_approved_by',$data);

    }

    function update_rme_approval_model($id){
      $config['upload_path'] = './assets/heritage/rme_approval_attachement';
      $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
      $config['max_size'] = '2048';
      $config['max_width'] = '2600';
      $config['max_height'] = '2000';
      $this->load->library('upload',$config);

      if(!$this->upload->do_upload()){
       $errors = array('error' => $this->upload->display_errors());       
         }else{
       $data = array('upload_data' => $this->upload->data());
       $rme_approval_attachement = $_FILES['userfile']['name'];
      }


      $data = array(
        'rme_id'                        => $this->session->userdata('user_id'),
        'date_rme_approved'             => date('Y-m-d'),
        'rme_approval_reason_file'      => $rme_approval_attachement,
        'rme_approval_status'           => 'Approved'
        );
        $this->db->where('heritage_id',$id);
        $this->db->update('maintenance_request_approved_by',$data);
    }

    function update_rme_rejection_model($id){
      $config['upload_path'] = './assets/heritage/rme_rejection_attachement';
      $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
      $config['max_size'] = '2048';
      $config['max_width'] = '2600';
      $config['max_height'] = '2000';
      $this->load->library('upload',$config);

      if(!$this->upload->do_upload()){
       $errors = array('error' => $this->upload->display_errors());       
         }else{
       $data = array('upload_data' => $this->upload->data());
       $rme_rejection_attachement = $_FILES['userfile']['name'];
      }


      $data = array(
        'rme_id'                        => $this->session->userdata('user_id'),
        'date_rme_approved'             => date('Y-m-d'),
        'rme_rejection_file'            => $rme_rejection_attachement,
        'rme_approval_status'           => 'Rejected'
        );
        $this->db->where('heritage_id',$id);
        $this->db->update('maintenance_request_approved_by',$data);
    }
      
    function update_rd_approval_model($id){
      $config['upload_path'] = './assets/heritage/rd_approval_attachement';
      $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
      $config['max_size'] = '2048';
      $config['max_width'] = '2600';
      $config['max_height'] = '2000';
      $this->load->library('upload',$config);

      if(!$this->upload->do_upload()){
       $errors = array('error' => $this->upload->display_errors());       
         }else{
       $data = array('upload_data' => $this->upload->data());
       $rd_approval_attachement = $_FILES['userfile']['name'];
      }


      $data = array(
        'rd_id'                        => $this->session->userdata('user_id'),
        'date_rd_approved'             => date('Y-m-d'),
        'rd_approval_reason_file'      => $rd_approval_attachement,
        'rd_approval_status'           => 'Approved'
        );
        $this->db->where('heritage_id',$id);
        $this->db->update('maintenance_request_approved_by',$data);
    }

    function update_rd_rejection_model($id){
      $config['upload_path'] = './assets/heritage/rd_rejection_attachement';
      $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
      $config['max_size'] = '2048';
      $config['max_width'] = '2600';
      $config['max_height'] = '2000';
      $this->load->library('upload',$config);

      if(!$this->upload->do_upload()){
       $errors = array('error' => $this->upload->display_errors());       
         }else{
       $data = array('upload_data' => $this->upload->data());
       $rd_rejection_attachement = $_FILES['userfile']['name'];
      }


      $data = array(
        'rd_id'                         => $this->session->userdata('user_id'),
        'date_rd_approved'              => date('Y-m-d'),
        'rd_rejection_file'             => $rd_rejection_attachement,
        'rd_approval_status'            => 'Rejected'
        );
        $this->db->where('heritage_id',$id);
        $this->db->update('maintenance_request_approved_by',$data);
    }

    function maintained_heritage_model($data){            
  
      $query = $this->db->insert('maintained_heritage_table',$data);

    }

    function update_tobe_maintained_heritage_model($heritage_id,$data){            
  
      $this->db->where('heritage_id',$heritage_id);
      $this->db->update('heritage_tobe_maintained_table',$data);

    }
      
    public function announce_lost_heritage_model($data){


      $query = $this->db->insert('lost_heritage_table',$data);
    }
      function get_lost_heritage_name_value($heritage_id){

        $user_woreda_id   = $this->session->userdata('user_woreda_id');
        $user_zone_id     = $this->session->userdata('user_zone_id');
        $user_region_id   = $this->session->userdata('user_region_id');
      
          $query = $this->db->query("SELECT Name,photo,Description                                                                   
            FROM heritage_table h_t, heritage_approved_by h_a_b, heritage_address_table h_a_t
            WHERE h_t.NationalRNO = h_a_b.heritage_id AND h_t.NationalRNO = h_a_t.heritage_id 
            AND h_a_t.woreda_id = '$user_woreda_id' AND h_a_t.zone_id = '$user_zone_id' AND h_a_t.region_id = '$user_region_id' AND h_a_b.approved_by_region !='0' AND regional_approval_status = 'Approved' AND h_t.NationalRNO = '$heritage_id' AND h_t.is_lost = '0'");
          if(empty($query->row())){
            return false;
          }else{
            return $query->row()->Name."`".$query->row()->photo."`".$query->row()->Description;
          }
        }

        function list_of_heritage_status_model($user_region_id){
       $query = $this->db->query("SELECT s_h_s.heritage_id, 
                                         Name,
                                         LocalName,
                                         Category,
                                         s_h_s.date
        FROM heritage_table h_t INNER JOIN send_heritage_status 
        s_h_s ON h_t.NationalRNO = s_h_s.heritage_id INNER JOIN heritage_address_table 
        h_a_t ON s_h_s.heritage_id = h_a_t.heritage_id AND h_a_t.region_id = $user_region_id");

      return $query->result_array();
    }

    function list_of_promoted_heritage_model($user_region_id){
       $query = $this->db->query("SELECT p_h.heritage_id, 
                                         Name,
                                         LocalName,
                                         Ownership,
                                         Category,
                                         p_h.date
        FROM heritage_table h_t INNER JOIN promot_heritage 
        p_h ON h_t.NationalRNO = p_h.heritage_id INNER JOIN heritage_address_table 
        h_a_t ON p_h.heritage_id = h_a_t.heritage_id AND h_a_t.region_id = $user_region_id");

      return $query->result_array();
    }

    function list_of_announced_lost_heritage_for_wr_model($empID,$region_id){
       $query = $this->db->query("SELECT l_h_t.heritage_id, 
                                         heritage_name,
                                         LocalName,
                                         Category,
                                         lost_date
        FROM heritage_table h_t, lost_heritage_table l_h_t, heritage_address_table h_a_t WHERE h_t.NationalRNO = l_h_t.heritage_id AND h_a_t.heritage_id = l_h_t.heritage_id AND l_h_t.empID = '$empID' AND h_a_t.region_id = $region_id");

      return $query->result_array();
    }

    function list_of_lost_heritage_model($region_id){
       $query = $this->db->query("SELECT l_h_t.heritage_id, 
                                         heritage_name,
                                         LocalName,
                                         Category,
                                         lost_date
        FROM heritage_table h_t,lost_heritage_table l_h_t, heritage_address_table h_a_t WHERE h_t.NationalRNO = l_h_t.heritage_id AND h_a_t.heritage_id = l_h_t.heritage_id AND h_a_t.region_id = $region_id");

      return $query->result_array();
    }

    /*function list_of_lost_heritage_by_category_model($category){
       $query = $this->db->query("SELECT heritage_id, 
                                         heritage_name,
                                         LocalName,
                                         Category,
                                         lost_date
        FROM heritage_table h_t, lost_heritage_table 
        l_h_t WHERE h_t.NationalRNO = l_h_t.heritage_id AND h_t.Category = '".$category."'");

      return $query->result_array();
    }*/

    /*public function get_heritage_name($heritage_id)
      {
        $query = $this->db->query("SELECT Name                                                                  
            FROM heritage_table h_t, heritage_approved_by h_a_b, heritage_address_table h_a_t
            WHERE h_t.NationalRNO = h_a_b.heritage_id AND h_t.NationalRNO = h_a_t.heritage_id 
            AND h_a_b.approved_by_region='1' AND h_t.NationalRNO = $heritage_id");
          
            return $query->row()->Name;
      }*/

      public function heritage_status_detail_model($id){
      $query = $this->db->query("SELECT h_t.NationalRNO,
                                        e_t.first_name,
                                        h_t.Name,
                                        h_t.LocalName,
                                        h_t.CatalogNO,
                                        h_t.photo,                                        
                                        h_t.Ownership,
                                        h_t.Aboundance,
                                        h_t.DateOfAquistion ,
                                        h_t.description,                                        
                                        h_t.LA,
                                        h_t.LO                                                                 
       FROM heritage_table h_t, send_heritage_status s_h_s, employee_table e_t WHERE
       s_h_s.heritage_id = h_t.NationalRNO AND s_h_s.heritage_id = '$id' AND s_h_s.user_id = e_t.emp_id");
      return $query->row_array();
    }

      public function current_heritage_status_detail_model($id){
      $query = $this->db->query("SELECT s_h_s.heritage_id,
                                        e_t.first_name,
                                        h_t.Name,
                                        h_t.LocalName,
                                        h_t.Category,                                        
                                        s_h_s.photo,
                                        h_t.Ownership,
                                        h_t.Aboundance,
                                        h_t.DateOfAquistion ,                                        
                                        s_h_s.description,
                                        h_t.LA,
                                        h_t.LO,
                                        s_h_s.la,
                                        s_h_s.lo,
                                        s_h_s.date                                        
       FROM heritage_table h_t, send_heritage_status s_h_s, employee_table e_t WHERE
       s_h_s.heritage_id = h_t.NationalRNO AND s_h_s.heritage_id = '$id' AND s_h_s.user_id = e_t.emp_id");
      return $query->result_array();
    }


      public function lost_heritage_detail_model($id){
      $query = $this->db->query("SELECT l_h_t.heritage_id,
                                        l_h_t.heritage_name,
                                        h_t.LocalName,
                                        h_t.Category,
                                        h_t.photo,
                                        h_t.Ownership,
                                        h_t.DateOfAquistion,
                                        l_h_t.description,
                                        h_t.LA,
                                        h_t.LO,
                                        l_h_t.lost_date,
                                        l_h_t.announce_date,
                                        e_t.username
       FROM heritage_table h_t INNER JOIN lost_heritage_table l_h_t ON 
       l_h_t.heritage_id = h_t.NationalRNO AND l_h_t.heritage_id = '$id' INNER JOIN employee_table e_t ON 
       e_t.emp_id = l_h_t.empID");
      return $query->row_array();
    }

    function list_of_heritage_recommendation_model(){
       $query = $this->db->query("SELECT heritage_id, 
                                         Name,
                                         LocalName,
                                         t_r_t.category,
                                         t_r_t.date
        FROM heritage_table h_t INNER JOIN tourist_recommendation_table 
        t_r_t ON h_t.NationalRNO = t_r_t.heritage_id");

      return $query->result_array();
    }

    public function heritage_recommendation_detail_model($id){
      $query = $this->db->query("SELECT t_r_t.heritage_id,
                                        h_t.Name,
                                        h_t.LocalName,
                                        t_r_t.category,
                                        t_r_t.photo,
                                        h_t.Ownership,
                                        h_t.DateOfAquistion,
                                        t_r_t.recommendation,
                                        t_r_t.la,
                                        t_r_t.lo,
                                        t_r_t.date,
                                        t_r_t.severity
       FROM heritage_table h_t INNER JOIN tourist_recommendation_table 
        t_r_t ON 
       t_r_t.heritage_id = h_t.NationalRNO AND t_r_t.heritage_id = '$id'");
      return $query->row_array();
    }

      //Bete Model End

    function load_all_heritage_found_in_woreda(){

      $user_woreda_id   = $this->session->userdata('user_woreda_id');
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');

       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership,
                                         approved_by_zone
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id AND
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id  AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND h_a_b.regional_approval_status = 'Approved' AND h_t.is_lost = '0'");

      return $query->result_array();
    }

    function load_all_heritage_found_in_zone(){

      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');

       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership,
                                         approved_by_zone
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id  AND h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND h_a_b.regional_approval_status = 'Approved' AND h_t.is_lost = '0'");

      return $query->result_array();
    }

    function load_heritage_found_in_region(){

      $user_region_id   = $this->session->userdata('user_region_id');
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership,
                                         approved_by_zone
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND h_a_b.regional_approval_status = 'Approved' AND h_t.is_lost = '0'");

      return $query->result_array();
    }

    function load_heritage_registered_by_all(){
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership,
                                         approved_by_zone
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO  AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND h_a_b.regional_approval_status = 'Approved' AND h_t.is_lost = '0'");

      return $query->result_array();
    }

    public function list_heritage_registerd_in_woreda(){
      
      $user_woreda_id   = $this->session->userdata('user_woreda_id');
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');
      
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership,
                                         zone_approval_status,
                                         regional_approval_status
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id AND
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0'");

      return $query->result_array();
    }



    public function load_heritage_registerd_in_woreda(){
      
      $user_woreda_id   = $this->session->userdata('user_woreda_id');
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');
      
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id AND
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone = '0' AND h_a_b.approved_by_region = '0'");

      return $query->result_array();
    }

    






    //load detail of heritage
    public function load_registerd_heritage_detail($id){

      $query = $this->db->query("SELECT h_t.NationalRNO,
                                        h_t.Name,
                                        h_t.LocalName,
                                        h_t.Aboundance,
                                        h_t.SiteName,
                                        h_t.photo,
                                        h_t.DateOfAquistion,
                                        h_t.Description,
                                        h_t.LA,
                                        h_t.LO,
                                        h_t.SiteCode,
                                        h_t.Ownership,
                                        h_t.empID,
                                        h_a_b.approved_by_zone,
                                        h_a_b.zone_approval_status,
                                        h_a_b.regional_approval_status
       FROM heritage_table h_t INNER JOIN heritage_approved_by h_a_b ON 
       h_a_b.heritage_id = h_t.NationalRNO AND h_t.NationalRNO = '$id'");
      return $query->row_array();
    }



    function load_heritage_registerd_in_woreda_detail($id){
     
      $query = $this->db->query("SELECT heritage_table.NationalRNO,heritage_table.Name,heritage_table.LocalName,
        heritage_table.Aboundance,heritage_table.SiteName,heritage_table.photo,heritage_table.DateOfAquistion,
        heritage_table.Description
       FROM heritage_table INNER JOIN heritage_approved_by ON 
       heritage_approved_by.heritage_id = heritage_table.NationalRNO
        AND heritage_approved_by.approved_by_woreda != '0' AND heritage_table.NationalRNO = '$id'");
      return $query->row_array();
      
    }

    function load_heritage_registerd_in_woreda_needs_zone_approval(){ //*     
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');      
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND 
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone = '0' AND h_a_b.approved_by_region = '0'");

      return $query->result_array();
    }

    function list_of_heritage_approved_by_zr(){ //*     
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');      
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership,
                                         regional_approval_status
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND 
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.zone_approval_status = 'Approved'");

      return $query->result_array();
    }

    function list_of_heritage_rejected_by_zr(){ //*     
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');      
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND 
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.zone_approval_status = 'Rejected'");

      return $query->result_array();
    }

    function list_of_heritage_rejected_by_zr_and_rr(){ //*  
      $user_woreda_id     = $this->session->userdata('user_woreda_id');   
      $user_zone_id       = $this->session->userdata('user_zone_id');
      $user_region_id     = $this->session->userdata('user_region_id');      
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id AND 
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND (h_a_b.zone_approval_status = 'Rejected' OR h_a_b.regional_approval_status = 'Rejected')");

      return $query->result_array();
    }

    function load_heritage_registerd_in_zone_needs_region_approval(){ //*    
      $user_region_id   = $this->session->userdata('user_region_id');
      
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND  h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region = '0' AND h_a_b.zone_approval_status = 'Approved'");

      return $query->result_array();
    }

    function list_of_heritage_rejected_by_rr(){ //*    
      $user_region_id   = $this->session->userdata('user_region_id');
      
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Category,
                                         Ownership
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND  h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND h_a_b.regional_approval_status = 'Rejected'");

      return $query->result_array();
    }

    function load_heritage_registerd_in_zone_detail($id){
     
      $query = $this->db->query("SELECT heritage_table.NationalRNO,heritage_table.Name,heritage_table.LocalName,
        heritage_table.Aboundance,heritage_table.SiteName,heritage_table.photo,heritage_table.DateOfAquistion,
        heritage_table.Description
       FROM heritage_table INNER JOIN heritage_approved_by ON 
       heritage_approved_by.heritage_id = heritage_table.NationalRNO
        AND heritage_approved_by.approved_by_zone = '1' AND heritage_table.NationalRNO = '$id'");
      return $query->row_array();
      
    }

    function load_heritage_registerd_in_region(){ //__

      $user_region_id = $this->session->userdata('user_region_id');
      //die($user_region_id);
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Aboundance,
                                         SiteName
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.zone_id = $user_region_id AND
        h_a_b.approved_by_region != '0'");

       return $query->result_array();

    }

     function load_heritage_registerd_in_zone_region($id){
     
      $query = $this->db->query("SELECT heritage_table.NationalRNO,heritage_table.Name,heritage_table.LocalName,
        heritage_table.Aboundance,heritage_table.SiteName,heritage_table.photo,heritage_table.DateOfAquistion,
        heritage_table.Description
       FROM heritage_table INNER JOIN heritage_approved_by ON 
       heritage_approved_by.heritage_id = heritage_table.NationalRNO
        AND heritage_approved_by.approved_by_region != '0' AND heritage_table.NationalRNO = '$id'");
      return $query->row_array();
      
    }

    function load_heritage_address($id){
      $query = $this->db->query("SELECT heritage_address_table.region_id,
                                        heritage_address_table.zone_id,
                                        heritage_address_table.woreda_id,
                                        heritage_address_table.kebele_id
            FROM heritage_address_table INNER JOIN heritage_table ON heritage_address_table.heritage_id = heritage_table.NationalRNO AND heritage_table.NationalRNO = '$id'");
            return $query->row();
    }

    //Bete Start

    function update_approval_to_zone($heritage_id){

             $config['upload_path'] = './assets/heritage/zone_approval_attachement';
             $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
             $config['max_size'] = '2048';
             $config['max_width'] = '2600';
             $config['max_height'] = '2000';
             $this->load->library('upload',$config);

             if(!$this->upload->do_upload()){
              $errors = array('error' => $this->upload->display_errors());
              //$post_image = 'test3.jpg';
                }else{
              $data = array('upload_data' => $this->upload->data());
              $post_image = $_FILES['userfile']['name'];
             }
  
      $data = array(
        'approved_by_zone'            => $this->session->userdata('user_id'),
        'zone_approval_date'          => date('Y-m-d'),
        'zone_approval_attachement'   => $post_image,
        'zone_approval_status'        => 'Approved'
        );
        $this->db->where('heritage_id',$heritage_id);
        $this->db->update('heritage_approved_by',$data);

    }
      
    function update_rejection_to_zone($heritage_id){

             $config['upload_path'] = './assets/heritage/zone_rejection_attachement';
             $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
             $config['max_size'] = '2048';
             $config['max_width'] = '2600';
             $config['max_height'] = '2000';
             $this->load->library('upload',$config);

             if(!$this->upload->do_upload()){
              $errors = array('error' => $this->upload->display_errors());              
                }else{
              $data = array('upload_data' => $this->upload->data());
              $zone_rejection_attachement = $_FILES['userfile']['name'];
             }
  
      $data = array(
        'approved_by_zone'                => $this->session->userdata('user_id'),
        'zone_approval_date'              => date('Y-m-d'),
        'zone_rejection_attachement'      => $zone_rejection_attachement,
        'zone_approval_status'            => 'Rejected'
        );
        $this->db->where('heritage_id',$heritage_id);
        $this->db->update('heritage_approved_by',$data);

    }

    function update_approval_to_region($heritage_id){
      $config['upload_path'] = './assets/heritage/regional_approval_attachement';
      $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
      $config['max_size'] = '2048';
      $config['max_width'] = '1200';
      $config['max_height'] = '1200';
      $this->load->library('upload',$config);

      if(!$this->upload->do_upload()){
       $errors = array('error' => $this->upload->display_errors());
       //$post_image = 'test3.jpg';
         }else{
       $data = array('upload_data' => $this->upload->data());
       $post_image = $_FILES['userfile']['name'];
      }


      $data = array(
        'approved_by_region'              => $this->session->userdata('user_id'),
        'region_approval_date'            => date('Y-m-d'),
        'regional_approval_attachement'   => $post_image,
        'regional_approval_status'        => 'Approved'
        );
        $this->db->where('heritage_id',$heritage_id);
        $this->db->update('heritage_approved_by',$data);
    }

    function update_rejection_to_region($heritage_id){

             $config['upload_path'] = './assets/heritage/regional_rejection_attachement';
             $config['allowed_types'] = 'gif|png|jpg|txt|pdf';
             $config['max_size'] = '2048';
             $config['max_width'] = '2600';
             $config['max_height'] = '2000';
             $this->load->library('upload',$config);

             if(!$this->upload->do_upload()){
              $errors = array('error' => $this->upload->display_errors());              
                }else{
              $data = array('upload_data' => $this->upload->data());
              $regional_rejection_attachement = $_FILES['userfile']['name'];
             }
  
      $data = array(
        'approved_by_region'                => $this->session->userdata('user_id'),
        'region_approval_date'              => date('Y-m-d'),
        'regional_rejection_attachement'    => $regional_rejection_attachement,
        'regional_approval_status'          => 'Rejected'
        );
        $this->db->where('heritage_id',$heritage_id);
        $this->db->update('heritage_approved_by',$data);

    }

    //Bete End

    function load_heritage_approval_info($id){
      $query = $this->db->query("SELECT approved_by_woreda,approved_by_zone,approved_by_region 
        FROM heritage_approved_by WHERE heritage_id = '$id'");

      return $query->row();
    }

    function load_heritage_registerd_in_region_for_RD(){
      $user_region_id = $this->session->userdata('user_region_id');
       $query = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         LocalName,
                                         Aboundance,
                                         SiteName 
        FROM heritage_table h_t, heritage_approved_by h_a_b, heritage_address_table h_a_t
        WHERE h_t.NationalRNO = h_a_b.heritage_id AND h_t.NationalRNO = h_a_t.heritage_id 
        AND h_a_b.approved_by_region !='0' AND h_a_t.region_id= $user_region_id ");

      return $query->result_array();

    }

    function logic_promote_heritage($data){
      $this->db->insert('promot_heritage',$data);
    }

    //load woreda name and aboundance 

      function chart_woreda_name_with_aboundace(){
        $user_region_id = $this->session->userdata('user_region_id');
        $user_zone_id   = $this->session->userdata('user_zone_id');
        $user_woreda_id = $this->session->userdata('user_woreda_id');

         $query = $this->db->query("SELECT Aboundance,Name,region_id,zone_id,woreda_id 
          FROM heritage_table h_t, heritage_approved_by h_a_b,heritage_address_table h_a_t 
          WHERE h_t.NationalRNO = h_a_b.heritage_id AND h_t.NationalRNO = h_a_t.heritage_id
          AND h_a_b.approved_by_woreda = '1' AND $user_region_id = h_a_t.region_id AND $user_zone_id = h_a_t.zone_id
          AND $user_woreda_id = h_a_t.woreda_id ");

          return $query->result_array();   
           }






           //report section 


          
           public function load_heritage_registerd_in_woreda_report_all(){
            $user_woreda_id   = $this->session->userdata('user_woreda_id');
            $user_zone_id     = $this->session->userdata('user_zone_id');
            $user_region_id   = $this->session->userdata('user_region_id');
            //die($user_woreda_id);
             $report_data = $this->db->query("SELECT NationalRNO, 
                                               Name,
                                               Category,
                                               LocalName,
                                               CatalogNO,
                                               Aboundance,
                                               SiteName
              FROM heritage_table h_t INNER JOIN heritage_approved_by 
              h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
              ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id AND 
              h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
              h_a_b.approved_by_woreda = '1' AND h_a_b.approved_by_zone = '0' AND h_a_b.approved_by_region = '0'");
      
             $output = '<table width="100%">';
             $output .= '<tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>LocalName</th>
                            <th>CatalogNO</th>
                            <th>Aboundance</th>
                            <th>SiteName</th>
                        </tr>
             ';
             foreach($report_data->result() as $row){
                $output .= '
                  <tr>
                    <td>'.$row->Name.'</td>
                    <td>'.$row->Category.'</td>
                    <td>'.$row->CatalogNO.'</td>
                    <td>'.$row->LocalName.'</td>
                    <td>'.$row->Aboundance.'</td>
                    <td>'.$row->SiteName.'</td>
                    
                    
                  </tr>
                ';
             }
             $output .= '</table>
             <style>
             table {
               border-collapse: collapse;
               margin-bottom: 25px;
             }
             th, td {
               border: 1px solid #ccc;
               padding: 10px;
               text-align: left;
             }
             tr:nth-child(even) {
               background-color: #eee;
             }
             tr:nth-child(odd) {
               background-color: #fff;
             }            
           </style>
             ';
             return $output;
          }
      
      
      
      
      
      
          public function load_heritage_registerd_in_woreda_report_all_site_land(){
            $user_woreda_id   = $this->session->userdata('user_woreda_id');
            $user_zone_id     = $this->session->userdata('user_zone_id');
            $user_region_id   = $this->session->userdata('user_region_id');
            //die($user_woreda_id);
             $report_data = $this->db->query("SELECT NationalRNO, 
                                               Name,
                                               Category,
                                               LocalName,
                                               CatalogNO,
                                               Aboundance,
                                               SiteName
              FROM heritage_table h_t INNER JOIN heritage_approved_by 
              h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
              ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id AND h_t.Category = 'site_land' AND
              h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
              h_a_b.approved_by_woreda = '1' AND h_a_b.approved_by_zone = '0' AND h_a_b.approved_by_region = '0'");
      
             $output = '<table width="100%">';
             $output .= '<tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>LocalName</th>
                            <th>CatalogNO</th>
                            <th>Aboundance</th>
                            <th>SiteName</th>
                        </tr>
             ';
             foreach($report_data->result() as $row){
                $output .= '
                  <tr>
                    <td>'.$row->Name.'</td>
                    <td>'.$row->Category.'</td>
                    <td>'.$row->CatalogNO.'</td>
                    <td>'.$row->LocalName.'</td>
                    <td>'.$row->Aboundance.'</td>
                    <td>'.$row->SiteName.'</td>
                    
                    
                  </tr>
                ';
             }
             $output .= '</table>
             <style>
             table {
               border-collapse: collapse;
               margin-bottom: 25px;
             }
             th, td {
               border: 1px solid #ccc;
               padding: 10px;
               text-align: left;
             }
             tr:nth-child(even) {
               background-color: #eee;
             }
             tr:nth-child(odd) {
               background-color: #fff;
             }            
           </style>
             ';
             return $output;
          }

          //aricological finding woreda


          public function load_heritage_registerd_in_woreda_report_all_arichilogical_finding(){
            $user_woreda_id   = $this->session->userdata('user_woreda_id');
            $user_zone_id     = $this->session->userdata('user_zone_id');
            $user_region_id   = $this->session->userdata('user_region_id');
            //die($user_woreda_id);
             $report_data = $this->db->query("SELECT NationalRNO, 
                                               Name,
                                               Category,
                                               LocalName,
                                               CatalogNO,
                                               Aboundance,
                                               SiteName
              FROM heritage_table h_t INNER JOIN heritage_approved_by 
              h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
              ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id AND h_t.Category = 'arichilogical_finding' AND
              h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
              h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone = '0' AND h_a_b.approved_by_region = '0'");
      
             $output = '<table width="100%">';
             $output .= '<tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>LocalName</th>
                            <th>CatalogNO</th>
                            <th>Aboundance</th>
                            <th>SiteName</th>
                        </tr>
             ';
             foreach($report_data->result() as $row){
                $output .= '
                  <tr>
                    <td>'.$row->Name.'</td>
                    <td>'.$row->Category.'</td>
                    <td>'.$row->CatalogNO.'</td>
                    <td>'.$row->LocalName.'</td>
                    <td>'.$row->Aboundance.'</td>
                    <td>'.$row->SiteName.'</td>
                    
                    
                  </tr>
                ';
             }
             $output .= '</table>
             <style>
             table {
               border-collapse: collapse;
               margin-bottom: 25px;
             }
             th, td {
               border: 1px solid #ccc;
               padding: 10px;
               text-align: left;
             }
             tr:nth-child(even) {
               background-color: #eee;
             }
             tr:nth-child(odd) {
               background-color: #fff;
             }            
           </style>
             ';
             return $output;
          }

          

          function load_heritage_registered_by_all_report(){
            $report_data = $this->db->query("SELECT NationalRNO, 
                                              Name,
                                              Category,
                                              LocalName,
                                              CatalogNO,
                                              Aboundance,
                                              SiteName
             FROM heritage_table h_t INNER JOIN heritage_approved_by 
             h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
             ON h_a_t.heritage_id = h_t.NationalRNO  AND
             h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0'
              ");
     
     $output = '<table width="100%">';
     $output .= '<tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>LocalName</th>
                    <th>CatalogNO</th>
                    <th>Aboundance</th>
                    <th>SiteName</th>
                </tr>
     ';
     foreach($report_data->result() as $row){
        $output .= '
          <tr>
            <td>'.$row->Name.'</td>
            <td>'.$row->Category.'</td>
            <td>'.$row->CatalogNO.'</td>
            <td>'.$row->LocalName.'</td>
            <td>'.$row->Aboundance.'</td>
            <td>'.$row->SiteName.'</td>
            
            
          </tr>
        ';
     }
     $output .= '</table>
     <style>
     table {
       border-collapse: collapse; margin-bottom: 25px;
     }
     th, td {
       border: 1px solid #ccc;padding: 10px;text-align: left;
     }
     tr:nth-child(even) {
       background-color: #eee;
     }
     tr:nth-child(odd) {
       background-color: #fff;
     }            
   </style>
     ';
     return $output;
         }

         //for site land

         function load_heritage_registered_by_all_report_site_land(){
          $report_data = $this->db->query("SELECT NationalRNO, 
                                            Name,
                                            Category,
                                            LocalName,
                                            CatalogNO,
                                            Aboundance,
                                            SiteName
           FROM heritage_table h_t INNER JOIN heritage_approved_by 
           h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
           ON h_a_t.heritage_id = h_t.NationalRNO  AND h_t.Category = 'site_land' AND
           h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0'");
   
   $output = '<table width="100%">';
   $output .= '<tr>
                  <th>Name</th>
                  <th>Category</th>
                  <th>LocalName</th>
                  <th>CatalogNO</th>
                  <th>Aboundance</th>
                  <th>SiteName</th>
              </tr>
   ';
   foreach($report_data->result() as $row){
      $output .= '
        <tr>
          <td>'.$row->Name.'</td>
          <td>'.$row->Category.'</td>
          <td>'.$row->CatalogNO.'</td>
          <td>'.$row->LocalName.'</td>
          <td>'.$row->Aboundance.'</td>
          <td>'.$row->SiteName.'</td>
          
          
        </tr>
      ';
   }
   $output .= '</table>
   <style>
   table {
     border-collapse: collapse; margin-bottom: 25px;
   }
   th, td {
     border: 1px solid #ccc;padding: 10px;text-align: left;
   }
   tr:nth-child(even) {
     background-color: #eee;
   }
   tr:nth-child(odd) {
     background-color: #fff;
   }            
 </style>
   ';
   return $output;
       }


        //for arilogical finding

        function load_heritage_registered_by_all_report_arichilogical_finding_with_limit($limit){
          $report_data = $this->db->query("SELECT NationalRNO, 
                                            Name,
                                            Category,
                                            LocalName,
                                            CatalogNO,
                                            Aboundance,
                                            SiteName
                                           
           FROM heritage_table h_t INNER JOIN heritage_approved_by 
           h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
           ON h_a_t.heritage_id = h_t.NationalRNO  AND h_t.Category = 'arichilogical_finding' AND
           h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0'
           ORDER BY h_t.NationalRNO ASC LIMIT $limit ");
   
   $output = '<table width="100%">';
   $output .= '<tr>
                  <th>Name</th>
                  <th>Category</th>
                  <th>LocalName</th>
                  <th>CatalogNO</th>
                  <th>Aboundance</th>
                  <th>SiteName</th>
              </tr>
   ';
   foreach($report_data->result() as $row){
      $output .= '
        <tr>
          <td>'.$row->Name.'</td>
          <td>'.$row->Category.'</td>
          <td>'.$row->CatalogNO.'</td>
          <td>'.$row->LocalName.'</td>
          <td>'.$row->Aboundance.'</td>
          <td>'.$row->SiteName.'</td>
          
          
        </tr>
      ';
   }
   $output .= '</table>
   <style>
   table {
     border-collapse: collapse; margin-bottom: 25px;
   }
   th, td {
     border: 1px solid #ccc;padding: 10px;text-align: left;
   }
   tr:nth-child(even) {
     background-color: #eee;
   }
   tr:nth-child(odd) {
     background-color: #fff;
   }            
 </style>
   ';
   return $output;
       }


       function load_heritage_registered_by_all_report_arichilogical_finding(){
        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Aboundance,
                                          SiteName
                                         
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO  AND h_t.Category = 'arichilogical_finding' AND
         h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0'
         ORDER BY h_t.NationalRNO ASC ");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Aboundance</th>
                <th>SiteName</th>
            </tr>
 ';
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->CatalogNO.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->Aboundance.'</td>
        <td>'.$row->SiteName.'</td>
        
        
      </tr>
    ';
 }
 $output .= '</table>
 <style>
 table {
   border-collapse: collapse; margin-bottom: 25px;
 }
 th, td {
   border: 1px solid #ccc;padding: 10px;text-align: left;
 }
 tr:nth-child(even) {
   background-color: #eee;
 }
 tr:nth-child(odd) {
   background-color: #fff;
 }            
</style>
 ';
 return $output;
     }
      

  }