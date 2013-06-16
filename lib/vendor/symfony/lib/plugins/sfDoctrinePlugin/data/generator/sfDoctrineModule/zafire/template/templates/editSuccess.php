[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="sf_admin_container">
  [?php if (!$no_title): ?]
    <h1>[?php echo <?php echo $this->getI18NString('edit.title') ?> ?]</h1>
  [?php endif; ?]

  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  <div id="sf_admin_header">
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_header', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
  </div>

  [?php if ($partial_links): ?]
  
  <table id="layout">
  <tr>
    <td align="left">
      <div id="sf_admin_content">
        [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
      </div>
    </td>
    
    [?php if (isset($section_links)): ?]
    <td>
      [?php include_partial('<?php echo $this->getModuleName() ?>/section_links', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'section_links' => $section_links, 'configuration' => $configuration, 'helper' => $helper)) ?]
    </td>
    [?php endif; ?]
    
    <td align="right">
      <div id="sf_admin_content">`
        [?php include_partial('<?php echo $this->getModuleName() ?>/links', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'links' => $links, 'configuration' => $configuration, 'helper' => $helper)) ?]
      </div>
    </td>
  </tr>
  </table>  
  
  [?php else: ?]
  
  <div id="sf_admin_content">
    
    <?php //added by William, 17/05/2013: ?>
    [?php if ($helper->formlist): ?]
      <div style="display: inline-block;vertical-align:top;">
        [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
      </div>
      <div style="display: inline-block;width:50%">
        [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper, 'sort_headers' => false)) ?]
      </div>
    [?php else: ?]   
      [?php include_partial('<?php echo $this->getModuleName() ?>/form', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
    [?php endif; ?]
    
  </div>
  
  [?php endif; ?]

  <div id="sf_admin_footer">
    [?php if ($edit_pager): ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/common_pager', array('helper' => $helper, 'pager' => $pager, 'edit_pager' => $edit_pager)) ?]
    [?php endif; ?]
    
    [?php include_partial('<?php echo $this->getModuleName() ?>/form_footer', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration)) ?]
  </div>
</div>
