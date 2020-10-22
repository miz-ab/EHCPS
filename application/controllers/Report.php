<?php
    class Report extends CI_Controller{

        public function __construct(){
          parent::__construct();
          $this->load->library('pdf');
        }

        /*
            generic reports they useful for all type of roll
        */  
    /*
        report display heritages that registered by all 
    */      

      public function report_heritage_registered_by_all(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }

          $data['category']= $this->heritage_model->category_model();

          $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
          $data['count'] = $this->heritage_model->count_notification_model();
          
          $this->load->view('template/header_WR',$data);
          $this->load->view('report/report_heritage_registered_by_all',$data);
          $this->load->view('template/footer_WR');
      }

        public function report_all_heritage_found_in_zone(){
            if (!$this->session->userdata('logged_in')) {
              redirect('login/index');
                  }
                
                 $username = $this->session->userdata('username');
                 $limit = $this->input->post('limit');
                 $category = $this->input->post('heritage_category');
                 if(($category == 'all') && ($limit == 'all')){
                  $content = '<h3 style="text-align: center;">List Of All Heritage Found In Zone</h3>';
                  $content .= $this->report_model->report_all_heritage_found_in_zone();
                  //$content .= $this->report_model->load_all_lost_heritage_report();
                   
                 }
                 if(($category == 'all') && ($limit != 'all')){
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of Top ";
                    $content .= $limit;
                    $content .= " Heritage Found In Zone";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_all_heritage_found_in_zone_with_limit($limit);
                 }
                 if(($category != 'all') && ($limit == 'all')){
                     
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of All ";
                    $content .= $category;
                    $content .= " Heritage Found In Zone";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_all_custom_heritage_found_in_zone_report($category);
                 }
                 if(($category != 'all') && ($limit != 'all')){
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of Top ";
                    $content .= $limit;
                    $content .= " Heritage Found In Zone ";
                    $content .= $category;
                    $content .= " Heritage";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_custom_heritage_found_in_zone_report_with_limit($category,$limit);
                 }
                 
                 $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                 $this->pdf->loadHtml($content);
                 $this->pdf->render();
                 $this->pdf->stream(""."report_list_of_heritage_found_in_zone". date('Y_m_d H_i_s') . ".pdf", array("Attachment" => 0));
                
                }

              public function report_heritage_found_in_region(){
            if (!$this->session->userdata('logged_in')) {
              redirect('login/index');
                  }
                
                 $username = $this->session->userdata('username');
                 $limit = $this->input->post('limit');
                 $category = $this->input->post('heritage_category');
                 if(($category == 'all') && ($limit == 'all')){
                  $content = '<h3 style="text-align: center;">List Of All Heritage Found In Region</h3>';
                  $content .= $this->report_model->load_all_heritage_found_in_region_report();
                  //$content .= $this->report_model->load_all_lost_heritage_report();
                   
                 }
                 if(($category == 'all') && ($limit != 'all')){
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of Top ";
                    $content .= $limit;
                    $content .= " Heritage Found In Region";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_all_heritage_found_in_region_report_with_limit($limit);
                 }
                 if(($category != 'all') && ($limit == 'all')){
                     
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of All ";
                    $content .= $category;
                    $content .= " Heritage Found In Region";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_all_custom_heritage_found_in_region_report($category);
                 }
                 if(($category != 'all') && ($limit != 'all')){
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of Top ";
                    $content .= $limit;
                    $content .= " Registered ";
                    $content .= $category;
                    $content .= " Heritage";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_all_custom_heritage_found_in_region_report_with_limit($category,$limit);
                 }
                 
                 $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                 $this->pdf->loadHtml($content);
                 $this->pdf->render();
                 $this->pdf->stream(""."report_list_of_heritage_found_in_region". date('Y_m_d H_i_s') . ".pdf", array("Attachment" => 0));
                
                }    

        public function report_heritage_all(){
            if (!$this->session->userdata('logged_in')) {
              redirect('login/index');
                  }
                
                 $username = $this->session->userdata('username');
                 $limit = $this->input->post('limit');
                 $category = $this->input->post('heritage_category');
                 if(($category == 'all') && ($limit == 'all')){
                  $content = '<h3 style="text-align: center;">List Of All Heritage Found In a Country</h3>';
                  $content .= $this->report_model->load_heritage_registered_by_all_report();
                  //$content .= $this->report_model->load_all_lost_heritage_report();
                   
                 }
                 if(($category == 'all') && ($limit != 'all')){
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of Top ";
                    $content .= $limit;
                    $content .= " Heritage Found In Country";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_heritage_registered_by_all_report_with_limit($limit);
                 }
                 if(($category != 'all') && ($limit == 'all')){
                     
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of All ";
                    $content .= $category;
                    $content .= " Heritage Found In a Country";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_custom_heritage_registered_by_all_report($category);
                 }
                 if(($category != 'all') && ($limit != 'all')){
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List of Top ";
                    $content .= $limit;
                    $content .= " Registered ";
                    $content .= $category;
                    $content .= " Heritage Found In a County";
                    $content .= '</h3>';            
                    $content .= $this->report_model->load_custom_heritage_registered_by_all_report_with_limit($category,$limit);
                 }
                 
                 $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                 $this->pdf->loadHtml($content);
                 $this->pdf->render();
                 $this->pdf->stream(""."report_list_of_all_heritage_found_in_country". date('Y_m_d H_i_s') . ".pdf", array("Attachment" => 0));
                
                }

          /*
           Reports for WR only i.e show all heritage that registered on WR only 
          */

        public function report_heritage_only_registered_by_wr(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }

            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('report/report_heritage_only_registered_by_wr',$data);
            $this->load->view('template/footer_WR');
        }

          public function report_wr(){
            if (!$this->session->userdata('logged_in')) {
              redirect('login/index');
                  }
                
                 $username = $this->session->userdata('username');
                 $category = $this->input->post('heritage_category');
                 if($category == 'all'){
                  $content = '<h3 style="text-align: center;">List Of All Heritage Found In Woreda</h3>';
                  $content .= $this->report_model->load_heritage_registerd_in_woreda_report_all();
                 }
                 if($category != 'all'){
                    $content  = '<h3 style="text-align: center;">';
                    $content .= "List ALL ";
                    $content .= $category;
                    $content .= " Heritage Found In Woreda";
                    $content .= '</h3>'; 
                    $content .= $this->report_model->load_heritage_registerd_in_woreda_report_custom($category);
                 }
                 
                 $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                 $this->pdf->loadHtml($content);
                 $this->pdf->render();
                 $this->pdf->stream(""."report_heritage_found_in_woreda". date('Y_m_d H_i_s') . ".pdf", array("Attachment" => 0));
                  
          }
          /*
          Reports for lost heritage 

          */

        public function lost_heritage_report(){
            if (!$this->session->userdata('logged_in')) {
              redirect('login/index');
                  }

            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('report/lost_heritage_report',$data);
            $this->load->view('template/footer_WR');
        }

          public function report_lost_heritage(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category = $this->input->post('heritage_category');
            $username = $this->session->userdata('username');
            //die($category);
            if($category == 'all'){
                $content = '<h3 style="text-align: center;">List Of All Lost Heritage In Region</h3>';
                $content .= $this->report_model->load_all_lost_heritage_report();
            }
            if($category != 'all'){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Lost ";
                $content .= $category;
                $content .= " Heritage";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_lost_heritage_report_custom($category);
             }
            

                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_lost_heritage_in_region". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));


          }

          public function report_lost_heritage_in_country(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category = $this->input->post('heritage_category');
            $username = $this->session->userdata('username');
            //die($category);
            if($category == 'all'){
                $content = '<h3 style="text-align: center;">List Of All Lost Heritage In Country</h3>';
                $content .= $this->report_model->load_all_lost_heritage_in_country_report();
            }
            if($category != 'all'){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Lost ";
                $content .= $category;
                $content .= " Heritage";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_custom_lost_heritage_in_county_report($category);
             }
            

                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_lost_heritage_in_country". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));


          }

          /*
            Maintenace Request heritage list report
          */

        public function report_heritage_maitenace_request_needs_zme_approval(){
            if (!$this->session->userdata('logged_in')) {
              redirect('login/index');
                  }

            //$data['category']= $this->report_model->category_model();
            //$data['list_of_heritage_category'] = $this->heritage_model->list_of_heritage_category();

            $this->load->view('template/header_WR');
            $this->load->view('report/report_heritage_maitenace_request_needs_zme_approval');
            $this->load->view('template/footer_WR');
        }

          public function report_heritage_maitenace_request(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            //$category = $this->input->post('heritage_category');
            $username = $this->session->userdata('username');
            //die($category);
            
                $content = '<h3 style="text-align: center;">List Of All Heritage That Needs Maintenance Request</h3>';
                $content .= $this->report_model->load_all_heritage_that_needs_maintenace_request_report_in_woreda();
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_heritage_needs_maintenance". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));

          }




          /* added new */

          /*
            for WR Approved Maitenace Request with in category
          */

        public function approved_maintenance_request(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }

            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('report/approved_maintenance_request',$data);
            $this->load->view('template/footer_WR');
        }

          public function load_all_heritage_that_maintenace_request_approved(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category = $this->input->post('heritage_category');
            $username = $this->session->userdata('username');
        
            
            if($category == 'all'){
                $content = '<h3 style="text-align: center;">List Of All Heritage Maintenace Request Accepted</h3>';
                $content .= $this->report_model->load_all_heritage_that_maintenace_request_approved();
            }
            if($category != 'all'){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL ";
                $content .= $category;
                $content .= " Heritage Maintenace Request Accepted";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_heritage_that_maintenace_request_approved_with_in_category($category);
             }
             
                //$content = '<h3 style="text-align: center;">List Of All Lost Heritage Maintenace Request</h3>';
                //$content .= $this->report_model->load_all_heritage_that_maitenace_request_approved();
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_heritage_maintenance_request_approved". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));


          }

          /*
            heritage maintenace request approved by zone 
          */

        public function maintenance_request_approved_by_zme(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }

            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('report/maintenance_request_approved_by',$data);
            $this->load->view('template/footer_WR');
        }

          public function load_all_heritage_that_maintenace_request_approved_by_zme(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category = $this->input->post('heritage_category');
            $username = $this->session->userdata('username');
        
            
            if($category == 'all'){
                $content = '<h3 style="text-align: center;">List Of All Heritage Maintenace Request Accepted By Zone ME</h3>';
                $content .= $this->report_model->load_all_heritage_that_maintenace_request_approved_by_zone_zme();
            }

            
            if($category != 'all'){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL ";
                $content .= $category;
                $content .= " Maintenace Request Accepted By Zone ME";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_heritage_that_maintenace_request_approved_by_zone_zme_with_in_category($category);
             }
             
             
                //$content = '<h3 style="text-align: center;">List Of All Lost Heritage Maintenace Request</h3>';
                //$content .= $this->report_model->load_all_heritage_that_maitenace_request_approved();
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_heritage_maintenance_request_approved". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));


          }

          /*
            heritage maintenace request approved by rme 
          */

        public function maintenance_request_approved_by_rme(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }

            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('report/maintenance_request_approved_by',$data);
            $this->load->view('template/footer_WR');
        }

          public function load_all_heritage_that_maintenace_request_approved_by_rme(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category = $this->input->post('heritage_category');
            $username = $this->session->userdata('username');
        
            
            if($category == 'all'){
                $content = '<h3 style="text-align: center;">List Of All Heritage Maintenace Request Accepted By Regional Maintenance Request</h3>';
                $content .= $this->report_model->load_all_heritage_that_maintenace_request_approved_by_rme();
            }

            
            if($category != 'all'){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL ";
                $content .= $category;
                $content .= " Heritage Maintenace Request Accepted By Region ME";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_heritage_that_maintenace_request_approved_by_rme_with_in_category($category);
             }
             
             
                //$content = '<h3 style="text-align: center;">List Of All Lost Heritage Maintenace Request</h3>';
                //$content .= $this->report_model->load_all_heritage_that_maitenace_request_approved();
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_heritage_maintenance_request_approved". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));


          }

          /*
          list of heritage approved MRequest for RD  . . .this report genratd only by RD
          */

        public function maintenance_request_approved_by_rd(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }

            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('report/maintenance_request_approved_by',$data);
            $this->load->view('template/footer_WR');
        }

          public function load_all_heritage_that_maintenace_request_approved_by_rd(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category = $this->input->post('heritage_category');
            $username = $this->session->userdata('username');
        
            
            if($category == 'all'){
                $content = '<h3 style="text-align: center;">List Of All Heritage Maintenace Request Accepted By Reginal Directorate</h3>';
                $content .= $this->report_model->load_all_heritage_that_maintenace_request_approved_by_RD();
            }

            
            if($category != 'all'){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL ";
                $content .= $category;
                $content .= " Heritage Maintenace Request Accepted By Reginal Directorate ";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_heritage_that_maintenace_request_approved_by_RD_with_in_category($category);
             }
             
             
                //$content = '<h3 style="text-align: center;">List Of All Lost Heritage Maintenace Request</h3>';
                //$content .= $this->report_model->load_all_heritage_that_maitenace_request_approved();
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_heritage_maintenance_request_approved". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));

          }

          /*
            recommended heritage 
            load recommended heritage based on category and date 
          */

          public function load_all_recommended_heritage(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category   = $this->input->post('heritage_category');
            $start_date = $this->input->post('start_date');
            $end_date   = $this->input->post('end_date');
            $username   = $this->session->userdata('username');

            //if category == all and no start and end date 
            if($category == 'all' && $start_date == '' && $end_date == ''){
                $content = '<h3 style="text-align: center;">List Of All Recommended Heritage </h3>';
                $content .= $this->report_model->load_all_recommended_heritage();
            }
            //if category == all and no start and end date 
            if($category == 'all' && $start_date != '' && $end_date != ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Recommended Heritage Between  ";
                $content .=  $start_date;
                $content .= " And ";
                $content .= $end_date;
                $content .= '</h3>';
                $content .= $this->report_model->load_all_recommended_heritage_with_date($start_date, $end_date);
            }
            //if category != all and no start and end date 
            if($category != 'all' && $start_date == '' && $end_date == ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Recommended ";
                $content .= $category;
                $content .= " Heritage  ";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_recommended_heritage_with_in_category($category);
             }
             //if category and date is not null
             if($category != 'all' && $start_date != '' && $end_date != ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Recommended ";
                $content .= $category;
                $content .= "Heritage Between ";
                $content .=  $start_date;
                $content .= " And ";
                $content .= $end_date;
                $content .= '</h3>';
                $content .= $this->report_model->load_all_recommended_heritage_with_in_category_with_date($category,$start_date,$end_date);
             }
             
                //$content = '<h3 style="text-align: center;">List Of All Lost Heritage Maintenace Request</h3>';
                //$content .= $this->report_model->load_all_heritage_that_maitenace_request_approved();
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_heritage_maintenance_request_approved". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));


          }

          /*
            List of promoted heritage 
          */

        public function promoted_heritage(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }

            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('report/promoted_heritage',$data);
            $this->load->view('template/footer_WR');
        }
          
          public function load_all_promoted_heritage(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category   = $this->input->post('heritage_category');
            $start_date = $this->input->post('start_date');
            $end_date   = $this->input->post('end_date');
            $username   = $this->session->userdata('username');

            //if category == all and no start and end date 
            if($category == 'all' && $start_date == '' && $end_date == ''){
                $content = '<h3 style="text-align: center;">List Of All Promoted Heritage In Region</h3>';
                $content .= $this->report_model->load_all_promoted_heritage_in_region();
            }
            //if category == all and no start and end date 
            if($category == 'all' && $start_date != '' && $end_date != ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Promoted Heritage Between  ";
                $content .=  $start_date;
                $content .= " And ";
                $content .= $end_date;
                $content .= '</h3>';
                $content .= $this->report_model->load_all_promoted_heritage_in_region_with_date($start_date, $end_date);
            }
            //if category != all and no start and end date 
            if($category != 'all' && $start_date == '' && $end_date == ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Promoted ";
                $content .= $category;
                $content .= " Heritage  ";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_promoted_heritage_in_region_with_category($category);
             }
             //if category and date is not null
             if($category != 'all' && $start_date != '' && $end_date != ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Promoted ";
                $content .= $category;
                $content .= " Heritage Between ";
                $content .=  $start_date;
                $content .= " And ";
                $content .= $end_date;
                $content .= '</h3>';
                $content .= $this->report_model->load_all_promoted_heritage_in_region_with_date_and_category($category,$start_date,$end_date);
             }
             
                //$content = '<h3 style="text-align: center;">List Of All Lost Heritage Maintenace Request</h3>';
                //$content .= $this->report_model->load_all_heritage_that_maitenace_request_approved();
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_promoted_heritage_in_region". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));

          }

          public function load_all_promoted_heritage_in_country(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }
            $category   = $this->input->post('heritage_category');
            $start_date = $this->input->post('start_date');
            $end_date   = $this->input->post('end_date');
            $username   = $this->session->userdata('username');

            //if category == all and no start and end date 
            if($category == 'all' && $start_date == '' && $end_date == ''){
                $content = '<h3 style="text-align: center;">List Of All Promoted Heritage In Country </h3>';
                $content .= $this->report_model->load_all_promoted_heritage();
            }
            //if category == all and no start and end date 
            if($category == 'all' && $start_date != '' && $end_date != ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Promoted Heritage Between  ";
                $content .=  $start_date;
                $content .= " And ";
                $content .= $end_date;
                $content .= '</h3>';
                $content .= $this->report_model->load_all_promoted_heritage_with_date($start_date, $end_date);
            }
            //if category != all and no start and end date 
            if($category != 'all' && $start_date == '' && $end_date == ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Promoted ";
                $content .= $category;
                $content .= " Heritage  ";
                $content .= '</h3>'; 
                $content .= $this->report_model->load_all_promoted_heritage_with_category($category);
             }
             //if category and date is not null
             if($category != 'all' && $start_date != '' && $end_date != ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Promoted ";
                $content .= $category;
                $content .= " Heritage Between ";
                $content .=  $start_date;
                $content .= " And ";
                $content .= $end_date;
                $content .= '</h3>';
                $content .= $this->report_model->load_all_promoted_heritage_with_date_and_category($category,$start_date,$end_date);
             }
             
                //$content = '<h3 style="text-align: center;">List Of All Lost Heritage Maintenace Request</h3>';
                //$content .= $this->report_model->load_all_heritage_that_maitenace_request_approved();
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_promoted_heritage_in_country". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));

          }

          /*
            Report tourist 
          */

        public function flow_of_tourist(){
        if (!$this->session->userdata('logged_in')) {
          redirect('login/index');
              }

            $data['category']= $this->heritage_model->category_model();

            $data['feedback_for_wr'] = $this->heritage_model->feedback_for_wr_model();
            $data['count'] = $this->heritage_model->count_notification_model();
            
            $this->load->view('template/header_WR',$data);
            $this->load->view('report/flow_of_tourist',$data);
            $this->load->view('template/footer_WR');
        }

          public function list_of_tourist_in_region_with_in_date(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }

            $start_date = $this->input->post('start_date');
            $end_date   = $this->input->post('end_date');
            $username   = $this->session->userdata('username');

            
            //list of tourist in some start date and end date 
            if($start_date != '' && $end_date != ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Tourist Between  ";
                $content .=  $start_date;
                $content .= " And ";
                $content .= $end_date;
                $content .= '</h3>';
                $content .= $this->report_model->list_of_tourist_with_in_date($start_date, $end_date);
            }
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_tourist". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));

          }

          public function list_of_tourist_with_in_date(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login/index');
                    }

            $start_date = $this->input->post('start_date');
            $end_date   = $this->input->post('end_date');
            $username   = $this->session->userdata('username');

            
            //list of tourist in some start date and end date 
            if($start_date != '' && $end_date != ''){
                $content  = '<h3 style="text-align: center;">';
                $content .= "List of ALL Tourist Between  ";
                $content .=  $start_date;
                $content .= " And ";
                $content .= $end_date;
                $content .= '</h3>';
                $content .= $this->report_model->list_of_tourist_with_in_date_for_ic($start_date, $end_date);
            }
                $content .= 'Genrated by ' . $username .  ' @ Date ' .date('Y-m-d') . ' and Time ' . date('H:i:s');
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $this->pdf->stream(""."report_list_of_tourist". date('Y_m_d_H_i_s') . ".pdf", array("Attachment" => 0));

          }


    }//end of class
