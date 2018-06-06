<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Class-Routine');?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('Class-Routine');?></li>
        </ol>
    </div>
</div>

<?php
    $section_id = $this->db->get_where('enroll' , array(
        'student_id' => $student_id,
            'class_id' => $class_id,
                'year' => $running_year
    ))->row()->section_id;
?>

<hr />
<div class="row">    
    <div class="col-md-12">
        <div class="panel panel-info" data-collapsed="0">
          <div class="panel-heading" >
          <div class="panel-title" style="font-size: 16px; color: white; text-align: center;">
         <?php echo get_phrase('Class'); ?> - <?php echo $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;?> : 
         <?php echo get_phrase('Section'); ?> - <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name;?>
    </div>
</div>

<div class="panel-body">
<table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered">
                    <tbody>
                        <?php 
                       for($d=1;$d<=7;$d++):
                        if($d==1)$day= get_phrase('Sunday');
                        else if($d==2) $day= get_phrase('Monday');
                        else if($d==3)$day = get_phrase('Tuesday');
                        else if($d==4)$day= get_phrase('Wednesday');
                        else if($d==5)$day= get_phrase('Thursday');
                        else if($d==6)$day= get_phrase('Friday');
                        else if($d==7)$day= get_phrase('Saturday');
                        ?>
                        <tr class="gradeA">
                            <td width="100"><?php echo strtoupper($day);?></td>
                            <td>
                                <?php
                                $this->db->order_by("time_start", "asc");
                                $this->db->where('day' , $day);
                                $this->db->where('class_id' , $class_id);
                                $this->db->where('section_id' , $section_id);
                                $this->db->where('year' , $running_year);
                                $routines   =   $this->db->get('class_routine')->result_array();
                                foreach($routines as $row2):
                                ?>
                                <div class="btn-group">
                                    <button class="btn btn-info">
                <?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
                <?php
                if ($row2['time_start_min'] == 0 && $row2['time_end_min'] == 0) 
                echo '('.$row2['time_start'].'-'.$row2['time_end'].')';
                if ($row2['time_start_min'] != 0 || $row2['time_end_min'] != 0)
                echo '('.$row2['time_start'].':'.$row2['time_start_min'].' a '.$row2['time_end'].':'.$row2['time_end_min'].')'; ?>
                                    </button>
                                </div>
                                <?php endforeach;?>
                            </td>
                        </tr>
                        <?php endfor;?>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>