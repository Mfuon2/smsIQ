<?php $running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description; ?>
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><?php echo get_phrase('Tabulation'); ?></h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Class'); ?></a>
                </li>
                <li class="active"><?php echo get_phrase('Tabulation'); ?></li>
            </ol>
        </div>
    </div>


    <hr/>
    <div class="row">
        <div id="viewMarks" class="col-md-12">
            <?php echo form_open(base_url() . 'index.php?admin/sms'); ?>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label"><?php echo get_phrase('Class'); ?></label>
                    <select name="class_id" class="form-control selectboxit">
                        <option value=""><?php echo get_phrase('Select'); ?></option>
                        <?php
                        $classes = $this->db->get('class')->result_array();
                        foreach ($classes as $row):
                            ?>
                            <option value="<?php echo $row['class_id']; ?>"
                                <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                <?php echo $row['name']; ?>
                            </option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label"><?php echo get_phrase('Term'); ?></label>
                    <select name="exam_id" class="form-control selectboxit">
                        <option value=""><?php echo get_phrase('Select'); ?></option>
                        <?php
                        $exams = $this->db->get_where('exam', array('year' => $running_year))->result_array();
                        foreach ($exams as $row):
                            ?>
                            <option value="<?php echo $row['exam_id']; ?>"
                                <?php if ($exam_id == $row['exam_id']) echo 'selected'; ?>>
                                <?php echo $row['name']; ?>
                            </option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="operation" value="selection">
            <div class="col-md-4" style="margin-top: 20px;">
                <button type="submit"  class="btn btn-info"><?php echo get_phrase('Generate Marks'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>

<?php if ($class_id != '' && $exam_id != ''): ?>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;">
            <div class="tile-stats tile-gray">
                <div class="icon"><i class="entypo-docs"></i></div>
                <h3 style="color: #696969;">
                    <?php
                    $exam_name = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name;
                    $class_name = $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
                    echo get_phrase('SMS Student Marks');
                    ?>
                </h3>
                <h4 style="color: #696969;">
                    <?php echo get_phrase('Class') . ' ' . $class_name; ?> : <?php echo $exam_name; ?>
                </h4>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>


    <hr/>

    <div onload="hideDiv()" class="row">
        <div class="col-md-12">
            <div class="white-box">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td style="text-align: center;">
                            <?php echo get_phrase('Students'); ?> <i class="fa fa-arrow-circle-down"></i>
                            | <?php echo get_phrase('Subjects'); ?> <i class="fa fa-arrow-circle-right"></i>
                        </td>
                        <?php
                        $subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'year' => $running_year))->result_array();
                        foreach ($subjects as $row):
                            ?>
                            <td style="text-align: center;"><?php echo $row['name']; ?></td>
                        <?php endforeach; ?>
                        <td style="text-align: center;"><?php echo get_phrase('Average'); ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year))->result_array();
                    foreach ($students as $row):
                        ?>
                        <tr>
                            <td style="text-align: left;">
                                <?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                                $studentName = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;
                                $admno = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->admissionNo;
                                $fathersNo = +$this->db->get_where('student', array('student_id' => $row['student_id']))->row()->fathersNo;
                                $motherNo = +$this->db->get_where('student', array('student_id' => $row['student_id']))->row()->mothersNo;

                                if(($fathersNo != null || $fathersNo != '' ) && ($motherNo != null || $motherNo != '')){
                                    $parentNo = "+254" .$fathersNo. ",+254".$motherNo;
                                }elseif (($fathersNo != null || $fathersNo != '') && ($motherNo == null || $motherNo == '')){
                                    $parentNo = "+254" .$fathersNo;
                                }elseif (($fathersNo == null || $fathersNo == '') && ($motherNo != null || $motherNo != '')){
                                    $parentNo = "+254" .$motherNo;
                                }

                                $termBalance = 0;
                                $invoice = $this->db->get_where('invoice', array('student_id' => $row['student_id']));
                                if($invoice ->num_rows() > 0){
                                    $this->db->select_sum('due');
                                    $this->db->from('invoice');
                                    $this->db->where('student_id',$row['student_id']);
                                    $query = $this->db->get();
                                    $termBalance = $query->row()->due;
                                }

                                $data['contactNo'] = $parentNo;
                                $data['StudentName'] = $studentName;
                                $data['admNo'] = $admno;
                                $data['student_id'] = $row['student_id'];
                                $data['balance'] = $termBalance;
                                $data['term_id'] = $exam_id;
                                $data['year'] = $running_year;
                                $data['class_id'] = $class_id;

                                if($this->db->get_where('sms_marks', array('student_id' => $row['student_id']))->row()->student_id == null) {
                                    $this->db->insert('sms_marks', $data);
                                }

                                ?>

                            </td>
                            <?php
                            $total_marks = 0;
                            foreach ($subjects as $row2): ?>
                                <td style="text-align: center;">
                                    <?php
                                    $marks = $this->db->get_where('mark', array('class_id' => $class_id, 'exam_id' => $exam_id,
                                        'subject_id' => $row2['subject_id'], 'student_id' => $row['student_id'], 'year' => $running_year));
                                    if ($marks->num_rows() > 0) {
                                        $obtained_marks = $marks->row()->labtotal;

                                        $subjectName = $row2['name'];

                                        if (strtolower($subjectName) == strtolower('english')){
                                            $data2['eng']  = $marks->row()->labtotal . " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('physics') ){
                                            $data2['phy']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('mathematics')){
                                            $data2['maths']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('kiswahili')){
                                            $data2['kisw']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('geography')){
                                            $data2['geo']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('history')){
                                            $data2['hist']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('chemistry')){
                                            $data2['chem']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('biology')){
                                            $data2['bio']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('cre')){
                                            $data2['cre']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('business')){
                                            $data2['bst']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('Home Science')){
                                            $data2['hmsci']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('Computer')){
                                            $data2['comp']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }elseif(strtolower($subjectName) == strtolower('Agriculture')){
                                            $data2['agri']  = $marks->row()->labtotal. " " . $marks->row()->grade;
                                        }

                                        $data2['totalMarks'] = $total_marks += $obtained_marks;
                                        $data2['sendStatus'] = 'UNS';

                                        if($data2['totalMarks'] > 0){
                                            $this->db->where('StudentName',$studentName);
                                            $this->db->update('sms_marks',$data2);
                                        }

                                        echo $obtained_marks . " " . $marks->row()->grade;
                                        $total_marks += $obtained_marks;
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                            <td style="text-align: center;">
                                <?php
                                $this->db->where('class_id', $class_id);
                                $this->db->where('year', $running_year);
                                $this->db->from('subject');
                                $total_subjects = $this->db->count_all_results();
                                echo($total_marks / $total_subjects);
                                echo "%";
                                ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                    </tbody>
                </table>
                <center>
                    <div class="col-md-12">
                        <?php echo form_open(base_url() . 'index.php?admin/sendSms'); ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"><?php echo get_phrase('Class'); ?></label>
                                <select id="classId" required name="class_id" class="form-control selectboxit">
                                    <option value=""><?php echo get_phrase('Select'); ?></option>
                                    <?php
                                    $classes = $this->db->get('class')->result_array();
                                    foreach ($classes as $row):
                                        ?>
                                        <option value="<?php echo $row['class_id']; ?>"
                                            <?php if ($class_id == $row['class_id']) echo 'selected'; ?>>
                                            <?php echo $row['name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label"><?php echo get_phrase('Term'); ?></label>
                                <select onclick="enable()" id="termSelect" required name="exam_id" class="form-control selectboxit">
                                    <option value=""><?php echo get_phrase('Select'); ?></option>
                                    <?php
                                    $exams = $this->db->get_where('exam', array('year' => $running_year))->result_array();
                                    foreach ($exams as $row):
                                        ?>
                                        <option value="<?php echo $row['exam_id']; ?>"
                                            <?php if ($exam_id == $row['exam_id']) echo 'selected'; ?>>
                                            <?php echo $row['name']; ?>
                                        </option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <button id="btn"><a onclick="hideDiv()" class="btn btn-info" href="">
                                <?php echo get_phrase('Send Parents SMS'); ?>
                            </a>
                        </button>
                        <?php echo form_close(); ?>
                    </div>


                </center>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>

    function enable() {
        return document.getElementById("btn").disabled = false;
    }
    function hideDiv() {
        var classId = document.getElementById('classId').value;
        var termSelect = document.getElementById('termSelect').value;
    }
</script>

