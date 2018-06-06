<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Teacher-Report');?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo $system_title; ?></a></li>
            <li class="active"><?php echo get_phrase('Teacher-Report');?></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <font color="white"><?php echo get_phrase('Send'); ?> <?php echo get_phrase('Teacher-Report');?></font>
                </div>
            </div>
            <div class="panel-body">

                <?php echo form_open(base_url() . 'index.php?student/listado_de_reportes/create/', array('class' => 'form-horizontal form-groups-bordered validate ticket-add', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Title'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" id="title" data-validate="required" 
                               data-message-required="<?php echo get_phrase('Required'); ?>" value="" autofocus>
                    </div>
                </div>

                <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo get_phrase('Teacher'); ?></label>
                <div class="col-sm-5">
                   <select name="teacher_id" class="form-control selectboxit" style="width:100%;">
                         <option value=""><?php echo get_phrase('Select'); ?></option>
                            <?php 
                            $teachers = $this->db->get('teacher')->result_array();
                            foreach($teachers as $row): ?>
                            <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
          </div>
                
        <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Priority'); ?></label>

                    <div class="col-sm-5">
                        <select name="priority" class="selectboxit">
                            <option value="baja"><?php echo get_phrase('Low'); ?></option>
                            <option value="media"><?php echo get_phrase('Medium'); ?></option>
                            <option value="alta"><?php echo get_phrase('High'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Why'); ?></label>

                    <div class="col-sm-8">
                        <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('File'); ?></label>

                    <div class="col-sm-6">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <span class="btn btn-primary btn-file">
                                <span class="fileinput-new"><?php echo get_phrase('Search'); ?></span>
                                <span class="fileinput-exists"><?php echo get_phrase('Change'); ?></span>
                                <input type="file" name="file" id="userfile">
                            </span>
                            <span class="fileinput-filename"></span>
                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
                           <?php echo get_phrase('Send'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        var options = {
            beforeSubmit: validate_ticket_add,
            success: show_response_ticket_add,
            resetForm: true
        };
        $('.ticket-add').submit(function () {
            $(this).ajaxSubmit(options);
            return false;
        });
    });
    function validate_ticket_add(formData, jqForm, options) {

        if (!jqForm[0].title.value)
        {
            return false;
        }
        $('#preloader-form').html('<img src="assets/images/preloader.gif" style="height:15px;margin-left:20px;" />');
        document.getElementById("submit-button").disabled = true;
    }

    function show_response_ticket_add(responseText, statusText, xhr, $form) {
        $('#preloader-form').html('');
        toastr.success("Report submitted successfully", "Success");
        document.getElementById("submit-button").disabled = false;
    }

</script>

<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>