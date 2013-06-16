<?php

/**
 * FeeAgreement form base class.
 *
 * @method FeeAgreement getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFeeAgreementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'lump_sum'              => new sfWidgetFormInputText(),
      'gst'                   => new sfWidgetFormInputText(),
      'total'                 => new sfWidgetFormInputText(),
      'hourly_fee'            => new sfWidgetFormInputText(),
      'estimate_total'        => new sfWidgetFormInputText(),
      'counsel_daily_fee'     => new sfWidgetFormInputText(),
      'instructor_daily_fee'  => new sfWidgetFormInputText(),
      'by_what_date'          => new sfWidgetFormDate(),
      'sent_date'             => new sfWidgetFormDateTime(),
      'account_type_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccountType'), 'add_empty' => true)),
      'sent_by_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SentBy'), 'add_empty' => true)),
      'fee_agreement_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FeeAgreementType'), 'add_empty' => true)),
      'court_date_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'user_file_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'lump_sum'              => new sfValidatorNumber(array('required' => false)),
      'gst'                   => new sfValidatorNumber(array('required' => false)),
      'total'                 => new sfValidatorNumber(array('required' => false)),
      'hourly_fee'            => new sfValidatorNumber(array('required' => false)),
      'estimate_total'        => new sfValidatorNumber(array('required' => false)),
      'counsel_daily_fee'     => new sfValidatorNumber(array('required' => false)),
      'instructor_daily_fee'  => new sfValidatorNumber(array('required' => false)),
      'by_what_date'          => new sfValidatorDate(array('required' => false)),
      'sent_date'             => new sfValidatorDateTime(array('required' => false)),
      'account_type_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AccountType'), 'required' => false)),
      'sent_by_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SentBy'), 'required' => false)),
      'fee_agreement_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FeeAgreementType'), 'required' => false)),
      'court_date_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'required' => false)),
      'user_file_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('fee_agreement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FeeAgreement';
  }

}
