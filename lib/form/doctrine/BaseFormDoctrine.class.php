<?php

/**
 * Project form base class.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends ahBaseFormDoctrine
//abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
    // allow extra fields
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
    // unset these fields from objects, bc they are set automatically when user create or update a record
    unset($this['created_at'], $this['updated_at']);
    
    // display a text value instead numeric ids
    $this->setDoctrineChoiceFieldsMethod();
    
    // set format for dates in all objects
    $this->setDatesFormat();
  }
  
  
  // add an extra field to check user willingness to link object to the file
  public function addThisFormField()
  {
    $this->widgetSchema['_frm'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['_frm']->setDefault(str_replace('Form' , '', get_class($this)));
    $this->validatorSchema['_frm'] = new sfValidatorPass();
  }
  
  
  // add an extra field to check user willingness to link object to the file
  public function addLinkToFileField()
  {
    $this->widgetSchema['link_to_file'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['link_to_file']->setDefault(0);
    $this->validatorSchema['link_to_file'] = new sfValidatorPass();
  }
  
  
  public function useFieldsEmbeddedForm($embeddedFormName, $use_fields)
  {
    $embedded_form = $this->getEmbeddedForm($embeddedFormName); 
    foreach($embedded_form->getObject()->toArray() as $key => $val) $tmp[] = strtolower($key);
   
    $tmp = array_diff($tmp, $use_fields);
    foreach($tmp as $value){
      unset($this->widgetSchema[$embeddedFormName][$value]);
      //unset($this->validatorSchema[$embeddedFormName][$value]);
    }
    foreach($use_fields as $k => $field) {
      $this->widgetSchema[$embeddedFormName]->moveField($field, sfWidgetFormSchema::LAST);
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
  
  // set default values for users (username and group)
  public function setUserDefaultValues($user_type)
  {
    $this->widgetSchema['groups_list']->addOption('table_method', 'get'.ucfirst($user_type).'GroupId');
    $this->widgetSchema['groups_list']->setLabel('Group');
    $this->widgetSchema['username'] = new sfWidgetFormInputHidden();
    $this->setDefault('username', Doctrine::getTable('sfGuardUser')->getDefaultUsername(strtolower($user_type)));
  }
  
  
  // format sfWidgetFormTime()
  public function formattedWidgetFormTime()
  {
    $hours_12hour = array('12 AM', '01 AM', '02 AM', '03 AM', '04 AM', '05 AM', '06 AM', '07 AM', '08 AM', '09 AM', '10 AM', '11 AM', 
                          '12 PM', '01 PM', '02 PM', '03 PM', '04 PM', '05 PM', '06 PM', '07 PM', '08 PM', '09 PM', '10 PM', '11 PM'); 
    $hours = range(0, 23);
    $minutes = range(0, 59, 5);
    $minutes_labels = implode('|', $minutes);
    $minutes_labels = explode('|', '0'.str_replace('|5|', '|05|', $minutes_labels));
    
    $ft = new sfWidgetFormTime(array(
            'hours' => array_combine($hours, $hours_12hour),
            'minutes' => array_combine($minutes, $minutes_labels)
            //'format' => '%date% &mdash; %time%',  
            //'default' => date('Y/m/d H:i', time()) 
          ));    
    
    return $ft;
  }
  
  
  // set format for dates fields
  public function setDatesFormat()
  {
    $years_dob = range(1900, (int)date('Y'));
    $years_other = range(2010, (int)date('Y')+5);
    
    $months = range(1, 12);
    $months_names = array('JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');
    
    /*$hours_12hour = array('12 AM', '01 AM', '02 AM', '03 AM', '04 AM', '05 AM', '06 AM', '07 AM', '08 AM', '09 AM', '10 AM', '11 AM', 
                          '12 PM', '01 PM', '02 PM', '03 PM', '04 PM', '05 PM', '06 PM', '07 PM', '08 PM', '09 PM', '10 PM', '11 PM'); 
    $hours = range(0, 23);*/
    
    foreach($this->getWidgetSchema()->getFields() as $key => $value) { 
      
      $years = ($key == 'dob') ? $years_dob : $years_other;
      
      if ($value instanceof sfWidgetFormDate) {
        $this->widgetSchema[$key] = new sfWidgetFormDate(array(
            'format' => '%day%/%month%/%year%', 
            'years' => array_combine($years, $years),
            'months' => array_combine($months, $months_names),
            'can_be_empty' => true,
          ));
      }
      /*else if ($value instanceof sfWidgetFormDateTime) {
        $this->widgetSchema[$key] = new sfWidgetFormDateTime(array(
            'date' => array(
                'format' => '%day%/%month%/%year%', 
                //'can_be_empty' => false,
                'years' => array_combine($years, $years),
                'months' => array_combine($months, $months_names),
                ),
            'time' => array(
                'hours' => array_combine($hours, $hours_12hour)
                ),
            //'format' => '%date% &mdash; %time%',  
            //'default' => date('Y/m/d H:i', time()) 
          ));
      }*/
      else if ($value instanceof sfWidgetFormFilterDate) {
        $this->widgetSchema[$key] = new sfWidgetFormFilterDate(array(
            'from_date' => new sfWidgetFormDate(array(
                'format' => '%day%/%month%/%year%',
                'years' => array_combine($years, $years),
                'months' => array_combine($months, $months_names),
                )), 
            'to_date' => new sfWidgetFormDate(array(
                'format' => '%day%/%month%/%year%',
                'years' => array_combine($years, $years),
                'months' => array_combine($months, $months_names),
                )),
            'with_empty' => false,
          )); 
      }
    }
  }
 
  
  /*// bind embedded filters form
  public function bindEmbeddedForms($embedded_forms, $values)
  {
    if($this->isValid()) {
      foreach ($embedded_forms as $name => $form) {
        if (isset($values[$name])) {
          $form->isBound = true;
          $form->values = $values[$name];

          if ($form->embeddedForms) {
            $this->bindEmbeddedForms($form->embeddedForms, $values[$name]);
          }
	}
      }
    }
  }
  
  public function bind(array $taintedValues = null, array $taintedFiles = null) 
  {
    parent::bind($taintedValues, $taintedFiles);
    $this->bindEmbeddedForms($this->embeddedForms, $this->getValues());
  }*/
  
  
  // added by William, 14/03/2013: show errors for form
  public function debug($arr=null)
  {
    if (sfConfig::get('sf_environment') != 'dev') {
      return;
    }
    if ($arr === null) $arr = $this->getErrorSchema()->getErrors();
    if (count($arr) > 0) {
      foreach($arr as $key => $error) {
        if (is_array($error)) debug($error);
        else echo '<p>' . $key . ': ' . $error . '</p>';
      }
    }
  }

}
