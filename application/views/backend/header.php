<nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part">
                <?php if($this->session->userdata('login_type') == 'admin') : ?>
                <a class="logo" href="<?php echo base_url(); ?>index.php?admin/admin_dashboard">
                <?php endif; ?>
                <?php if($this->session->userdata('login_type') == 'teacher') : ?>
                <a class="logo" href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard">
                <?php endif; ?>
                <?php if($this->session->userdata('login_type') == 'student') : ?>
                <a class="logo" href="<?php echo base_url(); ?>index.php?student/student_dashboard">
                <?php endif; ?>
                <?php if($this->session->userdata('login_type') == 'parent') : ?>
                <a class="logo" href="<?php echo base_url(); ?>index.php?parents/parents_dashboard">
                <?php endif; ?>
                <b><img src="<?php echo base_url();?>style/images/logoadmin.png" alt="home" /></b><span class="hidden-xs"><strong>{ LOGO }</strong> SCHOOL</span></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                    <?php if($this->session->userdata('login_type') == 'admin') : ?>
                    <li>
                     <?php echo form_open(base_url() . 'index.php?admin/search' , array('onsubmit' => 'return validate() role="search" class="app-search hidden-xs"')); ?>
                            <input type="text" id="search_input" name="search_key" placeholder="<?php echo get_phrase('Search-by-name'); ?>..." class="form-control"> <a href="#"><i class="fa fa-search"></i></a> 
                        </form>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo $this->crud_model->get_image_url($this->session->userdata('login_type'), $this->session->userdata('login_user_id'));?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?php
                        echo $this->db->get_where($this->session->userdata('login_type'), array(
                        $this->session->userdata('login_type') . '_id' => $this->session->userdata('login_user_id')))->row()->name;?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                        <?php if($this->session->userdata('login_type') == 'admin') : ?>
                            <li>
                            <a href="<?php echo base_url(); ?>index.php?admin/admin_profile/<?php echo $this->session->userdata('login_user_id'); ?>"><i class="ti-user"></i> <?php echo get_phrase('Profile'); ?></a>
                            </li>
                        <?php endif; ?>
                            <li>
                            <a href="<?php echo base_url(); ?>index.php?<?php echo $this->session->userdata('login_type'); ?>/message"><i class="ti-email"></i> <?php echo get_phrase('Messages'); ?></a></li>
                            <li><a href="<?php echo base_url();?>index.php?login/logout"><i class="fa fa-power-off"></i> <?php echo get_phrase('Exit'); ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>