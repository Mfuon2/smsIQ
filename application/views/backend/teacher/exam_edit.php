<?php
$exam = $this->db->get_where('exams', array('exam_code' => $exam_code))->result_array();
foreach ($exam as $row):
    ?>
    <div class="col-md-10">
        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><font color="white"><?php echo get_phrase('Edit'); ?></font></div>
            </div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?teacher/online_exams/edit/' . $row['exam_code'], array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data')); ?>

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('Title'); ?></label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" id="title" required value="<?php echo $row['title']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('Description'); ?></label>

                    <div class="col-sm-9">
                        <textarea class="form-control textarea_editor" rows="10" name="description" id="post_content"><?php echo $row['description']; ?></textarea>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Available From</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control mydatepicker" name="availablefrom" required value="<?php echo $row['availablefrom']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Available To</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control mydatepicker" name="availableto" required value="<?php echo $row['availableto']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Duration (Minutes)</label>

                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="duration" required value="<?php echo $row['duration']; ?>">
                    </div>
                </div>

                 <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Total Questions</label>

                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="questions" required value="<?php echo $row['questions']; ?>">
                    </div>
                </div>

                  <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Average to Pass</label>

                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="pass" required value="<?php echo $row['pass']; ?>">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" class="btn btn-info" id="submit-button">
    <?php echo get_phrase('Update'); ?></button>
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