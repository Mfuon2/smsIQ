<table class="table table-bordered datatable">
	<thead><tr>
			<th style="width:30px;">No.</th>
			<th><div><?php echo get_phrase('Title'); ?></div></th>
			<th><div><?php echo get_phrase('Options'); ?></div></th>
		</tr></thead>
	<tbody>
		<?php 
		$counter = 1; 
        $this->db->where('news_status' , 1);
		$this->db->order_by('news_id' , 'desc'); 
        $projects	=	$this->db->get('news')->result_array(); 
        foreach($projects as $row): ?>
		<tr>
		<td style="width:30px;"><?php echo $counter++;?></td>
        <td>
		    <a href="<?php echo base_url();?>index.php?student/projectroom/overview/<?php echo $row['news_code'];?>"><?php echo $row['title'];?></a>
        </td>
			<td>
            	  <a class="btn btn-blue tooltip-primary" data-toggle="tooltip" data-placement="top"
            	  href="<?php echo base_url();?>index.php?student/projectroom/overview/<?php echo $row['news_code'];?>">
               <?php echo get_phrase('View'); ?>
                </a>

                <a id="archive_link" class="btn btn-orange tooltip-primary" data-toggle="tooltip" data-placement="top" href="#"
              	onclick="mark_archived('<?php echo base_url();?>index.php?student/news/mark_as_archive/<?php echo $row['news_code'];?>' , '<?php echo base_url();?>index.php?student/reload_project_list');">
               <?php echo get_phrase('Archived'); ?>
                </a>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>

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

function mark_archived(archive_url , post_refresh_url)
{
	$.ajax({
        url: archive_url,
        success: function(response)
        {
            toastr.info("Marked as Archived", "Success");
            reload_data(post_refresh_url);
        }
    });
}

function remove_archived(remove_archive_url , post_refresh_url)
{
  $.ajax({
        url: remove_archive_url,
        success: function(response)
        {
            toastr.info("Removed from Archive", "Success");
            reload_data(post_refresh_url);
        }
    });
}
</script>