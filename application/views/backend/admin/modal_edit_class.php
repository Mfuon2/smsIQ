<?php 
$edit_data		=	$this->db->get_where('class' , array('class_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
					<font color="white"><?php echo get_phrase('Edit');?></font>
            	</div>
            </div>
            <br><hr><br>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/manage_classes/do_update/'.$row['class_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('Name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('Teacher');?></label>
                        <div class="col-sm-5">
                            <select name="teacher_id" class="form-control">
                                <option value=""><?php echo get_phrase('Select');?></option>
                                <?php 
                                $teachers = $this->db->get('teacher')->result_array();
                                foreach($teachers as $row2):
                                ?>
                                    <option value="<?php echo $row2['teacher_id'];?>"
                                        <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                            <?php echo $row2['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Update');?></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>
<?php
endforeach;
?>