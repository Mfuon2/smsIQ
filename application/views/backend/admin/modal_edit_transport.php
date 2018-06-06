<?php 
$edit_data		=	$this->db->get_where('transport' , array('transport_id' => $param2) )->result_array();
?>
<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/school_bus/do_update/'.$row['transport_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <br><br><hr>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Route');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="route_name" value="<?php echo $row['route_name'];?>"
                            data-validate="required" data-message-required="<?php echo get_phrase('Required');?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Enrollment-bus');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="number_of_vehicle" value="<?php echo $row['number_of_vehicle'];?>"/>
                    </div>
                </div>
				 <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Driver-Name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="driver_name" value="<?php echo $row['driver_name'];?>"/>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Driver-Phone');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="driver_phone" value="<?php echo $row['driver_phone'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Amount');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="route_fare" value="<?php echo $row['route_fare'];?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>