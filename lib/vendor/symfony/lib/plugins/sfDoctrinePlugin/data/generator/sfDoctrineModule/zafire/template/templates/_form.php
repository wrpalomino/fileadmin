[?php use_stylesheets_for_form($form) ?]
[?php use_javascripts_for_form($form) ?]

<div class="sf_admin_form">
  [?php 
    if (isset($helper->form_attributes)) echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>', $helper->form_attributes);
    else echo form_tag_for($form, '@<?php echo $this->params['route_prefix'] ?>');
  ?]
  
    [?php echo $form->renderHiddenFields(false) ?]

    [?php if ($form->hasGlobalErrors()): ?]
      [?php echo $form->renderGlobalErrors() ?]
    [?php endif; ?]

    [?php // added by William, 01/06/2013: only for testing
      foreach($form->getWidgetSchema()->getPositions() as $widgetName) {
        echo $form[$widgetName]->renderError();
      }  ?]
    
    
    [?php 
      $num_tabs = 0;
      if ( (method_exists($helper, 'getTabs')) && ($helper->getTabs()) ) {
        foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): 
          $num_tabs++;
        endforeach; 
      }
    ?]

      
    [?php if ($num_tabs > 1): ?]
      
      <input type="hidden" name="num_tabs" id="num_tabs" value="[?php echo $num_tabs?]" />
      <div>
        <ul class="tabsje">
          [?php $count=0; ?]
          [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
            [?php $count++ ?]
            <li id="tab_selected_[?php echo $count?]" [?php if ($count == 1): ?]class="activeje"[?php endif; ?] onclick="show_tab([?php echo $count?])"><a class="tabHref">[?php echo __($fieldset, array(), '<?php echo $this->getI18nCatalogue() ?>') ?]</a></li>
          [?php endforeach; ?]
        </ul>
      <div class="hr">.</div>
      </div>

      <div id="parent">
        [?php $count=0; ?]
        [?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?]
          [?php $count++ ?]
          <div id="tab_[?php echo $count?]" [?php if ($count == 1): ?]class="tab_[?php echo $count?]"[?php else: ?]class="tab_more"[?php endif; ?]>
          [?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'num_tabs' => $num_tabs)) ?]
          </div>
        [?php endforeach; ?]

        <!--<div align="center" style="width:100%">
                {if $num_tab > 1}{assign var="nj" value=$num_tab-1}<button onclick="show_tab({$nj}); return false" name="previous" style="width:150px;padding: 0 5" >&lt;&lt; Previous tab</button>{/if}
                {if $num_tab > 1 AND $num_tab < 4}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{/if}
                {if $num_tab < 4}{assign var="pj" value=$num_tab+1}<button onclick="show_tab({$pj}); return false" name="next" style="width:150px;padding: 0 5" >Next tab &gt;&gt;</button>{/if}
        </div>-->
      </div>
    
    [?php else: ?]
    
      [?php $form_template = (method_exists($helper, 'getFormTemplate') && ($helper->getFormTemplate() != null) ) ? $helper->getFormTemplate() : ($form->isNew() ? 'new' : 'edit'); ?]
      [?php foreach ($configuration->getFormFields($form, $form_template) as $fieldset => $fields): ?]
	[?php include_partial('<?php echo $this->getModuleName() ?>/form_fieldset', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'num_tabs' => $num_tabs)) ?]
      [?php endforeach; ?]
    
    [?php endif; ?]

    [?php include_partial('<?php echo $this->getModuleName() ?>/form_actions', array('<?php echo $this->getSingularName() ?>' => $<?php echo $this->getSingularName() ?>, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?]
  </form>
</div>
