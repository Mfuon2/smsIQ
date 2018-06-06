<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Subjects'); ?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo get_phrase('Dashboard'); ?></a></li>
            <li class="active"><?php echo get_phrase('Subjects'); ?></li>
        </ol>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
	<div class="white-box">
		<div class="tab-content">            
            <div class="tab-pane box active" id="list">
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Class'); ?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Subject'); ?></div></th>
                    		<th style="text-align: center;"><div><?php echo get_phrase('Teacher'); ?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1; foreach($subjects as $row):?>
                        <tr>
							<td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
							<td style="text-align: center;"><?php echo $row['name'];?></td>
							<td style="text-align: center;"><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>            
		</div>
	</div>
</div>
</div>