<?php
$current_homework = $this->db->get_where('homework', array(
            'homework_code' => $homework_code
        ))->result_array();
foreach ($current_homework as $row):
    ?>
    <div class="col-md-10">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <font color="white"><?php echo get_phrase('Edit'); ?></font>
                </div>
            </div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?teacher/homework/edit/' . $row['homework_code'], array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Title'); ?></label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="title" id="title" required value="<?php echo $row['title']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Description'); ?></label>

                    <div class="col-sm-8">
                        <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Last-day-delivery'); ?></label>

                    <div class="col-sm-5">
                            <input type="text" class="form-control mydatepicker" name="time_end"  value="<?php echo $row['time_end']; ?>" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button"><?php echo get_phrase('Update'); ?></button>
                        <span id="preloader-form"></span>
                    </div>
                </div>
    <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>  