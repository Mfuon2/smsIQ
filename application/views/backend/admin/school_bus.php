<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('School-Bus');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
  		    <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('School-Bus');?></a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab">
					<?php echo get_phrase('School-Bus');?>
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
                  <th style="text-align: center;"><div><?php echo get_phrase('Route');?></div></th>
                        <th style="text-align: center;"><div><?php echo get_phrase('Enrollment-bus');?></div></th>
              <th style="text-align: center;"><div><?php echo get_phrase('Driver-Name');?></div></th>
                        <th style="text-align: center;"><div><?php echo get_phrase('Driver-Phone');?></div></th>
                        <th style="text-align: center;"><div><?php echo get_phrase('Amount');?></div></th>
                        <th style="text-align: center;"><div><?php echo get_phrase('Options');?></div></th>
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

			         <td style="text-align: center;" class="text-nowrap"><a href="#" data-toggle="tooltip" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_transport_student/<?php echo $row['transport_id'];?>');" data-original-title="Students"> <i class="fa fa-users text-info"></i> </a><a href="#" data-toggle="tooltip" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_transport/<?php echo $row['transport_id'];?>');" data-original-title="Edit"> <i class="fa fa-edit text-info"></i> </a><a href="#" data-toggle="tooltip" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/school_bus/delete/<?php echo $row['transport_id'];?>');" data-original-title="Delete"> <i class="fa fa-trash text-danger"></i> </a></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            </div>
            </div>
          </div>

	<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                <?php echo form_open(base_url() . 'index.php?admin/school_bus/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

        <div class="col-md-12">
          <div class="white-box">
            <h3 class="box-title m-b-0"><?php echo get_phrase('New');?></h3>
            <br><br>
				<div class="padded">
		     
		     		 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Route');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="route_name"
                                        data-validate="required" data-message-required="<?php echo get_phrase('Required');?>"/>
                                </div>
                            </div>

                              <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Enrollment-bus');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="number_of_vehicle"/>
                                </div>
                            </div>
               <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Driver-Name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="driver_name"/>
                                </div>
                            </div>
               <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Driver-Phone');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="driver_phone"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Amount');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="route_fare"/>
                                </div>
                            </div>
        </div>
						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
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