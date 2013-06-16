<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class MyAccountForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    
    $this->addThisFormField();   // save indicator to load this form
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'street',           'suburb',           'postcode',      'city',     'state',    
        'home_phone',       'work_phone',       'mobile'
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    //$this->useFields(array('username', 'last_name', 'first_name', 'email_address',  'password', 'sfGuardUserProfiles', 'groups_list'));
    unset($this['is_active'], $this['is_super_admin'], $this['agencies_list'], $this['updated_at_text'], $this['created_at_text']);
        
    // hide this field, necessary to save the data but annoying for the final user
    //$this->hideField('groups_list');
  }

}

?>