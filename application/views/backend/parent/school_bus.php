<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('School-Bus');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
  		    <li><a href="<?php echo base_url(); ?>index.php?parents/parents_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('School-Bus');?></a></li>
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
                  <th style="text-align: center;"><div><?php echo get_phrase('Route');?></div></th>
                        <th style="text-align: center;"><div><?php echo get_phrase('Enrollment-bus');?></div></th>
              <th style="text-align: center;"><div><?php echo get_phrase('Driver-Name');?></div></th>
                        <th style="text-align: center;"><div><?php echo get_phrase('Driver-Phone');?></div></th>
                        <th style="text-align: center;"><div><?php echo get_phrase('Amount');?></div></th>
                </tr>
              </thead>
              <tbody>
              <?php $count = 1;foreach($transports as $row):?>
                <tr>
               <td style="text-align: center;"><?php echo $row['route_name'];?></td>
              <td style="text-align: center;"><?php echo $row['number_of_vehicle'];?></td>
              <td style="text-align: center;"><?php echo $row['driver_name'];?></td>
              <td style="text-align: center;"><?php echo $row['driver_phone'];?></td>
              <td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['route_fare'];?></td>
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