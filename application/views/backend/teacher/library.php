<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Library');?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('Library');?></li>
        </ol>
    </div>
</div>


<div class="row">
	<div class="col-md-12">
    <div class="white-box">
		<div class="tab-content">
        <br>
            <div class="tab-pane box active" id="list">
              <div class="table-responsive">	
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th style="text-align: center;"><div>#</div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Name');?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Author');?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Description');?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Price');?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Class');?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Status');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1; foreach($books as $row):?>
                        <tr>
                            <td style="text-align: center;"><?php echo $count++;?></td>
							<td style="text-align: center;"><?php echo $row['name'];?></td>
							<td style="text-align: center;"><?php echo $row['author'];?></td>
							<td style="text-align: center;"><?php echo $row['description'];?></td>
							<td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type'=>'currency'))->row()->description; ?><?php echo $row['price'];?></td>
							<td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
							<td style="text-align: center;">
                            <?php if($row['status'] == 1):?>
                            <span class="label label-success"><?php echo get_phrase('Availab');?></span>
                            <?php endif;?>
                            <?php if($row['status'] == 0):?>
                            <span class="label label-danger"><?php echo get_phrase('Unavailab');?></span>
                            <?php endif;?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>

			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/library/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" required/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Author');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="author"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Price');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="price"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Class');?></label>
                                <div class="col-sm-5">
                                    <select name="class_id" class="form-control selectboxit" style="width:100%;">
                                    	<?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('Status');?></label>
                                <div class="col-sm-5">
                                    <select name="status" class="form-control selectboxit" style="width:100%;">
                                    	<option value="1"><?php echo get_phrase('Available');?></option>
                                    	<option value="0"><?php echo get_phrase('Unavailable');?></option>
                                    </select>
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
    </div>
</div>