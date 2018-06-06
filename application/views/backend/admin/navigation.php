        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
                            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                            </span> </div>
                    </li>
                    <hr>
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard" class="waves-effect"><i class="ti-dashboard"></i> <span class="hide-menu"><?php echo get_phrase('Dashboard');?></span></a>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i> <span class="hide-menu"><?php echo get_phrase('Users-Account'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/admins"><?php echo get_phrase('Admins'); ?></a></li>
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/teachers"><?php echo get_phrase('Teachers'); ?></a></li>
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/parents"><?php echo get_phrase('Parents'); ?></a></li>
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/add_student"><?php echo get_phrase('Students'); ?></a></li>
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/student_bulk"><?php echo get_phrase('Student-Bulk'); ?></a></li>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-medall"></i> <span class="hide-menu"><?php echo get_phrase('Students-Information'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/students_area/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a></li>
                             <?php endforeach; ?>
                        </ul>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/student_promotion" class="waves-effect"><i class="ti-back-right"></i> <span class="hide-menu"><?php echo get_phrase('Student-Promotion'); ?></span></a>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-graduation-cap"></i> <span class="hide-menu"><?php echo get_phrase('Manage-Classes'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/manage_classes"><?php echo get_phrase('Manage-Classes'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/section"><?php echo get_phrase('Manage-Sections'); ?></a></li>
                        </ul>
                    </li>
                     <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i> <span class="hide-menu"><?php echo get_phrase('Subjects'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                        <?php $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row): ?>
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/courses/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a></li>
                             <?php endforeach; ?>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-graduation-cap"></i> <span class="hide-menu"><?php echo get_phrase('Qualifications'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/semesters"><?php echo get_phrase('Semesters'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/upload_marks"><?php echo get_phrase('Upload-Marks'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/tab_sheet"><?php echo get_phrase('Tabulation'); ?></a></li>
                        </ul>
                    </li>
                     <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-check-box"></i> <span class="hide-menu"><?php echo get_phrase('Attendance'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/attendance"><?php echo get_phrase('Daily-Attendance'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/attendance_report"><?php echo get_phrase('Attendance-Report'); ?></a></li>
                        </ul>
                    </li>
                     <li> <a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="ti-alarm-clock"></i> <span class="hide-menu"><?php echo get_phrase('Schedules'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                        <li> <a href="javascript:void(0)" class="waves-effect"><?php echo get_phrase('Class-Routine'); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                            <?php
                            $classes = $this->db->get('class')->result_array();
                             foreach ($classes as $row):?>
                                <li> <a href="<?php echo base_url(); ?>index.php?admin/class_routine_view/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a> </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0)" class="waves-effect"><?php echo get_phrase('Exam-Routine'); ?><span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                            <?php
                $classes = $this->db->get('class')->result_array();
                foreach ($classes as $row):?>
                                <li> <a href="<?php echo base_url(); ?>index.php?admin/looking_routine/<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></a> </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-text-o"></i> <span class="hide-menu"><?php echo get_phrase('News'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/news"><?php echo get_phrase('List'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/enviar_noticia"><?php echo get_phrase('Send'); ?></a></li>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-book"></i> <span class="hide-menu"><?php echo get_phrase('Library'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/library"><?php echo get_phrase('Library'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/virtual_library"><?php echo get_phrase('Virtual-Library'); ?></a></li>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-picture-o"></i> <span class="hide-menu"><?php echo get_phrase('Gallery'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/gallery_category"><?php echo get_phrase('Upload-Video'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/videos"><?php echo get_phrase('VideoGallery'); ?></a></li>
                        </ul>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/classrooms" class="waves-effect"><i class="ti-home"></i> <span class="hide-menu"><?php echo get_phrase('ManageClassrooms'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/unit_content" class="waves-effect"><i class="ti-book"></i> <span class="hide-menu"><?php echo get_phrase('SemesterContent'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/files" class="waves-effect"><i class="ti-files"></i> <span class="hide-menu"><?php echo get_phrase('TeachersFiles'); ?></span></a>
                    </li>
                    <li> <a href="<?php echo base_url(); ?>index.php?admin/events" class="waves-effect"><i class="fa fa-calendar"></i> <span class="hide-menu"><?php echo get_phrase('Events'); ?></span></a>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span class="hide-menu"><?php echo get_phrase('Accounting'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/payments"><?php echo get_phrase('Student-Payment'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/students_payments"><?php echo get_phrase('StudentPayment'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/expense"><?php echo get_phrase('Expense'); ?></a></li>
                        </ul>
                    </li>

                      <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-chart p-r-10"></i> <span class="hide-menu"> <?php echo get_phrase('SchoolReports'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/report_list"><?php echo get_phrase('TeacherReports'); ?></a></li>
                        </ul>
                    </li>

                    <li> <a href="<?php echo base_url(); ?>index.php?admin/school_bus" class="waves-effect"><i class="fa fa-bus"></i> <span class="hide-menu"><?php echo get_phrase('School-Bus'); ?></span></a>
                    </li>

                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-plus-square"></i> <span class="hide-menu"> <?php echo get_phrase('ListsPerms'); ?><span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url(); ?>index.php?admin/request"><?php echo get_phrase('TeacherRequest'); ?></a></li>
                             <li> <a href="<?php echo base_url(); ?>index.php?admin/request_student"><?php echo get_phrase('StudentRequest'); ?></a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0)" class="waves-effect"><i data-icon="F" class="fa fa-flag"></i> <span class="hide-menu"><?php echo get_phrase('StaticPages'); ?><span class="fa arrow"></span></span></a>
          <ul class="nav nav-second-level">
            <li> <a href="<?php echo base_url(); ?>index.php?admin/manage_pages"><?php echo get_phrase('ManagePages'); ?></a> </li>
            <li> <a href="<?php echo base_url(); ?>index.php?admin/static_page_add"><?php echo get_phrase('NewPage'); ?></a> </li>
            <li> <a href="javascript:void(0)" class="waves-effect"><?php echo get_phrase('Pages'); ?><span class="fa arrow"></span></a>
              <ul class="nav nav-third-level">
              <?php
                        $pages = $this->db->get('pages')->result_array();
                        foreach ($pages as $row):
                            ?>
                <li> <a href="<?php echo base_url(); ?>index.php?admin/pages_view/page_details/<?php echo $row['page_id']; ?>"><?php echo $row['title']; ?></a> </li>
                <?php endforeach; ?>
              </ul>
            </li>
          </ul>
        </li>

                    <li> <a href="<?php echo base_url(); ?>index.php?admin/message" class="waves-effect"><i class="fa fa-envelope"></i> <span class="hide-menu"><?php echo get_phrase('Messages'); ?></span></a>
                    </li>

                    <li> <a href="<?php echo base_url(); ?>index.php?admin/system_settings" class="waves-effect"><i class="ti-settings"></i> <span class="hide-menu"><?php echo get_phrase('System-Settings'); ?></span></a> </li>

                    <li> <a href="<?php echo base_url(); ?>index.php?admin/academic_settings" class="waves-effect"><i class="fa fa-graduation-cap"></i> <span class="hide-menu"><?php echo get_phrase('Academic-Settings'); ?></span></a> </li>
        </ul>
    </div>
</div>