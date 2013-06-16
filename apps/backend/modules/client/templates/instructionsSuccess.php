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
        Instructions in File? <select name="options">
        <?php foreach ($instructions_on_file as $k => $v): ?>
          <option <?php if ($iof_value == $k) echo "selected"?> value="<?php echo $k?>"><?php echo $v?></options>
        <?php endforeach;?>
        </select>
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
