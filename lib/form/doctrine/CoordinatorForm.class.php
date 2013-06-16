<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class CoordinatorForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array('work_phone','fax'));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    $this->useFields(array('username', 'last_name', 'first_name', 'email_address', 'sfGuardUserProfiles', 'groups_list'));
    
    // set the dafault values for username and group for this type of user
    $this->setUserDefaultValues('coordinator');
    
    // hide this field, necessary to save the data but annoying for the final user
    $this->hideField('groups_list');
  }
 
}

?>