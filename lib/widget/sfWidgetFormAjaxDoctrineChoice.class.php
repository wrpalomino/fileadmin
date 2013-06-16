<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sfWidgetFormAjaxDoctrineChoice
 *
 * @author William
 */
class sfWidgetFormAjaxDoctrineChoice extends sfWidgetFormDoctrineChoice
{
  protected function configure($options = array(), $attributes = array())
  {
    $this->addRequiredOption('form_module');
    parent::configure($options, $attributes);
  }
  
  
  public function render($name, $value = null, $attributes = array(), $errors = array()) 
  {
    $button_js = "selectOpenBox('".$this->getOption('form_module')."', '".$this->generateId($name)."'); return false";
    $button_style = 'font-size:10px;padding:0px;margin:0px';
    
    $button = $this->renderContentTag('button', 'Add/Edit', array_merge(array('name' => $name.'_btn'), array('style' => $button_style, 'onclick' => $button_js)));
    return '<div style="white-space: nowrap">'.parent::render($name, $value, $attributes, $errors). $button.'</div>';
  }
}

?>
