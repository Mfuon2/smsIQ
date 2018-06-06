        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar <?php if($page_name == 'student_bulk') echo 'navbar-collapse';?>">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
                    </li>
                    <hr>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/student_dashboard" class="waves-effect"><i class="ti-dashboard"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard');?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/teacher_list" class="waves-effect"><i class="fa fa-users"></i> <span class="hide-menu"><?php echo get_phrase('Teachers'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/events" class="waves-effect"><i class="fa fa-calendar"></i> <span class="hide-menu"><?php echo get_phrase('Events'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/subject" class="waves-effect"><i class="ti-pencil-alt"></i> <span class="hide-menu"><?php echo get_phrase('Subjects'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/my_marks/<?php echo $this->session->userdata('login_user_id');?>" class="waves-effect"><i class="fa fa-graduation-cap"></i> <span class="hide-menu"><?php echo get_phrase('My-Marks'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/attendance_report" class="waves-effect"><i class="ti-check-box"></i> <span class="hide-menu"><?php echo get_phrase('Attendance-Report'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/unit_content/<?php echo $this->session->userdata('login_user_id');?>" class="waves-effect"><i class="fa fa-cubes"></i> <span class="hide-menu"><?php echo get_phrase('Semester-Content'); ?></span></a>
                    </li>
                     <li> <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/study_material" class="waves-effect"><i class="fa fa-slack"></i> <span class="hide-menu"><?php echo get_phrase('Study-Material'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/homework/<?php echo $this->session->userdata('login_user_id');?>" class="waves-effect"><i class="fa fa-fax"></i> <span class="hide-menu"><?php echo get_phrase('My-Homework'); ?></span></a>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-book"></i> <span class="hide-menu"><?php echo get_phrase('Library'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?student/library"><?php echo get_phrase('Library'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?student/libreria_virtual/<?php echo $this->session->userdata('login_user_id');?>"><?php echo get_phrase('Virtual-Library'); ?></a></li>
                        </ul>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/request" class="waves-effect"><i class="fa fa-plus-square"></i> <span class="hide-menu"><?php echo get_phrase('ListsPerms'); ?></span></a>
                    </li>
                    <li><a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="ti-alarm-clock"></i> <span class="hide-menu"><?php echo get_phrase('Schedules'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/class_routine"><?php echo get_phrase('Class-Routine'); ?></a> 
                        </li>
                        <li> <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/horarios_de_examen"><?php echo get_phrase('Exam-Routine'); ?></a> 
                        </li>
                    </ul>
                    <li> <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/invoice" class="waves-effect"><i class="fa fa-money"></i> <span class="hide-menu"><?php echo get_phrase('Students-Payments'); ?></span></a>
                    </li>
                    </li>
<li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-picture-o"></i> <span class="hide-menu"><?php echo get_phrase('Gallery'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                             <li> <a href="<?php echo base_url(); ?>index.php?student/videos"><?php echo get_phrase('VideoGallery'); ?></a></li>
                        </ul>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/forum/<?php echo $this->session->userdata('login_user_id');?>" class="waves-effect"><i class="fa fa-comments"></i> <span class="hide-menu"><?php echo get_phrase('ClassForum'); ?></span></a>
                    </li>
                     <li> <a href="<?php echo base_url(); ?>index.php?student/circulares" class="waves-effect"><i class="fa fa-file-text-o"></i> <span class="hide-menu"><?php echo get_phrase('News'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/school_bus" class="waves-effect"><i class="fa fa-bus"></i> <span class="hide-menu"><?php echo get_phrase('School-Bus'); ?></span></a>
                    </li>
                     <?php if($this->db->get_where('academic_settings' , array('type' =>'report_teacher'))->row()->description == 1):?>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/crear_reporte/" class="waves-effect"><i class="fa fa-plus-square-o"></i> <span class="hide-menu"><?php echo get_phrase('Teacher-Report'); ?></span></a>
                    </li>
                     <?php endif; ?>
                    <li><a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="fa fa-flag"></i> <span class="hide-menu"><?php echo get_phrase('StaticPages'); ?><span class="fa arrow"></span></span></a>
                    <ul class="nav nav-third-level">
                    <?php
                        $pages = $this->db->get('pages')->result_array();
                        foreach ($pages as $row):
                            ?>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/pages_view/page_details/<?php echo $row['page_id']; ?>"><?php echo $row['title']; ?></a> </li>
                <?php endforeach; ?>
                          </ul>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?student/message" class="waves-effect"><i class="fa fa-envelope"></i> <span class="hide-menu"><?php echo get_phrase('Messages'); ?></span></a>
                    </li>
        </ul>
    </div>
</div>