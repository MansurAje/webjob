<div class="panel panel-primary">
  <div class="panel-heading"> 
    <style type="text/css">
    .rttengah{
      text-align: center;;
    }
  </style>
<h3>Privilege Form</h3>
  </div>
   <div class="panel-body">
  <?php if($this->session->flashdata('success')){?>
    <div class="alert alert-info alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Success:</span>
        <?php echo $this->session->flashdata('success') ?>
    </div>
  <?php }?>
  <?php if($this->session->flashdata('error')){?>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        <?php echo $this->session->flashdata('error') ?>
    </div>
  <?php }?>

<form method="post" action="<?php echo $action ?>" class="form-horizontal">
  <!-- hidden panel -->
  <input id="iPrivilege" value="<?php echo $iPrivilege ?>" name="iPrivilege" required="required" type="hidden">
  <!-- hidden panel -->


  <div class="form-group">
    <label for="iGroupUser" class="col-sm-2 control-label">Group User</label>
    <div class="col-sm-8">
        <?php 
          if($cAction=='insert'){

            $sql = "select * 
                    from nps.m_groupuser a 
                    where a.lDeleted=0
                    and a.iGroupUser not in (select iGroupUser from t_privilege a where a.lDeleted=0)
                    ";
            $teams = $this->db->query($sql)->result_array();
            $o  = "<select name='iGroupUser' id='iGroupUser' class='form-control' required='required' >";            
            $o .= "<option  value=''>Select one</option>";
            foreach($teams as $v) {
                if ($v['iGroupUser'] == $iGroupUser) $selected = " selected";
                else $selected = "";
                $o .= "<option {$selected} value='".$v['iGroupUser']."'>".$v['vGroupUserName']."</option>";
            }            
            $o .= "</select>";

            echo $o;
          }else{

            $sql = "select * from nps.m_groupuser a where a.lDeleted=0 and a.iGroupUser= '".$iGroupUser."' ";
            $data = $this->db->query($sql)->row_array();

            $ret = '<input id="iGroupUser" value='.$iGroupUser.' name="iGroupUser" required="required" type="hidden">';
            $ret .= $data['vGroupUserName'];
            echo $ret;

          }
         ?>

    </div>
  </div>


  <div class="form-group">
    <label for="vDescription" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-8">
      <textarea class="form-control" rows="5" id="vDescription" name="vDescription" placeholder="Description"><?php echo nl2br($vDescription) ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="vDescription" class="col-sm-2 control-label">Modul</label>
    <div class="col-sm-6">
      <?php 
          $sql = 'select a.*,b.vGroupMenuName 
                from m_menu a 
                join m_groupmenu b on a.iGroupMenu=b.iGroupMenu
                where a.lDeleted=0
                and b.lDeleted=0';
          $datas = $this->db->query($sql)->result_array();

       ?>
          <table class="dataTables table table-bordered table-striped table-hover table-responsive">
            <thead>
              <tr>
                <th rowspan="2" class="rttengah" style="width:5%;">No</th>
                <th rowspan="2" class="rttengah" style="width:20%;">Group Menu</th>
                <th rowspan="2" class="rttengah" style="width:20%;">Menu Name</th>
                <th colspan="4" class="rttengah" style="width:10%;">Select</th>
                
              </tr>
              <tr>
                <th>R</th>
                <th>C</th>
                <th>U</th>
                <th>D</th>
              </tr>
            </thead>
            <tbody>
                  <?php 
                      $i=1;
                      foreach ($datas as $list ) {

                        $sqlcek = 'select * from t_privilege_detail a where a.iPrivilege="'.$iPrivilege.'" and a.iMenu="'.$list['iMenu'].'"';
                        $datad = $this->db->query($sqlcek)->row_array();

                        if (empty($datad)) {
                          $cekC='';
                          $cekR='';
                          $cekU='';
                          $cekD='';
                        }else{

                          if( $datad['iCreate']== 1 ){
                            $cekC='checked';
                          }else{
                            $cekC='';
                          }

                          if( $datad['iRead']== 1 ){
                            $cekR='checked';
                          }else{
                            $cekR='';
                          }


                          if( $datad['iUpdate']== 1 ){
                            $cekU='checked';
                          }else{
                            $cekU='';
                          }

                          if( $datad['iDelete']== 1 ){
                            $cekD='checked';
                          }else{
                            $cekD='';
                          }

                        }

                        

                  ?>
                    <tr>
                      

                      <td align="right"><?php echo $i ?></td>
                      <td><?php echo $list['vGroupMenuName']?></td>
                      <td>
                        <input type="hidden" name="iMenu[]" value='<?php echo $list['iMenu'] ?>'>
                        <?php echo $list['vMenuName']?>
                          
                      </td>
                      <td align="center">
                            <input type="checkbox" <?php echo $cekR ?> name="iRead[<?php echo $list['iMenu'] ?>]" value='1'>
                      </td>
                      <td align="center">
                            <input type="checkbox" <?php echo $cekC ?> name="iCreate[<?php echo $list['iMenu'] ?>]" value='1'>
                      </td>
                      <td align="center">
                            <input type="checkbox" <?php echo $cekU ?> name="iUpdate[<?php echo $list['iMenu'] ?>]" value='1'>
                      </td>
                      <td align="center">
                            <input type="checkbox" <?php echo $cekD ?> name="iDelete[<?php echo $list['iMenu'] ?>]" value='1'>
                      </td>
                      
                    </tr>
                  <?php 
                      $i++; 
                    }
                  ?>
            </tbody>
          </table>
    </div>
  </div>

  

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button id="send" name="send" type="submit" class="btn btn-primary">Save</button>
      <a href="<?php echo base_url().$cController.'/'?>"><button type="button" class="btn btn-danger">Back</button></a>
    </div>
  </div>
</form>
</div>
