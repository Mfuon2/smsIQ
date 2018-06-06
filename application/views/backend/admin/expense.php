<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Expense');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('Expense');?></a></li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
     <div class="white-box">
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-docs"></i> 
                  <?php echo get_phrase('Expense');?>
                        </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('New-Expense');?>
                </a>
            </li>
            <li>
                <a href="#category" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('Expense-Category');?>
                </a>
            </li>
            <li>
                <a href="#addcategory" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('New-Category');?>
                </a>
            </li>
        </ul>
        <div class="tab-content">
        <br>
            <div class="tab-pane box active" id="list"> 
    <table class="table table-bordered table-striped datatable" id="table_export">
    <thead>
        <tr>
            <th style="text-align: center;"><div>No.</div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Title');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Category');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Method');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Amount');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Date');?></div></th>
            <th><div><?php echo get_phrase('Options');?></div></th>
        </tr>
    </thead>
        <tbody>
        <?php 
            $count = 1;
            $this->db->where('payment_type' , 'expense');
            $this->db->where('year' , $running_year);
            $this->db->order_by('timestamp' , 'desc');
            $expenses = $this->db->get('payment')->result_array();
            foreach ($expenses as $row):
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $count++;?></td>
            <td style="text-align: center;"><?php echo $row['title'];?></td>
            <td style="text-align: center;"><?php 
            if ($row['expense_category_id'] != 0 || $row['expense_category_id'] != '')
            echo $this->db->get_where('expense_category' , array('expense_category_id' => $row['expense_category_id']))->row()->name;
                ?>
            </td>
            <td style="text-align: center;">
                <?php 
                    if ($row['method'] == 1)
                        echo get_phrase('Cash');
                    if ($row['method'] == 2)
                        echo get_phrase('Check');
                    if ($row['method'] == 3)
                        echo get_phrase('Card');
                ?>
            </td>
            <td style="text-align: center;"><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['amount'];?></td>
            <td style="text-align: center;"><?php echo date('d M,Y', $row['timestamp']);?></td>
            <td> 
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                    <?php echo get_phrase('Options');?><span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-blue pull-right" role="menu">
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_edit/<?php echo $row['payment_id'];?>');">
                                <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('Edit');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/expense/delete/<?php echo $row['payment_id'];?>');">
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('Delete');?>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</div>


<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                  <?php echo form_open(base_url() . 'index.php?admin/expense/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<div class="padded">
                <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Title');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>" value="" autofocus>
                        </div>
                </div>

                <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Category');?></label>
                        <div class="col-sm-6">
                            <select name="expense_category_id" class="form-control selectboxit" required>
                                <option value=""><?php echo get_phrase('Select');?></option>
                                <?php 
                                    $categories = $this->db->get('expense_category')->result_array();
                                    foreach ($categories as $row):
                                ?>
                                <option value="<?php echo $row['expense_category_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                </div>

                <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Description');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="description" value="" >
                        </div> 
                </div>

                <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Amount');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="amount" value=""
                                data-validate="required" data-message-required="<?php echo get_phrase('Required');?>">
                        </div> 
                </div>

                <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Method');?></label>
                        <div class="col-sm-6">
                            <select name="method" class="form-control selectboxit">
                                <option value="1"><?php echo get_phrase('Cash');?></option>
                                <option value="2"><?php echo get_phrase('Check');?></option>
                                <option value="3"><?php echo get_phrase('Card');?></option>
                            </select>
                        </div>
                </div>

                 <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Date');?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control mydatepicker" name="timestamp"
                                data-validate="required" data-message-required="<?php echo get_phrase('Required');?>"/>
                        </div>
                </div>

                 <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
                        </div>
                </div>
              <?php echo form_close();?>
            </div>                  
         </div>              
</div>    



<div class="tab-pane box" id="category" style="padding: 5px"> 
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th style="text-align: center;"><div>No.</div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Name');?></div></th>
            <th><div><?php echo get_phrase('Options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $count = 1;
            $expenses = $this->db->get('expense_category')->result_array();
            foreach ($expenses as $row):
        ?>
        <tr>
            <td style="text-align: center;"><?php echo $count++;?></td>
            <td style="text-align: center;"><?php echo $row['name'];?></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                      <?php echo get_phrase('Options');?><span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-info pull-right" role="menu">
                        <li>
                            <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_category_edit/<?php echo $row['expense_category_id'];?>');">
                                <i class="entypo-pencil"></i>
                                    <?php echo get_phrase('Edit');?>
                            </a>
                        </li>
                        <li class="divider"></li>
                
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/expense_category/delete/<?php echo $row['expense_category_id'];?>');">
                                <i class="entypo-trash"></i>
                                <?php echo get_phrase('Delete');?>
                            </a>
                        </li>
                    </ul>
                </div>
                
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</div>


<div class="tab-pane box" id="addcategory" style="padding: 5px">
                <div class="box-content">
                  <?php echo form_open(base_url() . 'index.php?admin/expense_category/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

<div class="padded">
                <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Name');?></label>
                        
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('Required');?>" value="" autofocus>
                        </div>
                    </div>

                <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
                        </div>
                    </div>
                <?php echo form_close();?>
            </div>                  
         </div>              
        </div>   
     </div>
    </div>
</div>
</div>