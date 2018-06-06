<?php $current_notice = $this->db->get_where('news_teacher' , array(
'notice_code' => $notice_code))->result_array(); foreach ($current_notice as $row): ?>

<div class="col-md-9">
	<div class="panel panel-primary" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title">
				<?php echo get_phrase('Comment'); ?>
				</div>
</div>			
<div class="panel-body">				
		<?php echo form_open(base_url() . 'index.php?teacher/notice_message/add/' . $notice_code, array(
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
					$this->db->order_by('notice_message_id' , 'desc'); 
					$notice_messages = $this->db->get_where('notice_message' , array(
						'notice_id' => $row['notice_id']
					))->result_array();
					foreach ($notice_messages as $row2):
				?>
                <div class="alert alert-default" style="position:relative; padding:15px 15px 20px 15px;">
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
<?php endforeach;?>

<script>
    var post_refresh_url    =   '<?php echo base_url();?>index.php?teacher/reload_noticeroom_wall/<?php echo $notice_code;?>';
    var post_message        =   'Message Sent';
</script>
<script src="assets/js/jquery.form.js"></script>

<script type="text/javascript">
$(document).ready(function() { 
    var options = { 
        success             :   showResponse,  
        resetForm           :   true 
    }; 
    
    $('.project-submit').submit(function() { 
        $(this).ajaxSubmit(options); 
        return false; 
    }); 
});

function showResponse(responseText, statusText, xhr, $form)  { 
    
    reload_data(post_refresh_url);
}

function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            jQuery('.main_data').html(response);
			$("input.file2[type=file]").each(function(i, el)
			{
				var $this = $(el),
					label = attrDefault($this, 'label', 'Browse');
				$this.bootstrapFileInput(label);
			});
			$("textarea.autogrow, textarea.autosize").autosize();
			$('[data-toggle="tooltip"]').each(function(i, el)
			{
				var $this = $(el),
					placement = attrDefault($this, 'placement', 'top'),
					trigger = attrDefault($this, 'trigger', 'hover'),
					popover_class = $this.hasClass('tooltip-secondary') ? 'tooltip-secondary' : ($this.hasClass('tooltip-primary') ? 'tooltip-primary' : ($this.hasClass('tooltip-default') ? 'tooltip-default' : ''));
				$this.tooltip({
					placement: placement,
					trigger: trigger
				});
				$this.on('shown.bs.tooltip', function(ev)
				{
					var $tooltip = $this.next();	
					$tooltip.addClass(popover_class);
				});
			});              
        }
    });
}
</script>