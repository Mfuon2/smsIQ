<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Exam-Routine'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Exam-Routine'); ?></li>
        </ol>
    </div>
</div>

<hr />
<div class="row">
	<div class="col-md-12">
    <div class="white-box">
		<?php echo form_open(base_url() . 'index.php?admin/exam_routine/create' , array('class' => 'form-horizontal form-groups validate','target'=>'_top'));?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Class'); ?></label>
                <div class="col-sm-5">
                    <select name="class_id" class="form-control selectboxit" style="width:100%;"
                        onchange="return get_class_section_subject(this.value)">
                        <option value=""><?php echo get_phrase('Select'); ?></option>
                        <?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div id="section_subject_selection_holder"></div>
            <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Date'); ?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control mydatepicker" name="fecha" value="" data-start-view="2">
                        </div> 
                    </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Day'); ?></label>
                <div class="col-sm-5">
                    <select name="day" class="form-control selectboxit" style="width:100%;">
                        <option value="<?php echo get_phrase('Sunday'); ?>"><?php echo get_phrase('Sunday'); ?></option>
                        <option value="<?php echo get_phrase('Monday'); ?>"><?php echo get_phrase('Monday'); ?></option>
                        <option value="<?php echo get_phrase('Tuesday'); ?>"><?php echo get_phrase('Tuesday'); ?></option>
                        <option value="<?php echo get_phrase('Wednesday'); ?>"><?php echo get_phrase('Wednesday'); ?></option>
                        <option value="<?php echo get_phrase('Thursday'); ?>"><?php echo get_phrase('Thursday'); ?></option>
                        <option value="<?php echo get_phrase('Friday'); ?>"><?php echo get_phrase('Friday'); ?></option>
                        <option value="<?php echo get_phrase('Saturday'); ?>"><?php echo get_phrase('Saturday'); ?></option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('Start'); ?></label>
                <div class="col-sm-9">
                    <div class="col-md-3">
                        <select name="time_start" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('Hour'); ?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_start_min" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('Minutes'); ?></option>
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="starting_ampm" class="form-control selectboxit">
                            <option value="1">AM</option>
                            <option value="2">PM</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo get_phrase('End'); ?></label>
                <div class="col-sm-9">
                    <div class="col-md-3">
                        <select name="time_end" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('Hour'); ?></option>
                            <?php for($i = 0; $i <= 12 ; $i++):?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="time_end_min" class="form-control selectboxit">
                            <option value=""><?php echo get_phrase('Minutes'); ?></option>  
                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                            <?php endfor;?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="ending_ampm" class="form-control selectboxit">
                            <option value="1">AM</option>
                            <option value="2">PM</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
            <button type="submit" class="btn btn-info"><?php echo get_phrase('Add'); ?></button>
            </div>
            </div>
    <?php echo form_close();?>
	</div>
</div>
</div>

<script type="text/javascript">
    function get_class_section_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#section_subject_selection_holder').html(response);
            }
        });
    }
</script>