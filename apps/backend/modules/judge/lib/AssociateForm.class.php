<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AssociateForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'work_phone',     'mobile',     'fax',
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    $this->useFields(array('username', 'last_name', 'first_name', 'email_address', 'sfGuardUserProfiles', 'groups_list'));
    //$this->widgetSchema['last_name']->setLabel("Name");   
    
    // set the dafault values for username and group for this type of user
    $this->setUserDefaultValues('associate');
    
    // hide this field, necessary to save the data but annoying for the final user
    $this->hideField('groups_list');
  }
  
}

?>