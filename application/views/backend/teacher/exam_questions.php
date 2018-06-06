<?php
$exam = $this->db->get_where('exams', array('exam_code' => $exam_code))->result_array();
foreach ($exam as $row):
    ?>
    <div class="col-md-10">
        <div class="panel panel-info" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title"><font color="white">Manage Questions</font></div>
            </div>
            <?php 
            $this->db->select('question_id');
            $this->db->from('questions');
            $this->db->where('exam_id', $row['exam_id']);
            $num_results = $this->db->count_all_results();
            $total = $this->db->get_where('exams',array('exam_code'=>$exam_code))->row()->questions;
            ?>
            <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?teacher/online_exams/questions/' . $row['exam_code'], array('class' => 'form-horizontal form-groups-bordered', 'enctype' => 'multipart/form-data')); ?>

                 <?php if($num_results >= $total):?>
             <div class="alert alert-warning"> Llegaste al límite de preguntas, si deseas agregar más edita el examen o elimina una pregunta. </div>
                <?php endif;?>

                <input type="hidden" class="form-control" name="exam_id" value="<?php echo $row['exam_id'];?>" required>

                <input type="hidden" class="form-control" name="exam_code" value="<?php echo $row['exam_code'];?>" required>
    
                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Question</label>

                    <div class="col-sm-9">
                        <textarea type="text" class="form-control" name="question" rows="6" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Option A</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="optiona" required>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Option B</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="optionb" required">
                    </div>
                </div>

                  <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Option C</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="optionc" required>
                    </div>
                </div>

                 <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Option D</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="optiond" required>
                    </div>
                </div>

                <div class="form-group">
                       <label for="field-1" class="col-sm-2 control-label">Correct Answer</label>
                <div class="col-sm-9">
                      <select name="correctanswer" class="form-control">
                                    <option value="">------- Select Option ------</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label">Mark</label>

                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="marks" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-8">
                        <button type="submit" <?php if($num_results >= $total) echo 'disabled=""';?> class="btn btn-info" id="submit-button">Add Question</button>
                    </div>
                </div>

    <?php echo form_close(); ?>
            </div>
        </div>
        <div class="message_container">
             <?php include 'questions.php'; ?>
            </div>

    </div>
<?php endforeach; ?>