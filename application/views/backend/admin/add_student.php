
<!--/**
* Created by PhpStorm.
* User: Mfuon
* Date: 01/29/2018
* Time: 12:56 AM
*/-->
<div class="row bg-title">
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo get_phrase('Add-Student'); ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Add-Student'); ?></li>
        </ol>
    </div>

</div>

<div class="form-group" style="float: right ">

    <script>
        // Slowly Replace the div Containers for the dashboard
        /*$("#upload-excel").click(function () {
            $("#single-student").hide("slow", function () {
                enableField("students-register");
                $("#students-register").show("slow");
            });
        });*/

        function replaceContent(div_id){
            enableField("students-register");
            hideField("single-student");
            em(div_id).innerHTML = em("students-register").innerHTML
        }

        function em(div_Id) {
            return document.getElementById(div_Id);
        }

        function hideField(div_Id) {
            return em(div_Id).hidden = true;
        }

        function enableField(div_Id) {
            return em(div_Id).hidden = false;
        }

        function get_sections(class_id) {
            $.ajax({
                url: '<?php echo base_url();?>index.php?admin/get_sections/' + class_id ,
                success: function(response)
                {
                    jQuery('#section_holder').html(response);
                    jQuery('#bulk_add_form').show();
                }
            });
        }
    </script>
    <div class="col-sm-3">
        <button  onclick="replaceContent('students-register')" id="upload-excel" class="btn btn-info">Excel</button>
    </div>

    <div class="col-sm-offset-3 col-sm-3">
        <button type="submit" class="btn btn-info">CVS</button>
    </div>
</div>


<div class="row">

	<div class="col-md-12">

        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    <font color="white"><?php echo get_phrase('Student-Form'); ?></font>
                </div>
            </div>

            <div class="panel-body" id="students-register" hidden>

                <?php echo form_open(base_url() . 'index.php?admin/student/uploadStudentsFile/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                <div class="form-group">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="form_group">
                            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Class');?></label>
                            <select name="class_id" id="class_id" class="form-control selectboxit" required="required"
                                    onchange="get_sections(this.value)"  data-validate="required"  data-message-required="<?php echo get_phrase('Required');?>">
                                <option value=""><?php echo get_phrase('Select');?></option>
                                <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach($classes as $row):
                                    ?>
                                    <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form_group">
                            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Template Code');?></label>
                            <input type="text" name="templateCode" id="templateCode" class="form-control"  required PLACEHOLDER="Template Code" autofocus>
                        </div>
                    </div>
                    <div id="section_holder"></div>
                    <div class="col-md-3"></div>

                </div>
                <div class="col-sm-5">
                    <label for="field-1"
                           class="col-sm-3 control-label"><?php echo get_phrase('Upload Excel File'); ?></label>
                    <input type="file" name="file" id="file" class="form-control"  required accept=".xls, .xlsx" value="" autofocus>
                    <input type="submit" class="btn btn-info" name="uploadFile"  value="Upload"/>
                </div>
                <?php echo form_close(); ?>
            </div>

			<div class="panel-body" id="single-student">

                <?php echo form_open(base_url() . 'index.php?admin/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Name'); ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" required="" value="" autofocus>
						</div>
					</div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Admission Number'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="admNo" value="" >
                    </div>
                </div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Username'); ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="username" required value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" required class="col-sm-3 control-label"><?php echo get_phrase('Parent'); ?></label>
                        
						<div class="col-sm-5">
							<select name="parent_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('Select'); ?></option>
                              <?php 
								$parents = $this->db->get('parent')->result_array();
								foreach($parents as $row): ?>
                            		<option value="<?php echo $row['parent_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Class'); ?></label>
						<div class="col-sm-5">
							<select name="class_id" class="form-control" required="" onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('Select'); ?></option>
                              <?php $classes = $this->db->get('class')->result_array();
								foreach($classes as $row): ?>
                            		<option value="<?php echo $row['class_id'];?>">
									<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Stream'); ?></label>
		                    <div class="col-sm-5">
		                        <select name="section_id" class="form-control" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('Select-Class'); ?></option>
			                    </select>
			                </div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Enrolment Number'); ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="roll" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Birthday'); ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control mydatepicker" name="birthday" value="" placeholder="dd-mm-yyyy">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Sex'); ?></label>
						<div class="col-sm-5">
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('Select'); ?></option>
                              <option value="male"><?php echo get_phrase('Male'); ?></option>
                              <option value="female"><?php echo get_phrase('Female'); ?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Address'); ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="address" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Phone'); ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Email'); ?></label>
						<div class="col-sm-5">
							<input type="email" class="form-control" name="email" value=""<?=form_error('email'); ?>>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Password'); ?></label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="password" required="" value="" >
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Living-Assigned'); ?></label>
                        
						<div class="col-sm-5">
							<select name="dormitory_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('Select'); ?></option>
	                              <?php 
	                              	$dormitories = $this->db->get('dormitory')->result_array();
	                              	foreach($dormitories as $row): ?>
                              		<option value="<?php echo $row['dormitory_id'];?>"><?php echo $row['name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('School-Bus'); ?></label>
                        
						<div class="col-sm-5">
							<select name="transport_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('Select'); ?></option>
	                              <?php 
	                              	$transports = $this->db->get('transport')->result_array();
	                              	foreach($transports as $row): ?>
                              		<option value="<?php echo $row['transport_id'];?>"><?php echo $row['route_name'];?></option>
                          		<?php endforeach;?>
                          </select>
						</div> 
					</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Photo'); ?></label>
                        
						<div class="col-sm-5">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-info btn-file">
										<span class="fileinput-new"><?php echo get_phrase('Upload'); ?></span>
										<span class="fileinput-exists"><?php echo get_phrase('Change'); ?></span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete'); ?></a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Add'); ?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
	function get_class_sections(class_id) 
	{
    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>