<?php

/**
 * Project filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup()
  {
    // allow extra fields
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
    // unset these fields from all objects
    unset($this['created_at'], $this['updated_at']);
    
    // remove 'is_empty' check from all fields
    $this->removeEmptyChecks();
    
    // display a text value instead numeric ids
    $this->setDoctrineChoiceFieldsMethod();
    
    // set format for dates in all objects
    $this->setDatesFormat();
  }
  
  
  public function useFieldsEmbeddedForm($embeddedFormName, $use_fields)
  {
    $embedded_form = $this->getEmbeddedForm($embeddedFormName); 
    foreach($embedded_form->getWidgetSchema()->getFields() as $key => $val) $tmp[] = strtolower($key);
   
    $tmp = array_diff($tmp, $use_fields);
    foreach($tmp as $value){
      unset($this->widgetSchema[$embeddedFormName][$value]);
      unset($this->validatorSchema[$embeddedFormName][$value]);
    }
    foreach($use_fields as $k => $field) {
      $this->widgetSchema[$embeddedFormName]->moveField($field, sfWidgetFormSchema::LAST);
    }
    
  }
  
  // remove empty check from all the fields in the form
  public function removeEmptyChecks()
  {
    foreach($this->getWidgetSchema()->getFields() as $key => $value) {
      if (  ($value instanceof sfWidgetFormFilterInput) || 
            ($value instanceof sfWidgetFormFilterDate) ) {
        $this->widgetSchema[$key]->setOption('with_empty', false);
      }
    }
  }
 
  // show Name or value in sfWidgetFormDoctrineChoice
  public function setDoctrineChoiceFieldsMethod()
  {
    foreach($this->getWidgetSchema()->getFields() as $key => $value) {
      
      if ($value instanceof sfWidgetFormDoctrineChoice) {
        if (Doctrine::getTable($this->widgetSchema[$key]->getOption('model'))->hasColumn('name')) {
          $this->widgetSchema[$key]->setOption('method', 'getName');
        }
        else if (Doctrine::getTable($this->widgetSchema[$key]->getOption('model'))->hasColumn('value')) {
          $this->widgetSchema[$key]->setOption('method', 'getValue');
        }
      }
    }
  }
  
  // set format for dates fields
  public function setDatesFormat()
  {
    $years_dob = range(1900, (int)date('Y'));
    $years_other = range(2010, (int)date('Y')+5);
    
    foreach($this->getWidgetSchema()->getFields() as $key => $value) {  
      
      $years = ($key == 'dob') ? $years_dob : $years_other;
      
      if ($value instanceof sfWidgetFormDate) {
        $this->widgetSchema[$key] = new sfWidgetFormDate(array(
            'format' => '%day%/%month%/%year%', 
            'years' => array_combine($years, $years),
            'can_be_empty' => true,
          ));
      }
      else if ($value instanceof sfWidgetFormFilterDate) {
        $this->widgetSchema[$key] = new sfWidgetFormFilterDate(array(
            'from_date' => new sfWidgetFormDate(array(
                'format' => '%day%/%month%/%year%',
                'years' => array_combine($years, $years),
                )), 
            'to_date' => new sfWidgetFormDate(array(
                'format' => '%day%/%month%/%year%',
                'years' => array_combine($years, $years),
                )),
            'with_empty' => false,
          )); 
      }
    }
  }
  
  // bind embedded filters form
  public function bindEmbeddedForms($embedded_forms, $values)
  {
    if($this->isValid())
    {
      foreach ($embedded_forms as $name => $form)
      {
        $form->isBound = true;
	$form->values = $values[$name];

	if ($form->embeddedForms)
	{
	  $this->bindEmbeddedForms($form->embeddedForms, $values[$name]);
	}
      }
    }
  }
  
  public function bind(array $taintedValues = null, array $taintedFiles = null) 
  {
    parent::bind($taintedValues, $taintedFiles);
    
    foreach ($this->embeddedForms as $k => $v) {
      if (isset($taintedValues[$k])) $this->embeddedForms[$k]->bind($taintedValues[$k]);
    }
    //$this->bindEmbeddedForms($this->embeddedForms, $this->getValues());
  }
  
  public function getValues()
  { 
    /*$form = parent::getValues();
    foreach ($form as $k => $v) {
      echo $k .'->'. $v .'<br/>';
      foreach ($v as $k1 => $v1) {
        echo '......'.$k1 .'->'. $v1 .'<br/>';
        if (is_array($v1)) foreach ($v1 as $k2 => $v2) echo '...............'.$k2 .'->'. $v2 .'<br/>';
      }
    }*/
    
    return parent::getValues();
  }
  
  public function hideField($field, $show_as_text=false)
  {
    $this->widgetSchema[$field]->setLabel(false);
    $this->widgetSchema[$field]->setAttribute('style', 'visibility:hidden;height:0px');
    $this->widgetSchema->moveField($field, sfWidgetFormSchema::LAST);
  }
  
  public function isFilterArrayEmpty($arr)
  {
    $empty = true;
    foreach ($arr as $k => $v) {
      //echo $k .' =>'. $v.'<br/>';
      if (is_array($v)) {
        //$value = array_filter($v, 'strlen');
        //if (!empty($value)) $empty = false;
        $empty = $this->isFilterArrayEmpty($v);
      }
      else {
        if (!empty($v)) $empty = false;
      }
      if (!$empty) break;
    }
    return $empty;
  }
  
}
