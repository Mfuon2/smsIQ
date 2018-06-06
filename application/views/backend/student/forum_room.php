<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('ClassForum'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('ClassForum'); ?></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-md-2">
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?student/forumroom/posts/<?php echo $post_code;?>" 
			class="<?php if ($room_page == 'post')  echo 'btn btn-warning';
			else  echo 'btn btn-info';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('Details'); ?>
			<i class="fa fa-info"></i>
		</a>
	</div>

	<div class="main_data">
		<?php include $room_page . '.php';?>
	</div>
</div>