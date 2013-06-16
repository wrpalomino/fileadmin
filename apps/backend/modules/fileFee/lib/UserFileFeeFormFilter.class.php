<?php

/**
 * UserFile filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserFileFeeFormFilter extends BaseUserFileFormFilter
{
  public function configure()
  {
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
    $this->useFields(array('number', 'client_id', 'informant_id', 'prosecutor_id', 'solicitor_id', 'status_id'));
  
    $this->widgetSchema['status_id']->setOption('table_method', 'getUserFileStatus');
    
    $this->widgetSchema['client_id']->setOption('table_method', 'getClientsCB');
    $this->widgetSchema['client_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['informant_id']->setOption('table_method', 'getInformantsCB');
    $this->widgetSchema['informant_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['prosecutor_id']->setOption('table_method', 'getProsecutorsCB');
    $this->widgetSchema['prosecutor_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['solicitor_id']->setOption('table_method', 'getSolicitorsCB');
    $this->widgetSchema['solicitor_id']->setOption('method', 'obtainFullName');
    
    $this->widgetSchema->setHelp('number', 'HINT: There is no file number selected, please select one file number to see its fees');
    
    // set custom fields
    $this->widgetSchema['number']->setLabel('User File Number');
    
    /*$this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setFormChoiceValues')))
    );*/
    
  }
  
}
