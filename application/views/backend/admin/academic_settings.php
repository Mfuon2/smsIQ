<div class="row bg-title">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h4 class="page-title"><?php echo get_phrase('Academic-Settings'); ?></h4> 
  </div>
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
          <li class="active"><?php echo get_phrase('Academic-Settings'); ?></li>
        </ol>
    </div>
</div>

<div class="row">
    <?php echo form_open(base_url() . 'index.php?admin/academic_settings/do_update' , 
      array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <div class="col-md-12">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">
                       <font color="white"><?php echo get_phrase('Academic-Settings');?></font>
                    </div>
                </div>
                <br><br>
                <div class="panel-body">

                <div class="form-group">
                <label class="col-sm-5 control-label"><?php echo get_phrase('MiniMark');?></label>
                <div class="col-sm-5">
                <input type="number" class="form-control" name="minium_mark" value="<?php echo $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;?>"/>
                  </div>
                </div>

                 <div class="form-group">
                      <label  class="col-sm-5 control-label"><?php echo get_phrase('Allowed');?></label>
                      <div class="col-sm-5">
                          <div class="radio radio-info">
                        <input type="radio" name="allowed_marks" id="radio3" value="1" <?php if($this->db->get_where('academic_settings' , array('type' =>'allowed_marks'))->row()->description == 1) echo 'checked';?>>
                           <label for="radio3"><?php echo get_phrase('Yes');?></label>
                    </div>
                    <div class="radio radio-info">
                         <input type="radio" name="allowed_marks" id="radio4" value="2" <?php if($this->db->get_where('academic_settings' , array('type' =>'allowed_marks'))->row()->description == 2) echo 'checked';?>>
                           <label for="radio4"><?php echo get_phrase('No');?></label>
                     </div>
                      </div>
                  </div>

                <div class="form-group">
                <label class="col-sm-5 control-label"><?php echo get_phrase('AverageMin');?></label>
                <div class="col-sm-5">
                <input type="number" class="form-control" name="minium_average" value="<?php echo $this->db->get_where('academic_settings' , array('type' =>'minium_average'))->row()->description;?>"/>
                  </div>
                </div>
                
                  <div class="form-group">
                      <label  class="col-sm-5 control-label"><?php echo get_phrase('Rating');?></label>
                      <div class="col-sm-5">
                          <input type="checkbox" value="1" <?php if($this->db->get_where('academic_settings' , array('type' =>'report_teacher'))->row()->description == 1) echo 'checked';?> name="report_teacher" class="js-switch" data-color="#13dafe" />
                      </div>
                  </div>

                  <div class="form-group">
                      <label  class="col-sm-5 control-label"><?php echo get_phrase('TeacherAverage');?></label>
                      <div class="col-sm-5">
                          <div class="radio">
                        <input type="radio" name="teacher_average" id="radio1" value="1" <?php if($this->db->get_where('academic_settings' , array('type' =>'teacher_average'))->row()->description == 1) echo 'checked';?>>
                           <label for="radio1"><?php echo get_phrase('Yes');?></label>
                    </div>
                    <div class="radio radio-custom">
                         <input type="radio" name="teacher_average" id="radio2" value="2" <?php if($this->db->get_where('academic_settings' , array('type' =>'teacher_average'))->row()->description == 2) echo 'checked';?>>
                           <label for="radio2"><?php echo get_phrase('No');?></label>
                     </div>
                      </div>
                  </div>

                  <hr>
                   <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
                    </div>
                  </div>
             </div>
          <?php echo form_close();?>
        </div>
    </div>
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