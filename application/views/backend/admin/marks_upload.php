<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
       <h4 class="page-title"><?php echo get_phrase('Upload-Marks');?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
        	<li><a href="<?php echo base_url();?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li><li class="active"><?php echo get_phrase('Upload-Marks');?></li>
       	</ol>                
    </div>
</div>
<?php echo form_open(base_url() . 'index.php?admin/marks_selector');?>
<div class="row">

	<div class="col-md-2">
		<div class="form-group">
		<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Semester');?></label>
			<select name="exam_id" class="form-control selectboxit" required>
				<?php
					$exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
					foreach($exams as $row):
				?>
				<option value="<?php echo $row['exam_id'];?>"
					<?php if($exam_id == $row['exam_id']) echo 'selected';?>><?php echo $row['name'];?></option>
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
				<option value="<?php echo $row['class_id'];?>"
					<?php if($class_id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>

	<div id="subject_holder">
		<div class="col-md-2">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Section');?></label>
				<select name="section_id" id="section_id" class="form-control selectboxit">
					<?php 
						$sections = $this->db->get_where('section' , array(
							'class_id' => $class_id 
						))->result_array();
						foreach($sections as $row):
					?>
					<option value="<?php echo $row['section_id'];?>" 
						<?php if($section_id == $row['section_id']) echo 'selected';?>>
							<?php echo $row['name'];?>
					</option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
			<label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Subject');?></label>
				<select name="subject_id" id="subject_id" class="form-control selectboxit">
					<?php 
						$subjects = $this->db->get_where('subject' , array(
							'class_id' => $class_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description
						))->result_array();
						foreach($subjects as $row):
					?>
					<option value="<?php echo $row['subject_id'];?>"
						<?php if($subject_id == $row['subject_id']) echo 'selected';?>>
							<?php echo $row['name'];?>
					</option>
					<?php endforeach;?>
				</select>
			</div>
		</div>
		<div class="col-md-2" style="margin-top: 20px;">
			<center>
				<button type="submit" class="btn btn-info"><?php echo get_phrase('View');?></button>
			</center>
		</div>
	</div>

</div>
<?php echo form_close();?>

<hr />
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-12">
	<div class="white-box">
	<div class="table-responsive">
		<?php echo form_open(base_url() . 'index.php?admin/marks_update/'.$exam_id.'/'.$class_id.'/'.$section_id.'/'.$subject_id);?>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="text-align: center;"><?php echo get_phrase('Student');?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la1;?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la2;?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la3;?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la4;?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la5;?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la6;?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la7;?></th>
						<th><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la8;?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->la9;?></th>
						<th style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id' => $subject_id))->row()->final;?></th>
						<th style="text-align: center;"><?php echo get_phrase('Comments');?></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;
					$marks_of_students = $this->db->get_where('mark' , array(
						'class_id' => $class_id, 
							'section_id' => $section_id ,
								'year' => $running_year,
									'subject_id' => $subject_id,
										'exam_id' => $exam_id
					))->result_array();
					foreach($marks_of_students as $row):
				?>
					<tr>
						<td>
							<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
						</td>
						<td>
							<input type="text" class="form-control" name="marks_obtained_<?php echo $row['mark_id'];?>"
								style="width:60px;height:30px" value="<?php echo $row['mark_obtained'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="lab_uno_<?php echo $row['mark_id'];?>"
								style="width:60px;height:30px" value="<?php echo $row['labuno'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="lab_dos_<?php echo $row['mark_id'];?>"
								style="width:60px;height:30px" value="<?php echo $row['labdos'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="lab_tres_<?php echo $row['mark_id'];?>"
								style="width:60px;height:30px" value="<?php echo $row['labtres'];?>">	
						</td>
						<td>
							<input type="text" class="form-control"  name="lab_cuatro_<?php echo $row['mark_id'];?>"
								style="width:60px;height:30px" value="<?php echo $row['labcuatro'];?>">	
						</td>
						<td>
							<input type="text" class="form-control"  name="lab_cinco_<?php echo $row['mark_id'];?>"
								 style="width:60px;height:30px" value="<?php echo $row['labcinco'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="lab_seis_<?php echo $row['mark_id'];?>"
								style="width:60px;height:30px" value="<?php echo $row['labseis'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="lab_siete_<?php echo $row['mark_id'];?>"
								style="width:60px;height:30px" value="<?php echo $row['labsiete'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="lab_ocho_<?php echo $row['mark_id'];?>"
								style="width:60px;height:30px" value="<?php echo $row['labocho'];?>">	
						</td>
						<td>
							<input type="text" class="form-control" name="lab_nueve_<?php echo $row['mark_id'];?>"
								 style="width:60px;height:30px" value="<?php echo $row['labnueve'];?>">
						</td>
						<td>
							<input type="text" class="form-control" name="comment_<?php echo $row['mark_id'];?>"
								value="<?php echo $row['comment'];?>">
						</td>
					</tr>
				<?php endforeach;?>
				</tbody>
			</table>
		<center>
			<button type="submit" class="btn btn-info" id="submit_button">
				<i class="fa fa-check"></i> <?php echo get_phrase('Upload');?>
			</button>
		</center>
		<?php echo form_close();?>
	</div>
	<div class="col-md-2"></div>
</div>
</div>
</div>

<script type="text/javascript">
	function get_class_subject(class_id) {		
	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/marks_get_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
	}
</script>