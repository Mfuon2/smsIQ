<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Documents');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
  		    <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('Documents');?></a></li>
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
                  <th style="text-align: center;">#</th>
                <th style="text-align: center;"><?php echo get_phrase('Date');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Name');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Description');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Download');?></th>
                </tr>
              </thead>
              <tbody>
              <?php
        $count = 1;
        foreach ($poa_info as $row) { ?>   
                <tr>
                 <td style="text-align: center;"><?php echo $count++; ?></td>
                <td style="text-align: center;"><?php echo date("d M, Y", $row['timestamp']); ?></td>
                <td style="text-align: center;"><?php echo $row['titulo']?></td>
                <td style="text-align: center;"><?php echo $row['descripcion']?></td>
			         <td style="text-align: center;" class="text-nowrap"><a href="<?php echo base_url().'uploads/poa/'.$row['nombre_archivo']; ?>" data-toggle="tooltip" data-original-title="Download"> <i class="fa fa-download text-info"></i> </a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
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