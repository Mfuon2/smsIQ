<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo get_phrase('Tabulation');?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Class');?></a></li>
	        <li class="active"><?php echo get_phrase('Tabulation');?></li>
	    </ol>                
    </div>
</div>



<hr />
<div class="row">
	<div class="col-md-12">
		<?php echo form_open(base_url() . 'index.php?teacher/tab_sheet');?>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label"><?php echo get_phrase('Class');?></label>
					<select name="class_id" class="form-control selectboxit">
                        <option value=""><?php echo get_phrase('Select');?></option>
                        <?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"
                            	<?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            		<?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				<label class="control-label"><?php echo get_phrase('Semester');?></label>
					<select name="exam_id" class="form-control selectboxit">
                        <option value=""><?php echo get_phrase('Select');?></option>
                        <?php 
                        $exams = $this->db->get_where('exam' , array('year' => $running_year))->result_array();
                        foreach($exams as $row):
                        ?>
                            <option value="<?php echo $row['exam_id'];?>"
                            	<?php if ($exam_id == $row['exam_id']) echo 'selected';?>>
                            		<?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<input type="hidden" name="operation" value="selection">
			<div class="col-md-4" style="margin-top: 20px;">
				<button type="submit" class="btn btn-info"><?php echo get_phrase('Generate');?></button>
			</div>
		<?php echo form_close();?>
	</div>
</div>

<?php if ($class_id != '' && $exam_id != ''):?>
<br>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4" style="text-align: center;">
		<div class="tile-stats tile-gray">
		<div class="icon"><i class="entypo-docs"></i></div>
			<h3 style="color: #696969;">
				<?php
					$exam_name  = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; 
					$class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; 
					echo get_phrase('Tabulation');
				?>
			</h3>
			<h4 style="color: #696969;">
				<?php echo get_phrase('Class') . ' ' . $class_name;?> : <?php echo $exam_name;?>
			</h4>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>


<hr />

<div class="row">
	<div class="col-md-12">
	<div class="white-box">
		<table class="table table-bordered">
			<thead>
				<tr>
				<td style="text-align: center;">
					<?php echo get_phrase('Students');?> <i class="fa fa-arrow-circle-down"></i> | <?php echo get_phrase('Subjects');?> <i class="fa fa-arrow-circle-right"></i>
				</td>
				<?php 
					$subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
					foreach($subjects as $row):
				?>
					<td style="text-align: center;"><?php echo $row['name'];?></td>
				<?php endforeach;?>
				<td style="text-align: center;"><?php echo get_phrase('Average');?></td>
				</tr>
			</thead>
			<tbody>
			<?php
				
				$students = $this->db->get_where('enroll' , array('class_id' => $class_id , 'year' => $running_year))->result_array();
				foreach($students as $row):
			?>
				<tr>
					<td style="text-align: left;">
						<?php echo $this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;?>
					</td>
				<?php
					$total_marks = 0;  foreach($subjects as $row2): ?>
					<td style="text-align: center;">
				<?php $marks = 	$this->db->get_where('mark' , array('class_id' => $class_id ,'exam_id' => $exam_id , 
				'subject_id' => $row2['subject_id'] , 'student_id' => $row['student_id'],'year' => $running_year));
							if($marks->num_rows() > 0) 
							{
								$obtained_marks = $marks->row()->labtotal;
								echo $obtained_marks;
								$total_marks += $obtained_marks;
							}
						?>
					</td>
				<?php endforeach;?>
				<td style="text-align: center;">
					<?php 
						$this->db->where('class_id' , $class_id);
						$this->db->where('year' , $running_year);
						$this->db->from('subject');
						$total_subjects = $this->db->count_all_results();
						echo ($total_marks / $total_subjects); echo "%";
					?>
				</td>
				</tr>

			<?php endforeach;?>

			</tbody>
		</table>
		<center>
			<a href="<?php echo base_url();?>index.php?teacher/tab_sheet_print/<?php echo $class_id;?>/<?php echo $exam_id;?>" class="btn btn-info" target="_blank">
				<?php echo get_phrase('Print');?>
			</a>
		</center>
		</div>
	</div>
</div>
<?php endif;?>