<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Documents');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
  		    <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('Documents');?></a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab">
					<?php echo get_phrase('Documents');?>
                </a>
            </li>
			<li><a href="#add" data-toggle="tab">
					<?php echo get_phrase('New');?>
            	</a>
            </li>
		</ul>

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
            <th style="text-align: center;"><?php echo get_phrase('Delete');?></th>
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
                <td style="text-align: center;" class="text-nowrap"><a href="<?php echo base_url();?>index.php?admin/teachers_files/delete/<?php echo $row['id_poa']?>" onclick="return confirm('<?php echo get_phrase('Are-you-sure');?>');" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-trash text-danger"></i> </a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            </div>
            </div>
          </div>

	<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                <?php echo form_open(base_url() . 'index.php?admin/documentos_docentes/create', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>

        <div class="col-md-12">
          <div class="white-box">
            <h3 class="box-title m-b-0"><?php echo get_phrase('New');?></h3>
            <br><br>
				<div class="padded">
		     
		     		 <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Name');?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" required="" name="timestamp" placeholder="<?php echo get_phrase('Date');?>">
                    </div>
                    </div>

					
					<div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Phone');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                      <input type="number" class="form-control" required="" name="phone" placeholder="<?php echo get_phrase('Phone');?>">
                    </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Address');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                      <input type="text" class="form-control" required="" name="address" placeholder="<?php echo get_phrase('Address');?>">
                    </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Profession');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-info"></i></div>
                      <input type="text" class="form-control" name="profession" placeholder="<?php echo get_phrase('Profession');?>">
                    </div>
                    </div>
                  </div>
        </div>
						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
							<span id="preloader-form"></span>
						</div>
						</div>
						 <?php echo form_close();?>
                    </form>                
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