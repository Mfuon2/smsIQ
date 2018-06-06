<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Attendance'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li><li class="active"><?php echo get_phrase('Attendance'); ?></li>
        </ol>                
    </div>
</div>


<?php echo form_open(base_url() . 'index.php?admin/attendance_report_selector/'); ?>
<div class="row">
    <?php
    $query = $this->db->get('class');
    if ($query->num_rows() > 0):
        $class = $query->result_array();
        
        ?>
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Class');?></label>
                <select class="form-control selectboxit" name="class_id" onchange="select_section(this.value)">
                    <option value=""><?php echo get_phrase('Select');?></option>
                    <?php foreach ($class as $row): ?>
                    <option value="<?php echo $row['class_id']; ?>" ><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    <?php endif; ?>
    <div id="section_holder">
        <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Section');?></label>
                <select class="form-control selectboxit" name="section_id">
                    <option value=""><?php echo get_phrase('Select');?></option>
                </select>
            </div>
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
    <input type="hidden" name="operation" value="selection">
    <input type="hidden" name="year" value="<?php echo $running_year;?>">

	<div class="col-md-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-info"><?php echo get_phrase('View');?></button>
	</div>
</div>

<?php echo form_close(); ?>

<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>