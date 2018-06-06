<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('News'); ?></h4> </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard">Dashboard</a></li>
            <li class="active"><?php echo get_phrase('News'); ?></li>
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
			<th style="text-align: center;"><div><?php echo get_phrase('Title');?></div></th>
			<th style="text-align: center;"><div><?php echo get_phrase('Options');?></div></th>
		</tr>
	</thead>
	<tbody>
		<?php 
     $counter = 1;
		$this->db->where('news_status' , 1);
		$this->db->order_by('news_id' , 'desc');
		$news	=	$this->db->get('news')->result_array();
		foreach($news as $row):?>
		<tr>
    <td style="text-align: center;"><?php echo $counter++; ?></td>
		<td style="text-align: center;">
			<a href="<?php echo base_url();?>index.php?admin/news_view/details/<?php echo $row['news_code'];?>"><?php echo $row['title'];?></a>
    </td>
		<td style="text-align: center;">
            	<a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top"
            	href="<?php echo base_url();?>index.php?admin/news_view/details/<?php echo $row['news_code'];?>">
               <?php echo get_phrase('View');?>
                </a>
                <a id="archive_link" class="btn btn-danger tooltip-primary" data-toggle="tooltip" data-placement="top" href="#"
              			onclick="confirm_modal('<?php echo base_url();?>index.php?admin/news/delete/<?php echo $row['news_code'];?>' , '<?php echo base_url();?>index.php?admin/reload_news_list');">
                  		<?php echo get_phrase('Delete');?>
                </a>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
			</div>
		</div>
		</div>
		</div>
	</div>
</div>

<script src="assets/js/neon-custom-ajax.js"></script>