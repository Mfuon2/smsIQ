<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
       <h4 class="page-title"><?php echo get_phrase('Study-Material'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Study-Material'); ?></li>
        </ol>
    </div>
</div>

<div class="white-box">
<table class="table table-bordered table-striped datatable">
    <thead>
        <tr>
            <th>No.</th>
            <th style="text-align: center;"><?php echo get_phrase('Date'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Title'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Description'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Class'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Subject'); ?></th>
            <th style="text-align: center;"><?php echo get_phrase('Download'); ?></th>
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
                <?php $name = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name; echo $name;?>
                </td>
                <td style="text-align: center;">
                <?php $name = $this->db->get_where('subject' , array('subject_id' => $row['subject_id'] ))->row()->name; echo $name;?>
                </td>
                <td style="text-align: center;">
                <a href="<?php echo base_url().'uploads/document/'.$row['file_name']; ?>" class="btn btn-info btn-icon icon-left">
                <i class="fa fa-download"></i><?php echo get_phrase('Download'); ?></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>