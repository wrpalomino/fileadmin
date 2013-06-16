<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ProsecutorFormFilter extends sfGuardUserFormFilter
{
  public function configure()
  { 
    parent::configure();
    
    // use this in filters with embedded filter forms to avoid security vaidation
    $this->disableLocalCSRFProtection();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'honorific_id',     'work_phone',     'mobile',     'fax',
        /*'agency_id'*/
    ));
    
    //$this->widgetSchema['sfGuardUserProfiles']['agency_id']->setOption('table_method', 'getProsecutionsCB');
    //$this->widgetSchema['sfGuardUserProfiles']['agency_id']->setLabel('Prosecution');
    $this->widgetSchema['sfGuardUserProfiles']['honorific_id']->setOption('table_method', 'loadMilitia');
    
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    $this->useFields(array('last_name', 'first_name', 'email_address', 'agencies_list', 'sfGuardUserProfiles'));
    //$this->widgetSchema['last_name']->setLabel("Name");
    
    $this->widgetSchema['agencies_list']->setLabel('Prosecution');
    $this->widgetSchema['agencies_list']->setOption('table_method', 'getProsecutionsCB');
  }
  
}
?>