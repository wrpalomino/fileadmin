<?php

/**
 * sfGuardUserProfile filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileFormFilter extends BasesfGuardUserProfileFormFilter
{
  public function configure()
  {
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
    $this->widgetSchema['state'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine_Core::getTable('sfGuardUserProfile')->getFilterStates(),
      'expanded' => false,
    ));
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setStateName')))
    ); 
  }
  
  public function setStateName($validator, $values)
  {
    if (isset($values['state'])) {
      $val = $values['state'];
      $values['state'] = array('text' => $val);
    }
    return $values;
  }
  
}
