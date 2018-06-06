<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Attendance'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php?parents/parents_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li><li class="active"><?php echo get_phrase('Attendance'); ?></li>
        </ol>                
    </div>
</div>


<?php echo form_open(base_url() . 'index.php?parents/attendance_report_selector/'); ?>
<div class="row">
<div class="col-md-3">
            <div class="form-group">
                   <?php $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                            foreach ($children_of_parent as $row): 

    $class_id = $this->db->get_where('enroll' , array('student_id' => $row['student_id'] , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->row()->class_id;

  $section_id = $this->db->get_where('enroll' , array('student_id' => $row['student_id'] , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->row()->section_id;
                                ?>
                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                    <?php endforeach; ?>
            </div>
        </div>
    <div class="col-md-3">
         <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Month');?></label>
        <select name="month" class="form-control selectboxit" id="month" onchange="show_year()">
            <?php
            for ($i = 1; $i <= 12; $i++):
                if ($i == 1)
                    $m = get_phrase('January');
                else if ($i == 2)
                    $m = get_phrase('February');
                else if ($i == 3)
                    $m = get_phrase('March');
                else if ($i == 4)
                    $m = get_phrase('April');
                else if ($i == 5)
                    $m = get_phrase('May');
                else if ($i == 6)
                    $m = get_phrase('June');
                else if ($i == 7)
                    $m = get_phrase('July');
                else if ($i == 8)
                    $m = get_phrase('August');
                else if ($i == 9)
                    $m = get_phrase('September');
                else if ($i == 10)
                    $m = get_phrase('October');
                else if ($i == 11)
                    $m = get_phrase('November');
                else if ($i == 12)
                    $m = get_phrase('December');
                ?>
                <option value="<?php echo $i; ?>"
                      <?php if($month == $i) echo 'selected'; ?>  >
                            <?php echo $m; ?>
                </option>
                <?php
            endfor;
            ?>
        </select>
         </div>

    </div>

    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('View');?></button>
	</div>
</div>
<?php echo form_close(); ?>