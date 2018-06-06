<?php
$post = $this->db->get_where('forum', array(
            'post_code' => $post_code
        ))->result_array();
foreach ($post as $row):
    ?>
    <div class="col-md-10">
        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><font color="white"><?php echo get_phrase('Edit'); ?></font></div>
            </div>

            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?teacher/forum/edit/' . $row['post_code'], array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data')); ?>

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