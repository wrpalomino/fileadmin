<?php use_helper('I18N', 'Date') ?>
<?php include_partial(sfContext::getInstance()->getModuleName().'/assets') ?>

<div id="sf_admin_container">
  <table id="layout2">
  <tr>
    <td>
      <?php include_partial($this->getModuleName().'/section_links', array('section_links' => $section_links, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </td>
    <td align="right">
      <div id="sf_admin_content">
        <?php include_partial($this->getModuleName().'/links', array('links' => $links, 'configuration' => $configuration, 'helper' => $helper)) ?>
      </div>
      <div id="sf_admin_extra_content">
        <?php foreach ($extra_options as $option): ?>
        <div class="sf_admin_radio"><input type="checkbox" name="<?php echo $option['value'] ?>" value="<?php echo $option['value'] ?>" /> <?php echo $option['text'] ?></div>
        <?php endforeach; ?>
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
