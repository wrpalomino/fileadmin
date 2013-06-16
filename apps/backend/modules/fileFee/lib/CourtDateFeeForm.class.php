<?php

/**
 * CourtDate form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CourtDateFeeForm extends CourtDateForm
{
  public function configure()
  {
    // this is used instead usefields for embedding plugin compatibility
    unset($this['judge_id'],      $this['result'],          $this['instruction'],   
          $this['user_file_id'],  $this['coordinator_id'],  $this['court_note_id'],
          $this['time']
         );
    
    // set method to load values to show
    $this->widgetSchema['court_id']->setOption('table_method', 'getCourtsCB');
    $this->widgetSchema['court_id']->setAttribute('style', 'width:220px');
    
    $this->widgetSchema['appearing_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['appearing_id']->setOption('table_method', 'getSolicitorsCB');
    
    // added by William, 26/05/2013:
    $this->widgetSchema['barrister_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['barrister_id']->setOption('table_method', 'getBarristersCB');
    
    $this->widgetSchema['listing_id']->setOption('order_by', array('name', 'asc'));
    
    // remove emptys
    $this->widgetSchema['court_id']->setOption('add_empty', false);    
    
    // adding some extra validators
    $this->validatorSchema['court_id']->setOption('required', true);
      
    $this->addFee();
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setSpecialFeeValues')))
    );
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
}
