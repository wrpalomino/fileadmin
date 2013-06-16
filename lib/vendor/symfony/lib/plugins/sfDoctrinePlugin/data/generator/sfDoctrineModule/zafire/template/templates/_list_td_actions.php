
<?php if ($this->getSingularName() == 'document'): ?>
    
[?php if (sfContext::getInstance()->getUser()->hasCredential(array('E-ALL', 'E-'.$document->getDocumentType()->getShortName()), false)): ?]

<td>
  <ul class="sf_admin_td_actions">
<?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>
<?php if ('_delete' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>

<?php elseif ('_edit' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
  
<?php elseif ('_show' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToShow($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>    
    
<?php else: ?>
    <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
      <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
    </li>
    
<?php endif; ?>
<?php endforeach; ?>
  </ul>
</td>

[?php else: ?]
  [?php if (sfContext::getInstance()->getUser()->hasCredential('V-'.$document->getDocumentType()->getShortName())): ?]

<td>
  <ul class="sf_admin_td_actions">
<?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>
<?php if ('_show' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToShow($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
<?php endif; ?>
<?php endforeach; ?>
  </ul>
</td>
  [?php else: ?]
  
  <td></td>
  
  [?php endif; ?]

[?php endif; ?]


<?php else: ?>

<td>
  <ul class="sf_admin_td_actions">
<?php foreach ($this->configuration->getValue('list.object_actions') as $name => $params): ?>
<?php if ('_delete' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToDelete($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>

<?php elseif ('_edit' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToEdit($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>

<?php elseif ('_show' == $name): ?>
    <?php echo $this->addCredentialCondition('[?php echo $helper->linkToShow($'.$this->getSingularName().', '.$this->asPhp($params).') ?]', $params) ?>
    
<?php else: ?>
    <li class="sf_admin_action_<?php echo $params['class_suffix'] ?>">
      <?php echo $this->addCredentialCondition($this->getLinkToAction($name, $params, true), $params) ?>
    </li>
    
<?php endif; ?>
<?php endforeach; ?>
  </ul>
</td>

<?php endif; ?>
