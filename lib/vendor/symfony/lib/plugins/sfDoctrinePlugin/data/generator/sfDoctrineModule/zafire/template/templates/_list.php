<link rel="stylesheet" type="text/css" media="print" href="<?php echo sfContext::getInstance()->getRequest()->getRelativeUrlRoot()?>/css/printList.css" />

<div class="sf_admin_list">
  [?php if (!$pager->getNbResults()): ?]
    <p>[?php echo __('No result', array(), 'sf_admin') ?]</p>
  [?php else: ?]
    <table cellspacing="0">
      
      
<?php // added by William, 12/02/2012 ?>      
[?php if ( (!isset($allow_table_header)) || ($allow_table_header) ): ?]


      <thead>
        <tr>          
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
          <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
<?php endif; ?>
                    
          <?php // added by William, 12/02/2012 ?>  
          [?php if (isset($sort_headers)): ?]
          
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort, 'sort_headers' => $sort_headers)) ?]
            
          [?php else: ?]
          
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_th_<?php echo $this->configuration->getValue('list.layout') ?>', array('sort' => $sort)) ?]
          
          [?php endif; ?]
          
          
<?php // added by William, 12/02/2012 ?>      
[?php if ( (!isset($apply_actions)) || ($apply_actions) ): ?]
          
<?php if ($this->configuration->getValue('list.object_actions')): ?>
          <th id="sf_admin_list_th_actions">[?php echo __('Actions', array(), 'sf_admin') ?]</th>
<?php endif; ?>
          
[?php endif; // apply actions ?]

        </tr>
      </thead>
      
      
      <tfoot>
        <tr>
          <th colspan="<?php echo count($this->configuration->getValue('list.display')) + ($this->configuration->getValue('list.object_actions') ? 1 : 0) + ($this->configuration->getValue('list.batch_actions') ? 1 : 0) ?>">
            
            [?php if ($pager->haveToPaginate()): ?]
              [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('pager' => $pager, 'helper' => $helper)) ?]
            [?php endif; ?]

            [?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?]
            
            [?php if ($pager->haveToPaginate()): ?]
              [?php echo __('(page %%page%%/%%nb_pages%%)', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?]
            [?php endif; ?] 
          </th>
        </tr>
      </tfoot>
      

[?php endif; // allow table header ?]           
      
      
      <tbody>
        
        [?php foreach ($pager->getResults() as $i => $<?php echo $this->getSingularName() ?>): $odd = fmod(++$i, 2) ? 'odd' : 'even' ?]
          <tr class="sf_admin_row [?php echo $odd ?]">
<?php if ($this->configuration->getValue('list.batch_actions')): ?>
            
            
          <?php // added by William, 12/02/2012 ?>  
          [?php if (isset($sort_headers)): ?]
            
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper, 'sort_headers' => $sort_headers)) ?]
            
          [?php else: ?]
          
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_batch_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
          
          [?php endif; ?]
          
            
<?php endif; ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_<?php echo $this->configuration->getValue('list.layout') ?>', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>)) ?]
            
            
<?php // added by William, 12/02/2012 ?>            
[?php if ( (!isset($apply_actions)) || ($apply_actions) ): ?]
            
<?php if ($this->configuration->getValue('list.object_actions')): ?>
            [?php include_partial('<?php echo $this->getModuleName() ?>/list_td_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'helper' => $helper)) ?]
<?php endif; ?>
            
[?php endif; ?]            
            

          </tr>
        [?php endforeach; ?]
      </tbody>
    </table>
  [?php endif; ?]
</div>
<script type="text/javascript">
/* <![CDATA[ */
function checkAll()
{
  var boxes = document.getElementsByTagName('input'); for(var index = 0; index < boxes.length; index++) { box = boxes[index]; if (box.type == 'checkbox' && box.className == 'sf_admin_batch_checkbox') box.checked = document.getElementById('sf_admin_list_batch_checkbox').checked } return true;
}
/* ]]> */
</script>
