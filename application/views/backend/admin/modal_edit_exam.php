<?php $edit_data = $this->db->get_where('exams' , array('exam_id' => $param2) )->result_array();
?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/manage_exams/edit/'.$row['exam_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <br>
               
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Title');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>"
                            required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Description');?></label>
                    <div class="col-sm-5">
                        <textarea rows="8" class="form-control" name="description"><?php echo $row['description'];?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Available From</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control mydatepicker" name="availablefrom" value="<?php echo $row['availablefrom'];?>"/>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-4 control-label">Available To</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control mydatepicker" name="availableto" value="<?php echo $row['availableto'];?>"/>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-4 control-label">Total Questions</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="questions" value="<?php echo $row['questions'];?>"/>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-4 control-label">Duration (Minutes)</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="duration" value="<?php echo $row['duration'];?>"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label">Average</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="pass" value="<?php echo $row['pass'];?>"/>
                    </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-info"><?php echo get_phrase('Edit');?></button>
                  </div>
                </div>
        </form>
        <?php endforeach;?>
    </div>
</div>


<script type="text/javascript">
    function get_class_sections(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });
    }
</script>

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

<script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>  