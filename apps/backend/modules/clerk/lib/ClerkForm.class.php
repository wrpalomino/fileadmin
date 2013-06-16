<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ClerkForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'work_phone',     'mobile',     'fax',
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    $this->useFields(array('username', 'last_name', 'first_name', 'email_address', 'agencies_list', 'sfGuardUserProfiles', 'groups_list'));
    //$this->widgetSchema['last_name']->setLabel("Name");   
    
    $this->widgetSchema['last_name']->setLabel('Last name / Office (List)');
    $this->validatorSchema['first_name']->setOption('required', false);
    
    $this->widgetSchema['agencies_list']->setOption('table_method', 'getClerkOfficesCB');
    $this->widgetSchema['agencies_list']->setLabel("Clerk's Office");
    
    // set the dafault values for username and group for this type of user
    $this->setUserDefaultValues('clerk');
    
    // hide this field, necessary to save the data but annoying for the final user
    $this->hideField('groups_list');
    
    // re adding asterisk for required fields: we have modified some validators and labels
    $this->setAsteriskForRequiredFields(true);
  }
  
}

?>