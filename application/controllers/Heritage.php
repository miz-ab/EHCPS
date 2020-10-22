<?php
    class Heritage extends CI_Controller{

        public function __construct(){
          parent::__construct();
          $this->load->library('pdf');
        }
    	
         public function api_get_heritage(){	
         	$posts_arr = array();
          $posts_arr['list_of_heritages'] = array();
            $res = $this->heritage_model->api_get_heritage();

          foreach($res->result_array() as $row){
               $user_item = array(
                 'id'          => $row['NationalRNO'],
                 'name'        => $row['Name'],
                 'localname'   => $row['LocalName'],
                 'photo'       => $row['photo'],
                 'description' => $row['Description'],
                 'LA'          => $row['LA'],
                 'LO'          => $row['LO']   
                  );

        array_push($posts_arr['list_of_heritages'],$user_item);
        //print_r($posts_arr['list_of_heritages']);
      }

      echo json_encode($posts_arr,JSON_UNESCAPED_UNICODE);
         	 
         } // end of function get list of heritage

         public function api_get_single_heritage($id){

          $heritage_arr = array();
          $heritage_arr['list_of_heritages'] = array();
          $res = $this->heritage_model->api_get_single_heritage($id);

           foreach($res->result_array() as $row){
           $heritage_item = array(
          'id'          => $row['NationalRNO'],
          'name'        => $row['Name'],
          'localname'   => $row['LocalName'],
          'Photo'       => $row['photo'],
          'description' => $row['Description']
        );

        array_push($heritage_arr['list_of_heritages'],$heritage_item);
        }

      echo json_encode($heritage_arr,JSON_UNESCAPED_UNICODE);

         }// get single heritage

         public function api_get_promoted_heritage(){
      
          $heritage_arr_promot = array();
          $heritage_arr_promot['list_of_heritages_promoted'] = array();
          $res = $this->heritage_model->api_get_promoted_heritage(); 

           foreach($res->result_array() as $row){
           $heritage_item_promoted = array(
          'id'                => $row['NationalRNO'],   
          'name'              => $row['Name'],
          'localname'         => $row['LocalName'],
          'description'       => $row['Description'],
          'description_new'   => $row['description_new'],
          'photo'             => $row['photo'],
          'date'              => $row['date'],
          'promoted_id'       => $row['heritage_id']
          );
           array_push($heritage_arr_promot['list_of_heritages_promoted'],$heritage_item_promoted);
           }
          
          echo json_encode($heritage_arr_promot,JSON_UNESCAPED_UNICODE);
         } // end of list of promoted heritage

         public function api_get_promoted_heritage_notification(){
          $heritage_arr_promot = array();
          $heritage_arr_promot['list_of_all_heritages_promoted_notification'] = array();
          $res = $this->heritage_model->api_get_promoted_heritage_notification(); 

           foreach($res->result_array() as $row){
           $heritage_item_promoted = array(
          'id'                => $row['NationalRNO'],   
          'name'              => $row['Name'],
          'localname'         => $row['LocalName'],
          'description'       => $row['Description'],
          'description_new'   => $row['description_new'],
          'photo'             => $row['photo'],
          'date'              => $row['date'],
          'promoted_id'       => $row['heritage_id']
          );
           array_push($heritage_arr_promot['list_of_all_heritages_promoted_notification'],$heritage_item_promoted);
           }
          
          echo json_encode($heritage_arr_promot,JSON_UNESCAPED_UNICODE);
         }


         public function api_get_promoted_heritage_single($id){
            $arr_single = array();
            $arr_single['single_arr'] = array();
            $res = $this->heritage_model->api_get_promoted_heritage_single($id);

            foreach($res->result_array() as $row){
              $single_arry = array(
                'id'             => $row['NationalRNO'],
                'name'           => $row['Name'],
                'photo'          => $row['photo'],
                'description'    => $row['Description'],
                'description_new'=> $row['description_new'],
                'date'           => $row['date']

                );
              array_push($arr_single['single_arr'], $single_arry);

            }
            echo json_encode($arr_single, JSON_UNESCAPED_UNICODE);
         }


         public function api_update_promotion_flag(){
          $this->heritage_model->api_update_promotion_flag();
         } //end of update flag

       public function api_recommend_heritage_status(){

        header('Content-type: bitmap; charset=utf-8');
            $image_path   = './assets/recommended_heritage';
            $image_name   = md5(uniqid(rand(),true));
            $file_name    = $image_name . '.' .'png';
            $full_path    = $image_path.'/'.$file_name;

            $this->load->helper('file');
          
            $image = base64_decode($this->input->post('photo'),TRUE);

            //upload an image
            file_put_contents($full_path,$image);

              $data = array(
                'heritage_id'      => $this->input->post('heritage_id'),
                'user_id'          => $this->input->post('user_id'),
                'recommendation'   => $this->input->post('recommendation'),
                'photo'            => $file_name,
                'date'             => $this->input->post('date'),
                'la'               => $this->input->post('la'),
                'lo'               => $this->input->post('lo')
                
                //sha1(md5($this->input->post('password')))
              );
              $this->heritage_model->api_recommend_heritage_status($data);
            }

          public function api_send_heritage_status(){
            
            header('Content-type: bitmap; charset=utf-8');
            $image_path   = './assets/heritage_status';
            $image_name   = md5(uniqid(rand(),true));
            $file_name    = $image_name . '.' .'png';
            $full_path    = $image_path.'/'.$file_name;

            $this->load->helper('file');
          
            $image = base64_decode($this->input->post('photo'),TRUE);

            //upload an image
            file_put_contents($full_path,$image);
            

              $data = array(
                'heritage_id'      => $this->input->post('heritage_id'),
                'user_id'          => $this->input->post('user_id'),
                'description'      => $this->input->post('description'),
                'photo'            => $file_name,
                'severity'         => $this->input->post('severity'), 
                'date'             => $this->input->post('date'),
                'la'               => $this->input->post('la'),
                'lo'               => $this->input->post('lo')
                
                //sha1(md5($this->input->post('password')))
              );
              $this->heritage_model->api_send_heritage_status($data);
            }// function for send heritage status

           public function api_check_if_user_recommend_heritage(){
            
              $heritage_id = $this->input->post('heritage_id');
              $user_id     = $this->input->post('user_id');
              $date        = $this->input->post('sub_date');

              $result = $this->heritage_model->check_if_user_recommend_heritage($heritage_id,$user_id,$date);

              if ($result) {
                $json_data['res'] = '7';
                echo json_encode($json_data);
              }else{
                $json_data['res'] = '7';
                echo json_encode($json_data);
              }

           }// end of check_if_user_recommend_heritage


           public function register_heritage_home(){
              $this->load->view('template/header');
              $this->load->view('template/footer'); 
           }

           public function woreda_registeral_registration_form_one(){
            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                }

              $data['category']= $this->heritage_model->category_model();

              $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

              $data['count'] = $this->heritage_model->count_notification_model();

              $this->load->view('template/header_WR',$data);
              $this->load->view('heritage/registration_form_one',$data);
              $this->load->view('template/footer_WR'); 
           }

           public function woreda_registeral_registration_form_two(){

            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                }

              $userdata = $this->session->userdata('data_user');
              $id       = $this->session->userdata('session_NIDN');

              $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

              $data['count'] = $this->heritage_model->count_notification_model();

              $this->load->view('template/header_WR',$data);
              $this->load->view('heritage/registration_form_two');
              $this->load->view('template/footer_WR'); 
              
           }

           public function woreda_registeral_registration_form_three(){
            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                  }
            $data['regions'] = $this->heritage_model->load_region();
            $data['kebeles'] = $this->heritage_model->load_all_possible_kebele();

            $id              = $this->session->userdata('session_NIDN');

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

              $this->load->view('template/header_WR',$data);
              $this->load->view('heritage/registration_form_three',$data);
              $this->load->view('template/footer_WR');
           }

           //function load zone and woreda
           public function dependent_load_zone(){
              if($this->input->post('region_id')){
                 echo $this->heritage_model->dependent_load_zone($this->input->post('region_id'));
              }
           }

          public function dependent_load_woreda(){
            if($this->input->post('zone_id')){
                 echo $this->heritage_model->dependent_load_woreda($this->input->post('zone_id'));
              }
          }

          public function dependent_load_kebele(){
            if($this->input->post('woreda_id')){
                 echo $this->heritage_model->dependent_load_kebele($this->input->post('woreda_id'));
              }
          }

          //Bete start

        public function update_heritage_info($heritage_to_update_id){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            $emp_id = $this->session->userdata('user_id');

            $data['load_heritage_to_update']= $this->heritage_model->load_heritage_to_update_model($heritage_to_update_id); 
                         
            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/update_heritage_info',$data);
            $this->load->view('template/footer_WR');
        } 

        public function update_heritage($id){

            $config['upload_path'] = './assets/heritage';
             $config['allowed_types'] = 'gif|png|jpg';
             $config['max_size'] = '2048';
             $config['max_width'] = '2600';
             $config['max_height'] = '2000';
             $this->load->library('upload',$config);

              if(!$this->upload->do_upload()){
                     $errors = array('error' => $this->upload->display_errors());
                     //$post_image = 'test3.jpg';
                       }else{
                     $data = array('upload_data' => $this->upload->data());
                     $update_image = $_FILES['userfile']['name'];
                   }

        $data = array(   
          'NationalRNO'             =>$this->input->post('nid'),     
          'Name'                    =>$this->input->post('name'),
          'LocalName'               =>$this->input->post('localname'),
          'Category'                =>$this->input->post('heritage_category'),
          'CatalogNO'               =>$this->input->post('catalogNo'),
          'Aboundance'              =>$this->input->post('aboumdance'),                 
          'photo'                   =>$update_image,        
          'Ownership'               =>$this->input->post('ownerShip'),              
          'DateOfAquistion'         =>$this->input->post('dateOfAqusition'),                      
          'Description'             =>$this->input->post('Description'),                
          'SiteName'                =>$this->input->post('siteName'),              
          'SiteCode'                =>$this->input->post('siteCode'),                
          'LA'                      =>$this->input->post('LA'),        
          'LO'                      =>$this->input->post('LO')                                        
          );
        $dataa = array(
          'heritage_id'             =>$this->input->post('nid'),
          'kebele_id'               =>$this->input->post('kebele_id')                           
          );
            if($this->heritage_model->update_heritage_model($id,$data,$dataa))
              $this->session->set_flashdata("registered_successfully","Successfully Heritage Updated");
            else
              $this->session->set_flashdata("not_registered_successfully","Successfully Heritage Updated");


            redirect('employee/index');
       }

            //Maintenance Request
        public function send_maintenance_request_form(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }

            //$data['heritages'] = $this->heritage_model->load_heritage_id();

            $emp_id = $this->session->userdata('user_id');
              
            $data['heritage']= $this->heritage_model->dependent_heritage_id_model($emp_id);
            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/maintenance_request_form',$data);
            $this->load->view('template/footer_WR');
        }
        
        public function dependent_heritage_category(){
            if($this->input->post('heritage_id')){
                 echo $this->heritage_model->dependent_heritage_category_model($this->input->post('heritage_id'));
              }
        }

        public function announce_lost_heritage_form(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }
            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/lost_heritage_form');
            $this->load->view('template/footer_WR');
        }              

        public function send_maintenance_request(){

            $emp_id = $this->session->userdata('user_id');
            $format = '%Y-%m-%d';
            $request_date = mdate($format,time());

            $config['upload_path'] = './assets/maintenance_requested_heritage';
            $config['allowed_types'] = 'gif|png|jpg';
            $config['max_size'] = '2048';
            $config['max_width'] = '2600';
            $config['max_height'] = '2000';
            $this->load->library('upload',$config);

             if(!$this->upload->do_upload()){
                     $errors = array('error' => $this->upload->display_errors());                     
                       }else{
                     $data = array('upload_data' => $this->upload->data());
                     $heritage_image = $_FILES['userfile']['name'];
                    }
             $data = array(                    
                    'heritage_id'     =>    $this->input->post('heritage_id'),
                    'category'        =>    $this->session->userdata('Category'),
                    'photo'           =>    $heritage_image,
                    'severity'        =>    $this->input->post('severity'),
                    'description'     =>    $this->input->post('description'),
                    'empID'           =>    $emp_id,
                    'date'            =>    $request_date   
               );

              $this->session->set_userdata('requested_heritage_id',$this->input->post('heritage_id'));                        
              $res = $this->heritage_model->send_maintenance_request_model($data);
              $this->heritage_model->set_maintenance_requested_by_woreda_true();
              
              $this->session->set_flashdata("registered_successfully","Successfully Maintenance Request Sent");

              redirect('employee/index');    
        }

        public function list_of_maintenance_request_sent_by_wr(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            $data['list_of_maintenance_request']  = $this->heritage_model->list_of_maintenance_request_sent_by_wr_model();

            $data['list_of_maintenance_request_approved_by_zone_model']  = $this->heritage_model->list_of_approved_maintenance_request_for_wr_model();

            $data['list_of_maintained_heritage']  = $this->heritage_model->list_of_maintained_heritage_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_maintenance_request',$data);
            $this->load->view('template/footer_WR');
          

        }
        
        public function list_of_maintenance_request_needs_approvel_by_zme(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            $data['list_of_maintenance_request']  = $this->heritage_model->list_of_maintenance_request_needs_approvel_by_zme_model();

            $data['list_of_maintenance_request_approved_by_zone_model']  = $this->heritage_model->list_of_maintenance_request_approved_by_zme_model();

            $data['list_of_rejected_maintenance_request']  = $this->heritage_model->list_of_maintenance_request_rejected_by_zme_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_maintenance_request',$data);
            $this->load->view('template/footer_WR');
          

        }

        public function list_of_maintenance_request_needs_approvel_by_rme(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            $data['list_of_maintenance_request']  = $this->heritage_model->list_of_maintenance_request_needs_approvel_by_rme_model();

            $data['list_of_maintenance_request_approved_by_zone_model']  = $this->heritage_model->list_of_maintenance_request_approved_by_rme_model();

            $data['list_of_rejected_maintenance_request']  = $this->heritage_model->list_of_maintenance_request_rejected_by_rme_model();
                  
            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_maintenance_request',$data);
            $this->load->view('template/footer_WR');
          

        }

        public function list_of_maintenance_request_needs_approvel_by_rd(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            $data['list_of_maintenance_request']  = $this->heritage_model->list_of_maintenance_request_needs_approvel_by_rd_model();

            $data['list_of_maintenance_request_approved_by_zone_model']  = $this->heritage_model->list_of_maintenance_request_approved_by_rd_model();

            $data['list_of_maintained_heritage']  = $this->heritage_model->list_of_maintained_heritage_model();

            $data['list_of_rejected_maintenance_request']  = $this->heritage_model->list_of_maintenance_request_rejected_by_rd_model();
                  

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_maintenance_request',$data);
            $this->load->view('template/footer_WR');
          

        }

        function maintenance_request_detail($id){
            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                  }
            $data['maintenance_request_detail'] = $this->heritage_model->maintenance_request_detail_model($id);


            $approved_by      = $this->heritage_model->maintenance_request_approval_info($id);
            $resss            = $this->heritage_model->load_heritage_address($id);

            //print_r($data['load_registerd_heritage_detail']);
 
            $region  = $this->heritage_model->load_region_name($resss->region_id);
            $zone    = $this->heritage_model->load_zone_name($resss->zone_id);
            $woreda  = $this->heritage_model->load_woreda_name($resss->woreda_id);
            $kebele  = $this->heritage_model->load_kebele_name($resss->kebele_id);            

            $address_item = array(
              'region_id'             => $resss->region_id,
              'zone_id'               => $resss->zone_id,
              'woreda_id'             => $resss->woreda_id,
              'region'                => $region,
              'zone'                  => $zone,
              'woreda'                => $woreda,
              'kebele'                => $kebele,
              'approved_by_wr'        => $approved_by->wr_id,
              'approved_by_zme'       => $approved_by->zme_id,
              'approved_by_rme'       => $approved_by->rme_id,
              'approved_by_rd'        => $approved_by->rd_id
              );

            $data['address'] = $address_item;
            
            $data_updated = array(
              'request_id_updated'  => $id
              );

            $this->session->set_userdata($data_updated);

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/maintenance_request_detail',$data);
            $this->load->view('template/footer_WR');

           }

           public function confirm_maintenance($heritage_id,$receiver_empID,$heritage_name,$sender_empID){

            $userroll = $this->session->userdata('userroll');
            $user_id = $this->session->userdata('user_id');
            $maintenance_end_date = $this->input->post('maintenance_end_date');


            $config['upload_path'] = './assets/maintained_heritage';
            $config['allowed_types'] = 'gif|png|jpg|pdf';
            $config['max_size'] = '2048';
            $config['max_width'] = '2600';
            $config['max_height'] = '2000';
            $this->load->library('upload',$config);

             if(!$this->upload->do_upload()){
                     $errors = array('error' => $this->upload->display_errors());                     
                       }else{
                     $data = array('upload_data' => $this->upload->data());
                     $confirmation_file = $_FILES['userfile']['name'];
                    }

            $data = array(
                  'heritage_id'                     => $heritage_id,
                  'maintenance_end_date'            => $maintenance_end_date,
                  'maintenance_confirmation_file'   => $confirmation_file,                  
                  'status'                          => 'Maintained',
                  'confirmation_submited_date'      => date('Y-m-d'),
                  'confirmation_sender_id'          => $user_id
                );                      

              $this->heritage_model->maintained_heritage_model($data);
              $this->session->set_flashdata("registered_successfully","Confirmation Submit Successfully");

              $data = array(                                  
                  'status'                          => 'Maintained'                
                );                      

              $this->heritage_model->update_tobe_maintained_heritage_model($heritage_id,$data);

              $data1 = array(
                  'is_maintained' =>'1' 
                );

                $this->db->where('heritage_id',$heritage_id);
                $this->db->update('maintenance_request_approved_by',$data1);

              if ($userroll == 'WR') {

                $data = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'is maintained as scheduled',
                  'roll'                    => $userroll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'MR_maintained',
                  'flag'                    => '0'
                );

                $this->heritage_model->wr_feedback_model($data);
              } 
              redirect('heritage/list_of_maintenance_request_sent_by_wr');           
          }                      
        
           public function update_zme_approval($receiver_empID,$heritage_name,$sender_roll,$sender_empID){
            $heritage_id = $this->session->userdata('request_id_updated');
            

            if (isset($_POST['btn_approve'])) {

              $this->heritage_model->update_zme_approval_model($heritage_id);
              $this->session->set_flashdata("registered_successfully","Maintenance Request Approved Successfully");

              if ($sender_roll == 'ZME') {

                $data = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is approved by zone maintenance expert',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'MR_approval',
                  'flag'                    => '0'
                );

                $this->heritage_model->zme_feedback_model($data);
              }

            }

            if (isset($_POST['btn_reject'])) {

              $this->heritage_model->update_zme_rejection_model($heritage_id);
              $this->session->set_flashdata("danger_message","Maintenance Request Rejected Successfully");

              if ($sender_roll == 'ZME') {

                $data = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is rejected by zone maintenance expert',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'MR_rejection',
                  'flag'                    => '0'
                );

                $this->heritage_model->zme_feedback_model($data);
              }

            }

            redirect('employee/index');
           }          

           public function update_rme_approval($wr_receiver_empID,$zme_receiver_empID,$heritage_name,$sender_roll,$sender_empID){
            $heritage_id = $this->session->userdata('request_id_updated');

            if (isset($_POST['btn_approve'])) {

              $this->heritage_model->update_rme_approval_model($heritage_id);
              $this->session->set_flashdata("registered_successfully","Maintenance Request Approved Successfully");


              if ($sender_roll == 'RME') {

                $data1 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $wr_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is approved by regional maintenance expert',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'MR_approval',
                  'flag'                    => '0'
                );

                $data2 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $zme_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is approved by regional maintenance expert',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'MR_approval',
                  'flag'                    => '0'
                );

                $this->heritage_model->rme_feedback_model($data1,$data2);                
              }

            }

            if (isset($_POST['btn_reject'])) {

              $this->heritage_model->update_rme_rejection_model($heritage_id);
              $this->session->set_flashdata("danger_message","Maintenance Request Rejected Successfully");

              if ($sender_roll == 'RME') {

                $data1 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $wr_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is rejected by regional maintenance expert',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'MR_rejection',
                  'flag'                    => '0'
                );

                $data2 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $zme_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is rejected by regional maintenance expert',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'MR_rejection',
                  'flag'                    => '0'
                );

                $this->heritage_model->rme_feedback_model($data1,$data2);
              }

            }

            redirect('employee/index');
           }
        
           public function update_rd_approval($wr_receiver_empID,$zme_receiver_empID,$rme_receiver_empID,$heritage_name,$sender_roll,$sender_empID){
            $heritage_id = $this->session->userdata('request_id_updated');

            if (isset($_POST['btn_approve'])) {

              $this->heritage_model->update_rd_approval_model($heritage_id);
              $this->session->set_flashdata("registered_successfully","Maintenance Request Approved Successfully");

              if ($sender_roll == 'RD') {

                $data1 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $wr_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is approved by regional directorate',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'MR_approval',
                  'flag'                    => '0'
                );

                $data2 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $zme_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is approved by regional directorate',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'MR_approval',
                  'flag'                    => '0'
                );

                $data3 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $rme_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is approved by  regional directorate',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'MR_approval',
                  'flag'                    => '0'
                );

                $this->heritage_model->rd_feedback_model($data1,$data2,$data3);                
              }

            }

            if (isset($_POST['btn_reject'])) {

              $this->heritage_model->update_rd_rejection_model($heritage_id);
              $this->session->set_flashdata("danger_message","Maintenance Request Rejected Successfully");

              if ($sender_roll == 'RME') {

                $data1 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $wr_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is rejected by regional directorate',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'MR_rejection',
                  'flag'                    => '0'
                );

                $data2 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $zme_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is rejected by regional directorate',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'MR_rejection',
                  'flag'                    => '0'
                );

                $data3 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $rme_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'maintenance request is rejected by regional directorate',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'MR_rejection',
                  'flag'                    => '0'
                );

                $this->heritage_model->rd_feedback_model($data1,$data2,$data3);
              }

            }

            redirect('employee/index');
           }

           public function schedule_maintenance($heritage_id){

            $start_date     =   $this->input->post('start_date');
            $end_date       =   $this->input->post('end_date'); 
            $user_id        =   $this->session->userdata('user_id');

                $data = array(
                  'heritage_id'             => $heritage_id,
                  'start_date'              => $start_date,
                  'end_date'                => $end_date,                  
                  'status'                  => 'Scheduled',
                  'scheduler_id'            => $user_id,
                  'scheduled_date'          => date('Y-m-d')
                );

                $this->heritage_model->schedule_maintenance_model($data);
                $this->session->set_flashdata("registered_successfully","Maintenance Request Scheduled Successfully");

                $data1 = array(              
                  'is_scheduled'                    => '1'                  
                );

                $this->db->where('heritage_id',$heritage_id);
                $this->db->update('maintenance_request_approved_by',$data1);                        

            redirect('heritage/list_of_maintenance_request_needs_approvel_by_rd');
           }     


        public function announce_lost_heritage(){
            $emp_id = $this->session->userdata('user_id');
            $format = '%Y-%m-%d';
            $announce_date = mdate($format,time());
            $lost_date = $this->input->post('dateOflost');

            $lostDate = strtotime($lost_date);
            $announceDate = strtotime($announce_date);

            if($lostDate > $announceDate) {
              $this->session->set_flashdata("danger_message","Invalid Lost Date Entry");
              redirect('employee/index');
            }else{


              $data = array(                    
                    'heritage_id'     =>    $this->input->post('heritage_id'),
                    'heritage_name'   =>    $this->input->post('heritage_name'),                    
                    'description'     =>    $this->input->post('description'),
                    'empID'           =>    $emp_id,
                    'lost_date'       =>    $this->input->post('dateOflost'),
                    'announce_date'   =>    $announce_date                      
               );

             $data1 = array(                                        
                    'is_lost'   => '1'                      
               );

            $this->db->where('NationalRNO',$this->input->post('heritage_id'));
            $this->db->update('heritage_table',$data1);

             $this->session->set_userdata('requested_heritage_id',$this->input->post('heritage_id'));

             $res = $this->heritage_model->announce_lost_heritage_model($data);
              
             $this->session->set_flashdata("registered_successfully","Successfully Lost Heritage Announced");

              redirect('employee/index');

            }
                        
        }
        function get_lost_heritage_name_value($heritage_id){
              $res = $this->heritage_model->get_lost_heritage_name_value($heritage_id);

              /*$heritage_name=$this->heritage_model->get_heritage_name($heritage_id);
              
              $this->session->set_userdata('heritage_name',$heritage_name);*/

              if(!$res){
                echo json_encode('not_found');
              }else{
                echo json_encode($res);
              }
           }

           public function list_of_promoted_heritage(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }     

            $user_region_id = $this->session->userdata('user_region_id');     

            $data['list_of_promoted_heritage']  = $this->heritage_model->list_of_promoted_heritage_model($user_region_id);

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_promoted_heritage',$data);
            $this->load->view('template/footer_WR');
        }

           public function list_of_heritage_status(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }

            $user_region_id = $this->session->userdata('user_region_id');         

            $data['list_of_heritage_status']  = $this->heritage_model->list_of_heritage_status_model($user_region_id);

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_heritage_status',$data);
            $this->load->view('template/footer_WR');
        }

        function heritage_status_detail($id){
            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                  }

            $data['heritage_status_detail'] = $this->heritage_model->heritage_status_detail_model($id);          

            $data['current_heritage_status_detail'] = $this->heritage_model->current_heritage_status_detail_model($id);
            //$approved_by      = $this->heritage_model->load_heritage_approval_info($id);
            $resss            = $this->heritage_model->load_heritage_address($id);

            //print_r($data['load_registerd_heritage_detail']);
 
            $region  = $this->heritage_model->load_region_name($resss->region_id);
            $zone    = $this->heritage_model->load_zone_name($resss->zone_id);
            $woreda  = $this->heritage_model->load_woreda_name($resss->woreda_id);
            $kebele  = $this->heritage_model->load_kebele_name($resss->kebele_id);            

            $address_item = array(
              'region_id'             => $resss->region_id,
              'zone_id'               => $resss->zone_id,
              'woreda_id'             => $resss->woreda_id,
              'region'                => $region,
              'zone'                  => $zone,
              'woreda'                => $woreda,
              'kebele'                => $kebele              
              );

            $data['address'] = $address_item;          

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/heritage_status_detail',$data);
            $this->load->view('template/footer_WR');

           }

        public function list_of_lost_heritage(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }

            $empID = $this->session->userdata('user_id');
            $region_id = $this->session->userdata('user_region_id');    

            $data['list_of_lost_heritage']  = $this->heritage_model->list_of_lost_heritage_model($region_id);

            $data['list_of_lost_heritage_for_wr']  = $this->heritage_model->list_of_announced_lost_heritage_for_wr_model($empID,$region_id);

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  
            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_lost_heritage',$data);
            $this->load->view('template/footer_WR');
        }

        /*public function list_of_lost_heritage_by_category(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            $Category = $this->input->post('txt_search');

            print_r($Category);

            $data['list_of_lost_heritage']  = $this->heritage_model->list_of_lost_heritage_by_category_model($Category);


            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_lost_heritage',$data);
            $this->load->view('template/footer_WR');
        }*/

        function lost_heritage_detail($id){
            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                  }
            $data['lost_heritage_detail'] = $this->heritage_model->lost_heritage_detail_model($id);
            //$approved_by      = $this->heritage_model->load_heritage_approval_info($id);
            $resss            = $this->heritage_model->load_heritage_address($id);

            //print_r($data['load_registerd_heritage_detail']);
 
            $region  = $this->heritage_model->load_region_name($resss->region_id);
            $zone    = $this->heritage_model->load_zone_name($resss->zone_id);
            $woreda  = $this->heritage_model->load_woreda_name($resss->woreda_id);
            $kebele  = $this->heritage_model->load_kebele_name($resss->kebele_id);            

            $address_item = array(
              'region_id'             => $resss->region_id,
              'zone_id'               => $resss->zone_id,
              'woreda_id'             => $resss->woreda_id,
              'region'                => $region,
              'zone'                  => $zone,
              'woreda'                => $woreda,
              'kebele'                => $kebele              
              );

            $data['address'] = $address_item;          

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();      

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/lost_heritage_detail',$data);
            $this->load->view('template/footer_WR');

           }


           public function list_of_heritage_recommendation(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            $data['list_of_heritage_recommendation']  = $this->heritage_model->list_of_heritage_recommendation_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/list_of_heritage_recommendation',$data);
            $this->load->view('template/footer_WR');
        }

        function heritage_recommendation_detail($id){
            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                  }
            $data['heritage_recommendation_detail'] = $this->heritage_model->heritage_recommendation_detail_model($id);
            //$approved_by      = $this->heritage_model->load_heritage_approval_info($id);
            $resss            = $this->heritage_model->load_heritage_address($id);

            //print_r($data['heritage_recommendation_detail']);
 
            $region  = $this->heritage_model->load_region_name($resss->region_id);
            $zone    = $this->heritage_model->load_zone_name($resss->zone_id);
            $woreda  = $this->heritage_model->load_woreda_name($resss->woreda_id);
            $kebele  = $this->heritage_model->load_kebele_name($resss->kebele_id);            

            $address_item = array(
              'region_id'             => $resss->region_id,
              'zone_id'               => $resss->zone_id,
              'woreda_id'             => $resss->woreda_id,
              'region'                => $region,
              'zone'                  => $zone,
              'woreda'                => $woreda,
              'kebele'                => $kebele              
              );

            $data['address'] = $address_item;          

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/heritage_recommendation_detail',$data);
            $this->load->view('template/footer_WR');

           }


           public function all_notification($emp_id){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }
            $data['all_notification'] = null;
            $this->db->where('receiver_id',$emp_id);            
            $result = $this->db->get('notification_table');

            if ($result->num_rows() > 0) {

              $data['all_notification'] = $this->heritage_model->all_notification_model($emp_id);              

              /*$res = $this->heritage_model->attachement_for_all_notification_model($emp_id);

              //$attachements = array();

              //print_r($res->result_array());                      
              foreach($res->result() as $a_n_a){              


                if ($a_n_a->status == 'HR_approval') {
                 if ($a_n_a->roll == 'ZR') {
                $data['attachement'] = $this->heritage_model->zr_heritage_approval_attachement_for_wr($a_n_a->heritage_id,$a_n_a->receiver_id,$a_n_a->sender_id);
                   print_r($data['attachement']);
                   //array_push($attachements, $attachement);
                 }

                 if ($a_n_a->roll == 'RR') {
                   $data['attachement'] = $this->heritage_model->rr_heritage_approval_attachement_for_wr_and_zr($a_n_a->heritage_id,$a_n_a->receiver_id,$a_n_a->sender_id);
                   print_r($data['attachement']);
                   //array_push($attachements, $attachement);                

               } elseif ($a_n_a['status'] == 'HR_rejection') {
                 if ($a_n_a['roll'] == 'ZR') {
                   $data['attachement'] = $this->heritage_model->zr_heritage_rejection_attachement_for_wr($a_n_a['heritage_id'],$a_n_a['receiver_id'],$a_n_a['sender_id']);
                   //array_push($attachements, $attachement);
                 }

                 if ($a_n_a['roll'] == 'RR') {
                   $data['attachement'] = $this->heritage_model->rr_heritage_rejection_attachement_for_wr_and_zr($a_n_a['heritage_id'],$a_n_a['receiver_id'],$a_n_a['sender_id']);
                   //array_push($attachements, $attachement);
                 }
               }elseif ($a_n_a['status'] == 'MR_approval') {
                 if ($a_n_a['roll'] == 'ZME') {
                   $data['attachement'] = $this->heritage_model->zme_mr_approval_attachement_for_wr($a_n_a['heritage_id'],$a_n_a['receiver_id'],$a_n_a['sender_id']);
                   //array_push($attachements, $attachement);
                 }

                 if ($a_n_a['roll'] == 'RME') {
                   $data['attachement'] = $this->heritage_model->rme_mr_approval_attachement_for_wr_and_zme($a_n_a['heritage_id'],$a_n_a['receiver_id'],$a_n_a['sender_id']);
                   //array_push($attachements, $attachement);
                 }

                 if ($a_n_a['roll'] == 'RD') {
                   $data['attachement'] = $this->heritage_model->rd_mr_approval_attachement_for_wr_and_zme_and_rme($a_n_a['heritage_id'],$a_n_a['receiver_id'],$a_n_a['sender_id']);
                   //array_push($attachements, $attachement);
                 }
               }elseif ($a_n_a['status'] == 'MR_rejection') {
                 if ($a_n_a['roll'] == 'ZME') {
                   $data['attachement'] = $this->heritage_model->zme_mr_rejection_attachement_for_wr($a_n_a['heritage_id'],$a_n_a['receiver_id'],$a_n_a['sender_id']);
                   //array_push($attachements, $attachement);
                 }

                 if ($a_n_a['roll'] == 'RME') {
                   $data['attachement'] = $this->heritage_model->rme_mr_rejection_attachement_for_wr_and_zme($a_n_a['heritage_id'],$a_n_a['receiver_id'],$a_n_a['sender_id']);
                   //array_push($attachements, $attachement);
                 }

                 if ($a_n_a['roll'] == 'RD') {
                   $data['attachement'] = $this->heritage_model->rd_mr_rejection_attachement_for_wr_and_zme_and_rme($a_n_a['heritage_id'],$a_n_a['receiver_id'],$a_n_a['sender_id']);
                   //array_push($attachements, $attachement);
                 }
               }elseif ($a_n_a['status'] == 'MR_maintained') {
                 if ($roll == 'WR') {
                   $data['attachement'] = $this->heritage_model->wr_maintained_heritage_attachement_for_rd($a_n_a['heritage_id']);
                   //array_push($attachements, $attachement);
                 }
               } 

                
               }
                
              }*///end of foreach

              //$data['attachement'] = $attachements;

              
            } 

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  
            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/all_notification',$data);
            $this->load->view('template/footer_WR');       
            
        }
           

           function detail_notification($heritage_id,$status,$roll,$receiver_id,$sender_id){
            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                  }

            $data1 = array(              
              'flag'                    => '1'                  
            );

            $this->db->where('heritage_id',$heritage_id);
            $this->db->where('receiver_id',$receiver_id);
            $this->db->where('sender_id',$sender_id);
            $this->db->where('roll',$roll);
            $this->db->where('status',$status);
            $this->db->update('notification_table',$data1);

            if ($status == 'HR_approval') {
                 if ($roll == 'ZR') {
                   $data['attachement'] = $this->heritage_model->zr_heritage_approval_attachement_for_wr($heritage_id,$receiver_id,$sender_id);
                 }

                 if ($roll == 'RR') {
                   $data['attachement'] = $this->heritage_model->rr_heritage_approval_attachement_for_wr_and_zr($heritage_id,$receiver_id,$sender_id);
                 }

               } elseif ($status == 'HR_rejection') {
                 if ($roll == 'ZR') {
                   $data['attachement'] = $this->heritage_model->zr_heritage_rejection_attachement_for_wr($heritage_id,$receiver_id,$sender_id);
                 }

                 if ($roll == 'RR') {
                   $data['attachement'] = $this->heritage_model->rr_heritage_rejection_attachement_for_wr_and_zr($heritage_id,$receiver_id,$sender_id);
                 }
               }elseif ($status == 'MR_approval') {
                 if ($roll == 'ZME') {
                   $data['attachement'] = $this->heritage_model->zme_mr_approval_attachement_for_wr($heritage_id,$receiver_id,$sender_id);
                 }

                 if ($roll == 'RME') {
                   $data['attachement'] = $this->heritage_model->rme_mr_approval_attachement_for_wr_and_zme($heritage_id,$receiver_id,$sender_id);
                 }

                 if ($roll == 'RD') {
                   $data['attachement'] = $this->heritage_model->rd_mr_approval_attachement_for_wr_and_zme_and_rme($heritage_id,$receiver_id,$sender_id);
                 }
               }elseif ($status == 'MR_rejection') {
                 if ($roll == 'ZME') {
                   $data['attachement'] = $this->heritage_model->zme_mr_rejection_attachement_for_wr($heritage_id,$receiver_id,$sender_id);
                 }

                 if ($roll == 'RME') {
                   $data['attachement'] = $this->heritage_model->rme_mr_rejection_attachement_for_wr_and_zme($heritage_id,$receiver_id,$sender_id);
                 }

                 if ($roll == 'RD') {
                   $data['attachement'] = $this->heritage_model->rd_mr_rejection_attachement_for_wr_and_zme_and_rme($heritage_id,$receiver_id,$sender_id);
                 }
               }elseif ($status == 'MR_maintained') {
                 if ($roll == 'WR') {
                   $data['attachement'] = $this->heritage_model->wr_maintained_heritage_attachement_for_rd($heritage_id);
                 }
               } 
                  

            $data['detail_notification'] = $this->heritage_model->detail_notification_model($heritage_id,$status,$roll);                           
            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();      

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/notification',$data);
            $this->load->view('template/footer_WR');

           }


            //Bete End

           public function logic_register_heritage_one(){
            //get emp id that add the heritage 
            $emp_id = $this->session->userdata('user_id');

            $data = array(
              'NationalRNO'      => $this->input->post('nid'),
              'Name'             => $this->input->post('localname'),
              'Category'         => $this->input->post('heritage_category'),
              'LocalName'        => $this->input->post('localname'),
              'CatalogNO'        => $this->input->post('catalogNo'),
              'Aboundance'       => $this->input->post('aboumdance'),
              'DateOfAquistion'  => $this->input->post('dateOfAqusition'),
              'Ownership'        => $this->input->post('ownerShip'),
              'empID'            => $emp_id
              );

              //$this->session->unset('session_NIDN');
              
              //$res = $this->heritage_model->logic_register_heritage_one($data);
              $this->session->set_userdata('session_NIDN',$this->input->post('nid'));
              $this->session->set_userdata('data_user',$data);

              $this->session->set_userdata('selected_category',$this->input->post('heritage_category'));

              
              redirect('heritage/woreda_registeral_registration_form_two');

             //set the session 
             //redirect('heritage/woreda_registeral_registration_form_one');
            }

           function logic_register_heritage_two(){

            $action = $this->input->post('action');
            if($action === '<<'){
              redirect('heritage/woreda_registeral_registration_form_one');
              //$this->woreda_registeral_registration_form_one();
            }else{

             $config['upload_path'] = './assets/heritage';
             $config['allowed_types'] = 'gif|png|jpg';
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
                    'photo'        => $post_image,
                    'SiteName'     => $this->input->post('siteName'),
                    'SiteCode'     => $this->input->post('siteCode'),
                    'Description'  => $this->input->post('Description'),
                    'LA'           => $this->input->post('LA'),
                    'LO'           => $this->input->post('LO'),
                    'is_lost'      => '0'
                );

              $id = $this->session->userdata('NationalRNO');
              $userdataa = $this->session->userdata('data_user');

              $arr_merge = array_merge($userdataa,$data);
              $res = $this->heritage_model->logic_register_heritage_one($arr_merge);
              
              redirect('heritage/woreda_registeral_registration_form_three');
                
                }     
           }//end of func

           function logic_register_heritage_three(){            

             $action = $this->input->post('action');
            if($action == '<<'){
                redirect('heritage/woreda_registeral_registration_form_two');
            }else{

            $id = $this->session->userdata('session_NIDN');

            $data = array(
              'region_id'    => $this->session->userdata('user_region_id'),
              'zone_id'      => $this->session->userdata('user_zone_id'),
              'woreda_id'    => $this->session->userdata('user_woreda_id'),
              'kebele_id'    => $this->input->post('kebele_id'),
              'heritage_id'  => $id
              );

            $this->heritage_model->logic_register_heritage_three($data); 
            $this->heritage_model->set_registered_by_woreda_true();

            $this->session->set_flashdata("registered_successfully","Successfully Registered");

            redirect('employee/index');
            }
           }

           //ajax request methods

           //check if id exist or not ajax
           function check_heritage_id_exists($id){
            $res = $this->heritage_model->check_heritage_id_exists($id);
            if($res){
              echo json_encode('A');
            }else{
              echo json_encode('B');
            }
           }

           function get_heritage_id_value($heritage_id){
              $res = $this->heritage_model->get_heritage_id_value($heritage_id);
              if(!$res){
                echo json_encode('not_found');
              }else{
                echo json_encode($res);
              }
           }

           //load detail heritage info that registered in woreda
           function heritage_detail_view_in_woreda($id = 1){
            if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                  }
            $data['load_registerd_heritage_detail'] = $this->heritage_model->load_registerd_heritage_detail($id);
            $approved_by      = $this->heritage_model->load_heritage_approval_info($id);
            $resss                  = $this->heritage_model->load_heritage_address($id);

            //print_r($data['load_registerd_heritage_detail']);
 
            $region  = $this->heritage_model->load_region_name($resss->region_id);
            $zone    = $this->heritage_model->load_zone_name($resss->zone_id);
            $woreda  = $this->heritage_model->load_woreda_name($resss->woreda_id);
            $kebele  = $this->heritage_model->load_kebele_name($resss->kebele_id);            

            $address_item = array(
              'region_id'             => $resss->region_id,
              'zone_id'               => $resss->zone_id,
              'woreda_id'             => $resss->woreda_id,
              'region'                => $region,
              'zone'                  => $zone,
              'woreda'                => $woreda,
              'kebele'                => $kebele,
              'approved_by_woreda'    => $approved_by->approved_by_woreda,
              'approved_by_zone'      => $approved_by->approved_by_zone,
              'approved_by_region'    => $approved_by->approved_by_region
              );

            $data['address'] = $address_item;          

            $data_updated = array(
              'heritage_id_updated'  => $id
              );

            $this->session->set_userdata($data_updated);

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/heritage_detail_registered_in_woreda',$data);
            $this->load->view('template/footer_WR');

           }

           //Bete Start

           public function update_zone_approval($receiver_empID,$heritage_name,$sender_roll,$sender_empID){
            $heritage_id = $this->session->userdata('heritage_id_updated');
            
            if (isset($_POST['btn_approve'])) {
            
            $this->heritage_model->update_approval_to_zone($heritage_id);
            $this->session->set_flashdata("registered_successfully","Heritage Registration Approved Successfully");

            if ($sender_roll == 'ZR') {

                $data = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'registration is approved by zone registrar',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'HR_approval',
                  'flag'                    => '0'
                );

                $this->heritage_model->zr_feedback_model($data);
              }

            }

            if (isset($_POST['btn_reject'])) {

              $this->heritage_model->update_rejection_to_zone($heritage_id);
              $this->session->set_flashdata("danger_message","Heritage Registration Rejected Successfully");

              if ($sender_roll == 'ZR') {

                $data = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'registration is rejected by zone registrar',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'HR_rejection',
                  'flag'                    => '0'
                );

                $this->heritage_model->zr_feedback_model($data);
              }

            }

            redirect('employee/index');
           }

           public function update_region_approval($wr_receiver_empID,$zr_receiver_empID,$heritage_name,$sender_roll,$sender_empID){
            $heritage_id = $this->session->userdata('heritage_id_updated');            

            if (isset($_POST['btn_approve'])) {
            
            $this->heritage_model->update_approval_to_region($heritage_id);
            $this->session->set_flashdata("registered_successfully","Heritage Registration Approved Successfully");

            if ($sender_roll == 'RR') {

                $data1 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $wr_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'registration is approved by regional registrar and registered as a heritage',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'HR_approval',
                  'flag'                    => '0'
                );

                $data2 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $zr_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'registration is approved by regional registrar and registered as a heritage',
                  'roll'                    => $sender_roll,
                  'date'                    => date('Y-m-d'),
                  'status'                  => 'HR_approval',
                  'flag'                    => '0'
                );

                $this->heritage_model->rr_feedback_model($data1,$data2);
              }

            }

            if (isset($_POST['btn_reject'])) {

              $this->heritage_model->update_rejection_to_region($heritage_id);
              $this->session->set_flashdata("danger_message","Heritage Registration Rejected Successfully");

              if ($sender_roll == 'RR') {

                $data1 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $wr_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'registration is rejected by regional registrar',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'HR_rejection',
                  'flag'                    => '0'
                );

                $data2 = array(
                  'heritage_id'             => $heritage_id,
                  'receiver_id'             => $zr_receiver_empID,
                  'sender_id'               => $sender_empID,
                  'description'             => $heritage_name.'  '.'registration is rejected by regional registrar',
                  'date'                    => date('Y-m-d'),
                  'roll'                    => $sender_roll,
                  'status'                  => 'HR_rejection',
                  'flag'                    => '0'
                );

                $this->heritage_model->rr_feedback_model($data1,$data2);
              }

            }

            redirect('employee/index');
           }
         //Bete End

           //list of heritage registered by all .... i.e woreda, zone and region  

           public function list_of_heritage_found_in_country(){
             if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                }

            $data['list_of_heritage_registered_by_all']  = $this->heritage_model->load_heritage_registered_by_all();                          

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

            $this->load->view('template/header_WR',$data);
            $this->load->view('employee/list_of_registered_heritage',$data);
            $this->load->view('template/footer_WR');

            //print_r($data['list_of_heritage_registered_by_all']);
           }
                

           public function list_of_heritage_registerd_by_wr(){
             if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                }

            $data['list_of_heritage_registered_by_all']  = $this->heritage_model->load_all_heritage_found_in_woreda();

            $data['load_heritage_registerd_in_woreda'] = $this->heritage_model->list_heritage_registerd_in_woreda();

            $data['list_of_heritage_rejected_by'] = $this->heritage_model->list_of_heritage_rejected_by_zr_and_rr();                  

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

            $this->load->view('template/header_WR',$data);
            $this->load->view('employee/list_of_registered_heritage',$data);
            $this->load->view('template/footer_WR');

            //print_r($data['list_of_heritage_registered_by_all']);
           }

           public function list_of_heritage_needs_zr_approval(){
             if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                }

            $data['list_of_heritage_registered_by_all']  = $this->heritage_model->load_all_heritage_found_in_zone();          

            $data['load_heritage_registerd_in'] = $this->heritage_model->load_heritage_registerd_in_woreda_needs_zone_approval();

            $data['list_of_heritage_approved_by_zr'] = $this->heritage_model->list_of_heritage_approved_by_zr();

            $data['list_of_heritage_rejected_by'] = $this->heritage_model->list_of_heritage_rejected_by_zr();          

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

            $this->load->view('template/header_WR',$data);
            $this->load->view('employee/list_of_registered_heritage',$data);
            $this->load->view('template/footer_WR');

            //print_r($data['list_of_heritage_registered_by_all']);
           }

           public function list_of_heritage_needs_rr_approval(){
             if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                }

            $data['list_of_heritage_registered_by_all']  = $this->heritage_model->load_heritage_found_in_region();

            //For Federal
            //$data['list_of_heritage_registered_by_all']  = $this->heritage_model->load_heritage_registered_by_all();          

            $data['load_heritage_registerd_in'] = $this->heritage_model->load_heritage_registerd_in_zone_needs_region_approval();

            $data['list_of_heritage_rejected_by'] = $this->heritage_model->list_of_heritage_rejected_by_rr();

            $data['list_of_heritage_rejected_by_zr'] = $this->heritage_model->list_of_heritage_rejected_by_zr();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();

            $this->load->view('template/header_WR',$data);
            $this->load->view('employee/list_of_registered_heritage',$data);
            $this->load->view('template/footer_WR');

            //print_r($data['list_of_heritage_registered_by_all']);
           }


           public function load_heritage_registerd_in_woreda(){
              if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
                }
                $data['load_heritage_registerd_in_woreda'] = $this->heritage_model->load_heritage_registerd_in_woreda();

                $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

                $data['count'] = $this->heritage_model->count_notification_model();
                //print_r($data['heritage_registerd_in_woreda']);
                $this->load->view('template/header_WR',$data);
                $this->load->view('employee/list_of_registered_heritage_in_woreda',$data);
                $this->load->view('template/footer_WR');
           }


           //promot heritage
           function promot_heritage(){
               if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
             }

            
            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('heritage/promot_heritage');
            $this->load->view('template/footer_WR');
           }

           function logic_promote_heritage(){

            $date_val = date('Y/m/d');

            /*

             $config['upload_path'] = './assets/images/pheritage';
             $config['allowed_types'] = 'gif|png|jpg';
             $config['max_size'] = '2048';
             $config['max_width'] = '1200';
             $config['max_height'] = '1200';
             $this->load->library('upload',$config);

              if(!$this->upload->do_upload()){
                     $errors = array('error' => $this->upload->display_errors());
                      //$post_image = 'default.jpg';
                       }else{
                     $data = array('upload_data' => $this->upload->data());
                     $post_image = $_FILES['userfile']['name'];
                    }
                    */
              $data = array(
                    'heritage_id'       => $this->input->post('heritage_id'),
                    'description_new'   => $this->input->post('description'),
                    'date'              => $date_val,
                    'emp_id'            => $emp_id = $this->session->userdata('user_id'),
                    'flag'              => '0'
                    
                );

              //$id = $this->session->userdata('NationalRNO');
              //$userdataa = $this->session->userdata('data_user');

              //$arr_merge = array_merge($userdataa,$data);
              $res = $this->heritage_model->logic_promote_heritage($data);
              $this->session->set_flashdata('promoted_successfully','Heritage Promoted Successfully');
              redirect('employee/index');
           }
           //chart js
           //load woreda name and aboundance 

        function chart_woreda_name_with_aboundace(){
            $data['test'] = $this->heritage_model->chart_woreda_name_with_aboundace();

            //print_r($data['test']);

      
            $myArray = $data['test'];
            $arr = array();
            $arr['aboundance'] = array();

            //$arr_woreda_id = array();
            $arr['woreda_id'] = array();

            foreach ($myArray as $i => $values) {
              foreach ($values as $key => $value) {
                if($key == "Aboundance"){
                  array_push($arr['aboundance'], $value);
                  //print "$i, $key => $value<br>";
                }
                if($key == "woreda_id"){
                  array_push($arr['woreda_id'], $value);
                }
                  
              }
            }
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
            //print_r($arr);
      
           }

           //report section controller



          // report of all heritage registerd in the woreda only
      public function report_wr(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }
            
             $username = $this->session->userdata('username');

             $category = $this->input->post('heritage_category');
             if($category == 'all'){
              $content = '<h3 style="text-align: center;">List Of All Heritage Registered In Woreda That Needs Zone Approval</h3>';
              $content .= $this->heritage_model->load_heritage_registerd_in_woreda_report_all();
             }
             if($category == 'site_land'){
              $content = '<h3 style="text-align: center;">List Of All Site Land Heritage Registered In Woreda That Needs Zone Approval</h3>';
              $content .= $this->heritage_model->load_heritage_registerd_in_woreda_report_all_site_land();
             }
             if($category == 'arichilogical_finding'){
              $content = '<h3 style="text-align: center;">List Of All Arichilogical Finding Heritage Registered In Woreda That Needs Zone Approval</h3>';
              $content .= $this->heritage_model->load_heritage_registerd_in_woreda_report_all_arichilogical_finding();
             }
             $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
             $this->pdf->loadHtml($content);
             $this->pdf->render();
             $this->pdf->stream(""."report_". date('Y_m_d H_i_s') . ".pdf", array("Attachment" => 0));
              
      }


      //report of all heritage registerd in the contry
      public function report_heritage_all(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }
            
             $username = $this->session->userdata('username');
             $limit = $this->input->post('limit');

             $category = $this->input->post('heritage_category');
             if($category == 'all'){
              $content = '<h3 style="text-align: center;">List Of All Heritage Registered</h3>';
              $content .= $this->heritage_model->load_heritage_registered_by_all_report();
             }
             if($category == 'site_land'){
              $content = '<h3 style="text-align: center;">List Of All Site Land Heritage Registered </h3>';
              $content .= $this->heritage_model->load_heritage_registered_by_all_report_site_land();
             }
             if(($category == 'arichilogical_finding') && ($limit == 'all')){
              $content = '<h3 style="text-align: center;">List Of All Arichilogical Finding Heritage Registered</h3>';
              $content .= $this->heritage_model->load_heritage_registered_by_all_report_arichilogical_finding();
             }
             if($category == 'arichilogical_finding' && ($limit != 'all')){
              $content = '<h3 style="text-align: center;">List Of All Arichilogical Finding Heritage Registered</h3>';
              $content .= $this->heritage_model->load_heritage_registered_by_all_report_arichilogical_finding_with_limit($limit);
             }
             $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
             $this->pdf->loadHtml($content);
             $this->pdf->render();
             $this->pdf->stream(""."report_". date('Y_m_d H_i_s') . ".pdf", array("Attachment" => 0));
      }

      public function report_wr_setting(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }
           $this->load->view('template/header_WR');
            $this->load->view('report/report_wr_setting');
            $this->load->view('template/footer_WR');
      }

      public function report_heritage_setting_all(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }
           $this->load->view('template/header_WR');
            $this->load->view('report/report_heritage_setting_all');
            $this->load->view('template/footer_WR');
      }

    }// end of class_alias()