<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Teachers');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
  		    <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('Teachers');?></a></li>
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
                  <th style="text-align: center;"><?php echo get_phrase('Photo'); ?></th>
                  <th style="text-align: center;"><?php echo get_phrase('Name'); ?></th>
                  <th style="text-align: center;"><?php echo get_phrase('Birthday'); ?></th>
                  <th style="text-align: center;"><?php echo get_phrase('Email'); ?></th>
                  <th style="text-align: center;"><?php echo get_phrase('Phone'); ?></th>
                </tr>
              </thead>
              <tbody>
               <?php $teachers = $this->db->get('teacher' )->result_array();
                   foreach($teachers as $row):?>
                <tr>
                  <td style="text-align: center;"><img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" class="img-circle" width="30" /></td>
                  <td style="text-align: center;"><?php echo $row['name'];?></td>

                  <td style="text-align: center;">
                  <?php $teacher_birthday = $row['birthday'];
                      list ($day, $month, $year) = split("-", $teacher_birthday);
                        $now = date("m");
                      if ($now == $month):?>
                    <center><div class="badge badge-info">
                        <i class="icon-present"></i> <?php echo get_phrase('This-Month');?>
                    </div></center>
                <?php endif;?> 
                <?php if($now != $month):?>
                  <?php echo $row['birthday'];?>
                <?php endif;?>
                    </td>
                  <td style="text-align: center;"><?php echo $row['email'];?></td>
                  <td style="text-align: center;"><?php echo $row['phone'];?></td>
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