<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Online Exams</h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active">Online Exams</li>
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
            <th style="text-align: center;"><div><?php echo get_phrase('Title'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Class'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Section'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Subject'); ?></div></th>
            <th style="text-align: center;"><div>Available From</div></th>
            <th style="text-align: center;"><div>Available To</div></th>
            <th style="text-align: center;"><div>Manage</div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Delete'); ?></div></th>
        </tr>
    </thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->order_by('exam_id', 'desc');
    $post = $this->db->get('exams')->result_array();
    foreach ($post as $row):
        ?>
    <?php  if ($this->session->userdata('login_user_id') == $row['teacher_id']) { ?>
        <tr>
            <td style="text-align: center;">
                <a href="<?php echo base_url(); ?>index.php?teacher/examroom/exam/<?php echo $row['exam_code']; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('section',$row['section_id']);?></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?></td>
            <td style="text-align: center;"><?php echo $row['availablefrom'];?></td>
            <td style="text-align: center;"><?php echo $row['availableto'];?></td>
            <td style="text-align: center;">
                <a href="<?php echo base_url(); ?>index.php?teacher/examroom/exam/<?php echo $row['exam_code']; ?>" class="btn btn-info btn-icon icon-left">
               <i class="fa fa-sitemap"></i> Manage
                </a>
             </td>
            <td style="text-align: center;">
                <a class="btn btn-danger tooltip-primary" data-toggle="tooltip" data-placement="top" 
                   title="" data-original-title="<?php echo get_phrase('Delete'); ?>" href="#" 
                   onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/manage_exams/delete/<?php echo $row['exam_id'];?>');">
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