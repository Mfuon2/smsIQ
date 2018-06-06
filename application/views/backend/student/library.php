<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Library');?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
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
                            <span class="label label-success"><?php echo get_phrase('Available');?></span>
                            <?php endif;?>
                            <?php if($row['status'] == 0):?>
                            <span class="label label-danger"><?php echo get_phrase('Unavailable');?></span>
                            <?php endif;?>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
    </div>
</div>