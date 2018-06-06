<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Teacher-Report');?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo $system_title; ?></a></li>
            <li class="active"><?php echo get_phrase('Teacher-Report');?></li>
        </ol>
    </div>
</div>

<span class="main_data">
<?php include 'report_body.php';?>
</span>