<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class InstitutionForm extends BaseAgencyForm
{
  public function configure()
  {
    $this->useFields(array(
        'name',               'street',         'suburb',         'postcode',     'state',
        'phone',              'fax',            'email',          'website',
        'sf_guard_group_id',  'subgroup_id',    'status_id'
        ));
    
    $this->widgetSchema['name']->setAttribute('size', '50');
    
    $this->widgetSchema['sf_guard_group_id']->setLabel('Group');
    $this->widgetSchema['sf_guard_group_id']->setOption('table_method', 'getAgenciesCB');
    
    /* added by William, 10/05/2013: it seems all sfGuardPlugin objs do not allow to sort using 
    addOption('order_by' => array('name', 'asc')), then, jQuery replaces the functionality */
    $this->widgetSchema['sf_guard_group_id']->setAttribute('class', 'sortMe');
    
    $this->widgetSchema['subgroup_id']->setLabel('Sub Group');
    
    $this->widgetSchema['subgroup_id'] = new sfWidgetFormDoctrineDependentSelect(array(
          'model' => $this->getRelatedModelName('Subgroup'), 
          'depends' => 'sf_guard_group_id',
          'add_empty' => '-- Select if required --',
          'ref_method' => 'getGroupId',
          'master_widget' => 'sf_guard_group_id',
          'order_by' => array('name', 'asc')
          //'form_module' => 'agency?code=1',
          ));
    
    
    
    $this->widgetSchema['status_id']->setOption('table_method', 'getActiveInactiveStatus');
    $this->widgetSchema['status_id']->setOption('add_empty', false);
    
    $this->widgetSchema['state'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine_Core::getTable('sfGuardUserProfile')->getStates(),
      'expanded' => false,
    ));
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
}
?>