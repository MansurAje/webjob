<!doctype html>
<html lang="en">
<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	  <!-- Meta, title, CSS, favicons, etc. -->
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admin Layout</title>
	<!--untuk memanggil css-->
	<?php echo $css; ?>

	<style type="text/css">
	.loaders {position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url('<?php echo base_url();?>/assets/loaders/ajax-loader1.gif') 50% 50% no-repeat #f2f2f2;opacity: 0.9;filter: alpha(opacity=90);}
  
	</style>

</head>

<body class="nav-md">
	
  <!-- loaders -->
    <div class="loaders"></div>
  <!-- /loaders -->
  <div class="container body">


    <div class="main_container">
      
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>APP Core <?php echo site_url(); ?></span></a>
          </div>
          <div class="clearfix"></div>

          	

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <?php //if($level == 2){?>
              <img src="<?php echo base_url();?>assets/gantella/images/wildan.jpg" alt="..." class="img-circle profile_img">
              <?php//}//else if($level ==2){?>
              <!-- <img src="<?php //echo base_url();?>assets/gantella/images/user.png" alt="..." class="img-circle profile_img"> -->
              <?php //}else{} ?>
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2><?php  echo $ses_vUsername;?></h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

          	<div class="menu_section">
          		<h3>Menu</h3>
          		<ul class="nav side-menu">
                	<li>
                		<a class= "home" href="<?php echo base_url()?>index.php/home"><i class="fa fa-home"></i> Home</a>	
                	</li>

                	<li><a><i class="fa fa-edit"></i> Data Master <span class="fa fa-chevron-down"></span></a>
	                  <ul class="nav child_menu" style="display: none">
	                    <li><a href="<?php echo base_url()?>index.php/User"> Data User</a></li>
	                    <li><a href="<?php echo base_url()?>index.php/Group">Data Group</a></li>
	                    <li><a href="<?php echo base_url()?>index.php/Menu">Data Menu</a></li>
	                    
	                  </ul>
	                </li>
                </ul>
          	</div>

          </div>
          <!-- /sidebar menu -->
          
          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url()?>assets/gantella/images/wildan.jpg" alt=""><?php  echo $ses_vUsername;?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="javascript:;">  Profile</a>
                  </li>
                  <li>
                    <a href="javascript:;">
                      <span class="badge bg-red pull-right">50%</span>
                      <span>Settings</span>
                    </a>
                  </li>
                  <li>
                    <a href="javascript:;">Help</a>
                  </li>
                  <li><a href="<?php echo site_url('login/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">

                  </span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  <?php 
                    if($status == 0){
                      if($level ==2){?>
                  <li>
                    <a href="<?php echo base_url('jadwal/pemberitahuan/'.$id)?>">
                      <span class="image">
                          <img src="<?php echo base_url()?>assets/gantella/images/wildan.jpg" alt="Profile Image" />
                      </span>
                      <span>
                      <span>admin@gmail.com</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                          saya sudah membuat jadwal untuk survey silahkan lihat jadwalnya dan segera hubungi responden yang akan ikut berpartisipasi 
                      </span>
                    </a>
                  </li>
                  <?php }else{?>
                    <li>
                    <a>
                      <span class="image">
                      </span>
                      <span>
                      <span></span>
                      <span class="time"></span>
                      </span>
                      <span class="message">
                      tidak ada pemberitahuan
                      </span>
                    </a>
                  </li>
                  
                    <?php } ?>
                  <?php }else{?>
                  <li>
                    <a>
                      <span class="image">
                      </span>
                      <span>
                      <span></span>
                      <span class="time"></span>
                      </span>
                      <span class="message">
                      tidak ada pemberitahuan
                      </span>
                    </a>
                  </li>
                  <?php } ?>
                </ul>
              </li>

            </ul>
          </nav>
        </div>

      </div>
      
      <!-- main content -->
              
      <!-- page content -->
      <div class="right_col" role="main"><br />
        <div class="row top_tiles">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <?php echo $isi;?>                    
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
        
        
        <!-- /main content -->

        <!-- footer content -->
        <footer>
          <div class="copyright-info">
            <p class="pull-right">Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>    
            </p>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div>
      <!-- /page content -->
    </div>


  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <?php echo $js; ?>

</body>

<body>
 

</html>