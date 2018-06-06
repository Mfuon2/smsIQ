<?php
$running_year 		=   $this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
$system_name        =	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description; 
?>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	    <h4 class="page-title"><?php echo get_phrase('Admin-Dashboard');?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php?admin/admin_dashboard"><?php echo $system_title; ?></a></li>
            <li class="active"><?php echo get_phrase('Admin-Dashboard');?></li>
        </ol>
    </div>
</div>

<div class="row">
<div class="col-md-12">
<div class="alert alert-info">
        <span style="color: #fff; font-weight: Verdana; font-size: 23px;">
<marquee direction="left" scrollamount="10"><?php echo $this->db->get_where('settings' , array('type' =>'ad'))->row()->description;?></marquee></span>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title">Social</h3>
                            <div class="button-box">
                                <div class="button-list">
                                    <a target="_blank" href="<?php echo $this->db->get_where('settings' , array('type' =>'facebook_url'))->row()->description;?>"><button class="btn btn-facebook waves-effect waves-light" type="button"> <i class="fa fa-facebook"></i> </button></a>
                                    <a target="_blank" href="<?php echo $this->db->get_where('settings' , array('type' =>'twitter_url'))->row()->description;?>"><button class="btn btn-twitter waves-effect waves-light" type="button"> <i class="fa fa-twitter"></i> </button></a>
                                     <a target="_blank" href="<?php echo $this->db->get_where('settings' , array('type' =>'google_url'))->row()->description;?>"><button class="btn btn-googleplus waves-effect waves-light" type="button"> <i class="fa fa-google-plus"></i> </button></a>
                                     <a target="_blank" href="<?php echo $this->db->get_where('settings' , array('type' =>'linkedin_url'))->row()->description;?>"><button class="btn btn-linkedin waves-effect waves-light" type="button"> <i class="fa fa-linkedin"></i> </button></a>
                                    <a target="_blank" href="<?php echo $this->db->get_where('settings' , array('type' =>'instagram_url'))->row()->description;?>"><button class="btn btn-instagram waves-effect waves-light" type="button"> <i class="fa fa-instagram"></i> </button></a>
                                    <a target="_blank" href="<?php echo $this->db->get_where('settings' , array('type' =>'pinterest_url'))->row()->description;?>"><button class="btn btn-pinterest waves-effect waves-light" type="button"> <i class="fa fa-pinterest"></i> </button></a>
                                    <a target="_blank" href="<?php echo $this->db->get_where('settings' , array('type' =>'dribbble_url'))->row()->description;?>"><button class="btn btn-dribbble waves-effect waves-light" type="button"> <i class="fa fa-dribbble"></i> </button></a>
                                    <a target="_blank" href="<?php echo $this->db->get_where('settings' , array('type' =>'youtube_url'))->row()->description;?>"><button class="btn btn-youtube waves-effect waves-light" type="button"> <i class="fa fa-youtube"></i> </button></a>
                                </div>
                            </div>
    </div>
</div>
<div class="col-md-6">
                <div class="alert alert-warning">
                    <div class="icon"><i class="entypo-chart-bar"></i></div>
                    <?php 
                        $check  =   array(  'timestamp' => strtotime(date('Y-m-d')) , 'status' => '1' );
                        $query = $this->db->get_where('attendance' , $check);
                        $present_today      =   $query->num_rows();
                        ?>
                    <h4><font color="white"><?php echo get_phrase('Attendance');?></font></h4>
                    <p>Present Student Today: </p>
                    <h3><font color="white"><?php echo $present_today;?></font></h3>
                </div>
                
            </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-wrapper p-b-10 collapse in">
                               <div class="card-body card-padding">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                      </ol>

        <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="<?php echo base_url();?>uploads/slider/slider1.png" alt="">
                    </div>
                    <div class="item">
                        <img src="<?php echo base_url();?>uploads/slider/slider2.png" alt="">
                    </div>
                    <div class="item">
                        <img src="<?php echo base_url();?>uploads/slider/slider3.png" alt="">
                    </div>
        </div>

        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="zmdi zmdi-chevron-left" aria-hidden="true"></span>
            <span class="sr-only"><?php echo get_phrase('Prev');?></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="zmdi zmdi-chevron-right" aria-hidden="true"></span>
            <span class="sr-only"><?php echo get_phrase('Next');?></span>
        </a>
        </div>
    </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
   				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <div class="white-box">
                        <h3 class="box-title"><?php echo get_phrase('Admins');?></h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-people text-info"></i></li>
                            <li class="text-right"><span class="counter"><?php echo $this->db->count_all('admin');?></span></li>
                        </ul>
                    </div>
                </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <div class="white-box">
                        <h3 class="box-title"><?php echo get_phrase('Teachers');?></h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-people text-info"></i></li>
                            <li class="text-right"><span class="counter"><?php echo $this->db->count_all('teacher');?></span></li>
                        </ul>
                    </div>
                </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <div class="white-box">
                        <h3 class="box-title"><?php echo get_phrase('Students');?></h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-people text-info"></i></li>
                            <li class="text-right"><span class="counter"><?php echo $this->db->count_all('student');?></span></li>
                        </ul>
                    </div>
                </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                   <div class="white-box">
                        <h3 class="box-title"><?php echo get_phrase('Parents');?></h3>
                        <ul class="list-inline two-part">
                            <li><i class="icon-people text-info"></i></li>
                            <li class="text-right"><span class="counter"><?php echo $this->db->count_all('parent');?></span></li>
                        </ul>
                    </div>
                </div>
</div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="white-box">
                            <h3 class="box-title"><?php echo get_phrase('Last-News');?></h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                <th style="text-align: center;">#</th>
                                <th style="text-align: center;"><div><?php echo get_phrase('Title');?></div></th>
								<th style="text-align: center;"><div><?php echo get_phrase('Options');?></div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
     									$counter = 1;
										$this->db->where('news_status' , 1);
										$this->db->limit(7);
										$this->db->order_by('news_id' , 'desc');
										$news	=	$this->db->get('news')->result_array();
										foreach($news as $row):?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $counter++; ?></td>
                                            <td style="text-align: center;">
			<a href="<?php echo base_url();?>index.php?admin/news_view/details/<?php echo $row['news_code'];?>"><?php echo $row['title'];?></a>
    </td>
    <td style="text-align: center;"><?php echo substr($row['description'], 0, 30);?>...</td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
            </div>
        </div>
    </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
          <div class="white-box">
            <h3 class="box-title"><?php echo get_phrase('Events');?></h3>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                  	<th style="text-align: center;">#</th>
                    <th style="text-align: center;"><div><?php echo get_phrase('Title');?></div></th>
					<th style="text-align: center;"><div><?php echo get_phrase('From');?></div></th>
					<th style="text-align: center;"><div><?php echo get_phrase('To');?></div></th>
                  </tr>
                </thead>
                <tbody>
                 <?php $counter = 1;
						$this->db->limit(7);
						$this->db->order_by('event_id' , 'desc');
						$events	=	$this->db->get('events')->result_array();
						foreach($events as $row2):?>
                  <tr>
                    <td style="text-align: center;"><?php echo  $counter++;?></td>
                    <td style="text-align: center;"><?php echo $row2['title'];?></td>
                <td style="text-align: center;"><span class="text-warning"><?php echo $row2['datefrom'];?></td>
                  <td style="text-align: center;"><span class="text-info"><?php echo $row2['dateto'];?></td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
          </div>
        </div>
</div>
</div>