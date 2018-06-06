 <?php $running_year = $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;?>
  <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title"><?php echo get_phrase('Students');?></h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('Students');?></li>
          </ol>
        </div>
      </div>
 <div class="row">
  <div class="white-box">
            <ul class="nav customtab nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"> <?php echo get_phrase('Students');?></span></a></li>
               <?php $query = $this->db->get_where('section' , array('class_id' => $class_id)); 
                if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row2):?>
              <li role="presentation" class=""><a href="#<?php echo $row2['section_id'];?>" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs"><?php echo get_phrase('Section');?> <?php echo $row2['name'];?></span></a></li><?php endforeach;?>
        <?php endif;?>
            </ul>


 <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="home">
              <?php $students = $this->db->get_where('enroll' , array(
             'class_id' => $class_id , 'year' => $running_year))->result_array();
            foreach($students as $row):?>
                <div class="col-md-4 col-sm-4">
            <div class="white-box"> 
                <div class="row">
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php?admin/student_portal/<?php echo $row['student_id'];?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" alt="user" class="img-circle img-responsive"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php?admin/student_portal/<?php echo $row['student_id'];?>"><?php echo $this->db->get_where('student' , array(
        'student_id' => $row['student_id']))->row()->name;?></a></h3>
                      <small><?php echo $row['roll'];?></small>
                    </div>
                </div>
            </div>  
          </div>
                 <?php endforeach;?>
                <div class="clearfix"></div>
              </div>

              <?php $query = $this->db->get_where('section' , array('class_id' => $class_id));
                if ($query->num_rows() > 0):
                $sections = $query->result_array();
                foreach ($sections as $row): ?>
              <div role="tabpanel" class="tab-pane fade" id="<?php echo $row['section_id'];?>">
              <?php $students = $this->db->get_where('enroll' , array(
         'class_id'=>$class_id , 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
                foreach($students as $row2):?>
                <div class="col-md-4 col-sm-4">
                     <div class="white-box"> 
                <div class="row">
                    <div class="col-md-4 col-sm-4 text-center"><a href="<?php echo base_url();?>index.php?admin/student_portal/<?php echo $row2['student_id'];?>"><img src="<?php echo $this->crud_model->get_image_url('student',$row2['student_id']);?>" alt="user" class="img-circle img-responsive"></a></div>
                    <div class="col-md-8 col-sm-8">
                      <h3 class="box-title m-b-0"><a href="<?php echo base_url();?>index.php?admin/student_portal/<?php echo $row2['student_id'];?>"><?php echo $this->db->get_where('student' , array(
        'student_id' => $row2['student_id']))->row()->name;?></a></h3>
                      <small><?php echo $row2['roll'];?></small>
                    </div>
                </div>
            </div>  
          </div>
                  <?php endforeach;?>
                <div class="clearfix"></div>
              </div>
        <?php endforeach;?>
        <?php endif;?>
           </div>
         </div>
       </div>
    </div>
</div>