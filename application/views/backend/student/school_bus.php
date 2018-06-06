<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('School-Bus'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('School-Bus'); ?></li>
        </ol>
    </div>
</div>


<div class="row">
	<div class="col-md-12">
    <div class="white-box">
		<div class="tab-content">
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Route'); ?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Enrollment-bus'); ?></div></th>
                            <th style="text-align: center;"><div><?php echo get_phrase('Driver-Name'); ?></div></th>
                            <th style="text-align: center;"><div><?php echo get_phrase('Driver-Phone'); ?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Amount'); ?></div></th>
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