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
                <?php echo form_open(base_url() . 'index.php?admin/gall_category/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
		
					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>" value="" autofocus>
						</div>
					</div>

						<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Description');?></label>
                        
						<div class="col-sm-5">
							<textarea type="text" class="form-control" name="description" rows="5" value="" autofocus></textarea>
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