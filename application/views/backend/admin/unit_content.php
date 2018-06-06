<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                     <h4 class="page-title"><?php echo get_phrase('SemesterContent');?></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url();?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
                            <li class="active"><?php echo get_phrase('SemesterContent');?></li>
                        </ol>
    </div>
</div>

<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/upload_unit_content/');" 
	class="btn btn-primary pull-right">
    	<i class="entypo-plus-circled"></i>
			<?php echo get_phrase('Upload');?>
</a> 
<br><br><br>
<div class="row">
	<div class="col-md-12">
	<div class="white-box">
		<div class="tabs-vertical-env">
		<div class="nav nav-tabs">
			<ul class="nav customtab nav-tabs">
			<?php 
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
			?>
				<li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php?admin/unit_content/<?php echo $row['class_id'];?>">
						<i class="entypo-right"></i>
						 <?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
			</ul></div>
			
			<div class="tab-content">
				<div class="tab-pane active">
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th><center>#</center></th>
								<th><center><?php echo get_phrase('Title');?></center></th>
								<th><center><?php echo get_phrase('Description');?></center></th>
                                <th><center><?php echo get_phrase('Subject');?></center></th>
								<th><center><?php echo get_phrase('By');?></center></th>
								<th><center><?php echo get_phrase('Date');?></center></th>
								<th><center><?php echo get_phrase('File');?></center></th>
								<th><center><?php echo get_phrase('Download');?></center></th>
								<th><center><?php echo get_phrase('Delete');?></center></th>
							</tr>
						</thead>
						<tbody>
						<?php
							$count    = 1;
							$syllabus = $this->db->get_where('academic_syllabus' , array(
								'class_id' => $class_id , 'year' => $running_year
							))->result_array();
							foreach ($syllabus as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['title'];?></td>
								<td><?php echo $row['description'];?></td>
                                <td>
									<?php 
										echo $this->db->get_where('subject' , array(
											'subject_id' => $row['subject_id']
										))->row()->name;
									?>
								</td>
								<td>
									<?php 
										echo $this->db->get_where($row['uploader_type'] , array(
											$row['uploader_type'].'_id' => $row['uploader_id']
										))->row()->name;
									?>
								</td>
								<td><?php echo date("d/m/Y" , $row['timestamp']);?></td>
								<td>
									<?php echo substr($row['file_name'], 0, 20);?><?php if(strlen($row['file_name']) > 20) echo '...';?>
								</td>
								<td align="center">
									<a class="btn btn-blue"
										href="<?php echo base_url();?>index.php?admin/download_unit_content/<?php echo $row['academic_syllabus_code'];?>">
										<i class="fa fa-download"></i> <?php echo get_phrase('Download');?>
									</a>
								</td>
								<td align="center">
									<a class="btn btn-red"
										href="<?php echo base_url();?>index.php?admin/delete_unit_content/<?php echo $row['academic_syllabus_id'];?>">
										<i class="fa fa-trash"></i> <?php echo get_phrase('Delete');?>
									</a>
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
</div>