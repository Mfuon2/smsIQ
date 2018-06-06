<div class="row bg-title">
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo get_phrase('Gallery'); ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="index-2.html"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Gallery'); ?></li>
        </ol>
    </div>
</div><!--fin div-->

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
					<font color="white"><?php echo get_phrase('Gallery'); ?></font>
            	</div>
            </div>

			<div class="panel-body">
                 <?php echo form_open(base_url() . 'index.php?admin/gall_category/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('Title'); ?></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('Required'); ?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label">YouTube Video ID</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="embed" data-validate="required" data-message-required="<?php echo get_phrase('Required'); ?>" value="" autofocus>
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('Description'); ?></label>
						<div class="col-sm-8">
							<textarea class="textarea_editor form-control"  name="description" id="description" rows="15" placeholder="<?php echo get_phrase('Description'); ?>..."></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="field-1" class="col-sm-4 control-label">Thumbnail</label>
                        
						<div class="col-sm-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-red btn-file">
										<span class="fileinput-new"><?php echo get_phrase('Upload'); ?></span>
										<span class="fileinput-exists"><?php echo get_phrase('Change'); ?></span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete'); ?></a>
								</div>
							</div>
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