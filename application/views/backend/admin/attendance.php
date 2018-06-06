<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Attendance'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
        	<li><a href="<?php echo base_url();?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li><li class="active"><?php echo get_phrase('Attendance'); ?></li>
        </ol>                
    </div>
</div>


<?php echo form_open(base_url() . 'index.php?admin/attendance_selector/');?>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Class'); ?></label>
			<select name="class_id" class="form-control selectboxit" onchange="select_section(this.value)">
				<option value=""><?php echo get_phrase('Select'); ?></option>
				<?php
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):                        
				?>                
				<option value="<?php echo $row['class_id'];?>"
					><?php echo $row['name'];?></option>            
				<?php endforeach;?>
			</select>
		</div>
	</div>

    <div id="section_holder">
	<div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Section'); ?></label>
			<select class="form-control selectboxit" name="section_id">
            <option value=""><?php echo get_phrase('Select'); ?></option>
			</select>
		</div>
	</div>
    </div>
	
        <div class="col-md-3">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Date'); ?></label>
			<input type="text" class="form-control mydatepicker" name="timestamp"
				value="<?php echo date("d-m-Y");?>"/>
		</div>
	</div>
	<input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('View'); ?></button>
	</div>
</div>
<?php echo form_close();?>


<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>