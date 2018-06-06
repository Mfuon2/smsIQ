<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs bordered">
			<li class="active">
				<a href="#running" data-toggle="tab">
					<span><i class="entypo-home"></i>
					<?php echo get_phrase('Running');?></span>
				</a>
			</li>
			<li class="">
				<a href="#archived" data-toggle="tab">
					<span><i class="entypo-archive"></i>
					<?php echo get_phrase('Archiveds');?></span>
				</a>
			</li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="running">
				<?php include 'running_notice.php';?>
			</div>
			<div class="tab-pane" id="archived">
				<?php include 'archived_notice.php';?>	
			</div>
		</div>
	</div>
</div>