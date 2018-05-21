<style type="text/css">
  @media (min-width: 767px) {
      .navbar-nav .dropdown-menu .caret {
    transform: rotate(-90deg);
      }
  }

</style>

<script type="text/javascript">
  $(document).ready(function() {
      $('.navbar a.dropdown-toggle').on('click', function(e) {
          var $el = $(this);
          var $parent = $(this).offsetParent(".dropdown-menu");
          $(this).parent("li").toggleClass('open');

          if(!$parent.parent().hasClass('nav')) {
              $el.next().css({"top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
          }

          $('.nav li.open').not($(this).parents("li")).removeClass("open");

          return false;
      });
  });

</script>

<nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url();?>Home">Novell Production System </a>
    </div>

    <!-- Menu -->
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url();?>Home">Home</a></li>
      <!-- <li><a href="<?php echo base_url();?>Profile">About</a></li> -->

     <!--  <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Messenger
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url();?>send">Send Message</a></li>
          <li><a href="<?php echo base_url();?>message">Inbox</a></li>
        </ul>
      </li> -->

      

      <!-- Master Data -->
      <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <?php 
                  $sqlgrp = 'select * from m_groupmenu a where a.lDeleted=0 and a.iJenis=1';
                  $dgrp = $this->db->query($sqlgrp);

                  if ($dgrp->num_rows() > 0 ) {

                    foreach ($dgrp->result_array() as $grp) {
                      if($grp['iNeedLogin']==1){
                        if($this->session->userdata('loggedin')){

                          /*cek auth group menu*/
                          $sq_cek_auth_group = 'select * 
                                                from t_privilege a 
                                                join t_privilege_detail b on b.iPrivilege=a.iPrivilege
                                                join m_menu c on c.iMenu=b.iMenu
                                                join m_groupmenu d on d.iGroupMenu=c.iGroupMenu
                                                where a.lDeleted=0
                                                and b.lDeleted=0
                                                and c.lDeleted=0
                                                and d.lDeleted=0
                                                and a.iGroupUser="'.$this->session->userdata('iGroupUser').'"
                                                and d.iGroupMenu="'.$grp['iGroupMenu'].'"
                                                and b.iRead = 1
                                                ';
                          $d_auth_group = $this->db->query($sq_cek_auth_group);

                          if ($d_auth_group->num_rows() > 0 ) {

              ?>      
                            <!-- <li><a href="<?php echo base_url();?><?php echo $menu['iGroupMenu'] ?>"><?php echo $menu['vGroupMenuName'] ?></a></li> -->
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $grp['vGroupMenuName'] ?> <b class="caret"></b></a>

                                    <ul class="dropdown-menu">
                                        <?php 
                                            $sqlm = 'select * from m_menu a where a.lDeleted=0 and a.iGroupMenu= "'.$grp['iGroupMenu'].'" ';
                                            $dmenu = $this->db->query($sqlm);
                                            if ($dmenu->num_rows() > 0 ) {


                                              foreach ($dmenu->result_array() as $menu) {
                                                 /*cek auth menu*/
                                                  $sq_cek_auth_menu = 'select * 
                                                                        from t_privilege a 
                                                                        join t_privilege_detail b on b.iPrivilege=a.iPrivilege
                                                                        join m_menu c on c.iMenu=b.iMenu
                                                                        join m_groupmenu d on d.iGroupMenu=c.iGroupMenu
                                                                        where a.lDeleted=0
                                                                        and b.lDeleted=0
                                                                        and c.lDeleted=0
                                                                        and d.lDeleted=0
                                                                        and a.iGroupUser="'.$this->session->userdata('iGroupUser').'"
                                                                        and c.iMenu="'.$menu['iMenu'].'"
                                                                        and b.iRead = 1
                                                                        ';    
                                                  /*echo $sq_cek_auth_menu;
                                                  echo "<br>";*/

                                                  $d_auth_menu = $this->db->query($sq_cek_auth_menu);

                                                  if ($d_auth_menu->num_rows() > 0 ) {
                                        ?>
                                                    <li><a href="<?php echo base_url();?><?php echo $menu['vController'] ?>"><?php echo $menu['vMenuName'] ?></a> </li>
                                        <?php 
                                                  }else{

                                                    //echo '<li><a href="#">No Data</a></li>';     
                                                  }

                                              }
                                            }else{
                                               echo '<li><a href="#">No Data</a></li>';
                                            }
                                        ?>
                                    </ul>
                                </li>
                                <li class="divider"></li>



              <?php       }else{
                            //echo '<li><a href="#">No Data</a></li>';
                          }
                        }else{
                          //echo '<li><a href="#">Login First</a></li>';
                        }

                      }else{

                      ?>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $grp['vGroupMenuName'] ?> <b class="caret"></b></a>

                            <ul class="dropdown-menu">
                                <?php 
                                    $sqlm = 'select * from m_menu a where a.lDeleted=0 and a.iGroupMenu= "'.$grp['iGroupMenu'].'" ';
                                    $dmenu = $this->db->query($sqlm);
                                    if ($dmenu->num_rows() > 0 ) {


                                      foreach ($dmenu->result_array() as $menu) {

                                ?>
                                        <li><a href="<?php echo base_url();?><?php echo $menu['vController'] ?>"><?php echo $menu['vMenuName'] ?></a> </li>
                                <?php 

                                      }
                                    }else{
                                       echo '<li><a href="#">No Data</a></li>';
                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="divider"></li>


                      <?php 
                      }
                    }

                  }else{

                      echo '<li><a href="#">No Data</a></li>';

                  }

               ?>
          </ul>
      </li>
      <!-- Transaction -->
      <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Transaction <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <?php 
                  $sqlgrp = 'select * from m_groupmenu a where a.lDeleted=0 and a.iJenis=2';
                  $dgrp = $this->db->query($sqlgrp);

                  if ($dgrp->num_rows() > 0 ) {

                    foreach ($dgrp->result_array() as $grp) {
                      if($grp['iNeedLogin']==1){
                        if($this->session->userdata('loggedin')){

                          /*cek auth group menu*/
                          $sq_cek_auth_group = 'select * 
                                                from t_privilege a 
                                                join t_privilege_detail b on b.iPrivilege=a.iPrivilege
                                                join m_menu c on c.iMenu=b.iMenu
                                                join m_groupmenu d on d.iGroupMenu=c.iGroupMenu
                                                where a.lDeleted=0
                                                and b.lDeleted=0
                                                and c.lDeleted=0
                                                and d.lDeleted=0
                                                and a.iGroupUser="'.$this->session->userdata('iGroupUser').'"
                                                and d.iGroupMenu="'.$grp['iGroupMenu'].'"
                                                and b.iRead = 1
                                                ';
                          $d_auth_group = $this->db->query($sq_cek_auth_group);

                          if ($d_auth_group->num_rows() > 0 ) {

              ?>      
                            <!-- <li><a href="<?php echo base_url();?><?php echo $menu['iGroupMenu'] ?>"><?php echo $menu['vGroupMenuName'] ?></a></li> -->
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $grp['vGroupMenuName'] ?> <b class="caret"></b></a>

                                    <ul class="dropdown-menu">
                                        <?php 
                                            $sqlm = 'select * from m_menu a where a.lDeleted=0 and a.iGroupMenu= "'.$grp['iGroupMenu'].'" ';
                                            $dmenu = $this->db->query($sqlm);
                                            if ($dmenu->num_rows() > 0 ) {


                                              foreach ($dmenu->result_array() as $menu) {
                                                 /*cek auth menu*/
                                                  $sq_cek_auth_menu = 'select * 
                                                                        from t_privilege a 
                                                                        join t_privilege_detail b on b.iPrivilege=a.iPrivilege
                                                                        join m_menu c on c.iMenu=b.iMenu
                                                                        join m_groupmenu d on d.iGroupMenu=c.iGroupMenu
                                                                        where a.lDeleted=0
                                                                        and b.lDeleted=0
                                                                        and c.lDeleted=0
                                                                        and d.lDeleted=0
                                                                        and a.iGroupUser="'.$this->session->userdata('iGroupUser').'"
                                                                        and c.iMenu="'.$menu['iMenu'].'"
                                                                        and b.iRead = 1
                                                                        ';    
                                                  /*echo $sq_cek_auth_menu;
                                                  echo "<br>";*/

                                                  $d_auth_menu = $this->db->query($sq_cek_auth_menu);

                                                  if ($d_auth_menu->num_rows() > 0 ) {
                                        ?>
                                                    <li><a href="<?php echo base_url();?><?php echo $menu['vController'] ?>"><?php echo $menu['vMenuName'] ?></a> </li>
                                        <?php 
                                                  }else{

                                                    //echo '<li><a href="#">No Data</a></li>';     
                                                  }

                                              }
                                            }else{
                                               echo '<li><a href="#">No Data</a></li>';
                                            }
                                        ?>
                                    </ul>
                                </li>
                                <li class="divider"></li>



              <?php       }else{
                            //echo '<li><a href="#">No Data</a></li>';
                          }
                        }else{
                          //echo '<li><a href="#">Login First</a></li>';
                        }

                      }else{

                      ?>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $grp['vGroupMenuName'] ?> <b class="caret"></b></a>

                            <ul class="dropdown-menu">
                                <?php 
                                    $sqlm = 'select * from m_menu a where a.lDeleted=0 and a.iGroupMenu= "'.$grp['iGroupMenu'].'" ';
                                    $dmenu = $this->db->query($sqlm);
                                    if ($dmenu->num_rows() > 0 ) {


                                      foreach ($dmenu->result_array() as $menu) {

                                ?>
                                        <li><a href="<?php echo base_url();?><?php echo $menu['vController'] ?>"><?php echo $menu['vMenuName'] ?></a> </li>
                                <?php 

                                      }
                                    }else{
                                       echo '<li><a href="#">No Data</a></li>';
                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="divider"></li>


                      <?php 
                      }
                    }

                  }else{

                      echo '<li><a href="#">No Data</a></li>';

                  }

               ?>
          </ul>
      </li>
      
      <!-- Report -->
      <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Report <b class="caret"></b></a>
          <ul class="dropdown-menu">
              <?php 
                  $sqlgrp = 'select * from m_groupmenu a where a.lDeleted=0 and a.iJenis=3';
                  $dgrp = $this->db->query($sqlgrp);

                  if ($dgrp->num_rows() > 0 ) {

                    foreach ($dgrp->result_array() as $grp) {
                      if($grp['iNeedLogin']==1){
                        if($this->session->userdata('loggedin')){

                          /*cek auth group menu*/
                          $sq_cek_auth_group = 'select * 
                                                from t_privilege a 
                                                join t_privilege_detail b on b.iPrivilege=a.iPrivilege
                                                join m_menu c on c.iMenu=b.iMenu
                                                join m_groupmenu d on d.iGroupMenu=c.iGroupMenu
                                                where a.lDeleted=0
                                                and b.lDeleted=0
                                                and c.lDeleted=0
                                                and d.lDeleted=0
                                                and a.iGroupUser="'.$this->session->userdata('iGroupUser').'"
                                                and d.iGroupMenu="'.$grp['iGroupMenu'].'"
                                                and b.iRead = 1
                                                ';
                          $d_auth_group = $this->db->query($sq_cek_auth_group);

                          if ($d_auth_group->num_rows() > 0 ) {

              ?>      
                            <!-- <li><a href="<?php echo base_url();?><?php echo $menu['iGroupMenu'] ?>"><?php echo $menu['vGroupMenuName'] ?></a></li> -->
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $grp['vGroupMenuName'] ?> <b class="caret"></b></a>

                                    <ul class="dropdown-menu">
                                        <?php 
                                            $sqlm = 'select * from m_menu a where a.lDeleted=0 and a.iGroupMenu= "'.$grp['iGroupMenu'].'" ';
                                            $dmenu = $this->db->query($sqlm);
                                            if ($dmenu->num_rows() > 0 ) {


                                              foreach ($dmenu->result_array() as $menu) {
                                                 /*cek auth menu*/
                                                  $sq_cek_auth_menu = 'select * 
                                                                        from t_privilege a 
                                                                        join t_privilege_detail b on b.iPrivilege=a.iPrivilege
                                                                        join m_menu c on c.iMenu=b.iMenu
                                                                        join m_groupmenu d on d.iGroupMenu=c.iGroupMenu
                                                                        where a.lDeleted=0
                                                                        and b.lDeleted=0
                                                                        and c.lDeleted=0
                                                                        and d.lDeleted=0
                                                                        and a.iGroupUser="'.$this->session->userdata('iGroupUser').'"
                                                                        and c.iMenu="'.$menu['iMenu'].'"
                                                                        and b.iRead = 1
                                                                        ';    
                                                  /*echo $sq_cek_auth_menu;
                                                  echo "<br>";*/

                                                  $d_auth_menu = $this->db->query($sq_cek_auth_menu);

                                                  if ($d_auth_menu->num_rows() > 0 ) {
                                        ?>
                                                    <li><a href="<?php echo base_url();?><?php echo $menu['vController'] ?>"><?php echo $menu['vMenuName'] ?></a> </li>
                                        <?php 
                                                  }else{

                                                    //echo '<li><a href="#">No Data</a></li>';     
                                                  }

                                              }
                                            }else{
                                               echo '<li><a href="#">No Data</a></li>';
                                            }
                                        ?>
                                    </ul>
                                </li>
                                <li class="divider"></li>



              <?php       }else{
                            //echo '<li><a href="#">No Data</a></li>';
                          }
                        }else{
                          //echo '<li><a href="#">Login First</a></li>';
                        }

                      }else{

                      ?>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $grp['vGroupMenuName'] ?> <b class="caret"></b></a>

                            <ul class="dropdown-menu">
                                <?php 
                                    $sqlm = 'select * from m_menu a where a.lDeleted=0 and a.iGroupMenu= "'.$grp['iGroupMenu'].'" ';
                                    $dmenu = $this->db->query($sqlm);
                                    if ($dmenu->num_rows() > 0 ) {


                                      foreach ($dmenu->result_array() as $menu) {

                                ?>
                                        <li><a href="<?php echo base_url();?><?php echo $menu['vController'] ?>"><?php echo $menu['vMenuName'] ?></a> </li>
                                <?php 

                                      }
                                    }else{
                                       echo '<li><a href="#">No Data</a></li>';
                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="divider"></li>


                      <?php 
                      }
                    }

                  }else{

                      echo '<li><a href="#">No Data</a></li>';

                  }

               ?>
          </ul>
      </li>


      <!-- <li>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Master Data <b class="caret"></b></a>

          <ul class="dropdown-menu">
              <li><a href="#">Action [Menu 1.1]</a></li>
              <li><a href="#">Another action [Menu 1.1]</a></li>
              <li><a href="#">Something else here [Menu 1.1]</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link [Menu 1.1]</a></li>
              <li class="divider"></li>
              <li><a href="#">One more separated link [Menu 1.1]</a></li>
              <li>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown [Menu 1.1] <b class="caret"></b></a>

                  <ul class="dropdown-menu">
                      <li><a href="#">Action [Menu 1.2]</a></li>
                      <li>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown [Menu 1.2] <b class="caret"></b></a>

                          <ul class="dropdown-menu">
                              <li>
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown [Menu 1.3] <b class="caret"></b></a>

                                  <ul class="dropdown-menu">
                                      <li><a href="#">Action [Menu 1.4]</a></li>
                                      <li><a href="#">Another action [Menu 1.4]</a></li>
                                      <li><a href="#">Something else here [Menu 1.4]</a></li>
                                      <li class="divider"></li>
                                      <li><a href="#">Separated link [Menu 1.4]</a></li>
                                      <li class="divider"></li>
                                      <li><a href="#">One more separated link [Menu 1.4]</a></li>
                                  </ul>
                              </li>
                          </ul>
                      </li>
                  </ul>
              </li>
          </ul>
      </li> -->
    </ul>
    <!-- Menu -->

    <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav nav-pills pull-right" role="tablist">
        <li role="presentation"><a href="<?php echo base_url();?>message">New messages <span class="badge" id="new_count_message"><?php echo $this->db->where('read_status',0)->count_all_results('message');?></span></a></li>
        
        <?php 
          if(!$this->session->userdata('loggedin'))
          {
          ?>
            <li role="presentation"><a href="<?php echo base_url();?>Login">Login</a></li>
          <?php 
            }else{
          ?>
            <li role="presentation"><a href="<?php echo base_url();?>Login/logout">Logout ( <?php echo $this->session->userdata('vName')  ?> ) </a></li>
          <?php }?>
        

      </ul>
    </div> -->

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav nav-pills pull-right" role="tablist">
       
        <?php 
          if(!$this->session->userdata('loggedin'))
          {
          ?>
            <li role="presentation"><a href="<?php echo base_url();?>Login">Login</a></li>
          <?php 
            }else{
              $sql = "SELECT DISTINCT(e.`vName`), m.* , md.`istat` FROM `message` m 
                  JOIN hrd.`employee` e ON e.`cNip` = m.`vfrom` 
                  JOIN message_detail md ON md.`id` = m.`id`
                  WHERE md.`istat`<>1 AND md.`cNip` = '".$this->session->userdata('cNip')."'";
              $count = $this->db->query($sql)->num_rows();
          ?> 
            <li role="presentation"><a href="<?php echo base_url();?>Message">Messages <span class="badge" id="new_count_message"> <?php echo $count ?></span></a></li>
            <li role="presentation"><a href="<?php echo base_url();?>Login/logout">Logout ( <?php echo $this->session->userdata('vName')  ?> ) </a></li>
          <?php }?>
        

      </ul>
    </div>
    

  </div>

</nav>
