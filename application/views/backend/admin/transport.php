<hr/>
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('List');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('New');?>
                </a></li>
		</ul>
   
		<div class="tab-content">
        <br>
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
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
							<td style="text-align: center;">
                            <div class="btn-group">
                                <button type="button" class="btn btn-blue btn-sm dropdown-toggle" data-toggle="dropdown">
                               <?php echo get_phrase('Options');?><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-blue pull-right" role="menu">
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_transport_student/<?php echo $row['transport_id'];?>');">
                                            <i class="entypo-users"></i>
                                               <?php echo get_phrase('Students');?>
                                            </a>
                                    </li>
                                    <li class="divider"></li>
                                    
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_transport/<?php echo $row['transport_id'];?>');">
                                            <i class="entypo-pencil"></i>
                                               <?php echo get_phrase('Edit');?>
                                            </a>
                                                    </li>
                                    <li class="divider"></li>
                                    
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/transport/delete/<?php echo $row['transport_id'];?>');">
                                            <i class="entypo-trash"></i>
                                               <?php echo get_phrase('Delete');?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>

			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/transport/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

                           
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
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
		</div>
	</div>
</div>