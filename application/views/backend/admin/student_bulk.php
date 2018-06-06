<?php echo form_open(base_url() . 'index.php?admin/student_bulk/add_bulk_student' , 
			array('class' => 'form-inline validate', 'style' => 'text-align:center;'));?>
<div class="row bg-title">
<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title"><?php echo get_phrase('Add-Student');?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="#"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a href="#"><?php echo get_phrase('Students');?></a></li>
            <li class="active"><?php echo get_phrase('Add-Student');?></li>
          </ol>
        </div>
</div>
	<div class="row bg-title">
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
	</div>
	<div id="section_holder"></div>
	<div class="col-md-3"></div>
</div>
<br><br>

<div id="bulk_add_form">
<div id="student_entry">
	<div class="row" style="margin-bottom:10px;">

		<div class="form-group">
			<input type="text" name="name[]" id="name" class="form-control" style="width: 160px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Name');?>" required>
		</div>

		<div class="form-group">
			<input type="text" name="roll[]" id="roll" class="form-control" style="width: 80px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Roll');?>">
		</div>

		<div class="form-group">
			<input type="text" name="username[]" id="username" class="form-control" style="width: 160px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Username');?>" required>
		</div>
	
		<div class="form-group">
			<input type="password" name="password[]" id="password" class="form-control" style="width: 150px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Password');?>" required>
		</div>

		<div class="form-group">
			<input type="text" name="phone[]" id="phone" class="form-control" style="width: 140px; margin-left: 5px;"
				placeholder="<?php echo get_phrase('Phone');?>">
		</div>

		<div class="form-group">
			<select name="sex[]" id="sex" class="form-control" style="width: 110px; margin-left: 5px;">
				<option value=""><?php echo get_phrase('Sex');?></option>
				<option value="male"><?php echo get_phrase('Male');?></option>
				<option value="female"><?php echo get_phrase('Female');?></option>
			</select>
		</div>

		<div class="form-group">
			<button type="button" class="btn btn-danger " title="<?php echo get_phrase('Delete');?>"
					onclick="deleteParentElement(this)" style="margin-left: 10px;">
        		<i class="fa fa-trash-o" style="color: #fff;"></i>
        	</button>
		</div>

			
	</div>

</div>


<div id="student_entry_append"></div>
<br>

<div class="row">
	<center>
		<button type="button" class="btn btn-info" onclick="append_student_entry()">
			<i class="fa fa-plus"></i> <?php echo get_phrase('add_a_row');?>
		</button>
	</center>
</div>

<br><br>

<div class="row">
	<center>
		<button type="submit" class="btn btn-success" id="submit_button">
			<i class="entypo-check"></i> <?php echo get_phrase('Save');?>
		</button>
	</center>
</div>
</div>

<?php echo form_close();?>

<script type="text/javascript">
	var blank_student_entry ='';
	$(document).ready(function() {
		blank_student_entry = $('#student_entry').html();

		for ($i = 0; $i<7;$i++) {
			$("#student_entry").append(blank_student_entry);
		}
		
	});
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

	function append_student_entry()
	{
		$("#student_entry_append").append(blank_student_entry);
	}

	function deleteParentElement(n)
	{
		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
	}

</script>
