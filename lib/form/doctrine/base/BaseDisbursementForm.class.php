<?php

/**
 * Disbursement form base class.
 *
 * @method Disbursement getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDisbursementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'provider'             => new sfWidgetFormInputText(),
      'amount'               => new sfWidgetFormInputText(),
      'invoice_number'       => new sfWidgetFormInputText(),
      'date'                 => new sfWidgetFormDate(),
      'paid'                 => new sfWidgetFormInputText(),
      'disbursement_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DisbursementType'), 'add_empty' => true)),
      'court_date_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'provider'             => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'amount'               => new sfValidatorNumber(),
      'invoice_number'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'date'                 => new sfValidatorDate(array('required' => false)),
      'paid'                 => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'disbursement_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DisbursementType'), 'required' => false)),
      'court_date_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('disbursement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Disbursement';
  }

}
