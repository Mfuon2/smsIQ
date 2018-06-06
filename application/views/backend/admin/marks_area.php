<?php 
    $student_info = $this->crud_model->get_student_info($student_id);
    $exams         = $this->crud_model->get_exams();
    foreach ($student_info as $row1):
    foreach ($exams as $row2):
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><strong><?php echo $row2['name'];?></strong></div>
            </div>
            <div class="panel-body">
               <div class="col-md-12">
                   <table class="table table-bordered">
                       <thead>
                        <tr>
                            <td style="text-align: center;">Curso</td><td style="text-align: center;"><?php echo get_phrase('Teacher');?></td>
                            <td style="text-align: center;">C1</td>
                            <td style="text-align: center;">C2</td>
                            <td style="text-align: center;">C3</td>
                            <td style="text-align: center;">C4</td>
                            <td style="text-align: center;">C5</td>
                            <td style="text-align: center;">C6</td>
                            <td style="text-align: center;">C7</td>
                            <td style="text-align: center;">C8</td>
                            <td style="text-align: center;">C9</td>
                            <td style="text-align: center;">C10</td>
                            <td style="text-align: center;"><?php echo get_phrase('Final-Exam');?></td>
                            <td style="text-align: center;"><?php echo get_phrase('Total');?></td>
                            <td style="text-align: center;"><?php echo get_phrase('Status');?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $subjects = $this->db->get_where('subject' , array(
                                'class_id' => $class_id , 'year' => $running_year
                            ))->result_array();
                            foreach ($subjects as $row3): ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row3['name'];?></td>
                                <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('teacher', $row3['teacher_id']); ?></td>
                                <td style="text-align: center;">
                                    <?php $obtained_mark_query = $this->db->get_where('mark' , array(
                                    'subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'],
                                    'class_id' => $class_id, 'student_id' => $student_id , 
                                    'year' => $running_year));
                                    if ( $obtained_mark_query->num_rows() > 0)
                                    {
                                    $marks = $obtained_mark_query->result_array();
                                    foreach ($marks as $row4)
                                    echo $row4['mark_obtained'];        
                                    } ?>
                                </td>
                                <td style="text-align: center;"> <?php  $marks = $obtained_mark_query->result_array();
                                    foreach ($marks as $row4) echo $row4['labuno'];?></td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labdos'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labtres'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labcuatro'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labcinco'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labseis'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labsiete'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labocho'];?>
                                </td>
                                <td style="text-align: center;">
                                    <?php foreach ($marks as $row4) echo $row4['labnueve'];?>
                                </td>
                                 <td style="text-align: center;">
                                <?php foreach ($marks as $row4) echo $row4['final'];?>
                                </td>
                                <td style="text-align: center;">
                                <?php foreach ($marks as $row4) echo $row4['labtotal'];?>
                                </td>


                                <?php $min = $this->db->get_where('settings' , array('type' =>'minimark'))->row()->description;?>

                                <td style="text-align: center;">
                                <?php foreach ($marks as $row4) if($row4['labtotal'] < $min) {echo "<span class=\"badge badge-danger\">Repproved</span>";} 
                                else {echo "<span class=\"badge badge-success\">Approved</span>";} ?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                   </table>
                    <a href="<?php echo base_url();?>index.php?admin/marks_print_view/<?php echo $student_id;?>/<?php echo $row2['exam_id'];?>" 
                        class="btn btn-primary" target="_blank">
                       <?php echo get_phrase('Print-Marks');?>
                    </a>               </div>
               
            </div>
        </div>  
    </div>
</div>
<?php
    endforeach;
        endforeach;
?>