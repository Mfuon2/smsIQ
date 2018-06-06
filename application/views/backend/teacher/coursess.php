<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Subjects');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
  		    <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('Subjects');?></a></li>
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
                    <th style="text-align: center;"><div><?php echo get_phrase('Class');?></div></th>
                    <th style="text-align: center;"><div><?php echo get_phrase('Subject');?></div></th>
                    <th style="text-align: center;"><div><?php echo get_phrase('Teacher');?></div></th>
                    <th style="text-align: center;"><div><?php echo get_phrase('Edit');?></div></th>
                </tr>
              </thead>
              <tbody>
             <?php $count = 1;foreach($subjects as $row):?>
             <?php  if ($this->session->userdata('login_user_id') == $row['teacher_id']) { ?>
                <tr>
                <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
              <td style="text-align: center;"><?php echo $row['name'];?></td>
              <td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>

			    <td style="text-align: center;" class="text-nowrap">
          <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_subject/<?php echo $row['subject_id'];?>');" data-toggle="tooltip" data-original-title="Subject Activity"> <i class="fa fa-edit text-info m-r-10"></i> </a></td>
                </tr>
                 <?php } ?>
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