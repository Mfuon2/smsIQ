<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <font color="white"><?php echo get_phrase('Upload');?></font>
                </div>
            </div>
            <br>
            <div class="panel-body">
                <?php
                echo form_open(base_url() . 'index.php?admin/upload_unit_content', array(
                    'class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data'
                ));
                ?>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('Title');?></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="title"
                               data-validate="required" data-message-required="<?php echo get_phrase('Required');?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                    <div class="col-sm-6">
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('Class');?></label>
                    <div class="col-sm-6">
                        <select class="form-control selectboxit" name="class_id" id="class_id" onchange="return get_class_subject(this.value)">
                            <option value=""><?php echo get_phrase('Select');?></option>
                            <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $row):
                                ?>

                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Subject');?></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="form-control" id="subject_selector_holder">
                            <option value=""><?php echo get_phrase('Select-Class');?></option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('File');?></label>
                    <div class="col-sm-5">
                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <?php echo get_phrase('Search');?>" 
                               data-validate="required" data-message-required="<?php echo get_phrase('Required');?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info">
                            <i class="entypo-upload"></i> <?php echo get_phrase('Upload');?>
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_subject/' + class_id,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
</script>