<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="panel-title">
					<font color="white"><i class="fa fa-graduation-cap"></i>
					<?php echo get_phrase('Students');?></font>
				</div>
			</div>
	
			<div class="panel-body with-table">
				<table class="table  table-bordered table-hover table-striped">
					<tbody>
						<?php 
							$this->db->like('name' , $search_key);
							$this->db->or_like('email' , $search_key);
							$this->db->or_like('phone' , $search_key);
							$this->db->or_like('address' , $search_key);
							$student_query = $this->db->get('student');
						?>
						<?php 
							if ($student_query->num_rows() > 0):
								$students = $student_query->result_array();
								foreach ($students as $row):
						?>
						<tr>
							<td><?php echo $row['name'];?></td>
							<td>
				            	<a href="<?php echo base_url(); ?>index.php?admin/student_portal/<?php echo $row['student_id']; ?>" class="btn btn-warning">
                                	<font color="white"><?php echo get_phrase('Profile');?> <i class="fa fa-user"></font></i>
                            	</a>
				           </td>
						   <td>
				            	<a href="<?php echo base_url(); ?>index.php?admin/student_portal/<?php echo $row['student_id']; ?>" class="btn btn-info">
                                <font color="white"><?php echo get_phrase('Qualifications');?> <i class="fa fa-graduation-cap"></i></font>
                            	</a>
				           </td>
						</tr>
						<?php 
							endforeach;
							endif;
						?>

						<?php if ($student_query->num_rows() < 1):?>
							<td class="text-center">
								 <strong><?php echo get_phrase('Not-Found');?></strong>
							</td>
						<?php endif;?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>