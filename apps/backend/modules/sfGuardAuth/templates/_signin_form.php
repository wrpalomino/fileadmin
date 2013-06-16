<?php use_helper('I18N') ?>

<style>
  div.loginPage {
    width: 59%;
    vertical-align: middle;
    margin: 10% 20%;
    background: url('<?php echo $sf_user->getBaseUrl()?>images/ft_logo.png') repeat-x;
  }
  table.loginTable {
    border-collapse: collapse;
    border: 1px solid;
    margin: auto;
    padding: 100px;
    white-space: nowrap;
    background-color: #EEEEEE;
    width: 400px;
  }
</style>

<div class="loginPage">

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <br/>
  <table class="loginTable">
    <tbody>
      <tr><td colspan="2"><div id="sf_admin_container"><div class="info">Note: Password is case sensitive</div></div></td></tr>
      <?php echo $form ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" value="<?php echo __('Signin', null, 'sf_guard') ?>" />
          
          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
          <?php endif; ?>

          <?php if (isset($routes['sf_guard_register'])): ?>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
  </table>
  <br/>
</form>
  
</div>