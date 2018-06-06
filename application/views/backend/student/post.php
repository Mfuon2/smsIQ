<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php $posts = $this->db->get_where('forum' , array('post_code' => $post_code))->result_array();
    foreach ($posts as $row):
?>
<div class="col-md-7">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="panel-title"><font color="white"><?php echo get_phrase('Details'); ?></font></div>
        </div>
        
        <div class="panel-body">   
            <p><?php echo $row['description'];?></p>
            <hr />
            <p style="font-size: 10px;">
                <i class="fa fa-calendar" style="color: #ccc;"></i>
                <?php echo date("d/m/Y", $row['timestamp']);?>
            </p>
        </div>
    </div>
    <div class="message_container">
    <?php include 'comments.php'; ?>
        </div>
</div>

<div class="col-md-3">
        <div class="panel panel-warning" data-collapsed="0">
            <div class="panel-heading">
            <div class="panel-title">
                <font color="white"><i class="fa fa-graduation-cap"></i> <?php echo get_phrase('Students'); ?></font>
            </div>
        </div>
            <div class="panel-body">
        <?php $students   =   $this->db->get_where('enroll' , array('class_id' => $row['class_id'], 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
                foreach($students as $row2):?>
                                <table width="100%" border="0">
                                    <tr>
                        <td rowspan="2" width="60">
                                    <img src="<?php echo $this->crud_model->get_image_url('student', $row2['student_id']); ?>" 
                                                 alt="" class="img-circle" width="30">
                                     </td>
                                  <td>
                                 <h4><?php echo $this->db->get_where('student' , array('student_id' => $row2['student_id']))->row()->name; ?></h4>
                             </td>
                          </tr>
                       </table>
                    <?php endforeach;?>
                <br>
            </div>
        </div>
</div>
<?php endforeach;?>