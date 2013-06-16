[?php if ($field->isPartial()): ?]
  [?php include_partial('<?php echo $this->getModuleName() ?>/'.$name, array('form' => $form, 'attributes' => $attributes->getRawValue())) ?]
[?php elseif ($field->isComponent()): ?]
  [?php include_component('<?php echo $this->getModuleName() ?>', $name, array('form' => $form, 'attributes' => $attributes->getRawValue())) ?]
[?php else: ?]
  <div class="[?php echo $class ?][?php $form[$name]->hasError() and print ' errors' ?]">
    [?php echo $form[$name]->renderError() ?]
    <div>
      [?php echo $form[$name]->renderLabel($label) ?]

      <div class="content">
          [?php echo sfContext::getInstance()->getUser()->renderX($form[$name], $attributes->getRawValue()) ?]
      </div>

      [?php if ($help): ?]
        <div class="help">[?php echo __($help, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</div>
      [?php elseif ($help = $form[$name]->renderHelp()): ?]
        <div class="help">[?php echo $help ?]</div>
      [?php endif; ?]
    </div>
  </div>
[?php endif; ?]
