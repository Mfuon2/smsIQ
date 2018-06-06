<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb bc-3">
			<li>
				<a href="<?php echo base_url();?>index.php?admin/desktop">
					<i class="entypo-folder"></i>
					<?php echo get_phrase('Dashboard');?>
				</a>
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-2">
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?admin/news_teacher_view/details/<?php echo $notice_code;?>" 
			class="<?php if ($room_page == 'details_notice') echo 'btn btn-primary';
			else echo 'btn btn-info';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('Details');?>
			<i class="entypo-info"></i>
		</a>
		<a style="text-align: left;" href="<?php echo base_url();?>index.php?admin/news_teacher_view/comment/<?php echo $notice_code;?>" 
			class="<?php if ($room_page == 'comment_notice') echo 'btn btn-primary';
							else echo 'btn btn-info';?> btn-block btn-icon icon-left">
			<?php echo get_phrase('Comment');?>
			<i class="entypo-chat"></i>
		</a>
	</div>
	<div class="main_data">
		<?php include $room_page . '.php';?>
	</div>
</div>