<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Online Exams</h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active">Online Exams</li>
        </ol>
    </div>
</div>


<div class="row">
<div class="white-box">
	<table class="table table-bordered responsive">
		<thead>
			<tr>
				<th style="text-align: center;"><?php echo get_phrase('Title'); ?></th>
				<th style="text-align: center;"><?php echo get_phrase('Teacher'); ?></th>
				<th style="text-align: center;"><?php echo get_phrase('Subject'); ?></th>
                <th style="text-align: center;">Available To</th>
				<th style="text-align: center;">Take Exam</th>
			</tr>
		</thead>
		<tbody>
	<?php $count    = 1;
	$class_id = $this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $running_year))->row()->class_id;

	$exam = $this->db->get_where('exams' , array('class_id' => $class_id))->result_array(); 
	foreach ($exam as $row):?>
	<tr>
		<td style="text-align: center;"><?php echo $row['title'];?></td>
		<td style="text-align: center;"><?php echo $this->db->get_where('teacher' , array('teacher_id'=> $row['teacher_id']))->row()->name; ?></td>
		<td style="text-align: center;"><?php echo $this->db->get_where('subject' , array('subject_id'=> $row['subject_id']))->row()->name; ?></td>
		<td style="text-align: center;"><?php echo $row['availableto'];?></td>
		<td align="center"><a class="btn btn-info" href="<?php echo base_url();?>index.php?student/take_exam/<?php echo $row['exam_code'];?>">
		<i class="fa fa-sitemap"></i> Take Exam</a></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>
</div>