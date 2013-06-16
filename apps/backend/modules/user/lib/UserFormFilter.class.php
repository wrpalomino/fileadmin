<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class UserFormFilter extends sfGuardUserFormFilter
{
  public function configure()
  { 
    parent::configure();
    
    $this->useFields(array('last_name', 'first_name', 'email_address', 'groups_list', 'sfGuardUserProfiles'));
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array('criminal_crn'));
  }
  
}
?>