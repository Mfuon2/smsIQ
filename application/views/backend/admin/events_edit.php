<?php  $edit =	$this->db->get_where('events' , array('event_id' => $param2) )->result_array();
foreach ($edit as $row):
?>
<br><br>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info" data-collapsed="0">
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/events/edit/'.$row['event_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="panel-heading">
                <div class="panel-title" >
                    <i class="entypo-plus-circled"></i>
                    <font color="white"><?php echo get_phrase('Events');?></font>
                </div>
            </div>
            <br>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('Title');?></label>
                    <div class="col-sm-5 controls">
                        <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>"/>
                    </div>
                </div>

                <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                        
                    <textarea class="textarea_editor form-control"  name="description" id="description" rows="7"><?php echo $row['description'];?></textarea>
                    </div>

            
                     <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('From');?></label>
               <div class="col-md-12">
           <input type="text" name="datefrom" value="<?php echo $row['datefrom']; ?>" class="form-control mydatepicker">
            </div>

                    </div>

                    <div class="form-group">
            <label class="control-label" style="margin-bottom: 5px;"><?php echo get_phrase('To');?></label>
               <div class="col-md-12">
           <input type="text" name="dateto" value="<?php echo $row['dateto']; ?>" class="form-control mydatepicker">
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




  <script>
        $(document).ready(function () {
            $('.textarea_editor').wysihtml5();
        });
    </script>