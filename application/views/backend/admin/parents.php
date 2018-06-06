<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Parents');?></h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
  		    <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo get_phrase('Dashboard');?></a></li>
            <li><a class="active"><?php echo get_phrase('Parents');?></a></li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab">
					<?php echo get_phrase('Parents');?>
                </a>
            </li>
			<li><a href="#add" data-toggle="tab">
					<?php echo get_phrase('New');?>
            	</a>
            </li>
		</ul>

<div class="tab-content">
		<div class="tab-pane box active" id="list">
          <div class="white-box">
            <div class="table-responsive">
            <table id="myTable" class="table table-striped">
              <thead>
                <tr>
                  <th style="text-align: center;"><?php echo get_phrase('Name');?></th>
				          <th style="text-align: center;"><?php echo get_phrase('Username');?></th>
                  <th style="text-align: center;"><?php echo get_phrase('Email');?></th>
			            <th style="text-align: center;"><?php echo get_phrase('Phone');?></th>
			            <th style="text-align: center;"><?php echo get_phrase('Profession');?></th>
			            <th style="text-align: center;"><?php echo get_phrase('Delete');?></th>
                </tr>
              </thead>
              <tbody>
              <?php 
		              $parents	=	$this->db->get('parent' )->result_array();
		              foreach($parents as $row):
		          ?>
                <tr>
                <td style="text-align: center;"><?php echo $row['name'];?></td>
            	  <td style="text-align: center;"><?php echo $row['username'];?></td>
                <td style="text-align: center;"><?php echo $row['email'];?></td>
            	  <td style="text-align: center;"><?php echo $row['phone'];?></td>
				        <td style="text-align: center;"><?php echo $row['profession'];?></td>
			         <td style="text-align: center;" class="text-nowrap"><a href="#" data-toggle="tooltip" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/parents/delete/<?php echo $row['parent_id'];?>');" data-original-title="Delete"> <i class="fa fa-close text-danger"></i> </a></td>
                </tr>
                <?php endforeach;?>
              </tbody>
            </table>
            </div>
            </div>
          </div>

	<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/parents/create/' , array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>

        <div class="col-md-12">
          <div class="white-box">
            <h3 class="box-title m-b-0"><?php echo get_phrase('New');?></h3>
            <br><br>
				<div class="padded">
		     
		     		 <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Name');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="ti-user"></i></div>
                      <input type="text" class="form-control" required="" name="name" placeholder="<?php echo get_phrase('Name');?>">
                    </div>
                    </div>
                  </div>

					 <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Username');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="ti-user"></i></div>
                      <input type="text" class="form-control" required="" name="username" placeholder="<?php echo get_phrase('Username');?>">
                    </div>
                    </div>
                  </div>

					<div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Email');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                      <input type="email" class="form-control" required="" name="email" placeholder="<?php echo get_phrase('Email');?>">
                    </div>
                    </div>
                  </div>
					
					<div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Password');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-key"></i></div>
                      <input type="password" class="form-control" required="" name="password" placeholder="<?php echo get_phrase('Password');?>">
                    </div>
                    </div>
                  </div>
					
					<div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Phone');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                      <input type="number" class="form-control" required="" name="phone" placeholder="<?php echo get_phrase('Phone');?>">
                    </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Address');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                      <input type="text" class="form-control" required="" name="address" placeholder="<?php echo get_phrase('Address');?>">
                    </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo get_phrase('Profession');?></label>
                    <div class="col-sm-5">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-info"></i></div>
                      <input type="text" class="form-control" name="profession" placeholder="<?php echo get_phrase('Profession');?>">
                    </div>
                    </div>
                  </div>

                  <div class="form-group">
                <label for="field-1" class="col-sm-4 control-label"><?php echo get_phrase('Photo'); ?></label>
                        
                <div class="col-sm-5">
              <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                      <img src="http://placehold.it/200x200" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                <div>
                      <span class="btn btn-info btn-file">
                    <span class="fileinput-new"><?php echo get_phrase('Upload'); ?></span>
                    <span class="fileinput-exists"><?php echo get_phrase('Change'); ?></span>
                    <input type="file" name="userfile" accept="image/*">
                      </span>
                      <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput"><?php echo get_phrase('Delete'); ?></a>
                    </div>
                      </div>
                </div>
              </div>
        </div>
						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('Add');?></button>
							<span id="preloader-form"></span>
						</div>
						</div>
						 <?php echo form_close();?>
                    </form>                
                </div>                
			</div>
			 </div>                
			</div>
</div>

<script>
    $(document).ready(function(){
      $('#myTable').DataTable();
      $(document).ready(function() {
        var table = $('#example').DataTable({
          "columnDefs": [
          { "visible": false, "targets": 2 }
          ],
          "order": [[ 2, 'asc' ]],
          "displayLength": 25,
          "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
              if ( last !== group ) {
                $(rows).eq( i ).before(
                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                  );

                last = group;
              }
            } );
          }
        } );
    $('#example tbody').on( 'click', 'tr.group', function () {
      var currentOrder = table.order()[0];
      if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
        table.order( [ 2, 'desc' ] ).draw();
      }
      else {
        table.order( [ 2, 'asc' ] ).draw();
      }
    });
  });
    });
    $('#example23').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
  </script>