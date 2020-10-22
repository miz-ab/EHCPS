<?php
    class Employee extends CI_Controller{

    	function index(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }
        //print_r($data['load_heritage_registerd_in_woreda']);
        $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
        $data['count'] = $this->heritage_model->count_notification_model();
        
        $this->load->view('template/header_WR',$data);

        if($this->session->userdata('userroll') == 'WR'){
          $data['load_heritage_registerd_in_woreda'] = $this->heritage_model->load_heritage_registerd_in_woreda();

          //print_r($data['load_heritage_registerd_in_zone']);
           $this->load->view('employee/wr_home',$data);
        }
        if($this->session->userdata('userroll') == 'ZR'){          
          //print_r($data['load_heritage_registerd_in_zone']);
          $this->load->view('employee/zr_home',$data);
        }
        if($this->session->userdata('userroll') == 'RR'){          
          $this->load->view('employee/rr_home', $data); 
        }
        if($this->session->userdata('userroll') == 'RD'){
          $data['load_heritage_registerd_in_all'] = $this->heritage_model->load_heritage_registerd_in_region_for_RD();

          $this->heritage_model->notify_not_maintained_heritage();

          $this->load->view('employee/rd_home',$data); 
        }
        if($this->session->userdata('userroll') == 'RTDD'){
          //$data['load_heritage_registerd_in_all'] = $this->heritage_model->load_heritage_registerd_in_region_for_RD();
          //print_r($data['load_heritage_registerd_in_all']);
          $this->load->view('employee/rtdd_home'); 
        }

        //Bete Begin

        if($this->session->userdata('userroll') == 'FHRA'){

          $this->load->view('employee/fhra_home'); 
        }
        if($this->session->userdata('userroll') == 'FHSA'){

          $this->load->view('employee/fhsa_home'); 
        }
        if($this->session->userdata('userroll') == 'FTDD'){

          $this->load->view('employee/ftdd_home'); 
        }

        if($this->session->userdata('userroll') == 'registrar'){

          $this->load->view('employee/registrar_home'); 
        }

        if($this->session->userdata('userroll') == 'ZME'){
          $data['load_heritage_registerd_in_zone'] = $this->heritage_model->load_heritage_registerd_in_woreda_needs_zone_approval();
          //print_r($data['load_heritage_registerd_in_zone']);
          $this->load->view('employee/zme_home',$data);
        }
        if($this->session->userdata('userroll') == 'RME'){
          $data['load_heritage_registerd_in_region'] = $this->heritage_model->load_heritage_registerd_in_zone_needs_region_approval();
          $this->load->view('employee/rme_home', $data); 
        }
        if($this->session->userdata('userroll') == 'RHS'){
          $data['load_heritage_registerd_in_zone'] = $this->heritage_model->load_heritage_registerd_in_woreda_needs_zone_approval();
          //print_r($data['load_heritage_registerd_in_zone']);
          $this->load->view('employee/rhs_home',$data);
        }
        
        //Bete End
        
        if($this->session->userdata('userroll') == 'AC_Admin'){
          $this->load->view('employee/Ac_admin_home'); 
        }
        $this->load->view('template/footer_WR');
    	}

      // Bete Begin

      public function announce_instruction(){
       if (!$this->session->userdata('logged_in')) {
      redirect('login/index');
          }      
          
      $data['regions'] = $this->heritage_model->load_region();

      $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

      $data['count'] = $this->heritage_model->count_notification_model();

      $this->load->view('template/header_WR',$data);
      $this->load->view('employee/announce_instruction',$data);
      $this->load->view('template/footer_WR');    
     }


      public function add_region(){
       if (!$this->session->userdata('logged_in')) {
      redirect('login/index');
          }                                  

      $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

      $data['count'] = $this->heritage_model->count_notification_model();

      $this->load->view('template/header_WR',$data);
      $this->load->view('employee/add_region',$data);
      $this->load->view('template/footer_WR');    
     }

     function register_region(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }        
          
          $data = array(
            'region_id'           => $this->input->post('region_id'),
            'region_name'         => $this->input->post('region_name'),            
            );

          $this->employee_model->register_region_model($data);
          $this->session->set_flashdata("registered_successfully","Registered successfully");

          redirect('employee/add_region');
        }

        function register_zone(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }        
          
          $data = array(
            'zone_id'           => $this->input->post('zone_id'),
            'zone_name'         => $this->input->post('zone_name'),
            'region_id'         => $this->input->post('region_option'),            
            );

          $this->employee_model->register_zone_model($data);
          $this->session->set_flashdata("registered_successfully","Registered successfully");

          redirect('employee/add_zone');
        }

        function register_woreda(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }        
          
          $data = array(
            'woreda_id'           => $this->input->post('woreda_id'),
            'woreda_name'         => $this->input->post('woreda_name'),
            'zone_id'             => $this->input->post('zone_option'),                      
            );

          $this->employee_model->register_woreda_model($data);
          $this->session->set_flashdata("registered_successfully","Registered successfully");

          redirect('employee/add_woreda');
        }

        function register_kebele(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }        
          
          $data = array(
            'kebele_id'             => $this->input->post('kebele_id'),
            'kebele_name'           => $this->input->post('kebele_name'),
            'woreda_id'             => $this->input->post('woreda_option'),                      
            );

          $this->employee_model->register_kebele_model($data);
          $this->session->set_flashdata("registered_successfully","Registered successfully");

          redirect('employee/add_kebele');
        }

     public function add_zone(){
       if (!$this->session->userdata('logged_in')) {
      redirect('login/index');
          }                                  

      $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

      $data['count'] = $this->heritage_model->count_notification_model();
      $data['regions'] = $this->heritage_model->load_region();      

      $this->load->view('template/header_WR',$data);
      $this->load->view('employee/add_zone',$data);
      $this->load->view('template/footer_WR');

      //print_r($data['list_of_heritage_registered_by_all']);
     }

     public function add_woreda(){
       if (!$this->session->userdata('logged_in')) {
      redirect('login/index');
          }                                  

      $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

      $data['count'] = $this->heritage_model->count_notification_model();
      $data['regions'] = $this->heritage_model->load_region();
      $data['zones'] = $this->heritage_model->load_zone();

      $this->load->view('template/header_WR',$data);
      $this->load->view('employee/add_woreda',$data);
      $this->load->view('template/footer_WR');

      //print_r($data['list_of_heritage_registered_by_all']);
     }

     public function add_kebele(){
       if (!$this->session->userdata('logged_in')) {
      redirect('login/index');
          }                                  

      $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

      $data['count'] = $this->heritage_model->count_notification_model();
      $data['regions'] = $this->heritage_model->load_region();
      $data['zones'] = $this->heritage_model->load_zone();
      $data['woredas'] = $this->heritage_model->load_woreda();

      $this->load->view('template/header_WR',$data);
      $this->load->view('employee/add_kebele',$data);
      $this->load->view('template/footer_WR');

      //print_r($data['list_of_heritage_registered_by_all']);
     }  

      public function list_of_employee(){
         if (!$this->session->userdata('logged_in')) {
        redirect('login/index');
            }        

        $data['list_of_user']  = $this->employee_model->list_of_employee_model();

        $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
        $data['count'] = $this->heritage_model->count_notification_model();
        
        $this->load->view('template/header_WR',$data);
        $this->load->view('employee/list_of_user',$data);
        $this->load->view('template/footer_WR');
        
      }

      public function list_of_icadmin(){
         if (!$this->session->userdata('logged_in')) {
        redirect('login/index');
            }        

        $data['list_of_user']  = $this->employee_model->list_of_icadmin_model();

        $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
        $data['count'] = $this->heritage_model->count_notification_model();
        
        $this->load->view('template/header_WR',$data);
        $this->load->view('employee/list_of_user',$data);
        $this->load->view('template/footer_WR');
        
      }    

      public function roll_management($username){        
        if (isset($_POST['btn_save_changes'])) {                

          $data = array(   
          'roll'             =>$this->input->post('new_roll'),                                              
          );        
          if($this->employee_model->roll_management_model($username,$data))
            $this->session->set_flashdata("registered_successfully","Successfully Roll Altered");
          else
            $this->session->set_flashdata("danger_message","Roll Altration Failed");
          redirect('employee/list_of_employee');       
        }        
      }

      public function status_management($username){

        if (isset($_POST['btn-activate'])) {                

          $data = array(   
          'status'             =>'active',                                              
          );        
          if($this->employee_model->status_management_model($username,$data))
            $this->session->set_flashdata("registered_successfully","User Account Activated");
          else
            $this->session->set_flashdata("danger_message","Status Deactivation Failed");

          if($this->session->userdata('userroll') == 'RD'){
            redirect('employee/list_of_employee');
          }

          if($this->session->userdata('userroll') == 'RTDD'){
            redirect('employee/list_of_icadmin');
          }
                 
        }
        if (isset($_POST['btn-deactivate'])) {
          $data = array(   
          'status'             =>'disabled',                                              
          );        
          if($this->employee_model->status_management_model($username,$data))
            $this->session->set_flashdata("danger_message","User Account Deactivated");
          else
            $this->session->set_flashdata("not_registered_successfully","Status Deactivation Failed");
          
          if($this->session->userdata('userroll') == 'RD'){
            redirect('employee/list_of_employee');
          }

          if($this->session->userdata('userroll') == 'RTDD'){
            redirect('employee/list_of_icadmin');
          }
          
        }
      }

      public function user_profile($empID){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            //print_r($empID);

            //$empID = $this->session->userdata('user_id');

            $data['user_profile']  = $this->employee_model->user_profile_model($empID);                          

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('employee/user_profile',$data);
            $this->load->view('template/footer_WR');
        }

      public function change_profile_picture($empID){        
        if (isset($_POST['btn_save_image_changes'])) {

         $config['upload_path'] = './assets/users/employee';
         $config['allowed_types'] = 'gif|png|jpg';
         $config['max_size'] = '2048';
         $config['max_width'] = '2600';
         $config['max_height'] = '2000';
         $this->load->library('upload',$config);

          if(!$this->upload->do_upload()){
                 $errors = array('error' => $this->upload->display_errors());                 
                   }else{
                 $data = array('upload_data' => $this->upload->data());
                 $profile_image = $_FILES['userfile']['name'];
               }                

          $data = array(   
          'user_photo'             =>$profile_image,                                              
          );        
          if($this->employee_model->change_profile_picture_model($empID,$data))
            $this->session->set_flashdata("registered_successfully","Successfully change your profile picture");
          else
            $this->session->set_flashdata("registered_successfully","Profile picture altration failed");
          redirect('employee/user_profile/'.$empID);       
        }        
      }

      public function change_email($empID){        
        if (isset($_POST['btn_save_email_changes'])) {                

          $data = array(   
          'email'             =>$this->input->post('new_email'),                                              
          );        
          if($this->employee_model->change_email_model($empID,$data))
            $this->session->set_flashdata("registered_successfully","Successfully E-mail Altered");
          else
            $this->session->set_flashdata("registered_successfully","E-mail Altration Failed");
          redirect('employee/user_profile/'.$empID);       
        }        
      } 

      public function change_password($empID){        
        if (isset($_POST['btn_save_password_changes'])) { 

        $oldpass    =   md5($this->input->post('old_pass'));
        $newpass    =   md5($this->input->post('new_pass'));
        $confpass   =   md5($this->input->post('conf_pass')); 

        $old_password = $this->employee_model->old_password_model($empID,$oldpass);

        if ($old_password) {
           if ($newpass == $confpass) {
             $data = array(   
            'password'    => $confpass,                     
            );        
            if($this->employee_model->change_password_model($empID,$data))
              $this->session->set_flashdata("registered_successfully","Successfully Password Altered");
            else
              $this->session->set_flashdata("registered_successfully","Password Altration Failed");
           } else {
             $this->session->set_flashdata("registered_successfully","New password not match");
           }
           
         } else {
           $this->session->set_flashdata("registered_successfully","Incorrect old password");
         }                                        
          redirect('employee/user_profile/'.$empID);       
        }        
      }

      // Bete End

    	function register_index(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }

    	  $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
        $data['count'] = $this->heritage_model->count_notification_model();
              
        $this->load->view('template/header_WR',$data);
        $this->load->view('employee/registration_employee');
        $this->load->view('template/footer_WR');
    	}

    	function employee_registration_two(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }
    	 $data['regions'] = $this->heritage_model->load_region();

    	  $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
        $data['count'] = $this->heritage_model->count_notification_model();
              
        $this->load->view('template/header_WR',$data);
        $this->load->view('employee/registration_employee_two',$data);
        $this->load->view('template/footer_WR');
    	}

      function create_account_of_ICADMIN(){  /****************/
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }


        $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
        $data['count'] = $this->heritage_model->count_notification_model();
              
        $this->load->view('template/header_WR',$data);
        $this->load->view('employee/registration_acAdmin');
        $this->load->view('template/footer_WR');
           }

    	function logic_employee_registration_one(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }
        $password_rand = rand(1000,10000);
        
        //print_r($password_rand);
    		$data = array(
              'emp_id'               => $this->input->post('emp_id'),
              'first_name'           => $this->input->post('emp_fname'),
              'middle_name'          => $this->input->post('emp_mname'),
              'last_name'            => $this->input->post('emp_lname'),
              'sex'                  => $this->input->post('emp_sex'),
              'roll'                 => $this->input->post('emp_roll'),
              'email'                => $this->input->post('emp_email'),
              'date_of_birth'        => $this->input->post('dateOB'),
              'username'			       => $this->input->post('emp_username'),
              'password'             => md5('bete'),
              'user_photo'           => 'default.png',
              'flag'                 => '0',
              'status'               => 'active'
              );

        //send the password to users email address

        $this->load->config('email');

        $this->load->library('email');

        $from = $this->config->item('smtp_user');

        $to = "mizaby19@gmail.com";
        $subject = 'Dear ' . $this->input->post('emp_fname');
        $message = "Your temporary password is " . $password_rand . " and Your username " 
             . $this->input->post('emp_username'). "  You can change the password after first login";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($this->input->post('emp_email'));
        $this->email->subject($subject);
        $this->email->message($message);

        
         /*if ($this->email->send()) {
            //$this->session->set_flashdata("email_sent","password sent successfully.");
        } else {
            show_error($this->email->print_debugger());
        }*/
        
        

        /*

         $this->email->from($from_email, 'EHCPS Admin'); 
         $this->email->to($to_email);
         $this->email->subject('Dear ' . $this->input->post('emp_fname')); 
         $this->email->message('Your Temp password is ' . $password_rand);

         if($this->email->send()){
          print_r('email sent');
          $this->session->set_flashdata("email_sent","password sent successfully.");
         }else{
          error_log("Failed to connect to database!", 0);
         }

         */
        $this->session->set_userdata('hidden_emp_id',$this->input->post('emp_id'));
    		$this->employee_model->logic_employee_registration_one($data);
        //$this->session->set_userdata('data_emp',$data);
        redirect('employee/employee_registration_two');
    	}

      function logic_ac_admin_registration_one(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }
        $password_rand = rand(1000,10000);
        
        //print_r($password_rand);
        $data = array(
              'emp_id'               => $this->input->post('emp_id'),
              'first_name'           => $this->input->post('emp_fname'),
              'middle_name'          => $this->input->post('emp_mname'),
              'last_name'            => $this->input->post('emp_lname'),
              'sex'                  => $this->input->post('emp_sex'),
              'roll'                 => 'AC_Admin',
              'email'                => $this->input->post('emp_email'),
              'date_of_birth'        => $this->input->post('dateOB'),
              'username'             => $this->input->post('emp_username'),
              'password'             => md5('bete'),
              'user_photo'           => 'default.png',
              'flag'                 => '3',
              'status'               => 'active'
              );
        

        $this->load->config('email');

        $this->load->library('email');

        $from = $this->config->item('smtp_user');

        $to = "mizaby19@gmail.com";
        $subject = 'Dear ' . $this->input->post('emp_fname');
        $message = "Your temporary password is " . $password_rand . 
                              " and Your username " .$this->input->post('emp_username'). "  You can change the password after first login";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($this->input->post('emp_email'));
        $this->email->subject($subject);
        $this->email->message($message);
        
        $this->session->set_userdata('hidden_emp_id',$this->input->post('emp_id'));
        $this->employee_model->logic_ac_admin_registration_one($data);
        //$this->session->set_userdata('data_emp',$data);
        redirect('employee/employee_registration_two');

        /*

         if ($this->email->send()) {
            $this->session->set_flashdata("email_sent","password sent successfully.");
        } else {
            show_error($this->email->print_debugger());
        }

        */

      } // end of ac admin registration

    	function logic_employee_registration_last(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }
    		$action = $this->input->post('action');
    		if($action == 'Finish'){
          $res = $this->employee_model->get_last_user_from_db();
          //print_r($res->emp_id);
    			
          $data = array(
          	'region_id'      => $this->input->post('region_id'),
          	'zone_id'        => $this->input->post('zone_id'),
          	'wereda_id'      => $this->input->post('woreda_id'),
          	'kebele_id'      => $this->input->post('kebele_id'),
          	'emp_id'		     => $this->input->post('hidden_emp_id')
          	);

          $this->employee_model->logic_employee_registration_last($data);
          $this->session->set_flashdata("registered_successfully","Registered successfully");

          $langData = array(
                            'user_id' => $this->input->post('hidden_emp_id'),
                            'lang'    =>  '0' 
                          );
          $this->employee_model->language_data($langData);

          redirect('employee/index');
        }
          
    	}

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

          //check if username exist or not 
          function check_user_username_exists($username){
            $res = $this->employee_model->check_user_username_exists($username);
            if($res){
              echo json_encode('A');
            }else{
              echo json_encode('B');
            }
          }

          function announce_fedral_instruction(){

            $user_federal_id = $this->session->userdata('user_id');

            if (!$this->session->userdata('logged_in')) {
              redirect('login/index');
              }

              $config['upload_path'] = './assets/fedral_assets';
              $config['allowed_types'] = 'gif|png|jpg|pdf';
              $config['max_size'] = '2048';
              $config['max_width'] = '2600';
              $config['max_height'] = '2000';
              $this->load->library('upload',$config);
  
               if(!$this->upload->do_upload()){
                       $errors = array('error' => $this->upload->display_errors());                     
                         }else{
                       $data = array('upload_data' => $this->upload->data());
                       $federal_attachement = $_FILES['userfile']['name'];
                      }

              $data = array(
                'title'       => $this->input->post('title'),
                'body'        => $this->input->post('description'),
                'date'        =>date('Y-m-d'),
                'flag'        => '0',
                'rd_id'       =>$this->input->post('region_id'),
                'federal_id'  =>$user_federal_id,
                'attachment'  => $federal_attachement
              );

              $this->employee_model->federal_instruction_announcement_model($data);
              $this->session->set_flashdata("registered_successfully","Announce successfully");

                redirect('employee/index');          
          }

          public function list_of_instruction(){
            if(!$this->session->userdata('logged_in')){
                   redirect('login/index');
            }          

            $data['list_of_instruction']  = $this->employee_model->list_of_instruction_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  

            $this->load->view('template/header_WR',$data);
            $this->load->view('employee/list_of_instruction',$data);
            $this->load->view('template/footer_WR');
        }

    }