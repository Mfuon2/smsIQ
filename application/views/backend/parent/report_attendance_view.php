<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Attendance-Report'); ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url();?>index.php?parents/parents_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Attendance-Report'); ?></li>
        </ol>
    </div>
</div>

<div class="white-box">
<?php if ($month != ''): ?>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
         <center><p><i class="fa fa-check-circle" style="color: #00a651;"></i> <?php echo get_phrase('Present');?>&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle" style="color: #ee4749;"></i> <?php echo get_phrase('Absent');?>&nbsp;&nbsp;&nbsp;<i class="fa fa-certificate" style="color: #fec42d;"></i> Llego Tarde</p></center>
         <hr>
         <div class="table-responsive">
            <table class="table table-bordered" id="my_table">
                <thead>
                    <tr>
                        <td style="text-align: center;">
    <?php echo get_phrase('Student');?> <i class="entypo-down-thin"></i> | <?php echo get_phrase('Date');?> <i class="entypo-right-thin"></i>
                        </td>
    <?php
    $year = explode('-', $running_year);
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year[0]);
    for ($i = 1; $i <= $days; $i++) {
        ?>
                            <td style="text-align: center;"><?php echo $i; ?></td>
                    <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                             $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                            foreach ($children_of_parent as $row): 

    $class_id = $this->db->get_where('enroll' , array('student_id' => $row['student_id'] , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->row()->class_id;

  $section_id = $this->db->get_where('enroll' , array('student_id' => $row['student_id'] , 'year' => $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description))->row()->section_id;
                                ?>
                        <tr>
                            <td style="text-align: center;">
                            <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name; ?>
                            </td>
                            <?php
                            $status = 0;
                            for ($i = 1; $i <= $days; $i++) {
                                $timestamp = strtotime($i . '-' . $month . '-' . $year[0]);
                                $this->db->group_by('timestamp');
                                $attendance = $this->db->get_where('attendance', array('section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamp, 'student_id' => $row['student_id']))->result_array();

                                foreach ($attendance as $row1):
                                    $month_dummy = date('d', $row1['timestamp']);
                                   
                                    if ($i == $month_dummy)
                                    $status = $row1['status'];
                                   
                                endforeach;
                                ?>
                                <td style="text-align: center;">
                             <?php if ($status == 1) { ?>
                                        <i class="fa fa-check-circle" title="<?php echo get_phrase('Present');?>" data-toggle="tooltip" style="color: #00a651;"></i></i>
                            <?php  } if($status == 2)  { ?>
                                        <i class="fa fa-times-circle" title="<?php echo get_phrase('Absent');?>" data-toggle="tooltip" style="color: #ee4749;"></i>
                            <?php  } if($status == 3)  { ?>
                                        <i class="fa fa-certificate" title="<?php echo get_phrase('Late');?>" data-toggle="tooltip" style="color: #fec42d;"></i>
                             <?php  } $status =0;?>
                                </td>
        <?php } ?>
        <?php endforeach; ?>
                    </tr>
    <?php ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function() {
        if($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        showFirstOption: attrDefault($this, 'first-option', true),
                        'native': attrDefault($this, 'native', false),
                        defaultText: attrDefault($this, 'text', ''),
                    };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }
    }); 
</script>
<script type="text/javascript">
    function select_section(class_id) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>