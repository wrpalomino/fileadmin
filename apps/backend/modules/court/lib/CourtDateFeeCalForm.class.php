<?php

/**
 * CourtDate form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class CourtDateFeeCalForm extends CourtDateForm
{
  public function configure()
  {
    $this->useFields(array('listing_id', 'appearing_id', 'barrister_id', 'appearing_type_id'));
   
    // set method to load values to show
    $this->widgetSchema['appearing_id']->setOption('table_method', 'getSolicitorsCB');
    $this->widgetSchema['barrister_id']->setOption('table_method', 'getBarristersCB');
   
    $this->addFee();
    $this->widgetSchema['Fee']->setLabel(false);
    
    $this->addThisFormField();   // save indicator to load this form 
    
    $this->validatorSchema->setPostValidator(
            new sfValidatorCallback(array('callback' => array($this, 'setSpecialFeeValues')))
            );

    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();    
  }
 
}
