<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ProsecutorForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'honorific_id',  'work_phone',     'mobile',     'fax',
        /*'agency_id'*/
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    //$this->widgetSchema['sfGuardUserProfiles']['agency_id']->setOption('table_method', 'getProsecutionsCB');
    //$this->widgetSchema['sfGuardUserProfiles']['agency_id']->setLabel('Prosecution');
        
    //$this->widgetSchema['sfGuardUserProfiles']['honorific_id']->setOption('table_method', 'loadMilitia');
    
    $this->useFields(array('username', 'last_name', 'first_name', 'email_address', 'agencies_list', 'sfGuardUserProfiles', 'groups_list'));
    
    $this->widgetSchema['agencies_list']->setLabel('Prosecution');
    $this->widgetSchema['agencies_list']->setOption('table_method', 'getProsecutionsCB');
    
    // set the dafault values for username and group for this type of user
    $this->setUserDefaultValues('prosecutor');
   
    // hide this field, necessary to save the data but annoying for the final user
    $this->hideField('groups_list');
  }
  
}

?>