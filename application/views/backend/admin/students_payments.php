<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('StudentPayment');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('StudentPayment');?></a></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
			<div class="white-box">
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a href="#unpaid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('invoices');?></span>
					</a>
				</li>
				<li>
					<a href="#paid" data-toggle="tab">
						<span class="hidden-xs"><?php echo get_phrase('payment_history');?></span>
					</a>
				</li>
			</ul>
			
			<div class="tab-content">
			<br>
				<div class="tab-pane active" id="unpaid">	
				<div class="table-responsive">	
						<table  id="myTable" class="table table-striped">
                	<thead>
                		<tr>
                			<th style="text-align: center;">#</th>
                    		<th style="text-align: center;"><?php echo get_phrase('Student');?></th>
                    		<th style="text-align: center;"><?php echo get_phrase('Title');?></th>
                            <th style="text-align: center;"><?php echo get_phrase('Total');?></th>
                            <th style="text-align: center;"><?php echo get_phrase('Amount');?></th>
                            <th style="text-align: center;"><?php echo get_phrase('Status');?></th>
                    		<th style="text-align: center;"><?php echo get_phrase('Date');?></th>
                    		<th style="text-align: center;"><?php echo get_phrase('Options');?></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
                    		$count = 1;
                    		$this->db->where('year' , $running_year);
                    		$this->db->order_by('creation_timestamp' , 'desc');
                    		$invoices = $this->db->get('invoice')->result_array();
                    		foreach($invoices as $row): ?>
                        <tr>
                        	<td style="text-align: center;"><?php echo $count++;?></td>
							<td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td style="text-align: center;"><?php echo $row['title'];?></td>
							<td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type'=>'currency'))->row()->description; ?><?php echo $row['amount'];?></td>
                            <td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type'=>'currency'))->row()->description; ?><?php echo $row['amount_paid'];?></td>
                            <?php if($row['due'] == 0):?>
                            	<td style="text-align: center;">
                            		<button class="btn btn-info btn-xs"><?php echo get_phrase('Paid');?></button>
                            	</td>
                            <?php endif;?>
                            <?php if($row['due'] > 0):?>
                            	<td style="text-align: center;">
                            		<button class="btn btn-danger btn-xs"><?php echo get_phrase('Unpaid');?></button>
                            	</td>
                            <?php endif;?>
							<td style="text-align: center;"><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							 <td style="text-align: center;" class="text-nowrap">
							 <a href="#" data-toggle="tooltip" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');" data-original-title="Edit"> <i class="fa fa-edit text-info"></i> </a>
							 <a href="#" data-toggle="tooltip" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');" data-original-title="Delete"> <i class="fa fa-trash text-danger"></i> </a></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
				</div>
				</div>
				<div class="tab-pane" id="paid">
				<div class="table-responsive">
					<table id="myTable" class="table table-striped">
					    <thead>
					        <tr>
					            <th style="text-align: center;">#</th>
					            <th style="text-align: center;"><?php echo get_phrase('Title');?></th>
					            <th style="text-align: center;"><?php echo get_phrase('Description');?></th>
					            <th style="text-align: center;"><?php echo get_phrase('Method');?></th>
					            <th style="text-align: center;"><?php echo get_phrase('Amount');?></th>
					            <th style="text-align: center;"><?php echo get_phrase('Date');?></th>
					        </tr>
					    </thead>
					    <tbody>
					        <?php 
					        	$count = 1;
					        	$this->db->where('payment_type' , 'income');
					        	$this->db->order_by('timestamp' , 'desc');
					        	$payments = $this->db->get('payment')->result_array();
					        	foreach ($payments as $row):
					        ?>
					        <tr>
					            <td style="text-align: center;"><?php echo $count++;?></td>
					            <td style="text-align: center;"><?php echo $row['title'];?></td>
					            <td style="text-align: center;"><?php echo $row['description'];?></td>
					            <td style="text-align: center;">
					            	<?php 
					            		if ($row['method'] == 1)
					            			echo get_phrase('Cash');
					            		if ($row['method'] == 2)
					            			echo get_phrase('Check');
					            		if ($row['method'] == 3)
					            			echo get_phrase('Card');
					                    if ($row['method'] == 'Paypal')
					                    	echo 'paypal';
					            	?>
					            </td>
					            <td><?php echo $this->db->get_where('settings' , array('type'=>'currency'))->row()->description; ?><?php echo $row['amount'];?></td>
					            <td><?php echo date('d M,Y', $row['timestamp']);?></td>
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
  </script>   