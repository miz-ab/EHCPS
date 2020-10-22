<?php

if(!defined('BASEPATH'))
	exit('No direct script access allowed');

  class Report_model extends CI_Model {
      public function __construct(){
      	parent::__construct();
          $this->load->database();
      }
      /*
        Generic Report uses for all roles
      */

      /*
        List of heritage with all category  
     */

    function report_all_heritage_found_in_zone(){

      $user_zone_id       = $this->session->userdata('user_zone_id');
      $user_region_id     = $this->session->userdata('user_region_id');

        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.zone_id = '$user_zone_id' AND h_a_t.region_id = '$user_region_id' AND h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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

     function load_all_heritage_found_in_zone_with_limit($limit){

      $user_zone_id       = $this->session->userdata('user_zone_id');
      $user_region_id     = $this->session->userdata('user_region_id');
      
        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.zone_id = '$user_zone_id' AND h_a_t.region_id = '$user_region_id' AND h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'
         ORDER BY h_t.NationalRNO ASC LIMIT $limit ");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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


     function load_all_custom_heritage_found_in_zone_report($category){

      $user_zone_id       = $this->session->userdata('user_zone_id');
      $user_region_id     = $this->session->userdata('user_region_id');

        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
                                         
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.zone_id = '$user_zone_id' AND h_a_t.region_id = '$user_region_id' AND h_t.Category = '$category' AND h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'
         ORDER BY h_t.NationalRNO ASC ");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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


     function load_custom_heritage_found_in_zone_report_with_limit($category,$limit){

      $user_zone_id       = $this->session->userdata('user_zone_id');
      $user_region_id     = $this->session->userdata('user_region_id');

        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
                                         
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.zone_id = '$user_zone_id' AND h_a_t.region_id = '$user_region_id' AND h_t.Category = '$category' AND h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'
         ORDER BY h_t.NationalRNO ASC LIMIT $limit ");

 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
 }
 $index++;
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


     function load_all_heritage_found_in_region_report(){

        $user_region_id     = $this->session->userdata('user_region_id');
        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = '$user_region_id' AND
         h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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

    function load_all_heritage_found_in_region_report_with_limit($limit){

        $user_region_id     = $this->session->userdata('user_region_id');
        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = '$user_region_id' AND
         h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'
         ORDER BY h_t.NationalRNO ASC LIMIT $limit ");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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


     function load_all_custom_heritage_found_in_region_report($category){
    
      $user_region_id     = $this->session->userdata('user_region_id');

        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
                                         
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = '$user_region_id' AND h_t.Category = '$category' AND h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'
         ORDER BY h_t.NationalRNO ASC ");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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


     function load_all_custom_heritage_found_in_region_report_with_limit($category,$limit){

        $user_region_id     = $this->session->userdata('user_region_id');
        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
                                         
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = '$user_region_id' AND h_t.Category = '$category' AND h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0' ORDER BY h_t.NationalRNO ASC LIMIT $limit ");

 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
 }
 $index++;
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



    function load_heritage_registered_by_all_report(){
        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO  AND
         h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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

     /*
        List of all heritage with limit 
     */  


    function load_heritage_registered_by_all_report_with_limit($limit){
        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO  AND
         h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'
         ORDER BY h_t.NationalRNO ASC LIMIT $limit ");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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



     function load_custom_heritage_registered_by_all_report($category){    

        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
                                         
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO AND h_t.Category = '$category' AND h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'
         ORDER BY h_t.NationalRNO ASC ");
 
 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
    $index++;
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

     /*
        List of custom heritage all
     */  

     /*
        List of Custom Heritage with limit and category
     */

    function load_custom_heritage_registered_by_all_report_with_limit($category,$limit){
        $report_data = $this->db->query("SELECT NationalRNO, 
                                          Name,
                                          Category,
                                          LocalName,
                                          CatalogNO,
                                          Ownership,
                                          DateOfAquistion
                                         
         FROM heritage_table h_t INNER JOIN heritage_approved_by 
         h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
         ON h_a_t.heritage_id = h_t.NationalRNO  AND h_t.Category = '$category' AND
         h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'
         ORDER BY h_t.NationalRNO ASC LIMIT $limit ");

 $output = '<table width="100%">';
 $output .= '<tr>
                <th>NO</th>
                <th>Name</th>
                <th>Category</th>
                <th>LocalName</th>
                <th>CatalogNO</th>
                <th>Ownership</th>
                <th>DateOfAquistion</th>
            </tr>
 ';
 $index = 1;
 foreach($report_data->result() as $row){
    $output .= '
      <tr>
        <td>'.$index.'</td>
        <td>'.$row->Name.'</td>
        <td>'.$row->Category.'</td>
        <td>'.$row->LocalName.'</td>
        <td>'.$row->CatalogNO.'</td>        
        <td>'.$row->Ownership.'</td>
        <td>'.$row->DateOfAquistion.'</td>
        
        
      </tr>
    ';
 }
 $index++;
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

     /*
      Reports that show records only registered in woreda 

     */

     /*
      records registered in woreda category = all
     */

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
                                         Ownership,
                                         DateOfAquistion
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id  AND
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'");

       $output = '<table width="100%">';
       $output .= '<tr>
                      <th>NO</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>LocalName</th>
                      <th>CatalogNO</th>
                      <th>Ownership</th>
                      <th>DateOfAquistion</th>
                  </tr>
       ';
       $index = 1;
       foreach($report_data->result() as $row){
          $output .= '
            <tr>
              <td>'.$index.'</td>
              <td>'.$row->Name.'</td>
              <td>'.$row->Category.'</td>
              <td>'.$row->LocalName.'</td>
              <td>'.$row->CatalogNO.'</td>              
              <td>'.$row->Ownership.'</td>
              <td>'.$row->DateOfAquistion.'</td>
              
              
            </tr>
          ';
          $index++;
       }
       $output .= '</table>
       <style>
       table {
         border-collapse: collapse;margin-bottom: 25px;
       }
       th, td {
         border: 1px solid #ccc; padding: 10px;text-align: left;
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

    /*
      records registered by only woredas with category 
    */

    public function load_heritage_registerd_in_woreda_report_custom($category){
      $user_woreda_id   = $this->session->userdata('user_woreda_id');
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');
      //die($user_woreda_id);
       $report_data = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         Category,
                                         LocalName,
                                         CatalogNO,
                                         Ownership,
                                         DateOfAquistion
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_t.Category = '$category' AND h_a_t.woreda_id = $user_woreda_id  AND
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region != '0' AND regional_approval_status = 'Approved' AND is_lost = '0'");

       $output = '<table width="100%">';
       $output .= '<tr>
                      <th>NO</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>LocalName</th>
                      <th>CatalogNO</th>
                      <th>Ownership</th>
                      <th>DateOfAquistion</th>
                  </tr>
       ';
       $index = 1;
       foreach($report_data->result() as $row){
          $output .= '
            <tr>
              <td>'.$index.'</td>
              <td>'.$row->Name.'</td>
              <td>'.$row->Category.'</td>
              <td>'.$row->LocalName.'</td>
              <td>'.$row->CatalogNO.'</td>              
              <td>'.$row->Ownership.'</td>
              <td>'.$row->DateOfAquistion.'</td>
              
              
            </tr>
          ';
          $index++;
       }
       $output .= '</table>
       <style>
       table {
         border-collapse: collapse;margin-bottom: 25px;
       }
       th, td {
         border: 1px solid #ccc; padding: 10px;text-align: left;
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

    /*
      Reports that shows list of heritage registered in zone but needs reginal approval
    */

    /*
      Load Heritage registered zone with all category 
    */

    public function load_heritage_registerd_in_zone_report_all(){
      $user_woreda_id   = $this->session->userdata('user_woreda_id');
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');
      //die($user_woreda_id);
       $report_data = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         Category,
                                         LocalName,
                                         CatalogNO,
                                         Ownership,
                                         DateOfAquistion
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.woreda_id = $user_woreda_id  AND
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region = '0'");

       $output = '<table width="100%">';
       $output .= '<tr>
                      <th>NO</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>LocalName</th>
                      <th>CatalogNO</th>
                      <th>Ownership</th>
                      <th>DateOfAquistion</th>
                  </tr>
       ';
       $index = 1;
       foreach($report_data->result() as $row){
          $output .= '
            <tr>
              <td>'.$index.'</td>
              <td>'.$row->Name.'</td>
              <td>'.$row->Category.'</td>
              <td>'.$row->LocalName.'</td>
              <td>'.$row->CatalogNO.'</td>              
              <td>'.$row->Ownership.'</td>
              <td>'.$row->DateOfAquistion.'</td>
              
              
            </tr>
          ';
          $index++;
       }
       $output .= '</table>
       <style>
       table {
         border-collapse: collapse;margin-bottom: 25px;
       }
       th, td {
         border: 1px solid #ccc; padding: 10px;text-align: left;
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

    /*
      Load Heritage registered in zone with category 
    */

    public function load_heritage_registerd_in_zone_report_custom($category){
      $user_woreda_id   = $this->session->userdata('user_woreda_id');
      $user_zone_id     = $this->session->userdata('user_zone_id');
      $user_region_id   = $this->session->userdata('user_region_id');
      //die($user_woreda_id);
       $report_data = $this->db->query("SELECT NationalRNO, 
                                         Name,
                                         Category,
                                         LocalName,
                                         CatalogNO,
                                         Ownership,
                                         DateOfAquistion
        FROM heritage_table h_t INNER JOIN heritage_approved_by 
        h_a_b ON h_t.NationalRNO = h_a_b.heritage_id INNER JOIN heritage_address_table h_a_t
        ON h_a_t.heritage_id = h_t.NationalRNO AND h_t.Category = '$category' AND h_a_t.woreda_id = $user_woreda_id  AND
        h_a_t.zone_id = $user_zone_id AND h_a_t.region_id = $user_region_id AND
        h_a_b.approved_by_woreda != '0' AND h_a_b.approved_by_zone != '0' AND h_a_b.approved_by_region = '0'");

       $output = '<table width="100%">';
       $output .= '<tr>
                      <th>NO</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>LocalName</th>
                      <th>CatalogNO</th>
                      <th>Ownership</th>
                      <th>DateOfAquistion</th>
                  </tr>
       ';
       $index = 1;
       foreach($report_data->result() as $row){
          $output .= '
            <tr>
              <td>'.$index.'</td>
              <td>'.$row->Name.'</td>
              <td>'.$row->Category.'</td>
              <td>'.$row->LocalName.'</td>
              <td>'.$row->CatalogNO.'</td>              
              <td>'.$row->Ownership.'</td>
              <td>'.$row->DateOfAquistion.'</td>
              
              
            </tr>
          ';
          $index++;
       }
       $output .= '</table>
       <style>
       table {
         border-collapse: collapse;margin-bottom: 25px;
       }
       th, td {
         border: 1px solid #ccc; padding: 10px;text-align: left;
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

    /*
      Report load lost heritage in all category
    */  

    public function load_all_lost_heritage_report(){

      $user_region_id = $this->session->userdata('user_region_id');

      $report_data = $this->db->query("SELECT NationalRNO,
                                              Name,
                                              Category,
                                              LocalName,
                                              photo,
                                              CatalogNO,
                                              lost_date,
                                              announce_date,
                                              l_h_t.description
      FROM heritage_table h_t, lost_heritage_table l_h_t, heritage_address_table h_a_t WHERE l_h_t.heritage_id = h_t.NationalRNO AND l_h_t.heritage_id = h_a_t.heritage_id AND h_a_t.region_id = '$user_region_id'");

      $output = '<div class="row">';
      $output .= '<div class="col-md-12">';
      $output .= '<table width="100%">';
      $output .= '<tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>LocalName</th>
                    <th>CatalogNO</th>
                    <th>Lost Date</th>
                    <th>Announce Date</th>
                  </tr>
                      ';
                      $index = 1;
      foreach($report_data->result_array() as $row){
            $output .= '
                          <tr>
                            <td>'.$index.'</td>
                            <td>'.$row["Name"].'</td>
                            <td>'.$row["Category"].'</td>
                            <td>'.$row["LocalName"].'</td>
                            <td>'.$row["CatalogNO"].'</td>
                            <td>'.$row["lost_date"].'</td>
                            <td>'.$row["announce_date"].'</td>
                            
                          </tr>
                        ';
                        $index++;
                     }

      $output .= '</table>
      <style>
      table {
        border-collapse: collapse;margin-bottom: 25px;
      }
      th, td {
        border: 1px solid #ccc; padding: 10px;text-align: left;
      }
      tr:nth-child(even) {
        background-color: #eee;
      }
      tr:nth-child(odd) {
        background-color: #fff;
      }            
    </style>
          ';
      $output .= '</div>'; //inner div table

      $output .= '<div class="container">';
         foreach($report_data->result_array() as $row){ 
          $output .= '<h3>Description</h3>';
           $output .= '<p>'.$row['description'].'</p>';
         }
      $output .= '===========================================================================================';
      $output .= '</div>';
      $output .= '</div>';

      return $output;
    
  }

  public function load_all_lost_heritage_in_country_report(){


      $report_data = $this->db->query("SELECT NationalRNO,
                                              Name,
                                              Category,
                                              LocalName,
                                              photo,
                                              CatalogNO,
                                              lost_date,
                                              announce_date,
                                              l_h_t.description
      FROM heritage_table h_t, lost_heritage_table l_h_t, heritage_address_table h_a_t WHERE l_h_t.heritage_id = h_t.NationalRNO AND l_h_t.heritage_id = h_a_t.heritage_id");

      $output = '<div class="row">';
      $output .= '<div class="col-md-12">';
      $output .= '<table width="100%">';
      $output .= '<tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>LocalName</th>
                    <th>CatalogNO</th>
                    <th>Lost Date</th>
                    <th>Announce Date</th>
                  </tr>
                      ';
                      $index = 1;
      foreach($report_data->result_array() as $row){
            $output .= '
                          <tr>
                            <td>'.$index.'</td>
                            <td>'.$row["Name"].'</td>
                            <td>'.$row["Category"].'</td>
                            <td>'.$row["LocalName"].'</td>
                            <td>'.$row["CatalogNO"].'</td>
                            <td>'.$row["lost_date"].'</td>
                            <td>'.$row["announce_date"].'</td>
                            
                          </tr>
                        ';
                        $index++;
                     }

      $output .= '</table>
      <style>
      table {
        border-collapse: collapse;margin-bottom: 25px;
      }
      th, td {
        border: 1px solid #ccc; padding: 10px;text-align: left;
      }
      tr:nth-child(even) {
        background-color: #eee;
      }
      tr:nth-child(odd) {
        background-color: #fff;
      }            
    </style>
          ';
      $output .= '</div>'; //inner div table

      $output .= '<div class="container">';
         foreach($report_data->result_array() as $row){ 
          $output .= '<h3>Description</h3>';
           $output .= '<p>'.$row['description'].'</p>';
         }
      $output .= '===========================================================================================';
      $output .= '</div>';
      $output .= '</div>';

      return $output;
    
  }



  public function load_all_custom_lost_heritage_in_county_report($category){

      $user_region_id = $this->session->userdata('user_region_id');
      $report_data = $this->db->query("SELECT NationalRNO,
                                              Name,
                                              Category,
                                              LocalName,
                                              photo,
                                              CatalogNO,
                                              lost_date,
                                              announce_date,
                                              l_h_t.description
      FROM heritage_table h_t, lost_heritage_table l_h_t, heritage_address_table h_a_t WHERE l_h_t.heritage_id = h_t.NationalRNO AND l_h_t.heritage_id = h_a_t.heritage_id AND h_a_t.region_id = '$user_region_id' AND h_t.Category = '$category'");

      $output = '<div class="row">';
      $output .= '<div class="col-md-12">';
      $output .= '<table width="100%">';
      $output .= '<tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>LocalName</th>
                    <th>CatalogNO</th>
                    <th>Lost Date</th>
                    <th>Announce Date</th>
                  </tr>
                      ';
                      $index = 1;
      foreach($report_data->result_array() as $row){
            $output .= '
                          <tr>
                            <td>'.$index.'</td>
                            <td>'.$row["Name"].'</td>
                            <td>'.$row["LocalName"].'</td>
                            <td>'.$row["CatalogNO"].'</td>
                            <td>'.$row["lost_date"].'</td>
                            <td>'.$row["announce_date"].'</td>
                            
                          </tr>
                        ';
                        $index++;
                     }

      $output .= '</table>
      <style>
      table {
        border-collapse: collapse;margin-bottom: 25px;
      }
      th, td {
        border: 1px solid #ccc; padding: 10px;text-align: left;
      }
      tr:nth-child(even) {
        background-color: #eee;
      }
      tr:nth-child(odd) {
        background-color: #fff;
      }            
    </style>
          ';
      $output .= '</div>'; //inner div table

      $output .= '<div class="container">';
         foreach($report_data->result_array() as $row){ 
          $output .= '<h3>Description</h3>';
           $output .= '<p>'.$row['l_h_t.description'].'</p>';
         }
      $output .= '<p>======================================================================================</p>';
      $output .= '</div>';
      $output .= '</div>';

      return $output;
    
  }


    /*
      function load all lost heritage in some category 
    */

    public function load_all_lost_heritage_report_custom($category){

      $user_region_id = $this->session->userdata('user_region_id');
      $report_data = $this->db->query("SELECT NationalRNO,
                                              Name,
                                              Category,
                                              LocalName,
                                              photo,
                                              CatalogNO,
                                              lost_date,
                                              announce_date,
                                              l_h_t.description
      FROM heritage_table h_t, lost_heritage_table l_h_t, heritage_address_table h_a_t WHERE l_h_t.heritage_id = h_t.NationalRNO AND l_h_t.heritage_id = h_a_t.heritage_id AND h_a_t.region_id = '$user_region_id' AND h_t.Category = '$category'");

      $output = '<div class="row">';
      $output .= '<div class="col-md-12">';
      $output .= '<table width="100%">';
      $output .= '<tr>
                    <th>NO</th>
                    <th>Name</th>
                    <th>LocalName</th>
                    <th>CatalogNO</th>
                    <th>Lost Date</th>
                    <th>Announce Date</th>
                  </tr>
                      ';
                      $index = 1;
      foreach($report_data->result_array() as $row){
            $output .= '
                          <tr>
                            <td>'.$index.'</td>
                            <td>'.$row["Name"].'</td>
                            <td>'.$row["LocalName"].'</td>
                            <td>'.$row["CatalogNO"].'</td>
                            <td>'.$row["lost_date"].'</td>
                            <td>'.$row["announce_date"].'</td>
                            
                          </tr>
                        ';
                        $index++;
                     }

      $output .= '</table>
      <style>
      table {
        border-collapse: collapse;margin-bottom: 25px;
      }
      th, td {
        border: 1px solid #ccc; padding: 10px;text-align: left;
      }
      tr:nth-child(even) {
        background-color: #eee;
      }
      tr:nth-child(odd) {
        background-color: #fff;
      }            
    </style>
          ';
      $output .= '</div>'; //inner div table

      $output .= '<div class="container">';
         foreach($report_data->result_array() as $row){ 
          $output .= '<h3>Description</h3>';
           $output .= '<p>'.$row['l_h_t.description'].'</p>';
         }
      $output .= '<p>======================================================================================</p>';
      $output .= '</div>';
      $output .= '</div>';

      return $output;
    
  }

  /*
    Report List of heritage that needs Maintenace Request
    use this function for ZME . . .  see how many of heritage needs maintenace 
  */

  public function load_all_heritage_that_needs_maintenace_request_report_in_woreda(){
    $report_data = $this->db->query("SELECT heritage_id,Name,severity,m_r_t.description,
    date FROM maintenance_request_table m_r_t,
    heritage_table h_t WHERE m_r_t.heritage_id = h_t.NationalRNO");

    $output = '<div class="row">';
    $output .= '<div class="col-md-12">';
    $output .= '<table width="100%">';
    $output .= '<tr>
                  <th>NO</th>
                  <th>Name</th>
                  <th>Severity</th>
                  <th>Date</th>
                </tr>
                    ';
                    $index = 1;
    foreach($report_data->result_array() as $row){
          $output .= '
                        <tr>
                          <td>'.$index.'</td>
                          <td>'.$row["Name"].'</td>
                          <td>'.$row["severity"].'</td>
                          <td>'.$row["date"].'</td>
                        </tr>
                      ';
                      $index++;
                   }

    $output .= '</table>
    <style>
    table {
      border-collapse: collapse;margin-bottom: 25px;
    }
    th, td {
      border: 1px solid #ccc; padding: 10px;text-align: left;
    }
    tr:nth-child(even) {
      background-color: #eee;
    }
    tr:nth-child(odd) {
      background-color: #fff;
    }            
  </style>
        ';
    $output .= '</div>'; //inner div table

    $output .= '<div class="container">';
       foreach($report_data->result_array() as $row){ 
        $output .= '<h3>Description</h3>';
         $output .= '<p>'.$row['description'].'</p>';
       }
    $output .= '<p>===========================================================================================</p>';
    $output .= '</div>';
    $output .= '</div>';

    return $output;
  
}

/*
  New added report 
*/

/*  for WR Approved Maitenace Request with out category  or with all category*/

public function load_all_heritage_that_maintenace_request_approved(){
  $user_woreda_id   = $this->session->userdata('user_woreda_id');
  $user_zone_id     = $this->session->userdata('user_zone_id');
  $user_region_id   = $this->session->userdata('user_region_id');

  $report_data = $this->db->query("SELECT   m_r_t.heritage_id,
                                            h_t.Name,
                                            h_t.LocalName,
                                            m_r_a_b.date_rd_approved
   FROM maintenance_request_table m_r_t,maintenance_request_approved_by m_r_a_b,heritage_address_table h_a_t, heritage_table h_t WHERE h_t.NationalRNO = m_r_t.heritage_id AND m_r_t.heritage_id = m_r_a_b.heritage_id  AND m_r_a_b.rd_id != '0' AND  h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = '$user_region_id' AND h_a_t.zone_id = '$user_zone_id' AND h_a_t.woreda_id = '$user_woreda_id' AND rd_approval_status = 'Approved' AND m_r_a_b.is_maintained = '0'");

  $output = '<table width="100%">'; 
  $output .= '<tr>
               <th>NO</th>
               <th>ID</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Date</th>
           </tr>
            ';
          $index = 1;
          foreach($report_data->result_array() as $row){
            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["heritage_id"].'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["date_rd_approved"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
          <style>
          table {
            border-collapse: collapse;margin-bottom: 25px;
          }
          th, td {
            border: 1px solid #ccc; padding: 10px;text-align: left;
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


/* for WR Approved Maitenace Request with in category with in category */

public function load_all_heritage_that_maintenace_request_approved_with_in_category($category){

  $user_woreda_id   = $this->session->userdata('user_woreda_id');
  $user_zone_id     = $this->session->userdata('user_zone_id');
  $user_region_id   = $this->session->userdata('user_region_id');

  $report_data = $this->db->query("SELECT  m_r_t.heritage_id,
                                           h_t.Name,
                                           h_t.LocalName,
                                           m_r_a_b.date_rd_approved
       FROM maintenance_request_table m_r_t,maintenance_request_approved_by m_r_a_b,heritage_address_table h_a_t, heritage_table h_t WHERE h_t.NationalRNO = m_r_t.heritage_id AND m_r_t.heritage_id = m_r_a_b.heritage_id  AND m_r_a_b.rd_id != '0' AND m_r_t.category = '$category' AND h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = '$user_region_id' AND h_a_t.zone_id = '$user_zone_id' AND h_a_t.woreda_id = '$user_woreda_id' AND rd_approval_status = 'Approved' AND m_r_a_b.is_maintained = '0'");

  $output = '<table width="100%">'; 
  $output .= '<tr>
               <th>NO</th>
               <th>ID</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Date</th>
           </tr>
            ';
          $index = 1;
          foreach($report_data->result_array() as $row){
            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["heritage_id"].'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["date_rd_approved"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
          <style>
          table {
            border-collapse: collapse;margin-bottom: 25px;
          }
          th, td {
            border: 1px solid #ccc; padding: 10px;text-align: left;
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



/*list of heritage maintenace request approved by ZME */

public function load_all_heritage_that_maintenace_request_approved_by_zone_zme(){
  $user_zone_id     = $this->session->userdata('user_zone_id');
  $user_region_id   = $this->session->userdata('user_region_id');

  $report_data = $this->db->query("SELECT   m_r_t.heritage_id,
                                            h_t.Name,
                                            h_t.LocalName,
                                            m_r_a_b.date_rd_approved
   FROM maintenance_request_table m_r_t,maintenance_request_approved_by m_r_a_b,heritage_address_table h_a_t, heritage_table h_t WHERE h_t.NationalRNO = m_r_t.heritage_id AND m_r_t.heritage_id = m_r_a_b.heritage_id  AND m_r_a_b.zme_id != '0' AND  h_a_t.heritage_id = h_t.NationalRNO AND h_a_t.region_id = '$user_region_id' AND h_a_t.zone_id = '$user_zone_id' AND m_r_a_b.zme_approval_status = 'Approved'");

  $output = '<table width="100%">'; 
  $output .= '<tr>
               <th>NO</th>
               <th>ID</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Date</th>
           </tr>
            ';
          $index = 1;
          foreach($report_data->result_array() as $row){
            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["heritage_id"].'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["date_rd_approved"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
          <style>
          table {
            border-collapse: collapse;margin-bottom: 25px;
          }
          th, td {
            border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*list of heritage maintenace request approved by ZME with in category */


public function load_all_heritage_that_maintenace_request_approved_by_zone_zme_with_in_category($category){
  $user_zone_id     = $this->session->userdata('user_zone_id');
  $user_region_id   = $this->session->userdata('user_region_id');

  $report_data = $this->db->query("SELECT  m_r_t.heritage_id,h_t.Name,h_t.LocalName,m_r_a_b.date_rd_approved
   FROM maintenance_request_table m_r_t,maintenance_request_approved_by m_r_a_b,heritage_address_table h_a_t,
       heritage_table h_t WHERE h_t.NationalRNO = m_r_t.heritage_id AND m_r_t.category = '$category' AND
       m_r_t.heritage_id = m_r_a_b.heritage_id  AND m_r_a_b.zme_id != '0' AND  h_a_t.heritage_id = h_t.NationalRNO AND
       h_a_t.region_id = '$user_region_id' AND h_a_t.zone_id = '$user_zone_id' AND m_r_a_b.zme_approval_status = 'Approved'");

  $output = '<table width="100%">'; 
  $output .= '<tr>
               <th>NO</th>
               <th>ID</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Date</th>
           </tr>
            ';
          $index = 1;
          foreach($report_data->result_array() as $row){
            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["heritage_id"].'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["date_rd_approved"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
          <style>
          table {
            border-collapse: collapse;margin-bottom: 25px;
          }
          th, td {
            border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*list of heritage maintenace request approved by RME */

public function load_all_heritage_that_maintenace_request_approved_by_rme(){
  $user_region_id     = $this->session->userdata('user_region_id');
  
  $report_data = $this->db->query("SELECT  m_r_t.heritage_id,h_t.Name,h_t.LocalName,m_r_a_b.date_rd_approved
   FROM maintenance_request_table m_r_t,maintenance_request_approved_by m_r_a_b,heritage_address_table h_a_t,
       heritage_table h_t WHERE h_t.NationalRNO = m_r_t.heritage_id AND
       m_r_t.heritage_id = m_r_a_b.heritage_id  AND m_r_a_b.rme_id != '0' AND  h_a_t.heritage_id = h_t.NationalRNO AND
       h_a_t.region_id = '$user_region_id' AND m_r_a_b.rme_approval_status = 'Approved'");

  $output = '<table width="100%">'; 
  $output .= '<tr>
               <th>NO</th>
               <th>ID</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Date</th>
           </tr>
            ';
          $index = 1;
          foreach($report_data->result_array() as $row){
            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["heritage_id"].'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["date_rd_approved"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
          <style>
          table {
            border-collapse: collapse;margin-bottom: 25px;
          }
          th, td {
            border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*list of heritage maintenace request approved by RME with in category */

public function load_all_heritage_that_maintenace_request_approved_by_rme_with_in_category($category){
  $user_region_id   = $this->session->userdata('user_region_id');

  $report_data = $this->db->query("SELECT  m_r_t.heritage_id,h_t.Name,h_t.LocalName,m_r_a_b.date_rd_approved
   FROM maintenance_request_table m_r_t,maintenance_request_approved_by m_r_a_b,heritage_address_table h_a_t,
       heritage_table h_t WHERE h_t.NationalRNO = m_r_t.heritage_id AND m_r_t.category = '$category' AND
       m_r_t.heritage_id = m_r_a_b.heritage_id  AND m_r_a_b.rme_id != '0' AND  h_a_t.heritage_id = h_t.NationalRNO AND
       h_a_t.region_id = '$user_region_id' AND m_r_a_b.rme_approval_status = 'Approved'");

  $output = '<table width="100%">'; 
  $output .= '<tr>
               <th>NO</th>
               <th>ID</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Date</th>
           </tr>
            ';
          $index = 1;
          foreach($report_data->result_array() as $row){
            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["heritage_id"].'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["date_rd_approved"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
          <style>
          table {
            border-collapse: collapse;margin-bottom: 25px;
          }
          th, td {
            border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  list of heritage approved MRequest for RD  . . .this report genratd only by RD
*/

public function load_all_heritage_that_maintenace_request_approved_by_RD(){
  $user_region_id   = $this->session->userdata('user_region_id'); 
  $user_id   = $this->session->userdata('user_id');

  $report_data = $this->db->query("SELECT  m_r_t.heritage_id,h_t.Name,h_t.LocalName,m_r_a_b.date_rd_approved
   FROM maintenance_request_table m_r_t,maintenance_request_approved_by m_r_a_b,heritage_address_table h_a_t,
       heritage_table h_t WHERE h_t.NationalRNO = m_r_t.heritage_id AND
       m_r_t.heritage_id = m_r_a_b.heritage_id  AND m_r_a_b.rd_id != '0' 
       AND  h_a_t.heritage_id = h_t.NationalRNO AND
       h_a_t.region_id = '$user_region_id' AND m_r_a_b.rd_id = '$user_id' AND m_r_a_b.rd_approval_status = 'Approved'");

  $output = '<table width="100%">'; 
  $output .= '<tr>
               <th>NO</th>
               <th>ID</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Date</th>
           </tr>
            ';
          $index = 1;
          foreach($report_data->result_array() as $row){
            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["heritage_id"].'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["date_rd_approved"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
          <style>
          table {
            border-collapse: collapse;margin-bottom: 25px;
          }
          th, td {
            border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  list of heritage approved MRequest for RD  . . .this report genratd only by RD with in category 
*/

public function load_all_heritage_that_maintenace_request_approved_by_RD_with_in_category($category){
  $user_region_id   = $this->session->userdata('user_region_id'); 
  $user_id   = $this->session->userdata('user_id');

  $report_data = $this->db->query("SELECT  m_r_t.heritage_id,h_t.Name,h_t.LocalName,m_r_a_b.date_rd_approved
   FROM maintenance_request_table m_r_t,maintenance_request_approved_by m_r_a_b,heritage_address_table h_a_t,
       heritage_table h_t WHERE h_t.NationalRNO = m_r_t.heritage_id AND
       m_r_t.heritage_id = m_r_a_b.heritage_id  AND m_r_a_b.rd_id != '0' 
       AND  h_a_t.heritage_id = h_t.NationalRNO AND m_r_t.category = '$category' AND
       h_a_t.region_id = '$user_region_id' AND m_r_a_b.rd_id = '$user_id' AND m_r_a_b.rd_approval_status = 'Approved'");

  $output = '<table width="100%">'; 
  $output .= '<tr>
               <th>NO</th>
               <th>ID</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Date</th>
           </tr>
            ';
          $index = 1;
          foreach($report_data->result_array() as $row){
            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["heritage_id"].'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["date_rd_approved"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
          <style>
          table {
            border-collapse: collapse;margin-bottom: 25px;
          }
          th, td {
            border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  List of Recommended heritage All 
*/

public function load_all_recommended_heritage(){
  //tourist_recommendation_table

  $report_data = $this->db->query("SELECT  h_t.Name,t_r_t.category,t_r_t.severity,t_r_t.date,t_r_t.la,t_r_t.lo,t_r_t.recommendation FROM 
       tourist_recommendation_table t_r_t,heritage_table h_t WHERE h_t.NationalRNO = t_r_t.heritage_id");
          $index = 1;
          foreach($report_data->result_array() as $row){

            $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>Category</th>
               <th>Severity</th>
               <th>LA</th>
               <th>LO</th>
               <th>Date</th>
           </tr>
            ';

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["category"].'</td>
                        <td>'.$row["severity"].'</td>
                        <td>'.$row["la"].'</td>
                        <td>'.$row["lo"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;

           $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
                        }
                        tr:nth-child(even) {
                          background-color: #eee;
                        }
                        tr:nth-child(odd) {
                          background-color: #fff;
                        }            
                      </style>
                            ';
             $output .= '<div class="container">';
             $output .= '<h3>Description</h3>';
             $output .= '<p>'.$row['recommendation'].'</p>';
             $output .= '<p>================================================================================</p>';
             $output .= '</div>';
          }

          
      return $output;
}


/*
  List of all heritage recommended with in strat date and end date 
*/
public function load_all_recommended_heritage_with_date($start_date,$end_date){
  $report_data = $this->db->query("SELECT  h_t.Name,t_r_t.category,t_r_t.severity,t_r_t.date,t_r_t.la,t_r_t.lo,t_r_t.recommendation FROM 
       tourist_recommendation_table t_r_t,heritage_table h_t WHERE h_t.NationalRNO = t_r_t.heritage_id 
       AND t_r_t.date >= '$start_date' AND t_r_t.date <= '$end_date'");
          $index = 1;
          if($report_data->num_rows() != 0){
          foreach($report_data->result_array() as $row){

            $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>Category</th>
               <th>Severity</th>
               <th>LA</th>
               <th>LO</th>
               <th>Date</th>
           </tr>
            ';

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["category"].'</td>
                        <td>'.$row["severity"].'</td>
                        <td>'.$row["la"].'</td>
                        <td>'.$row["lo"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;

           $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
                        }
                        tr:nth-child(even) {
                          background-color: #eee;
                        }
                        tr:nth-child(odd) {
                          background-color: #fff;
                        }            
                      </style>
                            ';
             $output .= '<div class="container">';
             $output .= '<h3>Description</h3>';
             $output .= '<p>'.$row['recommendation'].'</p>';
             $output .= '<p>================================================================================</p>';
             $output .= '</div>';
          }
          return $output;
        }else{
          $output = '<h4> NO Data avaliable </h4>';
          return $output;
        }   
}

/*List of recommended heritage with in category */

public function load_all_recommended_heritage_with_in_category($category){
  $report_data = $this->db->query("SELECT  h_t.Name,t_r_t.category,t_r_t.severity,t_r_t.date,t_r_t.la,t_r_t.lo,t_r_t.recommendation FROM 
       tourist_recommendation_table t_r_t,heritage_table h_t WHERE h_t.NationalRNO = t_r_t.heritage_id AND t_r_t.category = '$category'");
          $index = 1;
          foreach($report_data->result_array() as $row){

            $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>Severity</th>
               <th>LA</th>
               <th>LO</th>
               <th>Date</th>
           </tr>
            ';

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td> 
                        <td>'.$row["severity"].'</td>
                        <td>'.$row["la"].'</td>
                        <td>'.$row["lo"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;

           $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
                        }
                        tr:nth-child(even) {
                          background-color: #eee;
                        }
                        tr:nth-child(odd) {
                          background-color: #fff;
                        }            
                      </style>
                            ';
             $output .= '<div class="container">';
             $output .= '<h3>Description</h3>';
             $output .= '<p>'.$row['recommendation'].'</p>';
             $output .= '<p>================================================================================</p>';
             $output .= '</div>';
          }

          
      return $output;
}

public function load_all_recommended_heritage_with_in_category_with_date($category,$start_date,$end_date){
  $report_data = $this->db->query("SELECT  h_t.Name,t_r_t.category,t_r_t.severity,t_r_t.date,t_r_t.la,t_r_t.lo,t_r_t.recommendation FROM 
       tourist_recommendation_table t_r_t,heritage_table h_t WHERE h_t.NationalRNO = t_r_t.heritage_id AND t_r_t.category = '$category'
       AND t_r_t.date >= '$start_date' AND t_r_t.date <= '$end_date'");
          $index = 1;
          if($report_data->num_rows() != 0){
          foreach($report_data->result_array() as $row){

            $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>Category</th>
               <th>Severity</th>
               <th>LA</th>
               <th>LO</th>
               <th>Date</th>
           </tr>
            ';

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["category"].'</td>
                        <td>'.$row["severity"].'</td>
                        <td>'.$row["la"].'</td>
                        <td>'.$row["lo"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;

           $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
                        }
                        tr:nth-child(even) {
                          background-color: #eee;
                        }
                        tr:nth-child(odd) {
                          background-color: #fff;
                        }            
                      </style>
                            ';
             $output .= '<div class="container">';
             $output .= '<h3>Description</h3>';
             $output .= '<p>'.$row['recommendation'].'</p>';
             $output .= '<p>================================================================================</p>';
             $output .= '</div>';
          }
          return $output;
        }else{
          $output = '<h4> NO Data avaliable </h4>';
          return $output;
        }   
}

/*
  RTDD list of promoted heritage with all = category and null date 
*/

/*
  with all category and null start and end date 
*/

public function load_all_promoted_heritage_in_region(){

  $emp_id = $this->session->userdata('user_id');

  $report_data = $this->db->query("SELECT  h_t.Name,h_t.LocalName,h_t.Category,p_h.date FROM 
       promot_heritage p_h,heritage_table h_t WHERE h_t.NationalRNO = p_h.heritage_id AND p_h.emp_id = '$emp_id'");
          $index = 1;

          $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Category</th>
               <th>Date</th>
           </tr>
            ';

          foreach($report_data->result_array() as $row){

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["Category"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
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

public function load_all_promoted_heritage_in_region_with_date($start_date, $end_date){

  $emp_id = $this->session->userdata('user_id');

  $report_data = $this->db->query("SELECT  h_t.Name,h_t.LocalName,h_t.Category,p_h.date FROM promot_heritage p_h,
  heritage_table h_t WHERE h_t.NationalRNO = p_h.heritage_id AND p_h.date >= '$start_date' AND p_h.date <= '$end_date' AND p_h.emp_id = '$emp_id'");
          $index = 1;
          $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Category</th>
               <th>Date</th>
           </tr>
            ';

          foreach($report_data->result_array() as $row){

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["Category"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  with some category and null start and end date 
*/

public function load_all_promoted_heritage_in_region_with_category($category){

  $emp_id = $this->session->userdata('user_id');

  $report_data = $this->db->query("SELECT  h_t.Name,h_t.LocalName,h_t.Category,p_h.date FROM 
       promot_heritage p_h,heritage_table h_t WHERE h_t.NationalRNO = p_h.heritage_id AND h_t.Category = '$category' AND p_h.emp_id = '$emp_id'");
          $index = 1;

          $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Category</th>
               <th>Date</th>
           </tr>
            ';

          foreach($report_data->result_array() as $row){

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["Category"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  with some category and null start and end date 
*/

public function load_all_promoted_heritage_in_region_with_date_and_category($category,$start_date, $end_date){

  $emp_id = $this->session->userdata('user_id');

  $report_data = $this->db->query("SELECT  h_t.Name,h_t.LocalName,h_t.Category,p_h.date FROM promot_heritage p_h,
  heritage_table h_t WHERE h_t.NationalRNO = p_h.heritage_id AND h_t.Category = '$category' AND p_h.date >= '$start_date' AND p_h.date <= '$end_date' AND p_h.emp_id = '$emp_id'");
          $index = 1;
          $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Category</th>
               <th>Date</th>
           </tr>
            ';

          foreach($report_data->result_array() as $row){

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["Category"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
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

public function load_all_promoted_heritage(){

  $report_data = $this->db->query("SELECT  h_t.Name,h_t.LocalName,h_t.Category,p_h.date FROM 
       promot_heritage p_h,heritage_table h_t WHERE h_t.NationalRNO = p_h.heritage_id");
          $index = 1;

          $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Category</th>
               <th>Date</th>
           </tr>
            ';

          foreach($report_data->result_array() as $row){

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["Category"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  all promoted heritage with date 
*/

public function load_all_promoted_heritage_with_date($start_date, $end_date){

  $report_data = $this->db->query("SELECT  h_t.Name,h_t.LocalName,h_t.Category,p_h.date FROM promot_heritage p_h,
  heritage_table h_t WHERE h_t.NationalRNO = p_h.heritage_id AND p_h.date >= '$start_date' AND p_h.date <= '$end_date'");
          $index = 1;
          $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Category</th>
               <th>Date</th>
           </tr>
            ';

          foreach($report_data->result_array() as $row){

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["Category"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  with some category and null start and end date 
*/

public function load_all_promoted_heritage_with_category($category){

  $report_data = $this->db->query("SELECT  h_t.Name,h_t.LocalName,h_t.Category,p_h.date FROM 
       promot_heritage p_h,heritage_table h_t WHERE h_t.NationalRNO = p_h.heritage_id AND h_t.Category = '$category'");
          $index = 1;

          $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Category</th>
               <th>Date</th>
           </tr>
            ';

          foreach($report_data->result_array() as $row){

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["Category"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  with some category and null start and end date 
*/

public function load_all_promoted_heritage_with_date_and_category($category,$start_date, $end_date){

  $report_data = $this->db->query("SELECT  h_t.Name,h_t.LocalName,h_t.Category,p_h.date FROM promot_heritage p_h,
  heritage_table h_t WHERE h_t.NationalRNO = p_h.heritage_id AND h_t.Category = '$category' AND p_h.date >= '$start_date' AND p_h.date <= '$end_date'");
          $index = 1;
          $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>Name</th>
               <th>LocalName</th>
               <th>Category</th>
               <th>Date</th>
           </tr>
            ';

          foreach($report_data->result_array() as $row){

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["Name"].'</td>
                        <td>'.$row["LocalName"].'</td>
                        <td>'.$row["Category"].'</td>
                        <td>'.$row["date"].'</td>
                        </tr>
                        ';

                        $index++;
          }

          $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
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

/*
  tourist report with strat date and end date 
*/

public function list_of_tourist_with_in_date($start_date,$end_date){

  $user_region_id = $this->session->userdata('user_region_id');
  $report_data = $this->db->query("SELECT 
                                first_name,
                                last_name,
                                sex,
                                Country
                              FROM tourist_table t_t, user_address_table u_a_t WHERE date_Of_entry >= '$start_date' AND date_of_return <= '$end_date' AND t_t.emp_id = u_a_t.emp_id AND u_a_t.region_id = '$user_region_id'");
          $index = 1;
          if($report_data->num_rows() != 0){
          foreach($report_data->result_array() as $row){

            $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Sex</th>
               <th>Country</th>
           </tr>
            ';

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["first_name"].'</td>
                        <td>'.$row["last_name"].'</td>
                        <td>'.$row["sex"].'</td>
                        <td>'.$row["Country"].'</td>
                        </tr>
                        ';

                        $index++;

           $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
                        }
                        tr:nth-child(even) {
                          background-color: #eee;
                        }
                        tr:nth-child(odd) {
                          background-color: #fff;
                        }            
                      </style>
                            ';
          }
          return $output;
        }else{
          $output = '<h4> NO Data avaliable </h4>';
          return $output;
        }   
}

public function list_of_tourist_with_in_date_for_ic($start_date,$end_date){

  $user_id = $this->session->userdata('user_id');
  $report_data = $this->db->query("SELECT 
                                first_name,
                                last_name,
                                sex,
                                Country
                              FROM tourist_table t_t, user_address_table u_a_t WHERE date_Of_entry >= '$start_date' AND date_of_return <= '$end_date' AND t_t.emp_id = '$user_id'");
          $index = 1;
          if($report_data->num_rows() != 0){
          foreach($report_data->result_array() as $row){

            $output = '<table width="100%">'; 
            $output .= '<tr>
               <th>NO</th>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Sex</th>
               <th>Country</th>
           </tr>
            ';

            $output .= '
                        <tr>
                        <td>'.$index.'</td>
                        <td>'.$row["first_name"].'</td>
                        <td>'.$row["last_name"].'</td>
                        <td>'.$row["sex"].'</td>
                        <td>'.$row["Country"].'</td>
                        </tr>
                        ';

                        $index++;

           $output .= '</table>
                        <style>
                        table {
                          border-collapse: collapse;margin-bottom: 25px;
                        }
                        th, td {
                          border: 1px solid #ccc; padding: 10px;text-align: left;
                        }
                        tr:nth-child(even) {
                          background-color: #eee;
                        }
                        tr:nth-child(odd) {
                          background-color: #fff;
                        }            
                      </style>
                            ';
          }
          return $output;
        }else{
          $output = '<h4> NO Data avaliable </h4>';
          return $output;
        }   
}


}//end of class