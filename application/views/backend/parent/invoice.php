 <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo get_phrase('Students-Payments'); ?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?parents/parents_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Students-Payments'); ?></li>
        </ol>
    </div>
</div>

<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>

<?php 
    $child_of_parent = $this->db->get_where('student' , array(
        'student_id' => $student_id
    ))->result_array();
    foreach ($child_of_parent as $row):
?>
<div class="label label-info pull-right" style="font-size: 14px;">
    <i class="entypo-user"></i> <?php echo $row['name'];?>
</div>
<br><br>
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
                            <th style="text-align: center;"><div><?php echo get_phrase('Status');?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Date'); ?></div></th>
                            <th style="text-align: center;"><div><?php echo get_phrase('Options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php 
                            $invoices = $this->db->get_where('invoice' , array(
                                'student_id' => $row['student_id']
                            ))->result_array();
                            foreach($invoices as $row2):
                        ?>
                        <tr>
							<td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('student',$row2['student_id']);?></td>
							<td style="text-align: center;"><?php echo $row2['title'];?></td>
							<td style="text-align: center;"><?php echo $row2['description'];?></td>
							<td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row2['amount'];?></td>
                            <td style="text-align: center;"><span class="label label-<?php if($row2['status']=='paid') echo 'success'; else echo 'danger';?>"><?php echo $row2['status'];?></span>
                            </td>
							<td><?php echo date('d M,Y', $row2['creation_timestamp']);?></td>
                            <td>
                            <?php echo form_open(base_url() . 'index.php?parents/invoice/' . $row['student_id'] . '/make_payment');?>
                                    <input type="hidden" name="invoice_id" value="<?php echo $row2['invoice_id'];?>" />
                                        <button type="submit" class="btn btn-info" <?php if($row2['status'] == 'paid'):?> disabled="disabled"<?php endif;?>>
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
<?php endforeach;?>
