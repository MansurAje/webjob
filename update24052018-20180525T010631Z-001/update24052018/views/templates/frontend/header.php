<div class="w-container container">
      <div class="w-row">

       <!--///////////////////////////////////////////////////////
       // Logo section 
       //////////////////////////////////////////////////////////-->


        <div class="w-col w-col-32 logo">          
          <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/logo_bumn.png"  alt="bumn Logo" class="logobumn" ></a>
          <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/logo_bumn_wika.png"  alt="wika Logo" class="logowikamobile" ></a>
        </div>

        <!--///////////////////////////////////////////////////////
       // End Logo section 
       //////////////////////////////////////////////////////////-->

        <div class="w-col w-col-92">

       <!--///////////////////////////////////////////////////////
       // Menu section 
       //////////////////////////////////////////////////////////-->


          <div class="w-nav navbar" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
            <div class="w-container nav">
              <nav class="w-nav-menu nav-menu" role="navigation">

                <a class="w-nav-link menu-li" id="menuHome" href="<?php echo base_url();?>Beranda">Beranda</a>                
                <a class="w-nav-link menu-li" id="menuHasil" href="<?php echo base_url();?>Pengumuman">Pengumuman</a>
                <a class="w-nav-link menu-li" id="menuLoker" href="<?php echo base_url();?>Lowongan">Lowongan</a>
                <a class="w-nav-link menu-li" id="menuAbout" href="<?php echo base_url();?>About">About</a>
                <a class="w-nav-link menu-li" id="menuFaq" href="<?php echo base_url();?>About">FAQ</a>
                <a class="w-nav-link menu-li dropbutton" id="menuLogin" href="#login">MyProfile</a>
                
                <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/images/wika_transparant.png"  alt="wika Logo" class="logowika" ></a>
              </nav>
              <div class="w-nav-button">
                <div class="w-icon-nav-menu"></div>
              </div>
              <div class="divProfilemobile" style="float: right">
                <a class="w-nav-link menu-li dropbutton" id="menuLogin" href="#login"><i class="fa fa-user-circle" style="color: #000;"> </i></a>
              </div>
              
            </div>
          </div>
          <div class="dropdown-content">
	        	<a href="#" class="">Resume Saya</a>
	        	<a href="#">Lamaran Saya</a>
	        	<a href="#">Logout</a>
	        </div>


          <!--///////////////////////////////////////////////////////
       // End Menu section 
       //////////////////////////////////////////////////////////-->


        </div>
      </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".dropbutton").click(function(){
        $(".dropdown-content").slideToggle();
    });
});
</script>

    