<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
       <h4 class="page-title"><?php echo get_phrase('Upload-Marks');?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
        	<li><a href="<?php echo base_url();?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li><li class="active"><?php echo get_phrase('Upload-Marks');?></li>
       	</ol>                
    </div>
</div>

<?php echo form_open(base_url() . 'index.php?teacher/marks_selector');?>
<div class="row">
	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Semester');?></label>
			<select name="exam_id" class="form-control selectboxit">
				<?php $exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
					foreach($exams as $row):
				?>
				<option value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Class');?></label>
			<select name="class_id" class="form-control selectboxit" onchange="get_class_subject(this.value)">
				<option value=""><?php echo get_phrase('Select');?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
				?>
				<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div id="subject_holder">
		<div class="col-md-3">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Section');?></label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value=""><?php echo get_phrase('Select');?></option>		
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Subject');?></label>
				<select name="" id="" class="form-control selectboxit" disabled="disabled">
					<option value=""><?php echo get_phrase('Select-Class');?></option>		
				</select>
			</div>
		</div>
	
		<div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info" disabled="disabled"><?php echo get_phrase('View');?></button>
			</center>
		</div>
	</div>

</div>
<?php echo form_close();?>

<script type="text/javascript">
	function get_class_subject(class_id) {
		
		$.ajax({
            url: '<?php echo base_url();?>index.php?teacher/marks_get_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
	}
</script>