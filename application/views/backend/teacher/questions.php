<div class="panel panel-info" data-collapsed="0">
<div class="panel-heading">
                <div class="panel-title"><font color="white">Questions</font></div>
            </div>
<div class="tab-content">
        <div class="tab-pane box active">
          <div class="white-box">
            <div class="table-responsive">
<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th style="text-align: center;">Question</th>
            <th style="text-align: center;">Correct Answer</th>
            <th style="text-align: center;">Mark</th>
            <th style="text-align: center;">Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php $ques = $this->db->get_where('questions', array('exam_code' => $exam_code))->result_array();
        foreach ($ques as $row1):
            ?>
            <tr>
                <td style="text-align: center;"><?php echo $row1['question'];?></td>
                <td style="text-align: center;"><?php echo $row1['correctanswer']; ?></td>
                <td style="text-align: center;"><?php echo $row1['marks']; ?></td>
                <td style="text-align: center;" class="text-nowrap"><a href="#" data-toggle="tooltip" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/online_exams/delete_questions/<?php echo $row1['question_id'];?>');" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
              </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var responsiveHelper;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };
    var tableContainer;
    jQuery(document).ready(function ($)
    {
        $("#table-1").dataTable();
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
</script>
<br/>