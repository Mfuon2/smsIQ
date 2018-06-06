<div class="mail-header" style="padding-bottom: 27px ;">
    <h3 class="mail-title">
        <?php echo get_phrase('New');?>
    </h3>
</div>
<hr>
<div class="mail-compose">
    <?php echo form_open(base_url() . 'index.php?student/message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
    <div class="form-group">
        <label for="subject"><?php echo get_phrase('Receiver');?>:</label>
        <br><br>
        <select class="form-control select2" name="reciever" required>
            <option value=""><?php echo get_phrase('Select-User');?></option>
            <optgroup label="<?php echo get_phrase('Students');?>">
                <?php
                $students = $this->db->get('student')->result_array();
                foreach ($students as $row):
                    ?>
                    <option value="student-<?php echo $row['student_id']; ?>">
                         <?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('Teachers');?>">
                <?php
                $teachers = $this->db->get('teacher')->result_array();
                foreach ($teachers as $row):
                    ?>
                    <option value="teacher-<?php echo $row['teacher_id']; ?>">
                        <?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('Parents');?>">
                <?php
                $parents = $this->db->get('parent')->result_array();
                foreach ($parents as $row):
                    ?>
                    <option value="parent-<?php echo $row['parent_id']; ?>">
                        <?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('Admins');?>">
                <?php
                $parents = $this->db->get('admin')->result_array();
                foreach ($parents as $row):
                    ?>
                    <option value="admin-<?php echo $row['admin_id']; ?>">
                        <?php echo $row['name']; ?></option>
                <?php endforeach; ?>
            </optgroup>
        </select>
    </div>

    <div class="compose-message-editor">
                <textarea class="textarea_editor form-control" name="message" rows="15" placeholder="<?php echo get_phrase('Write-Message'); ?>..."></textarea>
    </div>
    <hr>
    <button type="submit" class="btn btn-success btn-icon pull-right">
        <?php echo get_phrase('Send');?>
        <i class="entypo-mail"></i>
    </button>
</form>
</div>





<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>