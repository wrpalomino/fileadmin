<?php if ($sf_user->hasFlash('error')): ?>
  <div id="sf_admin_container"><div class="error"><?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('info')): ?>
  <div id="sf_admin_container"><div class="info"><?php echo __($sf_user->getFlash('info'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div id="sf_admin_container"><div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div></div>
<?php endif; ?>