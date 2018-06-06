<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Homework'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('Homework'); ?></li>
        </ol>
    </div>
</div>


<div class="main_data">
	<div class="row">
	<div class="col-md-12">
    <div class="white-box">
		<div class="tab-content">
		<div class="tab-pane active" id="running">
<table class="table table-bordered datatable">
    <thead>
    <tr>
        <th style="text-align: center;">No.</th>
        <th style="text-align: center;"><div><?php echo get_phrase('Title'); ?></div></th>
        <th style="text-align: center;"><div><?php echo get_phrase('Class'); ?></div></th>
        <th style="text-align: center;"><div><?php echo get_phrase('Section'); ?></div></th>
        <th style="text-align: center;"><div><?php echo get_phrase('Teacher'); ?></div></th>
        <th style="text-align: center;"><div><?php echo get_phrase('Subject'); ?></div></th>
        <th style="text-align: center;"><div><?php echo get_phrase('Options'); ?></div></th>
    </tr>
</thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->where('homework_status', 1);
    $this->db->order_by('homework_id', 'desc');
    $homeworks = $this->db->get('homework')->result_array();
    foreach ($homeworks as $row):
        ?>
    <?php  if ($this->session->userdata('login_user_id') == $row['uploader_id']) { ?>
        <tr>
            <td style="text-align: center;"><?php echo $counter++; ?></td>
            <td style="text-align: center;"><a href="<?php echo base_url(); ?>index.php?teacher/homeworkroom/details/<?php echo $row['homework_code']; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </td>
            <td style="text-align: center;"><span class="badge badge-info badge-roundless"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></span></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('section',$row['section_id']);?></td>
            <td style="text-align: center;"><?php echo $this->db->get_where($row['uploader_type'] , array(
              $row['uploader_type'].'_id' => $row['uploader_id']))->row()->name;?>
            </td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?></td>
            <td style="text-align: center;">
                <a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase('View'); ?>" 
                   href="<?php echo base_url(); ?>index.php?teacher/homeworkroom/details/<?php echo $row['homework_code']; ?>">
                    <i class="fa fa-file-text"></i>
                </a>

                <a class="btn btn-danger tooltip-primary" data-toggle="tooltip" data-placement="top" 
                   title="" data-original-title="<?php echo get_phrase('Delete'); ?>" href="#" 
                   onclick="confirm_modal('<?php echo base_url(); ?>index.php?teacher/homework/delete/<?php echo $row['homework_code']; ?>', '<?php echo base_url(); ?>index.php?teacher/reload_homework_list');" >
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

<script src="assets/js/neon-custom-ajax.js"></script>
<script type="text/javascript">
function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            jQuery('.main_data').html(response);
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