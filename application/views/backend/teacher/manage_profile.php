<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"> <?php echo get_phrase('Profile'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Profile'); ?></li>
        </ol>
    </div>
</div>

    <?php 
                    foreach($edit_data as $row):
                        ?>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <div class="white-box">
         <div class="user-bg"> <img width="100%" alt="user" src="<?php echo $this->crud_model->get_image_url('teacher' , $row['teacher_id']);?>"> </div>
            <div class="user-btm-box">
                <div class="row text-center m-t-10">
                    <div class="col-md-6 b-r"><strong><?php echo get_phrase('Name'); ?></strong>
                            <p><?php echo $row['name'];?></p>
                                    </div>
                                    <div class="col-md-6"><strong><?php echo get_phrase('Username'); ?></strong>
                                        <p><?php echo $row['username'];?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong><?php echo get_phrase('Email'); ?></strong>
                                        <p><?php echo $row['email'];?></p>
                                    </div>
                                    <div class="col-md-6"><strong><?php echo get_phrase('Phone'); ?></strong>
                                        <p><?php echo $row['phone'];?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center m-t-10">
                                    <div class="col-md-12"><strong><?php echo get_phrase('Address'); ?></strong>
                                        <p><?php echo $row['address'];?></p>
                                    </div>
        </div>
    </div>
</div>
</div>
<?php endforeach;  ?>
	<div class="col-md-8">
<div class="white-box">
		<div class="tab-content">
			<div class="tab-pane box active" id="list" style="padding: 5px">
                <div class="box-content">
                    <?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'index.php?teacher/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo get_phrase('Name'); ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo get_phrase('Email'); ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo get_phrase('Phone'); ?></label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo get_phrase('Address'); ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-sm-4 control-label"><?php echo get_phrase('Salary'); ?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="salary" readonly value="<?php echo $row['salary'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Photo'); ?></label>
                        
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('teacher' , $row['teacher_id']);?>" alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new"><?php echo get_phrase('Select'); ?></span>
                                                <span class="fileinput-exists"><?php echo get_phrase('Change'); ?></span>
                                                <input type="file" name="userfile" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete'); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-4 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Update'); ?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
		</div>
	</div>
    </div>
</div>