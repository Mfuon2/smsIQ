 <div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Sections'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
        	<li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
        	<li class="active"><?php echo get_phrase('Sections'); ?></li></ol>                
    </div>
</div>

<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/section_add/');" 
	class="btn btn-info pull-right">
			<?php echo get_phrase('Add');?>
</a> 
<br><br><br>

<div class="row">
	<div class="col-md-12">
	<div class="white-box">
		<div class="tabs-vertical-env">
		<div class="nav nav-tabs">
			<ul class="nav customtab nav-tabs">
			<?php 
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
			?>
				<li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php?admin/section/<?php echo $row['class_id'];?>">
						<i class="entypo-right-circled"></i>
				<?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
			</ul>
		 </div>
		</div>	
			
		
		<div class="tab-content">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th style="text-align: center;"><?php echo get_phrase('Section');?></th>
							<th style="text-align: center;"><?php echo get_phrase('Teacher');?></th>
							<th style="text-align: center;"><?php echo get_phrase('Edit');?></th>
							<th style="text-align: center;"><?php echo get_phrase('Delete');?></th>
						</tr>
					</thead>
				<tbody>
						<?php
							$sections = $this->db->get_where('section' , array(
								'class_id' => $class_id
							))->result_array();
							foreach ($sections as $row):
						?>
							<tr>
								<td style="text-align: center;"><?php echo $row['name'];?></td>
								<td style="text-align: center;">
									<?php if ($row['teacher_id'] != '' || $row['teacher_id'] != 0)
											echo $this->db->get_where('teacher' , array('teacher_id' => $row['teacher_id']))->row()->name;
										?>
								</td>
								 <td style="text-align: center;" class="text-nowrap"><a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/section_edit/<?php echo $row['section_id'];?>');" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-edit text-info m-r-10"></i> </a></td>

								 <td style="text-align: center;" class="text-nowrap"><a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/sections/delete/<?php echo $row['section_id'];?>');" data-toggle="tooltip" data-original-title="Delete"> <i class="fa fa-trash text-danger m-r-10"></i> </a></td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
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