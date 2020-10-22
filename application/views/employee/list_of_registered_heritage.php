<div style="padding:0 15px;">
 <!-- language setting and language model -->
 <?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
	<div class="row">
		<div class="col-md-3 menu_wr">
			
			<div class="list_of_menu">
				<ul>
            <?php if($this->session->userdata('userroll') == 'ZR'):?>
               <li><a href="<?php echo base_url('employee/index');?>">
              <span class="glyphicon glyphicon-home"></span> Home</a></li>
               <li><a href="<?php echo base_url('report/report_heritage_registered_by_all');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
            <?php endif;?>


            <?php if($this->session->userdata('userroll') == 'WR'):?>
               <li><a href="<?php echo base_url('heritage/woreda_registeral_registration_form_one');?>">
                    <span class="glyphicon glyphicon-plus"></span> <?php echo lang('Register Heritage');?></a></li>
               <li><a href="<?php echo base_url('report/report_heritage_only_registered_by_wr');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> <?php echo lang('Generate Report');?></a></li>
            <?php endif;?>

            <?php if($this->session->userdata('userroll') == 'RR'):?>
               <li><a href="<?php echo base_url('employee/index');?>">
                  <span class="glyphicon glyphicon-home"></span> Home</a></li>
               <li><a href="<?php echo base_url('report/report_heritage_registered_by_all');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
            <?php endif;?>

            <?php if($this->session->userdata('userroll') == 'RD'):?>
               <li><a href="<?php echo base_url('employee/');?>"><span class="glyphicon glyphicon-plus">   </span>Create Account</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_heritage_needs_rr_approval');?>">
                  <span class="glyphicon glyphicon-th"></span> View Heritage</a></li>
               <li><a href="<?php echo base_url('heritage/list_of_maintenance_request_needs_approvel_by_rd');?>">
                  <span class="glyphicon glyphicon-cog"></span> View Maintenance Request</a></li>
               <li><a href="<?php echo base_url('report/report_heritage_registered_by_all');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
            <?php endif;?>

            <?php if($this->session->userdata('userroll') == 'FHRA'):?>
               <li><a href="<?php echo base_url('employee/announce_instruction');?>">
                <span class="glyphicon glyphicon-th"></span>Announce Instruction</a></li>
                <li><a href="<?php echo base_url('heritage/list_of_heritage_found_in_country');?>">
                <span class="glyphicon glyphicon-th"></span>View Heritage</a></li>
                <li><a href="<?php echo base_url('report/report_heritage_registered_by_all');?>">
                  <span class="glyphicon glyphicon-duplicate"></span> Generate Report</a></li>
            <?php endif;?>
					
		
				</ul>
			</div>
			
		</div> <!-- menu div -->

		<div class="col-md-9 list_of_heritage">

         <div class="row">
            <div class="col-md-3">
               <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_approved_heritage'><?php echo lang('Heritage Found In Woreda');?></button>
               <?php endif; ?>
               <?php if ($this->session->userdata('userroll') == 'ZR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_needs_approval'>Heritage Needs ZR Approval</button>
               <?php endif; ?>
               <?php if ($this->session->userdata('userroll') == 'RR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_needs_approval'>Heritage Needs RR Approval</button>
               <?php endif; ?>
               <?php if ($this->session->userdata('userroll') == 'RD'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_approved_heritage'>Heritage Found In Region</button>
               <?php endif; ?>
            </div>
            <div class="col-md-3">
               <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_registered_in_woreda'><?php echo lang('Heritage Registered In Woreda');?></button>
               <?php endif; ?>
               <?php if ($this->session->userdata('userroll') == 'ZR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_approved_by'> Heritage Approved by ZR</button>
               <?php endif; ?>
               <?php if ($this->session->userdata('userroll') == 'RR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rejected_by'>Heritage Rejected In Region</button>
               <?php endif; ?> 
               <?php if ($this->session->userdata('userroll') == 'FHRA'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_approved_heritage'>Heritage Found In Ethiopia</button>
               <?php endif; ?>              
            </div>
            <div class="col-md-3">
               <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rejected_by'><?php echo lang('Rejected Heritage In Woreda');?> </button>
               <?php endif; ?>
               <?php if ($this->session->userdata('userroll') == 'ZR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rejected_by'>Heritage Rejected In Zone</button>
               <?php endif; ?>
               <?php if ($this->session->userdata('userroll') == 'RR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_rejected_by_zr'>Heritage Rejected In Zone</button>
               <?php endif; ?>
            </div>
            <div class="col-md-3">
               <?php if ($this->session->userdata('userroll') == 'ZR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_approved_heritage'>Heritage Found In Zone</button>
               <?php endif; ?>
               <?php if ($this->session->userdata('userroll') == 'RR'): ?>
                  <button class="btn btn-primary btn-block" data-toggle='collapse' data-target='#tbl_approved_heritage'>Heritage Found In Region</button>
               <?php endif; ?>
            </div>
         </div>
			<div class="row">
            <div class="col-md-12">
               <div class="table-responsive" style="padding:0 15px;">
                  <div id="tbl_approved_heritage" class="collapse" style="margin-top: 50px;">
                     <caption><h3><?php echo lang('List of Approved Heritage');?></h3></caption>
                     <table id="tbl_list_of_approved_heritage" class="table table-striped table-bordered">            
                        <thead>
                           <tr>
                              <th><?php echo lang('ID');?> </th>
                              <th><?php echo lang('Name');?></th>
                              <th><?php echo lang('Local Name');?></th>
                              <th> <?php echo lang('Category');?> </th>
                              <th><?php echo lang('Ownership');?></th>
                              <th><?php echo lang('Detail');?></th>
                           </tr>
                        </thead>
                        <tbody id="tbl_list_of_approved_heritage" class="table table-striped table-bordered">
                        
                        <?php foreach($list_of_heritage_registered_by_all as $heritage):?>
                           <tr>
                           <td><?php echo $heritage['NationalRNO'];?></td>
                           <td><?php echo $heritage['Name'];?></td>
                           <td><?php echo $heritage['LocalName'];?></td>
                           <td><?php echo $heritage['Category'];?></td>
                           <td><?php echo $heritage['Ownership'];?></td>
                           <td><a href="<?php echo base_url('heritage/heritage_detail/' . $heritage['NationalRNO'])?>">
                               <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                        </tr>
                        <?php endforeach;?>
                        
                     </tbody>
                  </table>
               </div>
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive" style="padding:0 15px;">
                  <div id="tbl_needs_approval" class="collapse" style="margin-top: 50px;">
                  <?php if ($this->session->userdata('userroll') == 'ZR'): ?>
                  <caption><h3>List of Heritage Needs Zone Registrar Approval</h3></caption>
                  <?php elseif ($this->session->userdata('userroll') == 'RR'): ?>
                  <caption><h3>List of Heritage Needs Regional Registrar Approval</h3></caption>
                  <?php endif; ?>
                     <table id="tbl_list_of_approval_needs_heritage" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Local Name</th>
                          <th>Category</th>
                          <th>Ownership</th>
                          <th>Detail</th>
                          </tr>
                        </thead>
                        <tbody id="tbl_list_of_approval_needs_heritage" class="table table-striped table-bordered">
                  
                        <?php foreach($load_heritage_registerd_in as $heritage_registered_in):?>
                           <tr>
                           <td><?php echo $heritage_registered_in['NationalRNO'];?></td>
                           <td><?php echo $heritage_registered_in['Name'];?></td>
                           <td><?php echo $heritage_registered_in['LocalName'];?></td>
                           <td><?php echo $heritage_registered_in['Category'];?></td>
                           <td><?php echo $heritage_registered_in['Ownership'];?></td>
                           <td><a href="<?php echo base_url('heritage/heritage_detail/' . $heritage_registered_in['NationalRNO'])?>">
                              <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                        </tr>
                        <?php endforeach;?>
                      </table>
                  </div>
              </div> <!-- end of table resp -->
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive" style="padding:0 15px;">
                  <div id="tbl_approved_by" class="collapse" style="margin-top: 50px;">
                  <caption><h3>List of Heritage Approved by Zone Registrar</h3></caption>
                     <table id="tbl_list_of_heritage_approved_by" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Local Name</th>
                          <th>Category</th>
                          <th>Ownership</th>
                          <th>Approved by rr</th>
                          <th>Detail</th>
                          </tr>
                        </thead>
                        <tbody id="tbl_list_of_heritage_approved_by" class="table table-striped table-bordered">
                  
                        <?php foreach($list_of_heritage_approved_by_zr as $heritage_approved_by_zr):?>
                           <tr>
                           <td><?php echo $heritage_approved_by_zr['NationalRNO'];?></td>
                           <td><?php echo $heritage_approved_by_zr['Name'];?></td>
                           <td><?php echo $heritage_approved_by_zr['LocalName'];?></td>
                           <td><?php echo $heritage_approved_by_zr['Category'];?></td>
                           <td><?php echo $heritage_approved_by_zr['Ownership'];?></td>
                           <td><?php echo $heritage_approved_by_zr['regional_approval_status'];?></td>
                           <td><a href="<?php echo base_url('heritage/heritage_detail/' . $heritage_approved_by_zr['NationalRNO'])?>">
                              <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                        </tr>
                        <?php endforeach;?>
                      </table>
                  </div>
              </div> <!-- end of table resp -->
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive" style="padding:0 15px;">
                  <div id="tbl_registered_in_woreda" class="collapse" style="margin-top: 50px;">
                  <caption><h3><?php echo lang('List of Heritage Registered in Woreda');?></h3></caption>
                     <table id="tbl_list_of_heritage_registered_in_woreda" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                          <th><?php echo lang('ID');?></th>
                          <th><?php echo lang('Name');?></th>
                          <th><?php echo lang('Local Name');?> </th>
                          <th><?php echo lang('Category');?></th>
                          <th><?php echo lang('Ownership');?></th>
                          <th><?php echo lang('Approved by zr');?></th>
                          <th><?php echo lang('Approved by rr');?></th>
                          <th><?php echo lang('Detail');?></th>
                          </tr>
                        </thead>
                        <tbody id="tbl_list_of_heritage_approved_by" class="table table-striped table-bordered">
                  
                        <?php foreach($load_heritage_registerd_in_woreda as $heritage_registerd_in_woreda):?>
                           <tr>
                           <td><?php echo $heritage_registerd_in_woreda['NationalRNO'];?></td>
                           <td><?php echo $heritage_registerd_in_woreda['Name'];?></td>
                           <td><?php echo $heritage_registerd_in_woreda['LocalName'];?></td>
                           <td><?php echo $heritage_registerd_in_woreda['Category'];?></td>
                           <td><?php echo $heritage_registerd_in_woreda['Ownership'];?></td>
                           <td><?php echo $heritage_registerd_in_woreda['zone_approval_status'];?>
                           <td><?php echo $heritage_registerd_in_woreda['regional_approval_status'];?></td>
                           <td><a href="<?php echo base_url('heritage/heritage_detail/' . $heritage_registerd_in_woreda['NationalRNO'])?>">
                              <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                        </tr>
                        <?php endforeach;?>
                      </table>
                  </div>
              </div> <!-- end of table resp -->
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
            <?php $this->setting_model->load_language();$this->setting_model->current_lang_setting();?>
               <div class="table-responsive" style="padding:0 15px;">
                  <div id="tbl_rejected_by" class="collapse" style="margin-top: 50px;">
                  <?php if ($this->session->userdata('userroll') == 'WR'): ?>
                  <caption><h3><?php echo lang('List of Rejected Heritage');?></h3></caption>
                  <?php elseif ($this->session->userdata('userroll') == 'ZR'): ?>
                  <caption><h3>List of Heritage Rejected by Zone Registrar</h3></caption>
                  <?php elseif ($this->session->userdata('userroll') == 'RR'): ?>
                  <caption><h3>List of Heritage Rejected by Regional Registrar</h3></caption>
                  <?php endif; ?>
                     <table id="tbl_list_of_heritage_rejected_by" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                          <th><?php echo lang('ID');?></th>
                          <th> <?php echo lang('Name');?></th>
                          <th><?php echo lang('Local Name ');?></th>
                          <th><?php echo lang('Category');?></th>
                          <th><?php echo lang('Ownership');?></th>                          
                          <th><?php echo lang('Detail');?></th>
                          </tr>
                        </thead>
                        <tbody id="tbl_list_of_heritage_rejected_by" class="table table-striped table-bordered">
                  
                        <?php foreach($list_of_heritage_rejected_by as $heritage_rejected_by):?>
                           <tr>
                           <td><?php echo $heritage_rejected_by['NationalRNO'];?></td>
                           <td><?php echo $heritage_rejected_by['Name'];?></td>
                           <td><?php echo $heritage_rejected_by['LocalName'];?></td>
                           <td><?php echo $heritage_rejected_by['Category'];?></td>
                           <td><?php echo $heritage_rejected_by['Ownership'];?></td>                 
                           <td><a href="<?php echo base_url('heritage/heritage_detail/' . $heritage_rejected_by['NationalRNO'])?>">
                              <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                        </tr>
                        <?php endforeach;?>
                      </table>
                  </div>
              </div> <!-- end of table resp -->
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <div class="table-responsive" style="padding:0 15px;">
                  <div id="tbl_rejected_by_zr" class="collapse" style="margin-top: 50px;">
                  <caption><h3>List of Heritage Rejected by Zone Registrar</h3></caption>          
                     <table id="tbl_list_of_heritage_rejected_by_zr" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Local Name</th>
                          <th>Category</th>
                          <th>Ownership</th>                          
                          <th>Detail</th>
                          </tr>
                        </thead>
                        <tbody id="tbl_list_of_heritage_rejected_by_zr" class="table table-striped table-bordered">
                  
                        <?php foreach($list_of_heritage_rejected_by_zr as $heritage_rejected_by_zr):?>
                           <tr>
                           <td><?php echo $heritage_rejected_by_zr['NationalRNO'];?></td>
                           <td><?php echo $heritage_rejected_by_zr['Name'];?></td>
                           <td><?php echo $heritage_rejected_by_zr['LocalName'];?></td>
                           <td><?php echo $heritage_rejected_by_zr['Category'];?></td>
                           <td><?php echo $heritage_rejected_by_zr['Ownership'];?></td>                 
                           <td><a href="<?php echo base_url('heritage/heritage_detail/' . $heritage_rejected_by_zr['NationalRNO'])?>">
                              <span class="glyphicon glyphicon-folder-open"></span> &nbsp; Detail</a></td>
                        </tr>
                        <?php endforeach;?>
                      </table>
                  </div>
              </div> <!-- end of table resp -->
            </div>
         </div>        
         
		</div> <!-- menu div -->
	</div>
</div>         

<script>
      $(document).ready(function(){
      $('#tbl_list_of_approved_heritage').dataTable();
      $('#tbl_list_of_approval_needs_heritage').dataTable();
      $('#tbl_list_of_heritage_approved_by').dataTable();
      $('#tbl_list_of_heritage_rejected_by').dataTable();
      $('#tbl_list_of_heritage_registered_in_woreda').dataTable();
      $('#tbl_list_of_heritage_rejected_by_zr').dataTable();         
});
</script>