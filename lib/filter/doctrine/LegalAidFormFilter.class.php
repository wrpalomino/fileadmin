<?php

/**
 * LegalAid filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LegalAidFormFilter extends BaseLegalAidFormFilter
{
  public function configure()
  {
    $this->useFields(array('reference_number', 'office_id', 'assigment_officer_id', 'vla_app_status_id', 'date_sent_given', 'aid_status_id', 'date_aided_for', 'last_date_invoiced', 'user_file_id'));
    
    $this->widgetSchema['office_id']->setOption('table_method', 'getVLAOfficesCB');
    $this->widgetSchema['assigment_officer_id']->setOption('table_method', 'getVLAOfficersCB');
    
    $this->widgetSchema['vla_app_status_id']->setOption('table_method', 'getVLAApplicationStatus');
    $this->widgetSchema['aid_status_id']->setOption('table_method', 'getCurrentAidStatus');
    
    $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
  }
}
