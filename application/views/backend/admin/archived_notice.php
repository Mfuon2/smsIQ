<table class="table table-bordered datatable">
	<thead>
		<tr>
			<th style="text-align: center;">No.</th>
			<th style="text-align: center;"><div><?php echo get_phrase('Title'); ?></div></th>
			<th style="text-align: center;"><div><?php echo get_phrase('Options'); ?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
         $counter = 1;
		$this->db->where('notice_status' , 0);
		$this->db->order_by('notice_id' , 'desc');
		$notices	=	$this->db->get('news_teacher')->result_array();
		foreach($notices as $row):?>
		<tr>
          <td style="text-align: center;"><?php echo $counter++; ?></td>
		  <td style="text-align: center;">
			<a href="<?php echo base_url();?>index.php?admin/news_teacher_view/details/<?php echo $row['notice_code'];?>"><?php echo $row['title'];?></a>
           </td>
		   <td style="text-align: center;">
            	<a class="btn btn-blue tooltip-primary" data-toggle="tooltip" data-placement="top"
            	href="<?php echo base_url();?>index.php?admin/news_teacher_view/details/<?php echo $row['notice_code'];?>">
                <?php echo get_phrase('View'); ?>
                </a>
                <a id="archive_link" class="btn btn-orange tooltip-primary" data-toggle="tooltip" data-placement="top" href="#"
              			onclick="remove_archived('<?php echo base_url();?>index.php?admin/news_teacher/remove_from_archived/<?php echo $row['notice_code'];?>' , '<?php echo base_url();?>index.php?admin/reload_notice_list');">
                  		<?php echo get_phrase('Unarchived'); ?>
                </a>
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