<?php 
	$current_project = $this->db->get_where('news' , array(
		'news_code' => $news_code
	))->result_array();
	foreach ($current_project as $row):
?>
<div class="col-md-9">
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title"><?php echo get_phrase('Details'); ?></div>
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
</div>
<?php endforeach;?>
