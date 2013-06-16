<?php use_helper('I18N', 'Date') ?>
<?php include_partial(sfContext::getInstance()->getModuleName().'/assets') ?>

<div id="sf_admin_container">
  <table id="layout2">
  <tr>
    <td width="90%">
      <div id="sf_admin_content">
        <iframe id="frame" src="<?php echo url_for('sms/index?edit_pager=0') ?>" style="width:100%;border-style:none;min-height:400px"></iframe>
      </div>
    </td>
    <td align="right" width="10%">
      <div id="sf_admin_content">
        <?php include_partial($this->getModuleName().'/links', array('links' => $links, 'configuration' => $configuration, 'helper' => $helper)) ?>
      </div>
    </td>
  </tr>  
  </table>
  
  <?php if ($mode == 'browse'): ?>
  <div id="sf_admin_footer">
    <?php include_partial(sfContext::getInstance()->getModuleName().'/common_pager', array('helper' => $helper, 'pager' => $pager, 'edit_pager' => $edit_pager)) ?>
  </div>
  <?php endif; ?>  
  
</div>