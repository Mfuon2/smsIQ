<table class="table table-bordered datatable">
    <thead>
        <tr>
            <th style="width:30px;">No</th>
            <th style="text-align: center;"><div><?php echo get_phrase('Title'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Class'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Subject'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Teacher'); ?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Options'); ?></div></th>
        </tr>
    </thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->order_by('post_id', 'desc');
    $posts = $this->db->get('forum')->result_array();
    foreach ($posts as $row):
        ?>
        <tr>
            <td style="width:30px;">
                <?php echo $counter++; ?>
            </td>
            <td style="text-align: center;">
                <a href="<?php echo base_url(); ?>index.php?admin/projectroom/wall/<?php echo $row['project_code']; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?></td>
            <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
            <td style="text-align: center;">
                <a class="btn btn-info tooltip-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo get_phrase('project_room'); ?>" 
                   href="<?php echo base_url(); ?>index.php?admin/projectroom/wall/<?php echo $row['project_code']; ?>">
                    <i class="entypo-target"></i>
                </a>

                <a class="btn btn-danger tooltip-primary" data-toggle="tooltip" data-placement="top" 
                   title="" data-original-title="<?php echo get_phrase('Delete'); ?>" href="#" 
                   onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/project/delete/<?php echo $row['project_code']; ?>', '<?php echo base_url(); ?>index.php?admin/reload_project_list');" >
                    <i class="entypo-trash"></i>
                </a>

            </td>
        </tr>
<?php endforeach; ?>
</tbody>
</table>

<script src="assets/js/neon-custom-ajax.js"></script>

<script type="text/javascript">
                                    function reload_data(url)
                                    {
                                        $.ajax({
                                            url: url,
                                            success: function (response)
                                            {
                                                jQuery('.main_data').html(response);
                                            }
                                        });
                                    }

                                    function delete_data(delete_url, post_refresh_url)
                                    {
                                        $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
                                        document.getElementById("delete_link").disabled = true;
                                        document.getElementById("delete_cancel_link").disabled = true;
                                        $.ajax({
                                            url: delete_url,
                                            success: function (response)
                                            {
                                                $('#preloader-delete').html('');
                                                toastr.info("Data deleted successfully.", "Success");
                                                $('#modal_delete').modal('hide');
                                                document.getElementById("delete_link").disabled = false;
                                                document.getElementById("delete_cancel_link").disabled = false;
                                                reload_data(post_refresh_url);
                                            }
                                        });
                                    }
</script>