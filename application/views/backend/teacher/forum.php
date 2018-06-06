<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('ClassForum'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('ClassForum'); ?></li>
        </ol>
    </div>
</div>


<div class="main_data">
	<div class="row">
	<div class="col-md-12">
	<div class="white-box">
		<div class="tab-content">
		<br>
			<div class="tab-pane active" id="running">
<div class="table-responsive">	
				<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;"><div><?php echo get_phrase('Title'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Class'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Subject'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Date'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('View'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Delete'); ?></div></th>
        </tr>
    </thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->order_by('post_id', 'desc');
    $post = $this->db->get('forum')->result_array();
    foreach ($post as $row):
        ?>
    <?php  if ($this->session->userdata('login_user_id') == $row['teacher_id']) { ?>
        <tr>
            <td style="text-align: center;">
                <?php echo $counter++; ?>
            </td>
            <td style="text-align: center;">
                <a href="<?php echo base_url(); ?>index.php?teacher/forumroom/posts/<?php echo $row['post_code']; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?></td>
            <td style="text-align: center;"><?php echo date("d-m-Y" , $row['timestamp']);?></td>
            <td style="text-align: center;">
                <a href="<?php echo base_url(); ?>index.php?teacher/forumroom/posts/<?php echo $row['post_code']; ?>" class="btn btn-info btn-icon icon-left">
               <i class="fa fa-comments"></i> <?php echo get_phrase('View'); ?>
                </a>
             </td>
            <td style="text-align: center;">
                <a class="btn btn-danger tooltip-primary" data-toggle="tooltip" data-placement="top" 
                   title="" data-original-title="<?php echo get_phrase('Delete'); ?>" href="#" 
                   onclick="confirm_modal('<?php echo base_url(); ?>index.php?teacher/forum/delete/<?php echo $row['post_code']; ?>', '<?php echo base_url(); ?>index.php?admin/reload_project_list');" >
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
<?php endforeach; ?>
					</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
</div>
	</div>
</div>
<script src="assets/js/neon-custom-ajax.js"></script>