<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Virtual-Library');?></h4> 
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?teacher/teacher_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li class="active"><?php echo get_phrase('Virtual-Library');?></li>
        </ol>
    </div>
</div>



<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/agregar_libro/');" 
	class="btn btn-info pull-right">
			<?php echo get_phrase('Upload');?>
</a> 
<br><br><br>

<div class="row">
	<div class="col-md-12">
	<div class="white-box">
		<div class="tabs-vertical-env">
			<ul class="nav customtab nav-tabs">
			<?php 
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
			?>
				<li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php?teacher/virtual_library/<?php echo $row['class_id'];?>">
						<i class="entypo-right"></i>
					<?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
			</ul>
			
			<div class="tab-content">
				<div class="tab-pane active">
<div class="table-responsive">	
					<table class="table table-bordered responsive">
						<thead>
							<tr>
								<th style="text-align: center;"><?php echo get_phrase('Name');?></th>
								<th style="text-align: center;"><?php echo get_phrase('Autor');?></th>
								<th style="text-align: center;"><?php echo get_phrase('Description');?></th>
                                <th style="text-align: center;"><?php echo get_phrase('Subject');?></th>
								<th style="text-align: center;"><?php echo get_phrase('By');?></th>
								<th style="text-align: center;"><?php echo get_phrase('Date');?></th>
								<th style="text-align: center;"><?php echo get_phrase('Download');?></th>
							</tr>
						</thead>
						<tbody>
						<?php
							$syllabus = $this->db->get_where('libreria' , array(
								'class_id' => $class_id , 'year' => $running_year
							))->result_array();
							foreach ($syllabus as $row):
						?>
							<tr>
								<td style="text-align: center;"><?php echo $row['nombre'];?></td>
								<td style="text-align: center;"><?php echo $row['autor'];?></td>
								<td style="text-align: center;"><?php echo $row['description'];?></td>
                                <td style="text-align: center;"><?php echo $this->db->get_where('subject' , array(
								'subject_id' => $row['subject_id']))->row()->name;?>
								</td>
								<td style="text-align: center;"><?php 
									echo $this->db->get_where($row['uploader_type'] , array(
									$row['uploader_type'].'_id' => $row['uploader_id']
									))->row()->name;?>
								</td>
								<td style="text-align: center;"><?php echo date("d/m/Y" , $row['timestamp']);?></td>
								<td style="text-align: center;">
									<a class="btn btn-info"
										href="<?php echo base_url();?>index.php?teacher/download_book/<?php echo $row['libro_code'];?>">
										<i class="fa fa-download"></i> <?php echo get_phrase('Download');?>
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
</div>