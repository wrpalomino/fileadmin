<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class InstitutionFormFilter extends AgencyFormFilter
{
  public function configure()
  { 
    $this->useFields(array('name', 'sf_guard_group_id',	'subgroup_id',	/*'officer_id',*/ 'status_id'));
    $this->widgetSchema['name']->setAttribute('size', '50');
  }
  
}
?>