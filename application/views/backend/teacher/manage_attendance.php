<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo get_phrase('Attendance');?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Class');?></a></li>
	        <li class="active"><?php echo get_phrase('Attendance');?></li>
	    </ol>                
    </div>
</div>

<?php echo form_open(base_url() . 'index.php?teacher/attendance_selector/');?>
<div class="row">
	<div class="col-md-3 col-sm-offset-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Date'); ?></label>
			<input type="text" class="form-control mydatepicker" name="timestamp"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>

	<?php
		$query = $this->db->get_where('section' , array('class_id' => $class_id));
		if($query->num_rows() > 0):
			$sections = $query->result_array();
	?>

	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Section'); ?></label>
			<select class="form-control selectboxit" name="section_id">
				<?php foreach($sections as $row):?>
					<option value="<?php echo $row['section_id'];?>"><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>
	<?php endif;?>
	<input type="hidden" name="class_id" value="<?php echo $class_id;?>">
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('View'); ?></button>
	</div>

</div>
<?php echo form_close();?>