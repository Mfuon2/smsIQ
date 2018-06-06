<?php $is_owner = $this->db->get_where('admin' , array('admin_id' => $this->session->userdata('login_user_id')))->row()->owner_status;
?>

<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title"><?php echo get_phrase('Profile');?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="#"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a href="#"><?php echo get_phrase('Admins');?></a></li>
            <li class="active"><?php echo get_phrase('Profile');?></li>
          </ol>
        </div>
</div>


<div class="main_data">
    <?php
$profile_info = $this->db->get_where('admin' , array('admin_id' => $admin_id))->result_array();
foreach($profile_info as $row):?>
          <div class="user-profile">
            <div class="row">
              <div class="col-md-5">
          <div class="white-box">
          <div class="user-bg"> <img src="style/images/large/img.jpg" alt="user" style="100%">
              <div class="overlay-box">
                <div class="user-content"><a href="javascript:void(0)"><img alt="img" class="thumb-lg img-circle" src="<?php echo $this->crud_model->get_image_url('admin', $row['admin_id']);?>"></a>
                  <h4 class="text-white"><?php echo $row['name']; ?></h4>
                  <h5 class="text-white"><?php echo $row['email'];?></h5>
                </div>
              </div>
            </div><br><hr>
            <center><h3 class="box-title"><?php echo get_phrase('PersonalInfo');?></h3></center>
            <ul class="basic-list">
              <li><?php echo get_phrase('Name');?><span class="pull-right label-danger label"><?php echo $row['name'];?></span></li>
              <li><?php echo get_phrase('Username');?><span class="pull-right label-purple label"><?php echo $row['username'];?></span></li>
              <li><?php echo get_phrase('Phone');?><span class="pull-right label-red label"><?php echo $row['phone'];?></span></li>
              <li><?php echo get_phrase('Email');?><span class="pull-right label-success label"><?php echo $row['email'];?></span></li>
              <li><?php echo get_phrase('Birthday');?><span class="pull-right label-info label"><?php echo $row['birthday'];?></span></li>
              <li><?php echo get_phrase('Account-Status');?><span class="pull-right label-warning label"><?php if($row['status'] == 1) echo get_phrase('Active'); if($row['status'] == 2) echo get_phrase('Inactive')?></span></li>
            </ul>
          </div>
        </div>
              <div class="col-md-7">
                  <div class="panel" >
            <div class="panel-heading">
                <div class="panel-title">
                   <?php echo get_phrase('UpdateProfile');?>
                </div>
            </div>
            <?php if ($is_owner == 1):?> 
            <div class="panel-body">
               <?php $edit_data = $this->db->get_where('admin' , array('admin_id' => $admin_id))->result_array();
                      foreach ($edit_data as $row2):
                ?>
                    <?php echo form_open(base_url() . 'index.php?admin/admins/edit/'.$row2['admin_id'], array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('Name');?></label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row2['name'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('Username');?></label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="username" value="<?php echo $row2['username'];?>"/>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('Birthday');?></label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control mydatepicker" name="birthday" value="<?php echo $row2['birthday'];?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Account-Status');?></label>
                         <div class="col-sm-8">
                          <select class="form-control" name="status">
                                  <option value="1" <?php if($row2['status'] == 1) echo 'selected'?>><?php echo get_phrase('Active');?></option>
                                 <option value="2" <?php if($row2['status'] == 2) echo 'selected'?>><?php echo get_phrase('Inactive');?></option>
                         </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo get_phrase('Email');?></label>
                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row2['email'];?>"/>
                            </div>
                        </div>
                
                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Address');?></label>

                            <div class="col-sm-8">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row2['address'];?>" >
                            </div> 
                        </div>

                        <div class="form-group">
                            <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Phone');?></label>

                            <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row2['phone'];?>"  >
                            </div> 
                        </div>

              <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Photo'); ?></label>
                        
                <div class="col-sm-5">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="<?php echo $this->crud_model->get_image_url('admin' , $row2['admin_id']);?>" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                <div>
                      <span class="btn btn-info btn-file">
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
                              <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                          </div>
                        </div>
                    </form>
                    <?php
                endforeach;
                ?>
            </div>
            <?php endif;?>
        </div>
              </div>
            </div>
          </div>
<?php endforeach;?>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    <?php echo get_phrase('Update-Password');?>
                </div>
            </div>
            <?php if ($is_owner == 1):?>
            <div class="panel-body">
                    <?php 
                   $edit_datas = $this->db->get_where('admin' , array('admin_id' => $admin_id))->result_array();
                    foreach($edit_datas as $row3):
                        ?>
                         <?php echo form_open(base_url() . 'index.php?admin/admins/change_password/'.$row3['admin_id'], array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('New-Password');?></label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Confirm-Password');?></label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                              </div>
                                </div>
                        </form>
                        <?php
                    endforeach;
                    ?>
            </div>
             <?php endif;?>
        </div>
    </div>
</div>
</div>
