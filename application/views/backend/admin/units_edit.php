<?php 
$edit_data		=	$this->db->get_where('exam' , array('exam_id' => $param2) )->result_array();
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
<hr><br>
			<div class="panel-body">	
                <?php echo form_open(base_url() . 'index.php?admin/semesters/edit/do_update/'.$row['exam_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Semester');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>"/>
                    </div>
                </div>
      
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="comment" value="<?php echo $row['comment'];?>"/>
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





