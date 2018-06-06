<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
       <h4 class="page-title"><?php echo get_phrase('Semester-Content'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Semester-Content'); ?></li>
        </ol>
    </div>
</div>

<div class="row">
<div class="white-box">
    <button class="btn btn-primary pull-right">
        <i class="entypo-user"></i> <?php echo $this->crud_model->get_type_name_by_id('student', $student_id); ?>
    </button>
    <br><br>
    <table class="table table-bordered responsive">
        <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;"><?php echo get_phrase('Title'); ?></th>
                <th style="text-align: center;"><?php echo get_phrase('Description'); ?></th>
                <th style="text-align: center;"><?php echo get_phrase('Subject'); ?></th>
                <th style="text-align: center;"><?php echo get_phrase('By'); ?></th>
                <th style="text-align: center;"><?php echo get_phrase('Date'); ?></th>
                <th style="text-align: center;"><?php echo get_phrase('Download'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; $class_id = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year))->row()->class_id;
            $syllabus = $this->db->get_where('academic_syllabus', array('class_id' => $class_id, 'year' => $running_year))->result_array();
            foreach ($syllabus as $row):
                ?>
                <tr>
                    <td style="text-align: center;"><?php echo $count++; ?></td>
                    <td style="text-align: center;"><?php echo $row['title']; ?></td>
                    <td style="text-align: center;"><?php echo $row['description']; ?></td>
                    <td style="text-align: center;"><?php echo $this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name; ?>
                    </td>
                    <td style="text-align: center;"><?php echo $this->db->get_where($row['uploader_type'], array($row['uploader_type'] . '_id' => $row['uploader_id']))->row()->name; ?>
                    </td>
                    <td style="text-align: center;"><?php echo date("d/m/Y", $row['timestamp']); ?></td>
                    <td style="text-align: center;">
                        <a class="btn btn-info"
                           href="<?php echo base_url(); ?>index.php?student/download_unit_content/<?php echo $row['academic_syllabus_code']; ?>">
                            <i class="entypo-download"></i> <?php echo get_phrase('Download'); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>