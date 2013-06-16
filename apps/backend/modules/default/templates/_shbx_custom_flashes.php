<?php if ($sf_user->hasFlash('shbx_custom_error')): ?>
  <div id="sf_admin_container"><div class="error"><?php echo __($sf_user->getFlash('shbx_custom_error'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('shbx_custom_info')): ?>
  <div id="sf_admin_container"><div class="info"><?php echo __($sf_user->getFlash('shbx_custom_info'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('shbx_custom_notice')): ?>
  <div id="sf_admin_container"><div class="notice"><?php echo __($sf_user->getFlash('shbx_custom_notice'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>
