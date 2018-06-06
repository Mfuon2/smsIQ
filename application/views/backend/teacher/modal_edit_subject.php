<?php 
$edit_data		=	$this->db->get_where('subject' , array('subject_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<font color="white"><?php echo get_phrase('Edit'); ?></font>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?teacher/subject/do_update/'.$row['subject_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <br>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Subject'); ?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" readonly name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 1";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la1" value="<?php echo $row['la1'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 2";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la2" value="<?php echo $row['la2'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 3";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la3" value="<?php echo $row['la3'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 4";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la4" value="<?php echo $row['la4'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 5";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la5" value="<?php echo $row['la5'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 6";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la6" value="<?php echo $row['la6'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 7";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la7" value="<?php echo $row['la7'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 8";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la8" value="<?php echo $row['la8'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo "Activity 9";?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="la9" value="<?php echo $row['la9'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Final-Exam'); ?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="final" value="<?php echo $row['final'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-5">
                        <button type="submit" class="btn btn-info"><?php echo get_phrase('Update'); ?></button>
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



