<div class="row bg-title">
<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
   <h4 class="page-title"><?php echo get_phrase('Messages'); ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Messages'); ?></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-lg-3 col-md-3  col-sm-12 col-xs-12 inbox-panel">
                    <div> 
                <a href="<?php echo base_url(); ?>index.php?teacher/message/message_new" class="btn btn-custom btn-block waves-effect waves-light"><?php echo get_phrase('New');?></a>
<hr>
            <div class="list-group mail-list m-t-20"> 
             <?php $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
            $this->db->where('sender', $current_user);
            $this->db->or_where('reciever', $current_user);
            $message_threads = $this->db->get('message_thread')->result_array();
            foreach ($message_threads as $row):
                if ($row['sender'] == $current_user)
                    $user_to_show = explode('-', $row['reciever']);
                if ($row['reciever'] == $current_user)
                    $user_to_show = explode('-', $row['sender']);
                $user_to_show_type = $user_to_show[0];
                $user_to_show_id = $user_to_show[1];
                $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                ?>
            <a href="<?php echo base_url(); ?>index.php?teacher/message/message_read/<?php echo $row['message_thread_code']; ?>">
            <hr>
            <?php if($user_to_show_type =='student') : ?>
            <span class="fa fa-circle text-warning m-r-10"></span>
            <?php endif; ?>
            <?php if($user_to_show_type =='teacher') : ?>
            <span class="fa fa-circle text-danger m-r-10"></span>
            <?php endif; ?>
            <?php if($user_to_show_type =='parent') : ?>
            <span class="fa fa-circle text-success m-r-10"></span>
            <?php endif; ?>
            <?php if($user_to_show_type =='admin') : ?>
            <span class="fa fa-circle text-info m-r-10"></span>
            <?php endif; ?>
            <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?></a> 
            <?php if ($unread_message_number > 0): ?>
                            <span class="badge badge-secondary pull-right">
                                <?php echo $unread_message_number; ?>
                            </span>
            <?php endif;?>
            <?php endforeach; ?>  
            <hr>
            </div>
                    
            <h3 class="panel-title m-t-40 m-b-0">Labels</h3>
                <hr class="m-t-5">
                        <div class="list-group b-0 mail-list"> 
                        <a href="#" class="list-group-item"><span class="fa fa-circle text-info m-r-10"></span>
                        <?php echo get_phrase('Admins');?></a> 
                        <a href="#" class="list-group-item"><span class="fa fa-circle text-warning m-r-10"></span><?php echo get_phrase('Students');?></a> 
                        <a href="#" class="list-group-item"><span class="fa fa-circle text-success m-r-10"></span><?php echo get_phrase('Parents');?></a>
<a href="#" class="list-group-item"><span class="fa fa-circle text-danger m-r-10"></span><?php echo get_phrase('Teachers');?></a> </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mail_listing">
                    <div class="inbox-center">
                             <?php include $message_inner_page_name . '.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>