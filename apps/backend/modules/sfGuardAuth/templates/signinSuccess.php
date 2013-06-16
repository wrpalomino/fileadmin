<?php use_helper('I18N') ?>

<div align="center">
  <?php
    if (in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'))) {
      echo '<h1>File Admin - Test Site Only</h1>';
      echo 'Live site at: <a href="http://'.sfConfig::get("app_server_proip").'">File Admin Live</a>';
    }
  ?>
</div>

<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>