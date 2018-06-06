<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo get_phrase('Gallery'); ?></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
                            <li class="active"><?php echo get_phrase('Gallery'); ?></li>
                        </ol>
                    </div>
                </div>
                
                <div class="row el-element-overlay">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title"><?php echo get_phrase('Video-List'); ?></h3>
                            <div class="row">
                            <?php
                            $sections = $this->db->get_where('gallery_category')->result_array();
                            foreach ($sections as $row):
                        ?>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> <img src="uploads/screen/<?php echo $row['category_id']; ?>.jpg" />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li><a class="btn default btn-outline" href="<?php echo base_url(); ?>index.php?student/video_detail/<?php echo $row['category_id']; ?>"><i class="fa fa-play-circle-o fa-3x"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="alb-info">
                                            <h5><?php echo $row['title'];?></h5>
                                            <h6 class="text-muted"><?php echo substr($row['description'], 0, 60);?>...</h6>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>