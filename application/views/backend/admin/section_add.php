<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
					<font color="white"><?php echo get_phrase('Add');?></font>
            	</div>
            </div>
            <br><hr>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/sections/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
		
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Section');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('Class');?></label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>">
                              <option value=""><?php echo get_phrase('Select');?></option>
                              <?php 
									$classes = $this->db->get('class')->result_array();
									foreach($classes as $row):
										?>
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
						<label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('Teacher');?></label>
                        
						<div class="col-sm-5">
							<select name="teacher_id" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('Select');?></option>
                              <?php 
									$teachers = $this->db->get('teacher')->result_array();
									foreach($teachers as $row):
										?>
                                		<option value="<?php echo $row['teacher_id'];?>">
												<?php echo $row['name'];?>
                                                </option>
                                    <?php
									endforeach;
								?>
                          </select>
						</div> 
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-4 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>