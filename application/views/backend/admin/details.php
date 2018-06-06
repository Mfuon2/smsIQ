<?php  $current_news = $this->db->get_where('news' , array('news_code' => $news_code))->result_array();
    foreach ($current_news as $row):
?>
<div class="col-md-12">
    <div class="panel panel-info" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title"><font color="white"><?php echo get_phrase('Details'); ?></font></div>
        </div>
        <div class="panel-body"><p>
        <?php echo $row['description'];?></p>
        <hr/>
            <p>
                <?php 
                $status = 'info';
                if ($row['progress_status'] == 100)$status = 'success';
                if ($row['progress_status'] < 50)$status = 'danger';
                ?>
            </p>
        </div>
    </div>
    <div class="message_container">
        <div class="panel panel-warning" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                <font color="white"><?php echo get_phrase('Comment'); ?></font>
                </div>
</div>          
<div class="panel-body">                
        <?php echo form_open(base_url() . 'index.php?admin/news_message/add/' . $news_code, array(
                    'class' => 'form-horizontal form-groups-bordered validate project-submit', 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                        <div class="col-md-9">
                            <textarea class="form-control autogrow" rows="3" placeholder="<?php echo get_phrase('Write-Comment'); ?>.." name="message" required></textarea>
                        </div>
                            <button style="margin-left: 16px; margin-top: 5px;" type="submit" id="submit-button" class="btn btn-info">
                                <?php echo get_phrase('Comment'); ?>
                            </button> 
                    </div>
                <?php echo form_close(); ?>
                <hr/>
                <?php
                    $this->db->order_by('news_message_id' , 'desc'); 
                    $news_messages = $this->db->get_where('mensaje_reporte' , array(
                        'news_id' => $row['news_id']
                    ))->result_array();
                    foreach ($news_messages as $row2):
                ?>
                <div class="alert alert-default" style="position:relative; padding:15px 15px 20px 15px;">
                <img src="<?php echo $this->crud_model->get_image_url($row2['user_type'], $row2['user_id']); ?>" alt="" class="img-circle" width="30">
                    <strong>
                        <?php echo $this->db->get_where($row2['user_type'] , array(
                            $row2['user_type'] . '_id' => $row2['user_id']
                        ))->row()->name;?> : 
                    </strong> 

                    <span style="color:#777;">
                        <?php echo $row2['message'];?>
                    </span>
                    <?php if ($row2['message_file_name'] != ''):?>
                
                    <?php endif;?>
                </div>
                <?php endforeach;?>
            </div>
        </div>
        </div>
</div>
<?php endforeach;?>