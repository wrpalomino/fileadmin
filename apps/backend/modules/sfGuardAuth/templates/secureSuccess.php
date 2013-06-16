<?php use_helper('I18N') ?>

<div class="content">
 
<?php if ($sf_user->isAuthenticated()): ?>

  <h3><?php echo __('Sorry, the Forms & Download section requires you sign our agreement, please proceed to do it:', null, 'sf_guard') ?></h3>
  <br/><br/>
  <a href="<?php echo url_for('agreement/index') ?>" target="_self" title="Agreement">Sign Agreement</a>
  
<?php else: ?>

  <h2><?php echo __('Oops! The page you asked for is secure and you do not have proper credentials.', null, 'sf_guard') ?></h2>

  <p><?php echo sfContext::getInstance()->getRequest()->getUri() ?></p>

  <h3><?php echo __('Login below to gain access', null, 'sf_guard') ?></h3>

  <?php echo get_component('sfGuardAuth', 'signin_form') ?>
  
<?php endif; ?>

 </div>