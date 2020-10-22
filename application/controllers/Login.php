<?php
    class Login extends CI_Controller{

        public function api_login_as_employee(){
            
        	$username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $user_id = $this->login_model->api_login_as_employee($username,$password);
      
      
		      if($user_id){
		        $json_data['res'] = $user_id;
		        echo json_encode($json_data);
		      }else{
		        $json_data['res'] = '0';
		        echo json_encode($json_data);
		      }
        } //end of func api_login_as_employee   

        public function api_login_as_guider(){
        	
        	$username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $user_id = $this->login_model->api_login_as_guider($username,$password);

            if($user_id){
		        $json_data['res'] = $user_id;
		        echo json_encode($json_data);
		      }else{
		        $json_data['res'] = '0';
		        echo json_encode($json_data);
		      }

        }// end of func api_login_as_guider

        public function api_login_as_tourist(){

        	$username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $user_id = $this->login_model->api_login_as_tourist($username,$password);

            if($user_id){
		        $json_data['res'] = $user_id;
		        echo json_encode($json_data);
		      }else{
		        $json_data['res'] = '0';
		        echo json_encode($json_data);
		      }
        }//end of func api_login_as_tourist

        public function index(){

            

            $this->load->view('template/header_WR');
            $this->load->view('login/login_as_emp');
            $this->load->view('template/footer_WR');
        }


        public function login_as_emp(){
            $action = $this->input->post('action');
            //if($action == 'Login'){

            $username   = $this->input->post('username');
            $password   = md5($this->input->post('password'));
            //$status     = 'activate';

            $user_id = $this->login_model->login_as_emp($username,$password);

            
            
            if($user_id){

            $user_info = explode('.', $user_id);
            
            $userID             = $user_info[0];
            $userROLL           = $user_info[1];
            $user_photo         = $user_info[2];
            $user_photo_exc     = $user_info[3];
            $user_region        = $user_info[4];
            $user_zone          = $user_info[5];
            $user_woreda        = $user_info[6];
            $userNAME           = $username;

                $user_data = array(
            
                'user_id'                   => $userID,
                'userroll'                  => $userROLL,
                'username'                  => $username,
                'user_photo'                => $user_photo,
                'user_photo_exc'            => $user_photo_exc,
                'user_region_id'            => $user_region,
                'user_zone_id'              => $user_zone,
                'user_woreda_id'            => $user_woreda,
                'logged_in'                 => true
                  );

                //print_r($user_data);
            
            
               
            $this->session->set_userdata($user_data);
            $this->session->set_flashdata('login_sucess','You are now Loggedin');

            redirect('employee/index');
            }else{
                $this->session->set_flashdata('login_failed','Login Failed');
                redirect('login/index');
            }

            
            //}
        }// end of login

        public function logout(){

             $this->session->unset_userdata('logged_in');
             $this->session->unset_userdata('user_id');
             $this->session->unset_userdata('username');
             $this->session->unset_userdata('userroll');
             $this->session->unset_userdata('user_photo');
             $this->session->unset_userdata('user_photo_exc');
             $this->session->unset_userdata('user_woreda_id');
             $this->session->unset_userdata('user_zone_id');
             $this->session->unset_userdata('user_region_id');

            $this->session->set_flashdata('logged_out','You are now Loggedout');
             redirect('login/index');
        }

        function forgotpassword(){
            $this->load->view('template/header_WR');
            $this->load->view('login/forgot_password');
            $this->load->view('template/footer_WR');
        }

        function load_language_val_setting(){
            if($this->session->userdata('logged_in')){
            $data['lang_setting'] = $this->login_model->current_lang_val($this->session->userdata('user_id'));

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();

            $data['count'] = $this->heritage_model->count_notification_model();
                  
            $this->load->view('template/header_WR',$data);
            $this->load->view('template/lang',$data);
            $this->load->view('template/footer_WR');
            }else{
                redirect('employee/index');
            }
            
        }

        function set_lang_setting(){
            
            $this->login_model->set_lang_setting();
            
            redirect('employee/index');
            
        }

        function changepassword(){

        }

        public function authenticate_user($username,$password){
            $res = $this->login_model->authenticate_user($username,$password);
            if($res){
                echo json_encode($res);
            }else{
                echo json_encode('0');
            }
        }

        public function load_language_val(){
            $res = $this->login_model->load_language_val($this->session->userdata('user_id'));
            $arr = array();
            $arr['arr_lang'] = array();
            $arr_item = array(
                'id' => $res['id'],
                'am' => $res['am'],
                'en' => $res['en']
            );
            array_push($arr['arr_lang'],$arr_item);
            echo json_encode($arr);
        }

    }