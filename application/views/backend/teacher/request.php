<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('List-Perm');?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('Create');?></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
     <div class="white-box">
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-docs"></i> 
                    <?php echo get_phrase('List-Perm');?>
                        </a></li>
                  <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('Create');?>
                        </a></li>
        </ul>
        <div class="tab-content">
        <br>
            <div class="tab-pane box active" id="list"> 
<div class="table-responsive">	
<table class="table table-bordered table-striped datatable" id="table_export">
    <thead>
        <tr>
            <th style="width: 60px;">No.</th>
            <th><?php echo get_phrase('Title');?></th>
            <th><?php echo get_phrase('Description');?></th>
            <th><?php echo get_phrase('By');?></th>
            <th><?php echo get_phrase('Start_Date');?></th>
            <th><?php echo get_phrase('End_Date');?></th>
            <th><?php echo get_phrase('Status');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        $this->db->order_by('request_id', 'desc');
        $requests = $this->db->get_where('request', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
        foreach ($requests as $row) { ?>   
            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']))->row()->name; ?></td>
                <td><?php echo $row['start_date']; ?></td>
                <td><?php echo $row['end_date']; ?></td>
                <td>
                    <?php
                        if($row['status'] == 0)
                            $status = '<span class="label label-info" style="font-size: 10px;">' . get_phrase('Pending') . '</span>';
                        else if($row['status'] == 1)
                            $status = '<span class="label label-success" style="font-size: 10px;">' . get_phrase('Nice') . '</span>';
                        else
                            $status = '<span class="label label-danger" style="font-size: 10px;">' . get_phrase('Rejected') . '</span>';
                        echo $status;
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
            </div>
            </div>
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
    
                 <?php echo form_open(base_url() . 'index.php?teacher/request/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                       
                <div class="padded">

                 <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Title');?></label>

                    <div class="col-sm-5">
                        <input type="text" name="title" class="form-control" id="field-1" >
                    </div>
                </div>

                <div class="form-group">
                    <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Description');?></label>
                    <div class="col-sm-5">
                        <textarea class="form-control wysihtml5" rows="10" name="description" id="post_content" 
                                  data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                    </div>
                </div>

                     <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('Start_Date');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="mydatepicker form-control" name="start_date"
                                required value="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"><?php echo get_phrase('End_Date');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="mydatepicker form-control" name="end_date"
                                required value="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-5">
                            <button type="submit" class="btn btn-info"><?php echo get_phrase('Send');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
                       </div>                  
                    </div> 
                <br><br><br>             
            </div>                
        </div>
    </div>
</div>
</div>