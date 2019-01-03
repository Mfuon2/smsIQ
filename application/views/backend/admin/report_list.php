<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo get_phrase('Teacher-Report');?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?student/student_dashboard"><?php echo $system_title; ?></a></li>
            <li class="active"><?php echo get_phrase('Teacher-Report');?></li>
        </ol>
    </div>
</div>


<div class="main_data">
	<div class="row">
    <div class="col-md-12">
    <div class="white-box">
        <div class="tab-content">
        <br>
            <div class="tab-pane active" id="opened">
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
    <thead>
        <tr>
            <th style="text-align: center;">No.</th>
            <th style="text-align: center;"><div><?php echo get_phrase('Title');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Code');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Student');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Teacher');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Priority');?></div></th>
            <th style="text-align: center;"><div><?php echo get_phrase('Options');?></div></th>
        </tr>
    </thead>
<tbody>
    <?php
    $counter = 1;
    $this->db->order_by('report_id', 'desc');
    $tickets = $this->db->get('reporte_alumnos')->result_array();
    foreach ($tickets as $row): ?>
        <tr>
            <td style="width:30px;"><?php echo $counter++; ?></td>
            <td>
                <a href="<?php echo base_url(); ?>index.php?admin/looking_report/<?php echo $row['report_code']; ?>">
                    <?php echo $row['title']; ?>
                </a>
            </td>
            <td style="text-align: center;"><?php echo $row['report_code']; ?></td>
            <td style="text-align: center;"><span class="badge badge-success"><?php echo $this->crud_model->get_type_name_by_id('student', $row['student_id']); ?></span></td>
            <td style="text-align: center;"><span class="badge badge-danger"><?php echo $this->crud_model->get_type_name_by_id('teacher', $row['teacher_id']); ?></span></td>
            <td style="text-align: center;">
                <div class="label label-<?php
                if ($row['priority'] == 'alta') echo 'danger';
                else if ($row['priority'] == 'media') echo 'info';
                else if ($row['priority'] == 'baja') echo 'warning' ?>">
                <?php echo $row['priority']; ?></div>
            </td>
            <td style="text-align: center;">
                <div class="btn-group">
                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                       <?php echo get_phrase('Options');?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-blue pull-right" role="menu">
                        <li>
                            <a href="<?php echo base_url(); ?>index.php?admin/looking_report/<?php echo $row['report_code']; ?>">
                                <?php echo get_phrase('View');?>
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="#" onclick="confirm_modal('<?php echo base_url(); ?>index.php?admin/report_list/delete/<?php echo $row['report_code']; ?>', '<?php echo base_url(); ?>index.php?admin/reload_report_list');" >
                                <?php echo get_phrase('Delete');?>
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>
</div>

            </div>
        </div>
    </div>
    </div>
</div>
</div>



<script type="text/javascript">
    function reload_data(url)
{
    $.ajax({
        url: url,
        success: function(response)
        {
            jQuery('.main_data').html(response);
        }
    });
}
    function delete_data(delete_url , post_refresh_url)
    {
        $('#preloader-delete').html('<img src="assets/images/preloader.gif" style="height:15px;margin-top:-10px;" />');
        document.getElementById("delete_link").disabled=true;
        document.getElementById("delete_cancel_link").disabled=true;
        $.ajax({
            url: delete_url,
            success: function(response)
            {
                $('#preloader-delete').html('');
                toastr.info("Data deleted successfully.", "Success");
                $('#modal_delete').modal('hide');
                document.getElementById("delete_link").disabled=false;
                document.getElementById("delete_cancel_link").disabled=false;
                reload_data(post_refresh_url);
            }
        });
    }
</script>

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
  </script>         </div>
            <footer class="footer text-center"> Copyright Reserved &copy Mzalendo </footer>       </div>
    </div>
        <script type="text/javascript">
    function showAjaxModal(url)
    {
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_ajax .modal-body').html(response);
                  $(".mydatepicker").datepicker({
                    dateFormat: 'dd-mm-yy'
                })
            }
        });
    }
    </script>