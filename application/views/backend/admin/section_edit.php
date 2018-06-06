<?php 
	$edit_data = $this->db->get_where('section' , array(
		'section_id' => $param2
	))->result_array();
	foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
				<font color="white"><?php echo get_phrase('Edit');?></font>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/sections/edit/' . $row['section_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>" 
								value="<?php echo $row['name'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Class');?></label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>">
                              <option value=""><?php echo get_phrase('Select');?></option>
                              <?php 
									$classes = $this->db->get('class')->result_array();
									foreach($classes as $row2):
										?>
                                		<option value="<?php echo $row2['class_id'];?>"
                                			<?php if ($row['class_id'] == $row2['class_id'])
                                				echo 'selected';?>>
													<?php echo $row2['name'];?>
                                        </option>
                                    <?php
									endforeach;
								?>
                          </select>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Teacher');?></label>
                        
						<div class="col-sm-5">
							<select name="teacher_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('Select');?></option>
                              <?php 
									$teachers = $this->db->get('teacher')->result_array();
									foreach($teachers as $row3):
										?>
                                		<option value="<?php echo $row3['teacher_id'];?>"
                                			<?php if ($row['teacher_id'] == $row3['teacher_id'])
                                				echo 'selected';?>>
													<?php echo $row3['name'];?>
                                        </option>
                                    <?php
									endforeach;
								?>
                          </select>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>