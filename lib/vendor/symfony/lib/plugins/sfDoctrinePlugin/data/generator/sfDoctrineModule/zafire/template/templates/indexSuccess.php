[?php use_helper('I18N', 'Date') ?]
[?php include_partial('<?php echo $this->getModuleName() ?>/assets') ?]

<div id="sf_admin_container">
  
  [?php if (!$no_title): ?]
  <h1>[?php echo <?php echo $this->getI18NString('list.title') ?> ?]</h1>
  [?php endif; ?]

  [?php include_partial('<?php echo $this->getModuleName() ?>/flashes') ?]

  <div id="sf_admin_header">
    [?php include_partial('<?php echo $this->getModuleName() ?>/list_header', array('pager' => $pager, 'helper' => $helper)) ?]
  </div>

  
[?php if ( ($show_filters)&&($mode == 'search') ): ?]

  [?php if (!$only_filters): ?]  
    <?php if ($this->configuration->hasFilterForm()): ?>
      <a id="displayText" href="javascript:toggle();">
        [?php echo image_tag('search.png', array('id' => 'filters_img', 'alt' => 'Search', 'title' => 'Search', 'size' => '16x16')) ?]
        <span id="filters_txt">Search</span></a>
      <div id="searchForm" style="display:none;width:400px">
        [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration, 'only_filters' => $only_filters, 'helper' => $helper)) ?]
      </div>
      <br/><br/>
    <?php endif; ?>
  [?php endif; ?]

[?php endif; ?]
  
  
[?php if ($partial_links): ?]


<table id="layout">
  <tr>
    <td>
      <div id="sf_admin_content">
        
      [?php if ($only_filters): ?]
     
        [?php include_partial('<?php echo $this->getModuleName() ?>/filters', array('form' => $filters, 'configuration' => $configuration, 'only_filters' => $only_filters, 'helper' => $helper)) ?]    
     
      [?php else: ?]
      
        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
            <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
        <?php endif; ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
            <ul class="sf_admin_actions">
              [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
              [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
            </ul>
        <?php if ($this->configuration->getValue('list.batch_actions')): ?>
            </form>
        <?php endif; ?>
      
      [?php endif; ?]
      
      </div>
    </td>
    
    [?php if (isset($section_links)): ?]
    <td>
      [?php include_partial('<?php echo $this->getModuleName() ?>/section_links', array('section_links' => $section_links, 'configuration' => $configuration, 'helper' => $helper)) ?]
    </td>
    [?php endif; ?]
    
    [?php if (count($links)): ?]
    <td align="right">
      <div id="sf_admin_content">
        [?php include_partial('<?php echo $this->getModuleName() ?>/links', array('links' => $links, 'configuration' => $configuration, 'helper' => $helper)) ?]
      </div>
    </td>
    [?php endif; ?]
    
  </tr>  
  </table>


[?php else: ?]
  
  
  <div id="sf_admin_content">
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    <form action="[?php echo url_for('<?php echo $this->getUrlForAction('collection') ?>', array('action' => 'batch')) ?]" method="post">
<?php endif; ?>
    [?php include_partial('<?php echo $this->getModuleName() ?>/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?]
    <ul class="sf_admin_actions">
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_batch_actions', array('helper' => $helper)) ?]
      [?php include_partial('<?php echo $this->getModuleName() ?>/list_actions', array('helper' => $helper)) ?]
    </ul>
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
    </form>
<?php endif; ?>
  </div>


[?php endif; ?]


  <div id="sf_admin_footer">
    [?php include_partial('<?php echo $this->getModuleName() ?>/list_footer', array('pager' => $pager, 'helper' => $helper)) ?]
  </div>
</div>
