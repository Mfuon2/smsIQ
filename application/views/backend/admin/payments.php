<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Payments');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('Payments');?></a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
            <div class="tab-content">
            <br>
                <div class="tab-pane active" id="unpaid">
                <?php echo form_open(base_url() . 'index.php?admin/invoice/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="row">
                    <div class="col-md-6">
                            <div class="panel panel-default panel-shadow" data-collapsed="0">
                                <div class="panel-heading">
                                    <div class="panel-title"><?php echo get_phrase('Invoice');?></div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('Class');?></label>
                                        <div class="col-sm-9">
                                            <select name="class_id" class="form-control selectboxit"
                                                onchange="return get_class_students(this.value)">
                                                <option value=""><?php echo get_phrase('Select');?></option>
                                                <?php 
                                                    $classes = $this->db->get('class')->result_array();
                                                    foreach ($classes as $row):
                                                ?>
                                                <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('Student');?></label>
                                        <div class="col-sm-9">
                                            <select name="student_id" class="form-control" style="width:100%;" id="student_selection_holder">
                                                <option value=""><?php echo get_phrase('Select');?></option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('Title');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="title"
                                                required="" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="description"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('Date');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control mydatepicker" name="date"
                                                required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title"><?php echo get_phrase('PaymentInfo');?></div>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('Total');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount"
                                            placeholder="<?php echo get_phrase('Amount');?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('Payment');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php echo get_phrase('PaymentAmount');?>"
                                            required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('Status');?></label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control selectboxit">
                                            <option value="paid"><?php echo get_phrase('Paid');?></option>
                                            <option value="unpaid"><?php echo get_phrase('Unpaid');?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('Method');?></label>
                                    <div class="col-sm-9">
                                        <select name="method" class="form-control selectboxit">
                                            <option value="1"><?php echo get_phrase('Cash');?></option>
                                            <option value="2"><?php echo get_phrase('Check');?></option>
                                            <option value="3"><?php echo get_phrase('Card');?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
    </div>
</div>

<script type="text/javascript">
    function get_class_students(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_students/' + class_id ,
            success: function(response)
            {
                jQuery('#student_selection_holder').html(response);
            }
        });
    }
</script>
