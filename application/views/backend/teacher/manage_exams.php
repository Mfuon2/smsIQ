<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Manage Online Exams</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
  		    <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active">Manage Online Exams</a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">

<div class="tab-content">
		<div class="tab-pane box active" id="list">
          <div class="white-box">
            <div class="table-responsive">
            <table id="myTable" class="table table-striped">
              <thead>
                <tr>
                  <th style="text-align: center;"><?php echo get_phrase('Title');?></th>
                  <th style="text-align: center;"><?php echo get_phrase('Class');?></th>
                  <th style="text-align: center;"><?php echo get_phrase('Section');?></th>
			            <th style="text-align: center;"><?php echo get_phrase('Subject');?></th>
                  <th style="text-align: center;">Duration</th>
                  <th style="text-align: center;">Total Questions</th>
			            <th style="text-align: center;"><?php echo get_phrase('Options');?></th>
                </tr>
              </thead>
              <tbody>
              <?php 
		              $exams	=	$this->db->get('exams' )->result_array();
		              foreach($exams as $row):
		          ?>
                <tr>
                <td style="text-align: center;"><?php echo $row['title'];?></td>
                <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
                <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('section',$row['section_id']);?></td>
                <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('subject',$row['subject_id']);?></td>
                <td style="text-align: center;"><?php echo $row['duration'];?></td>
                <td style="text-align: center;"><?php echo $row['questions'];?></td>
			         <td style="text-align: center;" class="text-nowrap"><a href="#" data-toggle="tooltip" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_exam/<?php echo $row['exam_id'];?>');" data-original-title="Edit"> <i class="fa fa-edit text-info"></i> </a> <a href="<?php echo base_url();?>index.php?admin/exam_detail/<?php echo $row['exam_id'];?>" data-toggle="tooltip" data-original-title="Questions"> <i class="fa fa-question-circle text-info m-r-10"></i></a><a href="#" data-toggle="tooltip" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/manage_exams/delete/<?php echo $row['exam_id'];?>');" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a></td>
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

<script>
    $(document).ready(function(){
      $('#myTable').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          "columnDefs": [
          { "visible": false, "targets": 2 }
          ],
          "order": [[ 2, 'asc' ]],
          "displayLength": 25,
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

                last = group;
              }
            } );
          }
        } );
    $('#example tbody').on( 'click', 'tr.group', function () {
      var currentOrder = table.order()[0];
      if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
        table.order( [ 2, 'desc' ] ).draw();
      }
      else {
        table.order( [ 2, 'asc' ] ).draw();
      }
    });
  });
    });
    $('#example23').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
  </script>