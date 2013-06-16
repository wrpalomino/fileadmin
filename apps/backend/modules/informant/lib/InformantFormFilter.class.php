<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class InformantFormFilter extends sfGuardUserFormFilter
{
  public function configure()
  { 
    parent::configure();

    // use this in filters with embedded filter forms to avoid security vaidation
    $this->disableLocalCSRFProtection();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'honorific_id',   /*'agency_id',*/    'badge_number',     /*'home_phone',*/   
        'work_phone',     /*'mobile',*/       'other_phone',      'fax'
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    //$this->widgetSchema['sfGuardUserProfiles']['agency_id']->setOption('table_method', 'getPoliceStationsCB');
    $this->widgetSchema['sfGuardUserProfiles']['honorific_id']->setOption('table_method', 'loadMilitia2');
    
    $this->useFields(array('last_name', 'first_name', 'email_address', 'agencies_list', 'sfGuardUserProfiles'));
    
    $this->widgetSchema['agencies_list']->setLabel('Station');
    $this->widgetSchema['agencies_list']->setOption('table_method', 'getPoliceStationsCB');
    
  }
  
}
?>