<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('ManagePages'); ?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('ManagePages'); ?></a></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
    <div class="white-box">
		<div class="tab-content">
        <br>
            <div class="tab-pane box active" id="list">	
            <div class="table-responsive">
                <table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th style="text-align: center;"><?php echo get_phrase('Date');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Title');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        foreach ($pages_info as $row) { ?>   
            <tr>
                <td style="text-align: center;"><?php echo $count++; ?></td>
                <td style="text-align: center;"><?php echo date("d M, Y", $row['timestamp']); ?></td>
                <td style="text-align: center;">
                 <a href="<?php echo base_url();?>index.php?admin/pages_view/page_details/<?php echo $row['page_id'];?>"><?php echo $row['title'];?></a>
                 </td>
                <td style="text-align: center;">
                    <a href="<?php echo base_url();?>index.php?admin/manage_pages/delete/<?php echo $row['page_id']?>" 
                        class="btn btn-danger btn-sm" onclick="return confirm('<?php echo get_phrase('Are-you-sure');?>');">
                            <i class="entypo-cancel"></i>
                            <?php echo get_phrase('Delete');?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
			</div>
            </div>
		</div>
	</div>
</div>
</div>
<div style="clear:both;"></div>