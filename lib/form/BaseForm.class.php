<?php

/**
 * Base project form.
 * 
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class BaseForm extends sfFormSymfony
{
  // showing the create_at & updated_at fields as text
  public function setDatesFieldAsText()
  {
    if (!$this->isNew()) {
      $this->createTextField('updated_at');
      $this->createTextField('created_at');
    }
  }
  
  public function createTextField($field, $position='', $use_method=false)
  {
    $label = isset($this->widgetSchema[$field]) ? $this->widgetSchema[$field]->getLabel() : '';
    if (empty($label)) $label = ucfirst(str_replace(array('_id', '_'), array('', ' '), $field));
    
    $this->widgetSchema[$field.'_text'] = new sfWidgetFormInputText(array('label' => $label), $this->asText());
    $this->validatorSchema[$field.'_text'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
   
    $value = $this->getObject()->get($field);   // set the default value for the text
    
    // use method __toString instead the object's id number
    if ($use_method) {
      $method = "get".str_replace(' ', '', ucwords(str_replace(array('_id', '_'), array('', ' '), ($field))));    
      if ( method_exists($this->getObject(), $method) || is_callable(array($this->getObject(), $method)) ) {
        $value = $this->getObject()->$method();
      } 
    }
    
    $this->setDefault($field.'_text', $value);
    
    // put it in a specific position
    if ( !empty($position) && (isset($this->widgetSchema[$field])) ) {
      $positionx = ($position == "AFTER") ? sfWidgetFormSchema::AFTER : sfWidgetFormSchema::BEFORE;
      $this->widgetSchema->moveField($field.'_text', $positionx, $field);
    }
  }

  public function asText($size=40)
  {
    return array('readonly' => 'readonly', 'style' => 'border:none;background:transparent', 'size' => $size);
  }

  // hid ethe form field
  public function hideField($field, $show_as_text=false)
  {
    if (is_array($field)) {
      foreach ($field as $k => $v) {
        $this->hideField($v, $show_as_text);
      }
    }
    else {
      if ($show_as_text) {
        $this->createTextField($field, 'AFTER', true);
        //$this->widgetSchema[$field] = new sfWidgetFormInputHidden();  
      }
      //else {
        $this->widgetSchema[$field]->setLabel(false);
        $this->widgetSchema[$field]->setAttribute('style', 'visibility:hidden;height:0px');
      //}
    }
  }
  
  // avoid change event in a dropbox
  public function fixedValue()
  {
    return array('onfocus' => "this.defaultIndex=this.selectedIndex;", 'onchange' => "this.selectedIndex=this.defaultIndex;");
  }
  
  public function setAsteriskForRequiredFields($redo=false)
  {
    if ($redo) {
      foreach($this->getFormFieldSchema()->getWidget()->getFields() as $key => $object) {
        $label0 = $this->getFormFieldSchema()->offsetGet($key)->renderLabelName();
        if (strpos($label0, "&nbsp*") !== false) $this->widgetSchema->setLabel($key, str_replace ("&nbsp*", '', $label0)); 
      }
    }
    
    foreach($this->getFormFieldSchema()->getWidget()->getFields() as $key => $object) {
      $label = $this->getFormFieldSchema()->offsetGet($key)->renderLabelName();
      if($this->validatorSchema[$key]->getOption('required') == true) {
        if (!in_array($label, array("SfGuardUserProfiles", ""))) $this->widgetSchema->setLabel($key, $label."&nbsp*"); 
      }
    }
  }

  
  /**
   * Embeds a form like "mergeForm" does, but will still
   * save the input data.
   */
  public function embedMergeForm($name, sfForm $form)
  {
    // This starts like sfForm::embedForm
    $name = (string) $name;
    if (true === $this->isBound() || true === $form->isBound())
    {
      throw new LogicException('A bound form cannot be merged');
    }
    $this->embeddedForms[$name] = $form;
 
    $form = clone $form;
    unset($form[self::$CSRFFieldName]);
 
    // But now, copy each widget instead of the while form into the current
    // form. Each widget ist named "formname|fieldname".
    foreach ($form->getWidgetSchema()->getFields() as $field => $widget)
    {
      $widgetName = "$name-$field";
      if (isset($this->widgetSchema[$widgetName]))
      {
        throw new LogicException("The forms cannot be merged. A field name '$widgetName' already exists.");
      }
 
      $this->widgetSchema[$widgetName] = $widget;                           // Copy widget
      $this->validatorSchema[$widgetName] = $form->validatorSchema[$field]; // Copy schema
      $this->setDefault($widgetName, $form->getDefault($field));            // Copy default value
 
      if (!$widget->getLabel())
      {
        // Re-create label if not set (otherwise it would be named 'ucfirst($widgetName)')
        $label = $form->getWidgetSchema()->getFormFormatter()->generateLabelName($field);
        $this->getWidgetSchema()->setLabel($widgetName, $label);
      }
    }
 
    // And this is like in sfForm::embedForm
    $this->resetFormFields();
  }
 
  /**
   * Override sfFormDoctrine to prepare the
   * values: FORMNAME|FIELDNAME has to be transformed
   * to FORMNAME[FIELDNAME]
   */
  /*public function updateObject($values = null)
  {
    if (is_null($values))
    {
      $values = $this->values;
      foreach ($this->embeddedForms AS $name => $form)
      {
        foreach ($form AS $field => $f)
        {
          if (isset($values["$name-$field"]))
          {
            // Re-rename the form field and remove
            // the original field
            $values[$name][$field] = $values["$name-$field"];
            unset($values["$name-$field"]);
          }
        }
      }
    }
 
    // Give the request to the original method
    parent::updateObject($values);
  }*/
  
  
  
  
}
