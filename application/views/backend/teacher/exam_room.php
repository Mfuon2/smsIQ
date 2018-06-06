<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Examenes en línea</h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active">Examenes en línea</li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-md-2">
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?teacher/examroom/exam/<?php echo $exam_code;?>" 
			class="<?php if ($room_page == 'exam')  echo 'btn btn-warning';
			else  echo 'btn btn-info';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('Details'); ?>
			<i class="fa fa-info"></i>
		</a>

		<a style="text-align: left;" href="<?php echo base_url();?>index.php?teacher/examroom/exam_questions/<?php echo $exam_code;?>" 
			class="<?php if ($room_page == 'exam_questions')  echo 'btn btn-success';
			else  echo 'btn btn-info';?> btn-block btn-icon icon-left">
			Questions
			<i class="fa fa-question-circle"></i>
		</a>

		<a style="text-align: left;" href="<?php echo base_url();?>index.php?teacher/examroom/exam_questions/<?php echo $exam_code;?>" 
			class="<?php if ($room_page == 'exam_questions')  echo 'btn btn-danger';
			else  echo 'btn btn-info';?> btn-block btn-icon icon-left">
			View Results
			<i class="fa fa-tachometer"></i>
		</a>

        <a style="text-align: left;" href="<?php echo base_url();?>index.php?teacher/examroom/edit/<?php echo $exam_code;?>" 
			class="<?php if ($room_page == 'exam_edit')  echo 'btn btn-warning';
			else echo 'btn btn-info';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('Edit'); ?>
			<i class="fa fa-edit"></i>
		</a>
	</div>

	<div class="main_data">
		<?php include $room_page . '.php';?>
	</div>
</div>