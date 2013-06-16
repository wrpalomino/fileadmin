<?php

/**
 * Agency filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AgencyFormFilter extends BaseAgencyFormFilter
{
  public function configure()
  {
    $this->useFields(array(
        'name',         'phone',      'reference_number',      'fax',      
        /*'officer_id',*/   'email',      'sf_guard_group_id',
    ));
    $this->widgetSchema['name']->setAttribute('size', '50');
    
    $this->loadValues();
    
    // hide the 'sf_guard_group_id' in filters
    $this->hideField('sf_guard_group_id');
  }
  
  
  public function loadValues($default_values=array())
  {
    // set the agency group
    if (isset($default_values['agency_code'])) {
      $code = $default_values['agency_code'];
    }
    else {
      // get the agency group
      $code = isset($_GET['code']) ? $_GET['code'] : '';
      if ($code != '') sfContext::getInstance()->getUser()->setAttribute('agency_code', $code);
      else $code = sfContext::getInstance()->getUser()->getAttribute('agency_code', 'CLD');
    }
    
    $this->widgetSchema['sf_guard_group_id']->addOption('table_method', 'get'.$code.'GroupId');
    $this->widgetSchema['sf_guard_group_id']->setOption('add_empty', false);
    
  }
  
}
