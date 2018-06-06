<?php  $edit_data = $this->db->get_where('gallery_category' , array('category_id' => $param2))->result_array();
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
				
                <?php echo form_open(base_url() . 'index.php?admin/gall_category/edit/' . $row['category_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Title');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>" 
								value="<?php echo $row['title'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('embedid');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="embed" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>" 
								value="<?php echo $row['embed'];?>">
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                        
					<textarea class="textarea_editor form-control"  name="description" id="description" rows="15"><?php echo $row['description'];?></textarea>
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




    <script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>