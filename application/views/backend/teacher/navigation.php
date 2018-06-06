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
                    <li> <a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard" class="waves-effect"><i class="ti-dashboard"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard');?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?teacher/teacher_list" class="waves-effect"><i class="fa fa-users"></i> <span class="hide-menu"><?php echo get_phrase('Teachers'); ?></span></a>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-medall"></i> <span class="hide-menu"><?php echo get_phrase('Students-Information'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li> <a href="<?php echo base_url(); ?>index.php?teacher/students_area/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a></li>
                             <?php endforeach; ?>
                        </ul>
                    </li>
                     <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i> <span class="hide-menu"><?php echo get_phrase('Subjects'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                        <?php $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row): ?>
                        
                            <li>
                            <a href="<?php echo base_url(); ?>index.php?teacher/courses/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?>
                            </a>
                            </li>
                             <?php endforeach; ?>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-graduation-cap"></i> <span class="hide-menu"><?php echo get_phrase('Qualifications'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                             <li> <a href="<?php echo base_url(); ?>index.php?teacher/upload_marks"><?php echo get_phrase('Upload-Marks'); ?></a></li>
                             <?php if($this->db->get_where('academic_settings' , array('type' =>'teacher_average'))->row()->description == 1):?>
                             <li> <a href="<?php echo base_url(); ?>index.php?teacher/tab_sheet"><?php echo get_phrase('Tabulation'); ?></a></li>
                         <?php endif; ?>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-calendar"></i> <span class="hide-menu"><?php echo get_phrase('Homework'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?teacher/homework"><?php echo get_phrase('List'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?teacher/homework_add"><?php echo get_phrase('Add'); ?></a></li>
                        </ul>
                    </li>
                     <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-check-box"></i> <span class="hide-menu"><?php echo get_phrase('Attendance'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                        <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):
                    ?>
                            <li> <a href="<?php echo base_url(); ?>index.php?teacher/manage_attendance/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a></li>
                              <?php endforeach; ?>
                        </ul>
                    </li>
                     <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="ti-alarm-clock"></i> <span class="hide-menu"><?php echo get_phrase('Schedules'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                        <li> <a href="javascript:void(0)" class="waves-effect"><?php echo get_phrase('Class-Routine'); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                            <?php
                            $classes = $this->db->get('class')->result_array();
                             foreach ($classes as $row):?>
                                <li> <a href="<?php echo base_url(); ?>index.php?teacher/class_routine/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a> </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0)" class="waves-effect"><?php echo get_phrase('Exam-Routine'); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                            <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):?>
                                <li> <a href="<?php echo base_url(); ?>index.php?teacher/viendo_horarios/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a> </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                    </li>
                     <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-picture-o"></i> <span class="hide-menu"><?php echo get_phrase('Gallery'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                             <li> <a href="<?php echo base_url(); ?>index.php?teacher/videos"><?php echo get_phrase('VideoGallery'); ?></a></li>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-book"></i> <span class="hide-menu"><?php echo get_phrase('Library'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?teacher/library"><?php echo get_phrase('Library'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?teacher/virtual_library"><?php echo get_phrase('Virtual-Library'); ?></a></li>
                        </ul>
                    </li>
                     <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-comments-o"></i> <span class="hide-menu"><?php echo get_phrase('ClassForum'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?teacher/forum"><?php echo get_phrase('ClassForum'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?teacher/post_add"><?php echo get_phrase('CreatePost'); ?></a></li>
                        </ul>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?teacher/unit_content" class="waves-effect"><i class="ti-book"></i> <span class="hide-menu"><?php echo get_phrase('SemesterContent'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?teacher/events" class="waves-effect"><i class="fa fa-calendar"></i> <span class="hide-menu"><?php echo get_phrase('Events'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?teacher/study_material" class="waves-effect"><i class="fa fa-graduation-cap"></i> <span class="hide-menu"><?php echo get_phrase('Study-Material'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?teacher/files" class="waves-effect"><i class="ti-files"></i> <span class="hide-menu"><?php echo get_phrase('TeachersFiles'); ?></span></a>
                    </li>

                     <li> <a href="<?php echo base_url(); ?>index.php?teacher/request" class="waves-effect"><i class="fa fa-plus-square"></i> <span class="hide-menu"><?php echo get_phrase('ListsPerms'); ?></span></a>
                    </li>
                     <li> <a href="<?php echo base_url(); ?>index.php?teacher/circulares" class="waves-effect"><i class="fa fa-file-text-o"></i> <span class="hide-menu"><?php echo get_phrase('News'); ?></span></a>
                    </li>
                    <li><a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="fa fa-flag"></i> <span class="hide-menu"><?php echo get_phrase('StaticPages'); ?><span class="fa arrow"></span></span></a>
                    <ul class="nav nav-third-level">
                    <?php
                        $pages = $this->db->get('pages')->result_array();
                        foreach ($pages as $row):
                            ?>
                    <li> <a href="<?php echo base_url(); ?>index.php?teacher/pages_view/page_details/<?php echo $row['page_id']; ?>"><?php echo $row['title']; ?></a> </li>
                <?php endforeach; ?>
                          </ul>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?teacher/message" class="waves-effect"><i class="fa fa-envelope"></i> <span class="hide-menu"><?php echo get_phrase('Messages'); ?></span></a>
                    </li>
        </ul>
    </div>
</div>