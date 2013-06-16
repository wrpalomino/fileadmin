<?php

/**
 * UserFile form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ChangeFileNumberForm extends UserFileForm
{
  public function configure()
  {
    switch ($this->getOption('task')) {
      case 'chfinu':  
        $this->useFields(array('number'));
        $this->validatorSchema['number'] = new sfValidatorNumber(array('required' => true));
        $this->validatorSchema->setPostValidator(new sfValidatorCallback(array(
          'callback' => array($this, 'setCustomValues')
          )));
        $this->mergePostValidator(new sfValidatorDoctrineUnique(array(
            'model' => 'UserFile',
            'column' => array('number')
          )));
        break;
      case 'stficl':  case 'stfiro':
        $this->useFields(array('status_id'));
        $this->widgetSchema['status_id']->setOption('table_method', 'getUserFileStatus');
        $this->widgetSchema['status_id']->setOption('add_empty', false);
        break;
    }
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
  // format the number before saving
  public function setCustomValues($validator, $values) 
  {
    $values['number'] = str_pad($values['number'], 6, "0", STR_PAD_LEFT); 
    return $values;
  }
  
}