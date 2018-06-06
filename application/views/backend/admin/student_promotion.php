<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Student-Promotion');?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('Student-Promotion');?></li></ol>                
    </div>
</div>


<?php echo form_open(base_url() . 'index.php?admin/student_promotion/promote');?>
<div class="row">
<?php 
    $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    $running_year_array             = explode ( "-" , $running_year ); 
    $next_year_first_index          = $running_year_array[1];
    $next_year_second_index         = $running_year_array[1]+1;
    $next_year                      = $next_year_first_index. "-" .$next_year_second_index;
?>
	<div class="form-group">
        <div class="col-sm-3" style="margin-top: 40px;">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Year');?></label>
            <select name="running_year" class="form-control">
            <option value="<?php echo $running_year;?>">
            	<?php echo $running_year;?>
            </option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-3"  style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('To-Year');?></label>
            <select name="promotion_year" class="form-control" id="promotion_year">
            <option value="<?php echo $next_year;?>">
            	<?php echo $next_year;?>
            </option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2"  style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('Class');?></label>
            <select name="promotion_from_class_id" id="from_class_id" class="form-control"
                >
                <option value=""><?php echo get_phrase('Select');?></option>
                <?php
                    $classes = $this->db->get('class')->result_array();
                    foreach($classes as $row):
                ?>
                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"  style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('To-Class');?></label>
            <select name="promotion_to_class_id" id="to_class_id" class="form-control">
                <option value=""><?php echo get_phrase('Select');?></option>
                <?php foreach($classes as $row):?>
                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <center>
        <button class="btn btn-info" type="button" style="margin:40px;" onclick="get_students_to_promote('<?php echo $running_year;?>')">
           <?php echo get_phrase('View');?>
        </button>
    </center>
</div>
<div id="students_for_promotion_holder"></div>
<?php echo form_close();?>
<script type="text/javascript">
    function get_students_to_promote(running_year)
    {
        from_class_id   = $("#from_class_id").val();
        to_class_id     = $("#to_class_id").val();
        promotion_year  = $("#promotion_year").val();
        if (from_class_id == "" || to_class_id == "") {
            toastr.error("<?php echo get_phrase('Select-Class');?>")
            return false;
        }
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_students_to_promote/' + from_class_id + '/' + to_class_id + '/' + running_year + '/' + promotion_year,
            success: function(response)
            {
                jQuery('#students_for_promotion_holder').html(response);
            }
        });
        return false;
    }
</script>