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
      });
      var SF_BASE_URL = '<?php echo $sf_user->getBaseUrl('controller') ?>';
      var PRO_BASE_URL = 'http://'+'<?php echo sfConfig::get('app_server_baseurl') ?>';

      $(document).ready(function(){
        if (parent.Shadowbox) { 
          var actionx = $("form").attr('action');

          // for forms that can be in many layouts
          var shbx = $.urlParam('shbx');
          if (shbx) {
            $("form").attr("action", actionx  + "?shbx=1");
            $(".sf_admin_action_search_mode").css('display', 'none');

            if (shbx == 2) {  // succesful => close the window
              var obj_id = '<?php echo $sf_user->getAttribute('shbx_sel_obj', '')?>';
              var module = '<?php echo $sf_user->getAttribute('shbx_module', '')?>';
              //alert(obj_id+' 00 '+module);
              appendSelect(obj_id, module);
              if (module != 'document') parent.Shadowbox.close();
            }
          }

          // for document layout only
          var docx = $.urlParam('doc');
          if (docx) {
            $("form").attr("action", actionx  + "?doc=" + docx);
          }
        }
      });

      $(window).load(function() {
        if ( (window.frameElement.id == 'frame') && (top != self) ) { // only resize the embedded iframes
          parentIframeResize();          
        }
      });
      
    </script>
  </head>  
    
  <body>
    <div id="content">
      <?php 
        if (isset($_GET['sel_obj'])) {  // get the parent window variables
          $sf_user->setAttribute('shbx_sel_obj', $_GET['sel_obj']);
          $sf_user->setAttribute('shbx_module', $_GET['module']);
        }
      ?>
      <?php include_partial('default/shbx_custom_flashes') ?>
      <?php echo $sf_content ?>
    </div>
  </body>
</html>
