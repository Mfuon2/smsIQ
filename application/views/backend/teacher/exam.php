<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php $exams = $this->db->get_where('exams' , array('exam_code' => $exam_code))->result_array();
	foreach ($exams as $row):
?>
<div class="col-md-7">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title"><font color="white"><?php echo $row['title']; ?></font></div>
        </div>
        
        <div class="panel-body">   
            <p><?php echo $row['description'];?></p>
            <hr />
            <p style="font-size: 16px; text-align: center;">
                <span class="label label-info m-l-5">Desde: <?php echo $row['availablefrom'];?></span>  <span class="label label-warning m-l-5">Hasta: <?php echo $row['availableto'];?></span>  <span class="label label-success m-l-5">Average Required: <?php echo $row['pass'];?>%</span>
            </p>
            <p style="font-size: 16px; text-align: center;">
                 <span class="label label-danger m-l-5">Total Questions: <?php echo $row['questions'];?></span>  <span class="label label-primary m-l-5">Duration (Minutes): <?php echo $row['duration'];?></span>
            </p>
        </div>
    </div>
</div>

<div class="col-md-3">
        <div class="panel panel-warning" data-collapsed="0">
            <div class="panel-heading">
            <div class="panel-title">
                <font color="white"><i class="fa fa-graduation-cap"></i> <?php echo get_phrase('Students'); ?></font>
            </div>
        </div>
            <div class="panel-body">
        <?php $students   =   $this->db->get_where('enroll' , array('class_id' => $row['class_id'], 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
                foreach($students as $row2):?>
                                <table width="100%" border="0">
                                    <tr>
                        <td rowspan="2" width="60">
                                    <img src="<?php echo $this->crud_model->get_image_url('student', $row2['student_id']); ?>" 
                                                 alt="" class="img-circle" width="30">
                                     </td>
                                  <td>
                                 <h4><?php echo $this->db->get_where('student' , array('student_id' => $row2['student_id']))->row()->name; ?></h4>
                             </td>
                          </tr>
                       </table>
                    <?php endforeach;?>
                <br>
            </div>
        </div>
</div>
<?php endforeach;?>