<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo get_phrase('Gallery');?></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard');?></a>
                            </li>
                            <li class="active"><?php echo get_phrase('Gallery');?></li>
                        </ol>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="white-box">
                            <div class="row">
                            <?php $videos =  $this->db->get_where('gallery_category' , array('category_id' => $category_id))->result_array(); foreach ($videos as $row):
                                ?>
                                <div class="col-sm-12">
                                    <div id="jp_container_1" class="mvdplayer">
                                        <div class="jp-type-single" style="position: relative;">
                                            <center><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $row['embed'];?>" frameborder="0" allowfullscreen></iframe></center>
                                    </div>
                                    <h2 class="m-t-20"><?php echo $row['title'];?></h2>
                                    <p style="text-align: justify;"><?php echo $row['description'];?></p>
                                    <hr>
                                </div>
                            </div>
                             <?php endforeach;?>
                        </div>
                    </div>
                </div>