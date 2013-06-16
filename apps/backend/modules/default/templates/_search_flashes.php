<?php if ($sf_user->hasFlash('search_error')): ?>
  <div id="sf_admin_container"><div class="error"><?php echo __($sf_user->getFlash('search_error'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('search_info')): ?>
  <div id="sf_admin_container"><div class="info"><?php echo __($sf_user->getFlash('search_info'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('search_notice')): ?>
  <div id="sf_admin_container"><div class="notice"><?php echo __($sf_user->getFlash('search_notice'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>
  