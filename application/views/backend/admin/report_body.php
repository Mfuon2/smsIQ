<?php $report_detail = $this->db->get_where('reporte_alumnos', array('report_code' => $report_code))->result_array();
foreach ($report_detail as $row): ?>
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-info">
                <div class="panel-heading">
                <div class="panel-title">
                        <h4><font color="white"><?php echo $row['title']; ?></font></h4>
                 </div>
        </div>

        <div class="panel-body">
    <div class="profile-env">
    <section class="profile-feed" style="margin:0px;padding:0px;">
    <div class="profile-stories">
    <?php $reporte_mensajes = $this->db->get_where('reporte_mensaje', array('report_code' => $report_code))->result_array();
        foreach ($reporte_mensajes as $row2):?>
        <article class="story" style="padding:0px 10px 0px 20px; margin:20px 0px;">
            <aside class="user-thumb"><a href="#"><img src="<?php echo $this->crud_model->get_image_url(
                $row2['sender_type'], $row2['sender_id']); ?>" alt="" class="img-circle" style="height:44px;"></a>
            </aside>
            <div class="story-content">
            <header>
            <div class="publisher"><a href="#">
            <?php echo $this->crud_model->get_type_name_by_id($row2['sender_type'], $row2['sender_id']); ?></a> 
            <em><small>
            <?php echo $row2['timestamp']; ?></small></em></div>
            </header>

    <div class="story-main-content" style="text-align:justify;"><p><?php echo $row2['message']; ?></p></div>
    </br>
            </br>
                    <?php echo get_phrase('File');?><?php if ($row2['file'] != "") { ?><i class="entypo-download"></i>
                    <a href="<?php echo base_url() . 'uploads/reportes_alumnos/' . $row2['file']; ?>" class="">
                    <?php echo $row2['file']; ?></a><?php } ?></div></article>
                    <hr style="margin:0px;"><?php endforeach; ?>
                    </div></section></div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>
                            <font color="white"><?php echo get_phrase('Details');?></font>
                        </h4>
                    </div>
                </div>

                <div class="panel-body" style="padding:0px;">
                    <table class="table table-striped">
                        <tr>
                            <td style="width:130px;"><i class="entypo-dot"></i> <?php echo get_phrase('Code');?></td>
                            <td> : </td>
                            <td><?php echo $row['report_code']; ?></td>
                        </tr>
                        <tr>
                            <td><i class="entypo-dot"></i> <?php echo get_phrase('Student');?></td>
                            <td> : </td>
                            <td><span class="badge badge-success"><?php echo $this->crud_model->get_type_name_by_id('student', $row['student_id']); ?></span></td>
                        </tr>
                        <tr>
                            <td><i class="entypo-dot"></i> <?php echo get_phrase('Teacher');?></td>
                            <td> : </td>
                            <td><span class="badge badge-danger"><?php echo $this->crud_model->get_type_name_by_id('teacher', $row['teacher_id'], 'name'); ?></span?</td>
                        </tr>
                        <tr>
                            <td><i class="entypo-dot"></i> <?php echo get_phrase('Priority');?></td>
                            <td> : </td>
                            <td><div class="label label-<?php if ($row['priority'] == 'alta') echo 'danger';
                                else if ($row['priority'] == 'media') echo 'info';
                                else if ($row['priority'] == 'baja') echo 'warning' ?>">
                                <?php echo $row['priority']; ?></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    $(document).ready(function () {
        var options = {
            beforeSubmit: validate_ticket_message_add,
            success: show_response_ticket_message_add,
            resetForm: true
        };
        $('.ticket-message-add').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function validate_ticket_message_add(formData, jqForm, options) {
        if (!jqForm[0].message.value)
        {
            return false;
        }
        $('#preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
        document.getElementById("submit-button").disabled = true;
    }
    function show_response_ticket_message_add(responseText, statusText, xhr, $form) {
        $('#preloader-form').html('');
        toastr.success("Ticket reply submitted", "Success");
        document.getElementById("submit-button").disabled = false;
        reload_ticket_view_body();
    }
    function reload_ticket_view_body()
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/reload_looking_report/<?php echo $row['report_code']; ?>',
                        success: function (response)
                        {
                            jQuery('.main_data').html(response);
                        }
                    });
                }
</script>