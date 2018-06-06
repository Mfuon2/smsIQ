<table class="table table-bordered datatable">
	<thead><tr>
      <th style="width:30px;">No.</th>
      <th><div><?php echo get_phrase('Title'); ?></div></th>
      <th><div><?php echo get_phrase('Options'); ?></div></th>
    </tr></thead>
	<tbody>
		<?php 
		$counter = 1;
		$this->db->where('notice_status' , 0);
		$this->db->order_by('notice_id' , 'desc');
		$notice	=	$this->db->get('news_teacher')->result_array();
		foreach($notice as $row):
		?>
		<tr>
			<td style="width:30px;"><?php echo $counter++;?></td>
			<td>
			   <a href="<?php echo base_url();?>index.php?teacher/noticeroom/overview/<?php echo $row['notice_code'];?>">
			   <?php echo $row['title'];?></a>
      </td>
			<td>
        <a class="btn btn-blue tooltip-primary" data-toggle="tooltip" data-placement="top"
        href="<?php echo base_url();?>index.php?teacher/noticeroom/overview/<?php echo $row['notice_code'];?>">
        <?php echo get_phrase('View'); ?>
        </a>

        <a class="btn btn-orange tooltip-primary" data-toggle="tooltip" data-placement="top" href="#"
        onclick="remove_archived('<?php echo base_url();?>index.php?teacher/notice/remove_from_archived/<?php echo $row['notice_code'];?>' , '<?php echo base_url();?>index.php?teacher/reload_notice_list');">
        <?php echo get_phrase('Unarchived'); ?></a>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>

<script type="text/javascript">
	jQuery(document).ready(function ($)
    {
        var datatable = $(".datatable").dataTable({
            "sPaginationType": "bootstrap",
            "aoColumns": [
                {"bSortable": false},
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
<script src="assets/js/neon-custom-ajax.js"></script>