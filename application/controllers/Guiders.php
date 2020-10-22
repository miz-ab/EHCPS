<?php
    class Guiders extends CI_Controller{

    	public function api_get_all_guiders(){
    	  $guiders_arr = array();
          $guiders_arr['list_of_guiders'] = array();
          $res = $this->guiders_model->api_get_all_guiders();

          foreach($res->result_array() as $row){
               $user_item = array(
                 'id'          => $row['tour_guider_id'],
                 'username'    => $row['username'],
                 'email'       => $row['email'],
                 'phone'	     => $row['phone'],
                 'photo' 	     => $row['photo'],
                 'address'	   => $row['address'],
                 'fb'		       => $row['fb'],
                 'status'	     => $row['status'],
                 'bio'         => $row['bio'],
                 'LA' 		     => $row['LA'],
                 'LO'		       => $row['LO']
                  );

        array_push($guiders_arr['list_of_guiders'],$user_item);
      }

      echo json_encode($guiders_arr,JSON_UNESCAPED_UNICODE);
    	}

      public function api_get_single_guider($id){

          $guider_arr = array();
          $guider_arr['single_guider'] = array();
          $res = $this->guiders_model->api_get_single_guider($id);

           foreach($res->result_array() as $row){
           $guider_item = array(
          'tour_guider_id'          => $row['tour_guider_id'],
          'username'                => $row['username'],
          'localname'               => $row['address'],
          'photo'                   => $row['photo'],
          'bio'                     => $row['bio'],
          'fb'                      => $row['fb'],
          'email'                   => $row['email'],
          'phone'                   => $row['phone'],
          'status'                  => $row['status']
        );

        array_push($guider_arr['single_guider'],$guider_item);
        }

      echo json_encode($guider_arr,JSON_UNESCAPED_UNICODE);
      }

      public function api_update_profile(){

         header('Content-type: bitmap; charset=utf-8');
            $image_path   = './assets/users/guiders';
            $image_name   = md5(uniqid(rand(),true));
            $file_name    = $image_name . '.' .'png';
            $full_path    = $image_path.'/'.$file_name;

            $this->load->helper('file');

            if ($this->input->post('user_photo')) {
              $image = base64_decode($this->input->post('user_photo'),TRUE);  
              file_put_contents($full_path,$image);
            }
          
            
        $data = array(
            
            'email'  => $this->input->post('user_email'),
            'phone'  => $this->input->post('user_phone'),
            'fb'     => $this->input->post('user_fb'),
            'status' => $this->input->post('user_status'),
            'bio'    => $this->input->post('user_bio'),
        );

        $data_with_image = array(
            
            'email'  => $this->input->post('user_email'),
            'phone'  => $this->input->post('user_phone'),
            'fb'     => $this->input->post('user_fb'),
            'status' => $this->input->post('user_status'),
            'bio'    => $this->input->post('user_bio'),
            'photo'  => $file_name
        );

        if ($this->input->post('user_photo')) {
               $result = $this->guiders_model->api_update_profile($data_with_image);
            }else{
               $result = $this->guiders_model->api_update_profile($data);
            }

        if ($result) {
          $json_data['res'] = "1";
          echo json_encode($json_data);
        }else{
          $json_data['res'] = "0";
          echo json_encode($json_data);
        }

    }

     /*
      added values new 
    */

    public function api_get_list_of_rate_value_with_total_no($id){

      $res      = $this->guiders_model->api_get_ratting_value_of_guider($id);
      $val      = $this->guiders_model->api_get_no_of_count_ratting_value($id);

      $guider_arr = array();
      $guider_arr['list_of_guiders'] = array();
      $final_arr['val'] = $res."-".$val;
      //$json_data['res'] = $res."-".$val;

      array_push($guider_arr['list_of_guiders'],$final_arr);
      
      echo json_encode($guider_arr);
  }

  public function test($id){
    $check_id_exist = $this->guiders_model->api_check_if_ratting_id_exist($id);

    if($check_id_exist){
      echo json_encode('exist');

    }else{
      echo json_encode('not yet');
    }
  }

  public function api_update_or_give_new_ratting($id){
    $check_id_exist = $this->guiders_model->api_check_if_ratting_id_exist($id);
    $data = array('value'  => $this->input->post('ratting__val'));
    $full_data = array(
      'user_id'       => $this->input->post('user_id'),
      'guider_id'     => $this->input->post('guider_id'),
      'value'         => $this->input->post('ratting__val')
    );
    if($check_id_exist){
      //id allready exist . . . update the value
      $res = $this->guiders_model->api_update_ratting_value($full_data);
      if($res){
        echo json_encode('updated');
      }else{
        echo json_encode('not yet');
      }
    }else{
      //id dose not exit . . . enter new value
      $res = $this->guiders_model->api_insert_new_rate_value($full_data);
      if($res){
        echo json_encode('inserted');
      }else{
        echo json_encode('not yet inserted');
      }
    }

  }  

    //Bete Begin

    function register_tour_guider(){
       if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
             }

            
            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('guiders/guider_registration_form_one');
            $this->load->view('template/footer_WR');
    }

    //check if username exist or not 
    function check_guider_username_exists($username){
      $res = $this->guiders_model->check_guider_username_exists_model($username);
      if($res){
        echo json_encode('A');
      }else{
        echo json_encode('B');
      }
    }

    function guider_registration_one(){
        if (!$this->session->userdata('logged_in')) {
            redirect('login/index');
        }

        $emp_id = $this->session->userdata('user_id');
        $password_rand = rand(1000,10000);        
        
        //print_r($password_rand);
        $data = array(
              'first_name'            => $this->input->post('fname'),              
              'last_name'             => $this->input->post('lname'),
              'sex'                   => $this->input->post('sex'),              
              'email'                 => $this->input->post('email'),
              'fb'                    => $this->input->post('fb'),
              'phone'                 => $this->input->post('phone_no'),
              'username'              => $this->input->post('username'),
              'password'              => md5('mizab'),
              'photo'                 => 'default.png',
              'flag'                  => '1',
              'status'                => '1',
              'emp_id'                => $emp_id
              );

        //send the password to users email address

        $this->load->config('email');

        $this->load->library('email');

        $from = $this->config->item('smtp_user');

        $to = "mizaby19@gmail.com";
        $subject = 'Dear ' . $this->input->post('guider_fname');
        $message = "Your temporary password is " . $password_rand . " and Your username " 
             . $this->input->post('guider_username'). "  You can change the password after first login";

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

        $this->session->set_userdata('tour_guider_username',$this->input->post('guider_username'));
        $this->session->set_userdata('guider_data',$data);                
        redirect('guiders/guider_registration_form_two');
      }

      public function guider_registration_form_two(){

        if (!$this->session->userdata('logged_in')) {
        redirect('login/index');
            }

          $guiderdata = $this->session->userdata('guider_data');
          $username       = $this->session->userdata('tour_guider_username');

          $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
          $data['count'] = $this->heritage_model->count_notification_model();
          
          $this->load->view('template/header_WR',$data);
          $this->load->view('guiders/guider_registration_form_two');
          $this->load->view('template/footer_WR'); 
              
      }

      function guider_registration_two(){

        $action = $this->input->post('action');
        if($action === '<<'){
          redirect('guiders/register_tour_guider');              
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
                'LA'         => $this->input->post('la'),
                'LO'         => $this->input->post('lo'),
                'address'    => $this->input->post('address'),
                'bio'        => 'Bio...'                     
            );

          $username = $this->session->userdata('tour_guider_username');
          $userdataa = $this->session->userdata('guider_data');

          $arr_merge = array_merge($userdataa,$data);
          $res = $this->guiders_model->tour_guide_registration_model($arr_merge);
          
          $this->session->set_flashdata("registered_successfully","Successfully Tour Guid Registered");

          redirect('employee/index');
            
        }     
      }

      //Bete End
  }