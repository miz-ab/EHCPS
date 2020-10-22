<?php
    class Tourist extends CI_Controller{

    //Bete Begin

    function register_tourist(){
       if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
             }

            
            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('tourist/tourist_registration_form_one');
            $this->load->view('template/footer_WR');
    }

    //check if username exist or not 
    function check_tourist_username_exists($username){
      $res = $this->tourist_model->check_tourist_username_exists_model($username);
      if($res){
        echo json_encode('A');
      }else{
        echo json_encode('B');
      }
    }

    function tourist_registration_one(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }

        $emp_id = $this->session->userdata('user_id');
        $password_rand = rand(1000,10000);        
        
        //print_r($password_rand);
        $data = array(
              'first_name'            => $this->input->post('fname'),
              'middle_name'           => $this->input->post('mname'),              
              'last_name'             => $this->input->post('lname'),
              'sex'                   => $this->input->post('sex'),              
              'email'                 => $this->input->post('email'),
              'date_of_birth'         => $this->input->post('dob'),              
              'username'              => $this->input->post('username'),
              'password'              => md5('mizab'),
              'photo'                 => 'default.png',
              'flag'                  => '2',              
              'emp_id'                => $emp_id
              );

        //send the password to users email address

        $this->load->config('email');

        $this->load->library('email');

        $from = $this->config->item('smtp_user');

        $to = "mizaby19@gmail.com";
        $subject = 'Dear ' . $this->input->post('tourist_fname');
        $message = "Your temporary password is " . $password_rand . " and Your username " 
             . $this->input->post('tourist_username'). "  You can change the password after first login";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($this->input->post('email'));
        $this->email->subject($subject);
        $this->email->message($message);

        
        /* if ($this->email->send()) {
            //$this->session->set_flashdata("email_sent","password sent successfully.");
        } else {
            show_error($this->email->print_debugger());
        }  */                
        
        $this->session->set_userdata('tourist_data',$data);                
        redirect('tourist/tourist_registration_form_two');
      }

      public function tourist_registration_form_two(){

        if (!$this->session->userdata('logged_in')) {
        redirect('login/index');
            }

          $touristdata = $this->session->userdata('tourist_data');          

          $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
          $data['count'] = $this->heritage_model->count_notification_model();
          
          $this->load->view('template/header_WR',$data);
          $this->load->view('tourist/tourist_registration_form_two');
          $this->load->view('template/footer_WR'); 
              
      }

      function tourist_registration_two(){

        $action = $this->input->post('action');
        if($action === '<<'){
          redirect('tourist/register_tourist');              
        }else{

         /*$config['upload_path'] = './assets/heritage';
         $config['allowed_types'] = 'gif|png|jpg';
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
                }*/
          $data = array(
                //'photo'        => $post_image,
                'passport_no'           => $this->input->post('passport'),
                'Country'               => $this->input->post('country'),
                'date_Of_entry'         => $this->input->post('doe'),
                'date_of_return'        => $this->input->post('dor')                    
            );
          
          $userdataa = $this->session->userdata('tourist_data');

          $arr_merge = array_merge($userdataa,$data);
          $res = $this->tourist_model->tourist_registration_model($arr_merge);
          
          $this->session->set_flashdata("registered_successfully","Successfully Tourist Registered");

          redirect('employee/index');
            
        }     
      }

      //Bete End
  }