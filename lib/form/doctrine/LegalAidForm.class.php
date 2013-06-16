<?php

/**
 * LegalAid form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LegalAidForm extends BaseLegalAidForm
{
  public function configure()
  {
    $this->useFields(array('reference_number', 'office_id', 'assigment_officer_id', 'vla_app_status_id', 'date_sent_given', 'aid_status_id', 'date_aided_for', 'last_date_invoiced', 'user_file_id'));
    
    //$this->widgetSchema['office_id']->setOption('table_method', 'getVLAOfficesCB');
    //$this->widgetSchema['office_id']->setOption('add_empty', false);
    $this->widgetSchema['office_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Office'), 
        'form_module' => 'agency?code=VLA', 
        'add_empty' => true,
        //'method' => 'obtainFullName',
        'table_method' => 'getVLAOfficesCB'
        ));
    
    $this->widgetSchema['assigment_officer_id']->setOption('table_method', 'getVLAOfficersCB');
    //$this->widgetSchema['assigment_officer_id']->setOption('add_empty', false);
    
    $this->widgetSchema['vla_app_status_id']->setOption('table_method', 'getVLAApplicationStatus');
    $this->widgetSchema['aid_status_id']->setOption('table_method', 'getCurrentAidStatus');
    
    //$this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    $this->hideField('user_file_id');
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
