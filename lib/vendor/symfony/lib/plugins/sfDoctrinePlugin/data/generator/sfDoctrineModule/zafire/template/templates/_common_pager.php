[?php if ($edit_pager): ?]   
  <table id="edit_pager">
  <tr>
    <th colspan="<?php echo count($this->configuration->getValue('list.display')) + ($this->configuration->getValue('list.object_actions') ? 1 : 0) + ($this->configuration->getValue('list.batch_actions') ? 1 : 0) ?>">
      
      [?php // added by William, 02/03/2013: show pagination or not ?]
      [?php $pagination = isset($helper->pagination) ? $helper->pagination : $pager->haveToPaginate() ?]

      [?php if ($pagination): ?]
        [?php include_partial('<?php echo $this->getModuleName() ?>/pagination', array('helper' => $helper, 'pager' => $pager, 'edit_pager' => $edit_pager)) ?]
      [?php endif; ?]

      [?php echo format_number_choice('[0] no result|[1] 1 result|(1,+Inf] %1% results', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?]
      [?php if ($pagination): ?]
        [?php echo __('(page %%page%%/%%nb_pages%%)  .', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?]
      [?php endif; ?] 
    </th>
  </tr>
  </table>
[?php endif; ?]