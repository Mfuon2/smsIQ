<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo get_phrase('ListsPerms');?></h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#"><?php echo get_phrase('Dashboard');?></a></li>
                            <li class="active"><?php echo get_phrase('ListsPerms');?></li>
                        </ol>
                    </div>
</div>

<div class="white-box">
<div class="table-responsive">
<table id="myTable" class="table table-striped">
    <thead>
        <tr>
             <th style="text-align: center;">#</th>
            <th style="text-align: center;"><?php echo get_phrase('Title');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Description');?></th>
            <th style="text-align: center;"><?php echo get_phrase('By');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Start_Date');?></th>
            <th style="text-align: center;"><?php echo get_phrase('End_Date');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Status');?></th>
            <th style="text-align: center;"><?php echo get_phrase('Options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php
        $count = 1;
        $this->db->order_by('request_id', 'desc');
        $requests = $this->db->get('request')->result_array();
        foreach ($requests as $row) { ?>   
            <tr>
                <td style="text-align: center;"><?php echo $count++; ?></td>
                <td style="text-align: center;"><?php echo $row['title']; ?></td>
                <td style="text-align: center;"><?php echo $row['description']; ?></td>
                <td style="text-align: center;"><?php echo $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']))->row()->name; ?></td>
                <td style="text-align: center;"><?php echo $row['start_date']; ?></td>
                <td style="text-align: center;"><?php echo $row['end_date']; ?></td>
                <td style="text-align: center;">
                    <?php
                        if($row['status'] == 0)
                            $status = '<span class="label label-info" style="font-size: 10px;">' . get_phrase('Pending') . '</span>';
                        else if($row['status'] == 1)
                            $status = '<span class="label label-success" style="font-size: 10px;">' . get_phrase('Nice') . '</span>';
                        else
                            $status = '<span class="label label-danger" style="font-size: 10px;">' . get_phrase('Rejected') . '</span>';
                        echo $status;
                    ?>
                </td>
                <td>
                    <?php if($row['status'] == 0) { ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                            <?php echo get_phrase('Options');?><span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-blue pull-right" role="menu">
                                <li>
                                    <a href="<?php echo base_url();?>index.php?admin/request/accept/<?php echo $row['request_id'];?>">
                                        <i class="entypo-check"></i>
                                        <?php echo get_phrase('Accept');?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>index.php?admin/request/reject/<?php echo $row['request_id'];?>">
                                        <i class="entypo-cancel"></i>
                                        <?php echo get_phrase('Reject');?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php } else echo get_phrase('No_Options'); ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
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
  </script>