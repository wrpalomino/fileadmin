<?php

/**
 * UserFile filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserFileFormFilter extends BaseUserFileFormFilter
{
  public function configure()
  {
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
    // better than $this->useFields()
    unset($this['barrister_backsheet_options'], $this['barrister_fee']);
    
    $state_choices = Doctrine_Core::getTable('sfGuardUserProfile')->getFilterStates(); 
    $this->widgetSchema['state'] = new sfWidgetFormChoice(array(
      'choices'  => $state_choices, 'expanded' => false,
    ));
    $this->widgetSchema['state2'] = new sfWidgetFormChoice(array(
      'choices'  => $state_choices, 'expanded' => false,
    ));
    
    $this->widgetSchema['instruction_on_file'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['in_custody'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['bail_on_this'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getBailOnThisOptions()));
    
    $this->widgetSchema['status_id']->setOption('table_method', 'getUserFileStatus');
    
    $this->widgetSchema['client_id']->setOption('table_method', 'getClientsCB');
    $this->widgetSchema['informant_id']->setOption('table_method', 'getInformantsCB');
    $this->widgetSchema['prosecutor_id']->setOption('table_method', 'getProsecutorsCB');
    $this->widgetSchema['barrister_id']->setOption('table_method', 'getBarristersCB');
    $this->widgetSchema['solicitor_id']->setOption('table_method', 'getSolicitorsCB');
    
    $this->widgetSchema['prosecution_id']->setOption('table_method', 'getProsecutionsCB');
    $this->widgetSchema['prison_id']->setOption('table_method', 'getPrisonsCB');
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setFormChoiceValues')))
    );
    
  }
  
  public function setFormChoiceValues($validator, $values)
  {
    if (isset($values['state']))                $values['state'] = array('text' => $values['state']);
    if (isset($values['state2']))               $values['state2'] = array('text' => $values['state2']);
    if (isset($values['instruction_on_file']))  $values['instruction_on_file'] = array('text' => $values['instruction_on_file']);
    if (isset($values['in_custody']))           $values['in_custody'] = array('text' => $values['in_custody']);
    if (isset($values['bail_on_this']))         $values['bail_on_this'] = array('text' => $values['bail_on_this']);
    return $values;
  }
  
}
