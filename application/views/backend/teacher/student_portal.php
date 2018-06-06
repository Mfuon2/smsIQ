<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php $min = $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    	<h4 class="page-title"><?php echo get_phrase('Student-Portal'); ?></h4> 
   	</div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Student-Portal'); ?></li>
        </ol>
    </div>
</div>

<div class="row">
<?php $student_info	=	$this->db->get_where('enroll' , array('student_id' => $student_id , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->result_array(); 
    foreach($student_info as $row): ?>
    <div class="col-md-12">
                        <center><?php if(file_exists('uploads/student_image/'.$student_id.'.jpg')):?>
				<img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-responsive"/>
			<?php endif;?>
			<?php if(!file_exists('uploads/student_image/'.$student_id.'.jpg')):?>
				<img src="assets/user.png" class="img-rounded img-responsive"/>
			<?php endif;?></center>
                        <div class="white-box">
                            <center><h4><?php echo $this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->name;?></h4></center>
        <?php $destacado = $this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->board;
				if ($destacado == 1):?>
                  <center><h5><i class="fa fa-circle m-r-5" style="color: #00a651;"></i><?php echo get_phrase('Excellent'); ?></h5> </li></center>
                  <?php endif;?>
                  <br>
                                 <?php $student_birthday = $this->db->get_where('student' , array(
        	'student_id' => $row['student_id']))->row()->birthday;
				list ($day, $month, $year) = split("-", $student_birthday);
				$now = date("m");
                if ($now == $month):?>
                    <center><div class="badge badge-warnig">
                        <i class="icon-present"></i> <?php echo get_phrase('This-Month');?>
                    </div></center>
                <?php endif;?><br><br>

        <p><span><?php echo get_phrase('Sex'); ?>:</span>    <span class="pull-right label label-info label-rounded"><?php if($this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->sex == 'male') echo get_phrase('Male'); if($this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->sex == 'female') echo get_phrase('Female'); ?></span></p>

        <p><span><?php echo get_phrase('Class'); ?>:</span>    <span class="pull-right label label-info label-rounded"><?php echo $this->crud_model->get_class_name($row['class_id']); ?></span></p>

        <p><span><?php echo get_phrase('Section'); ?>:</span>    <span class="pull-right label label-info label-rounded"><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name; ?></span></p>

        <p><span><?php echo get_phrase('Parent'); ?>:</span>    <span class="pull-right label label-info label-rounded"><?php echo $this->crud_model->get_type_name_by_id('parent', $this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->parent_id); ?></span></p>

        <p><span><?php echo get_phrase('Birthday'); ?>:</span>    <span class="pull-right label label-info label-rounded"><?php echo $this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->birthday; ?></span></p>

        <p><span><?php echo get_phrase('Class-Assigned'); ?>:</span>    <span class="pull-right label label-info label-rounded"><?php echo $this->crud_model->get_type_name_by_id('dormitory', $this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->dormitory_id); ?></span></p>
                        </div>
                    </div>
	<?php endforeach;?>


<div class="main_data">
<br/><br/>
<?php 
    $student_info = $this->crud_model->get_student_info($student_id);
    $exams         = $this->crud_model->get_exams();
    foreach ($student_info as $row1):
    foreach ($exams as $row2):
?>
<div class="row">
	<div class="col-sm-12">
        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><font color="white"><?php echo $row2['name'];?></font></div>
            </div>
               <div class="white-box">
               <div class="table-responsive">
                   <table class="table table-bordered info-table">
                       <thead>
                        <tr>
                            <td style="text-align: center;"><strong><?php echo get_phrase('Subject');?></strong></td>
                            <td style="text-align: center;"><strong><?php echo get_phrase('Teacher');?></strong></td>
                            <td style="text-align: center;"><strong>C1</strong></td>
                            <td style="text-align: center;"><strong>C2</strong></td>
                            <td style="text-align: center;"><strong>C3</strong></td>
                            <td style="text-align: center;"><strong>C4</strong></td>
                            <td style="text-align: center;"><strong>C5</strong></td>
                            <td style="text-align: center;"><strong>C6</strong></td>
                            <td style="text-align: center;"><strong>C7</strong></td>
                            <td style="text-align: center;"><strong>C8</strong></td>
                            <td style="text-align: center;"><strong>C9</strong></td>
                            <td style="text-align: center;"><strong>C10</strong></td>
                            <td style="text-align: center;"><strong><?php echo get_phrase('FinalExam');?></strong></td>
                            <td style="text-align: center;"><strong><?php echo get_phrase('Total');?></strong></td>
                            <td style="text-align: center;"><strong><?php echo get_phrase('Comment');?></strong></td>
                            <td style="text-align: center;"><strong><?php echo get_phrase('Status');?></strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $subjects = $this->db->get_where('subject' , array('class_id' => $class_id , 'year' => $running_year
                            ))->result_array();
                            foreach ($subjects as $row3): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row3['name'];?></td>
                                <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('teacher', $row3['teacher_id']); ?></td>
                                <td style="text-align: center;">
                                    <?php $obtained_mark_query = $this->db->get_where('mark' , array(
                                    'subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'],
                                    'class_id' => $class_id, 'student_id' => $student_id , 
                                    'year' => $running_year));
                                    if ( $obtained_mark_query->num_rows() > 0)
                                    {
                                    $marks = $obtained_mark_query->result_array();
                                    foreach ($marks as $row4)
                                    echo $row4['mark_obtained'];        
                                    } ?>
                                </td>
                                <td style="text-align: center;"> <?php  $marks = $obtained_mark_query->result_array();
                                    foreach ($marks as $row4) echo $row4['labuno'];?></td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labdos'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labtres'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labcuatro'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labcinco'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labseis'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labsiete'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labocho'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labnueve'];?>
                                </td>
                                 <td style="text-align: center;">
                                <?php foreach ($marks as $row4) echo $row4['final'];?>
                                </td>
                               <?php if($row4['labtotal'] < $min):?>
                                <td style="text-align: center;">
                                <span class="label label-rouded label-danger pull-right"><?php foreach ($marks as $row4) echo $row4['labtotal'];?></span>
                                </td>
                                <?php endif;?>
                                <?php if($row4['labtotal'] >= $min):?>
                                <td style="text-align: center;">
                                <span class="label label-rouded label-info pull-right"><?php foreach ($marks as $row4) echo $row4['labtotal'];?></span>
                                </td>
                                <?php endif;?>
                                <td style="text-align: center;">
                                <?php foreach ($marks as $row4) echo $row4['comment'];?>
                                </td>


                                <?php $min = $this->db->get_where('settings' , array('type' =>'minimark'))->row()->description;?>

                                <td style="text-align: center;">
                                <?php foreach ($marks as $row4) $average = ($row4['labtotal']/11); echo number_format($average, 2, '.', '');?>%
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                   </table>
                </div>
        </div>  
	</div>
</div>
</div>
<?php endforeach;
    	endforeach; ?>
</div>