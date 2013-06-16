<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class AssociateFormFilter extends sfGuardUserFormFilter
{
  public function configure()
  { 
    parent::configure();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'work_phone',     'mobile',     'fax',
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    $this->useFields(array('last_name', 'first_name', 'email_address', 'sfGuardUserProfiles'));
    //$this->widgetSchema['last_name']->setLabel("Name");
  }
  
}
?>