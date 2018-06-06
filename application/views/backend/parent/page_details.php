<?php $pages = $this->db->get_where('pages' , array('page_id' => $page_id))->result_array();
    foreach ($pages as $row):?>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('StaticPages'); ?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?parents/parents_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('StaticPages'); ?></a></li>
        </ol>
    </div>
</div>

 <div class="row">
        <div class="col-md-12">
          <div class="white-box">
            <div class="text-muted"><span class="m-r-10"><?php echo date("d/m/Y", $row['timestamp']); ?></span> <a class="text-muted m-l-10"></a></div>
            <h3 class="m-t-20 m-b-20"><?php echo $row['title'];?></h3>
            <p align="justify"><?php echo $row['description'];?></p>
          </div>
        </div>
</div>
<?php endforeach;?>
