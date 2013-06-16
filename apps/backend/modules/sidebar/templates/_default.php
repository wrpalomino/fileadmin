<?php 
/*if ($sf_user->hasCredential('showCredentials')) {
    //foreach ($sf_user->getAllPermissionNames() as $k => $v) echo "<li>" . $k . " -> " . $v . "</li>"; 
    foreach ($sf_user->getCredentials() as $k => $v) echo "<li>" . $k . " -> " . $v . "</li>"; 
  }*/
  $selected = $sf_user->setSelectedMenuTab();
?>

<script type="text/javascript">
  $(window).load(function() 
  {
    function update() {
      $.ajax({
       type: 'POST',
       url: '<?php echo url_for('admin/clock')?>',
       timeout: 1000*15,
       success: function(data) {
          $("#timer").html(data); 
          window.setTimeout(update, 1000*15);
       }
      });
     }
     update();
  });
</script>

<ul class="semiopaquemenu">
  <li><?php echo link_to('Clients', 'client/index?edit_pager=1', $selected=='client' ? array("class" => "selected") : array() ) ?></li>
  <li><?php echo link_to('Informants', 'informant/index?edit_pager=1', $selected=='informant' ? array("class" => "selected") : array() ) ?></li>
  <li><?php echo link_to('Court', 'court/index?edit_pager=1', $selected=='court' ? array("class" => "selected") : array() ) ?></li>
  <li><?php echo link_to('Barristers', 'barrister/index?edit_pager=1', $selected=='barrister' ? array("class" => "selected") : array() ) ?></li>
  <li><?php echo link_to('Fees', 'fileFee/index?edit_pager=1&code=FEE', $selected=='fileFee' ? array("class" => "selected") : array() ) ?></li>
  <li><?php echo link_to('Legal Aid', 'legal/index?edit_pager=1', $selected=='legal' ? array("class" => "selected") : array() ) ?></li>
  <li><?php echo link_to('Agencies', 'agency/index?edit_pager=1&code=CLD', $selected=='agency' ? array("class" => "selected") : array() ) ?></li>
  <li><?php echo link_to('To Do', 'todo/index?edit_pager=0', $selected=='todo' ? array("class" => "selected") : array() ) ?></li>
  <li><?php echo link_to('Admin', 'admin/correspondence', $selected=='admin' ? array("class" => "selected") : array() ) ?></li>
  
  <!--<li>< ?php echo link_to('File', 'file/index?edit_pager=1', $sf_context->getModuleName()=='file' ? array("class" => "selected") : array() ) ?></li>-->
  <!--<li>< ?php echo link_to('Users', 'user/index?edit_pager=0', $sf_context->getModuleName()=='user' ? array("class" => "selected") : array() ) ?></li>-->
  <!--<li>< ?php echo link_to('Institutions', 'institution/index?edit_pager=0', $sf_context->getModuleName()=='institution' ? array("class" => "selected") : array() ) ?></li>-->
  
  <li><?php echo link_to('Help', 'help/index?edit_pager=0', $selected=='help' ? array("class" => "selected") : array() ) ?></li>
</ul>
<div class="bottombar"></div>
<div style="background-color:#257EB7;color:#FFF;width:100%;padding:5px 0px">
   &nbsp;&nbsp;&nbsp;&nbsp;Mode: <?php echo $sf_user->getAttribute('mode', 'search')?>
   <div style="float:right;padding:0px 20px">
     
     <span><i>Server Time: <span id="timer"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
     
     <b>Welcome <?php echo  $sf_user->getName()?>&nbsp;&nbsp;|&nbsp;&nbsp;</b>
     
     <a style="color:yellow" href="<?php echo url_for('user/edit?id='.$sf_user->getGuardUser()->getId()).'?edit_pager=0&_frm=MyAccount'?>">My Account</a>&nbsp;&nbsp;|&nbsp;&nbsp;
     
     <?php echo link_to('Logout', 'sf_guard_signout', array(), array('style' => 'color:#FFF;font-weight:bold')) ?>
   </div>
</div>
<?php include_partial('default/search_flashes') ?>
