<?php
$messages = $this->db->get_where('message', array('message_thread_code' => $current_message_thread_code))->result_array();
    foreach ($messages as $row):
    $sender = explode('-', $row['sender']);
    $sender_account_type = $sender[0];
    $sender_id = $sender[1];
    ?>

    <div class="panel panel-info">
        <div class="panel-heading"> <img src="<?php echo $this->crud_model->get_image_url($sender_account_type, $sender_id); ?>" class="img-circle" width="30"><span><?php echo $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name; ?></span>
            <div class="pull-right"> <a data-perform="panel-dismiss"><?php echo date("d M, Y", $row['timestamp']); ?> </a> </div>
        </div>
    </div>
    <div class="mail-text">         
        <p align="justify"><?php echo $row['message']; ?></p>
    </div>
<?php endforeach; ?>
<br><hr>
<?php echo form_open(base_url() . 'index.php?admin/message/send_reply/' . $current_message_thread_code, array('enctype' => 'multipart/form-data')); ?>
<div class="mail-reply">
    <div class="compose-message-editor">
        <textarea class="textarea_editor form-control" name="message" rows="15" placeholder="<?php echo get_phrase('Reply'); ?>..."></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-info btn-icon pull-right">
        <?php echo get_phrase('Send');?>
        <i class="fa fa-mail-forward"></i>
    </button>
    <br><br>
</div>
</form>
<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>