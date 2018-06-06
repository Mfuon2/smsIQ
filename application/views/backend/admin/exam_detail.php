<div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
          <h4 class="page-title">Exams Details</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
          <ol class="breadcrumb">
            <li><a href="#"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active">Exam Details</li>
          </ol>
        </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-info" data-collapsed="0">
          <div class="panel-heading">
              <div class="panel-title" >
          <font color="white">Manage Questions</font>
              </div>
            </div>

      <div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/exam_detail/questionadd/', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

          <div class="form-group">
            <div class="col-sm-5">
              <input type="hidden" class="form-control" name="exam_id" value='<?=(isset($exam_id)) ? $exam_id : '' ;?>' autofocus>
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Question</label>
            <div class="col-sm-5">
              <textarea type="text" class="form-control" rows="6" name="question" required="" value="" autofocus></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="field-1" class="col-sm-3 control-label">Option A</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="optiona" required value="" autofocus>
            </div>
          </div>
          
          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Option B</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="optionb" value="" >
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Option C</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="optionc" value="" >
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Option D</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="optiond" value="" >
            </div> 
          </div>
          
          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Correct Answer</label>
            <div class="col-sm-5">
              <select name="correctanswer" class="form-control selectboxit">
                              <option value="">Select Option</option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>
                              <option value="D">D</option>
                          </select>
            </div> 
          </div>

          <div class="form-group">
            <label for="field-2" class="col-sm-3 control-label">Marks</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="marks" value="" >
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
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">
                    Questions
                </div>
            </div>
            <div class="panel-body">
    <div class="tab-pane box active" id="list">
            <div class="table-responsive">
            <table id="myTable" class="table table-striped">
              <thead>
                <tr>
                  <th style="text-align: center;">Question</th>
                  <th style="text-align: center;">Correct Answer</th>
                  <th style="text-align: center;">Marks</th>
                  <th style="text-align: center;">Delete</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $classes = $this->db->get('questions', array('exam_id' => $exam_id))->result_array();
                  foreach ($classes as $row):
                 ?>
                <tr>
                <td style="text-align: center;"><?php echo $row['question'];?></td>
                <td style="text-align: center;"><?php echo $row['question'];?></td>
                <td style="text-align: center;"><?php echo $row['question'];?></td>
               <td style="text-align: center;" class="text-nowrap"><a href="#" data-toggle="tooltip" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/manage_exams/delete/<?php echo $row['exam_id'];?>');" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            </div>
            </div>
          </div>
        </div>
    </div>
</div>
</div>