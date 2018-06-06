<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo get_phrase('System-Settings'); ?></h4> 
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
          <li class="active"><?php echo get_phrase('System-Settings'); ?></li>
        </ol>
    </div>
</div>

<div class="row">
    <?php echo form_open(base_url() . 'index.php?admin/system_settings/do_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-6">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white"><?php echo get_phrase('System-Settings');?></font>
                    </div>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('System-Name');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_name" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('System-Title');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_title" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_title'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Paypal-Email');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="paypal_email" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'paypal_email'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Address');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="address" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?>">
                      </div>
                  </div>
          
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Language');?></label>
                      <div class="col-sm-9">
                          <select name="language" class="form-control selectboxit">
                                <?php $fields = $this->db->list_fields('language');
                                  foreach ($fields as $field)
                                {
                    if ($field == 'phrase_id' || $field == 'phrase') continue;
                    $current_default_language = $this->db->get_where('settings' , array('type'=>'language'))->row()->description; ?>
                              <option value="<?php echo $field;?>"
                                <?php if ($current_default_language == $field) echo 'selected';?>> <?php echo $field;?> </option>
                                        <?php } ?>
                           </select>
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Phone');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="phone" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'phone'))->row()->description;?>">
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Currency');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="currency" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Email');?></label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="system_email" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'system_email'))->row()->description;?>">
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-3 control-label"><?php echo get_phrase('Year');?></label>
                      <div class="col-sm-9">
                          <select name="running_year" class="form-control selectboxit">
                          <?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;?>
                          <option value=""><?php echo get_phrase('Select');?></option>
                          <?php for($i = 0; $i < 10; $i++):?>
                              <option value="<?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>"
                                <?php if($running_year == (2016+$i).'-'.(2016+$i+1)) echo 'selected';?>>
                                  <?php echo (2016+$i);?>-<?php echo (2016+$i+1);?>
                              </option>
                          <?php endfor;?>
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-5 control-label">RTL</label>
                      <div class="col-sm-5">
                          <input type="checkbox" value="rtl" <?php if($this->db->get_where('settings' , array('type' =>'rtl'))->row()->description == 'rtl') echo 'checked';?> name="rtl" class="js-switch" data-color="#13dafe" />
                      </div>
                  </div>
                <br>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                    </div>
                  </div>
                  <br><br><br><br><br><br><br>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>

        <?php echo form_open(base_url() . 'index.php?admin/system_settings/socials' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-6">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white">Social Links</font>
                    </div>
                </div>
                <div class="panel-body">
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Facebook URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="facebook_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'facebook_url'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Twitter URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="twitter_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'twitter_url'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Google+ URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="google_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'google_url'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">LinkedIn URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="linkedin_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'linkedin_url'))->row()->description;?>">
                      </div>
                  </div>
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Pinterest URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="pinterest_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'pinterest_url'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Instagram URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="instagram_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'instagram_url'))->row()->description;?>">
                      </div>
                  </div>
                  
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">Dribbble URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="dribbble_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'dribbble_url'))->row()->description;?>">
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-3 control-label">YouTube URL</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="youtube_url" 
                              value="<?php echo $this->db->get_where('settings' , array('type' =>'youtube_url'))->row()->description;?>">
                      </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                    </div>
                  </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
        <div class="panel panel-info" >
         <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Skin');?></font>
                      </div>
                  </div>
              <div class="panel-body">
               <?php echo form_open(base_url() . 'index.php?admin/system_settings/skin_colour' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>   
                <div class="radio radio-custom">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'dark') echo 'checked';?> name="skin_colour" id="radio2" value="dark">
                  <label for="radio2"> White </label>
                </div>
                <div class="radio radio-primary">
                  <input type="radio" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'purple') echo 'checked';?> name="skin_colour" id="radio3" value="purple">
                  <label for="radio3"> Purple </label>
                </div>
                <div class="radio radio-info">
                  <input type="radio" name="skin_colour" <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'blue') echo 'checked';?> id="radio5" value="blue">
                  <label for="radio5"> Blue </label>
                </div>
                <div class="radio radio-danger">
                  <input type="radio" name="skin_colour"  <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'danger') echo 'checked';?> id="radio6" value="danger">
                  <label for="radio6"> Danger </label>
                </div>
                <div class="radio radio-success">
                  <input type="radio" name="skin_colour"  <?php if($skin = $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description == 'megna') echo 'checked';?> id="radio7" value="megna">
                  <label for="radio7"> Megna </label>
                </div>
                <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                      </div>
                    </div>
                    <?php echo form_close();?>
                </div>
      </div>
          </div>

        <div class="col-md-6">
            <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_logo' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-info" >
                  <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Logo');?></font>
                      </div>
                  </div>
                  
                  <div class="panel-body">   
                      <div class="form-group">
                          <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Logo');?></label>
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/logo.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                  <div>
                                      <span class="btn btn-info btn-file">
                                          <span class="fileinput-new"><?php echo get_phrase('Upload');?></span>
                                          <span class="fileinput-exists"><?php echo get_phrase('Change');?></span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete');?></a>
                                  </div>
                              </div>
                          </div>
                      </div>

                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
         </div>

        <div class="col-md-6">
            <?php echo form_open(base_url() . 'index.php?admin/system_settings/ad' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>

              <div class="panel panel-info" >
                  <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Quick-ad');?></font>
                      </div>
                  </div>
                  
                  <div class="panel-body">
                     <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" rows="7" name="ad" id="post_content"><?php echo $this->db->get_where('settings' , array('type' =>'ad'))->row()->description;?></textarea>
                    </div>
                </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Send');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
         </div>
        </div>

 <div class="row">
    <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_slider' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Slider1');?></font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 50px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider1.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 50px"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new"><?php echo get_phrase('Upload');?></span>
                                          <span class="fileinput-exists"><?php echo get_phrase('Change');?></span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete');?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Upload');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
        </div>


            <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_slider2' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Slider2');?></font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 50px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider2.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 50px"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new"><?php echo get_phrase('Upload');?></span>
                                          <span class="fileinput-exists"><?php echo get_phrase('Change');?></span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete');?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
              
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Upload');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
        </div>


            <div class="col-sm-4">
            <?php echo form_open(base_url() . 'index.php?admin/system_settings/upload_slider3' , array(
            'class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
              <div class="panel panel-info" >
               <div class="panel-heading">
                      <div class="panel-title">
                          <font color="white"><?php echo get_phrase('Slider3');?></font>
                      </div>
                  </div>
                  <div class="panel-body">
                      <div class="form-group">
                          <div class="col-sm-9">
                              <div class="fileinput fileinput-new" data-provides="fileinput">
                                  <div class="fileinput-new thumbnail" style="width: 290px; height: 50px;" data-trigger="fileinput">
                                      <img src="<?php echo base_url();?>uploads/slider/slider3.png" alt="...">
                                  </div>
                                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 290px; max-height: 50px"></div>
                                  <div>
                                      <span class="btn btn-white btn-file">
                                          <span class="fileinput-new"><?php echo get_phrase('Upload');?></span>
                                          <span class="fileinput-exists"><?php echo get_phrase('Change');?></span>
                                          <input type="file" name="userfile" accept="image/*">
                                      </span>
                                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete');?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('Upload');?></button>
                      </div>
                    </div>
                  </div>
              </div>
            <?php echo form_close();?>
        </div>
    </div>

    <script>
jQuery(document).ready(function () 
  {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function () 
    {
       new Switchery($(this)[0], $(this).data());
    });
});
</script>