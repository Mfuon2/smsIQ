<?php $current = $this->db->get_where('forum' , array(
'post_code' => $post_code))->result_array(); foreach ($current as $row): ?>

<div class="panel panel-danger" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                <font color="white"><?php echo get_phrase('Discussion'); ?></font>
                </div>
</div>          
<div class="panel-body">                
        <?php echo form_open(base_url() . 'index.php?teacher/forum_message/add/' . $post_code, array(
                    'class' => 'form-horizontal form-groups-bordered validate project-submit', 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                        <div class="col-md-9">
                            <textarea class="form-control autogrow" rows="4" placeholder="<?php echo get_phrase('Write-Comment'); ?>.." name="message" required></textarea>
                        </div>
                            <button style="margin-left: 16px; margin-top: 5px;" type="submit" id="submit-button" class="btn btn-info">
                                <?php echo get_phrase('Comment'); ?>
                            </button> 
                    </div>
                <?php echo form_close(); ?>
                <hr/>
                <?php
                    $this->db->order_by('message_id' , 'desc'); 
                    $messages = $this->db->get_where('forum_message' , array(
                        'post_id' => $row['post_id']
                    ))->result_array();
                    foreach ($messages as $row2):
                ?>
                <div class="alert alert-default" style="position:relative; padding:15px 15px 20px 15px;">
                    <?php  if ($row2['user_type'] == "teacher") { ?>
                     <td rowspan="2" width="60" class="pull-right">
                     <img src="<?php echo $this->crud_model->get_image_url('teacher', $row2['user_id']); ?>" alt="" class="img-circle" width="30">
                    </td>
                    <?php } ?>
                    <?php  if ($row2['user_type'] == "student") { ?>
                    <td rowspan="2" width="60" class="pull-right">
                     <img src="<?php echo $this->crud_model->get_image_url('student', $row2['user_id']); ?>" alt="" class="img-circle" width="30">
                    </td>
                    <?php } ?>
                    <strong>
                        <?php echo $this->db->get_where($row2['user_type'] , array(
                            $row2['user_type'] . '_id' => $row2['user_id']
                        ))->row()->name;?> : 
                    </strong> 
                    <span style="color:#777;">
                        <?php echo $row2['message'];?>
                    </span>
                </div>
                <?php endforeach;?>
            </div>
        </div>
<?php endforeach;?>

<script>
    var post_refresh_url    =   '<?php echo base_url();?>index.php?teacher/reload_post_comment/<?php echo $post_code;?>';
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
</script>

<script type="text/javascript">
function reload_data(url)
        {
            var tableContainer;
            $.ajax({
                url: url,
                success: function (response)
                {
                    jQuery('.message_container').html(response);
                    $("textarea.autogrow, textarea.autosize").autosize();
                    $('[data-toggle="tooltip"]').each(function (i, el)
                    {
                        var $this = $(el),
                                placement = attrDefault($this, 'placement', 'top'),
                                trigger = attrDefault($this, 'trigger', 'hover'),
                                popover_class = $this.hasClass('tooltip-secondary') ? 'tooltip-secondary' : ($this.hasClass('tooltip-primary') ? 'tooltip-primary' : ($this.hasClass('tooltip-default') ? 'tooltip-default' : ''));
                        $this.tooltip({
                            placement: placement,
                            trigger: trigger
                        });
                        $this.on('shown.bs.tooltip', function (ev)
                        {
                            var $tooltip = $this.next();
                            $tooltip.addClass(popover_class);
                        });
                    });
                         $("#table-1").dataTable();
                }
            });
        }
</script>