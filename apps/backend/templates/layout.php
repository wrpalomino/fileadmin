<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    
    <script type="text/javascript">
      Shadowbox.init({
              players:    ["img","iframe","html"],
              handleOversize: "drag",
              modal: true,
              overlayOpacity: "0.8"
              //onClose: RefreshParent
      });
      var SF_BASE_URL = '<?php echo $sf_request->getUriPrefix().$sf_request->getPathInfoPrefix().'/' ?>';
      var PRO_BASE_URL = 'http://'+'<?php echo sfConfig::get('app_server_baseurl') ?>';

      if (top != self) {
        window.location.replace(window.location.pathname+'?shbx=1');
      }
    </script>  
  </head>
  
  <body>
    <?php //echo $sf_user->getCulture(); ?>
    <?php //Link::getLinks('client_correspondence')?>
    
    <?php if ($sf_user->isAuthenticated()): ?>
      <div id="clientFilter">
        <?php include_component_slot('clientFilter', array('default_action' => "@mf_".sfContext::getInstance()->getModuleName())) ?>
      </div>
      <div id="sideBar">
        <?php include_component_slot('sidebar');?>
      </div>
    <?php endif; ?>
    <div id="content">
      <?php include_partial('default/custom_flashes') ?>
      <?php echo $sf_content ?>
    </div>
 </body>
</html>
