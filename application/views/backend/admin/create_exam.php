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

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
					<font color="white">Create new online exam</font>
            	</div>
            </div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/create_exam/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>


            <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Class'); ?></label>

                    <div class="col-sm-5">
                        <select name="class_id" class="form-control selectboxit" id="class_id" onchange="get_class_subject(this.value); get_class_sections(this.value);">
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
                       <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Section'); ?></label>
                            <div class="col-sm-5">
                                <select name="section_id" class="form-control" id="section_selector_holder">
                                    <option value=""><?php echo get_phrase('Select-Class'); ?></option>
                                </select>
                            </div>
                    </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Subject'); ?></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="form-control" id="subject_selector_holder">
                            <option value=""><?php echo get_phrase('Select-Class'); ?></option>
                        </select>
                    </div>
                </div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Title'); ?></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="title" required="" value="" autofocus>
						</div>
					</div>


				<div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Description'); ?></label>

                    <div class="col-sm-5">
                        <textarea class="form-control" rows="10" required name="description" id="post_content"></textarea>
                    </div>
                </div>
				
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Available From</label>
						<div class="col-sm-5">
							<input type="text" class="form-control mydatepicker" name="availablefrom" value="" placeholder="dd-mm-yyyy">
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Available To</label>
						<div class="col-sm-5">
							<input type="text" class="form-control mydatepicker" name="availableto" value="" placeholder="dd-mm-yyyy">
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Total Questions</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="questions" value="" >
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label">Duration (Minutes)</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="duration" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Password'); ?></label>
						<div class="col-sm-5">
							<input type="password" class="form-control" name="pass" required="" value="" >
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

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_subject/' + class_id,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
</script>

<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>  