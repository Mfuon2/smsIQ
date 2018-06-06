<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title" >
                    <?php echo get_phrase('Upload'); ?>
                </div>
            </div>
            <div class="panel-body">
                <?php
                echo form_open(base_url() . 'index.php?teacher/subir_libro', array(
                    'class' => 'form-horizontal form-groups-bordered validate', 'target' => '_top', 'enctype' => 'multipart/form-data'
                ));
                ?>
				<br>
				   <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Name'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nombre"
                               required/>
                    </div>
                </div>
				
				   <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Autor'); ?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="autor"
                               required="" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Description'); ?></label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Class'); ?></label>
                    <div class="col-sm-5">
                        <select class="form-control selectboxit" name="class_id" id="class_id" onchange="return get_class_subject(this.value)">
                            <option value=""><?php echo get_phrase('Select'); ?></option>
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
                    <label for="field-2" class="col-sm-4 control-label"><?php echo get_phrase('Subject'); ?></label>
                    <div class="col-sm-5">
                        <select name="subject_id" class="form-control" id="subject_selector_holder">
                            <option value=""><?php echo get_phrase('Select-Class'); ?></option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Book'); ?></label>
                    <div class="col-sm-5">
                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" 
                              required/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-5">
                        <button type="submit" class="btn btn-info">
                            <i class="entypo-upload"></i> <?php echo get_phrase('Upload'); ?>
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function get_class_subject(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?teacher/get_class_subject/' + class_id,
            success: function (response)
            {
                jQuery('#subject_selector_holder').html(response);
            }
        });
    }
</script>