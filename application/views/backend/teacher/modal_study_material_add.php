<?php $class_info = $this->db->get('class')->result_array(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <font color="white"><?php echo get_phrase('Study-Material'); ?></font>
                </div>
            </div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?teacher/study_material/create', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Title'); ?></label>

                    <div class="col-sm-5">
                        <input type="text" name="title" class="form-control" id="field-1" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Description'); ?></label>

                    <div class="col-sm-5">
                        <textarea name="description" class="form-control" id="field-ta"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('Class'); ?></label>

                    <div class="col-sm-5">
                        <select name="class_id" class="form-control selectboxit" id="class_id" onchange="return get_class_subject(this.value)">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                            <?php foreach ($class_info as $row) { ?>
                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('Subject'); ?></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="form-control" id="subject_selector_holder">
                            <option value=""><?php echo get_phrase('Select-Class'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('File'); ?></label>

                    <div class="col-sm-5">

                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <?php echo get_phrase('Search'); ?>" />

                    </div>
                </div>

                <div class="form-group">
                    <label for="field-ta" class="col-sm-4 control-label"><?php echo get_phrase('File-Type'); ?></label>

                    <div class="col-sm-5">
                        <select name="file_type" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
                            <option value="pdf"><?php echo get_phrase('Pdf'); ?></option>
                            <option value="excel"><?php echo get_phrase('Excel'); ?></option>
                            <option value="other"><?php echo get_phrase('Other'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3 control-label col-sm-offset-2">
                    <button type="submit" class="btn btn-success"><?php echo get_phrase('Send'); ?></button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?teacher/get_class_subject/' + class_id,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
</script>