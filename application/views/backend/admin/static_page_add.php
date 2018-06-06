<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('ManagePages'); ?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('ManagePages'); ?></a></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
					<font color="white"><?php echo get_phrase('NewPage'); ?></font>
            	</div>
            </div>
            <br><br>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/pages/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Title'); ?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('Required'); ?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Description'); ?></label>
						<div class="col-sm-8">
							<textarea class="textarea_editor form-control"  name="description" rows="15" placeholder="<?php echo get_phrase('Description'); ?>..."></textarea>
						</div>
					</div>

                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Add'); ?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>