<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class InformantForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'honorific_id',   /*'agency_id',*/      'badge_number',     /*'home_phone',*/   
        'work_phone',     /*'mobile',*/         'other_phone',      'fax'
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    $this->widgetSchema['sfGuardUserProfiles']['honorific_id']->setOption('table_method', 'loadMilitia2');
       
    $this->useFields(array('username', 'last_name', 'first_name', 'email_address', 'agencies_list', 'sfGuardUserProfiles', 'groups_list'));
    
    $this->widgetSchema['agencies_list']->setLabel('Station');
    $this->widgetSchema['agencies_list']->setOption('table_method', 'getPoliceStationsCB');
    
    //$this->widgetSchema['sfGuardUserProfiles']['agency_id']->setOption('table_method', 'getPoliceStationsCB');
    //$this->widgetSchema['sfGuardUserProfiles']['agency_id']->setOption('add_empty', false);
    
    $this->widgetSchema['badge_number'] = new sfWidgetFormInputText();
    $this->validatorSchema['badge_number'] = new sfValidatorString();
    $this->widgetSchema->moveField('badge_number', sfWidgetFormSchema::BEFORE, 'email_address');
    $default_value = $this->getObject()->getUserProfiles()->getBadgeNumber();
    $this->widgetSchema['badge_number']->setDefault($default_value);
    
    $this->widgetSchema['sfGuardUserProfiles']['badge_number'] = new sfWidgetFormInputHidden();
    
    
    // set the dafault values for username and group for this type of user
    $this->setUserDefaultValues('informant');
    //$this->widgetSchema['last_name']->setLabel('Informant *');
    
    // hide this field, necessary to save the data but annoying for the final user
    $this->hideField('groups_list');
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setSpecialValues')))
    ); 
  }
  
  public function setSpecialValues($validator, $values)
  {
    if (empty($values['sfGuardUserProfiles']['agency_id'])) {
      unset($values['sfGuardUserProfiles']['agency_id']);
    }
    if (isset($values['badge_number'])) {
      $values['sfGuardUserProfiles']['badge_number'] = $values['badge_number'];
    }
    //$values['sfGuardUserProfiles']['dob'] = $values['sfGuardUserProfiles']['dob']['year'].'-'.$values['sfGuardUserProfiles']['dob']['month'].'-'.$values['sfGuardUserProfiles']['dob']['day'];
    
    return $values;
  }
  
}
?>