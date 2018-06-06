<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Study-Material'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Study-Material'); ?></li>
        </ol>
    </div>
</div>

<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_study_material_add');" 
    class="btn btn-info pull-right"><?php echo get_phrase('Upload'); ?>
</button>
<div style="clear:both;"></div>
<br>
 <div class="white-box">
<div class="table-responsive">	
<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th style="text-align: center;">#</th>
            <th style="text-align: center;"><?php echo get_phrase('Date'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Title'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Description'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Class'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Subject'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Download'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Options'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        foreach ($study_material_info as $row) { ?>   
            <tr>
                <td style="text-align: center;"><?php echo $count++; ?></td>
                <td style="text-align: center;"><?php echo date("d M, Y", $row['timestamp']); ?></td>
                <td style="text-align: center;"><?php echo $row['title']?></td>
                <td style="text-align: center;"><?php echo $row['description']?></td>
                <td style="text-align: center;">
                    <?php $name = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td style="text-align: center;">
                    <?php $name = $this->db->get_where('subject' , array('subject_id' => $row['subject_id'] ))->row()->name;
                        echo $name;?>
                </td>
                <td style="text-align: center;">
                    <a href="<?php echo base_url().'uploads/document/'.$row['file_name']; ?>" class="btn btn-info btn-icon icon-left">
                        <i class="fa fa-download"></i>
                        <?php echo get_phrase('Download'); ?>
                    </a>
                </td>
                <td style="text-align: center;">
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_study_material_edit/<?php echo $row['document_id']?>');" 
                        class="btn btn-info btn-sm btn-icon icon-left">
                            <i class="fa fa-edit"></i><?php echo get_phrase('Edit'); ?>
                    </a>
                    <a href="<?php echo base_url();?>index.php?teacher/study_material/delete/<?php echo $row['document_id']?>" class="btn btn-danger btn-sm btn-icon icon-left" onclick="return confirm('<?php echo get_phrase('Are-you-sure'); ?>');">
                            <i class="fa fa-trash"></i><?php echo get_phrase('Delete'); ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</div>