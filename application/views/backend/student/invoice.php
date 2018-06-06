<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Student-Payment');?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('Student-Payment');?></li>
        </ol>
    </div>
</div>


<div class="row">
	<div class="col-md-12">
    <div class="white-box">
		<div class="tab-content">
            <div class="tab-pane box active" id="list">
                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Student'); ?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Title'); ?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Description'); ?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Amount'); ?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Date'); ?></div></th>
                            <th style="text-align: center;"><div><?php echo get_phrase('Status');?></div></th>
                            <th style="text-align: center;"><div><?php echo get_phrase('Options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($invoices as $row):?>
                        <tr>
							<td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td style="text-align: center;"><?php echo $row['title'];?></td>
							<td style="text-align: center;"><?php echo $row['description'];?></td>
							<td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['amount'];?></td>
							<td style="text-align: center;"><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
                            <td style="text-align: center;">
                                <span class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'danger';?>"><?php echo $row['status'];?></span>
                            </td>
                            <td style="text-align: center;">
                            <?php echo form_open('student/invoice/make_payment');?>
                                    <input type="hidden" name="invoice_id" value="<?php echo $row['invoice_id'];?>" />
                                        <button type="submit" class="btn btn-info" <?php if($row['status'] == 'paid'):?> disabled="disabled"<?php endif;?>>
                                            <i class="icon-paypal"></i> Pay with PayPal
                                        </button>
                                </form>
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