<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('ClassForum'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
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
				<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th style="text-align: center;">No</th>
            <th style="text-align: center;"><div><?php echo get_phrase('Title'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Class'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Subject'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Date'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('View'); ?></div></th>
        </tr>
    </thead>
<tbody>
    <?php
    $counter = 1;
    $class_id = $this->db->get_where('enroll' , array('student_id' => $this->session->userdata('login_user_id') , 'year' => $running_year))->row()->class_id;

    $this->db->order_by('post_id', 'desc');
    $post = $this->db->get('forum')->result_array();
    foreach ($post as $row):
        ?>
    <?php  if ($class_id == $row['class_id']) { ?>
        <tr>
            <td style="text-align: center;">
                <?php echo $counter++; ?>
            </td>
            <td style="text-align: center;">
                <a href="<?php echo base_url(); ?>index.php?student/forumroom/posts/<?php echo $row['post_code']; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$class_id);?></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?></td>
            <td style="text-align: center;"><?php echo date("d-m-Y" , $row['timestamp']);?></td>
            <td style="text-align: center;">
                <a href="<?php echo base_url(); ?>index.php?student/forumroom/posts/<?php echo $row['post_code']; ?>" class="btn btn-info btn-icon icon-left">
               <i class="fa fa-comment"></i> <?php echo get_phrase('View'); ?>
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


<script src="assets/js/neon-custom-ajax.js"></script>

<script type="text/javascript">
    function reload_data(url)
    {
        $.ajax({
            url: url,
            success: function (response)
            {
                jQuery('.main_data').html(response);
            }
        });
    }

    function delete_data(delete_url, post_refresh_url)
    {
        $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
        document.getElementById("delete_link").disabled = true;
        document.getElementById("delete_cancel_link").disabled = true;
        $.ajax({
            url: delete_url,
            success: function (response)
            {
                $('#preloader-delete').html('');
                toastr.info("Data deleted successfully.", "Success");
                $('#modal_delete').modal('hide');
                document.getElementById("delete_link").disabled = false;
                document.getElementById("delete_cancel_link").disabled = false;
                reload_data(post_refresh_url);
            }
        });
    }

</script>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        var datatable = $(".datatable").dataTable({
            "sPaginationType": "bootstrap",
            "aoColumns": [
                {"bSortable": false},
                null,
                null,
                null,
                null,
                null
            ],
            aLengthMenu: [
            [-1 , 25 , 50 , 100 , 200],
            ["All" , 25 , 50 , 100 , 200]
            ],
        });
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
</script>