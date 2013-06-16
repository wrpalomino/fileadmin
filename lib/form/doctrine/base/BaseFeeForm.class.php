<?php

/**
 * Fee form base class.
 *
 * @method Fee getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFeeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'amount'                 => new sfWidgetFormInputText(),
      'vla'                    => new sfWidgetFormInputText(),
      'paid'                   => new sfWidgetFormInputText(),
      'need_invoicing'         => new sfWidgetFormInputText(),
      'filled_out_date'        => new sfWidgetFormDateTime(),
      'funding_status_comment' => new sfWidgetFormInputText(),
      'invoice_number'         => new sfWidgetFormInputText(),
      'court_date_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'appear_by_whom_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppearByWhom'), 'add_empty' => true)),
      'status_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'amount'                 => new sfValidatorNumber(),
      'vla'                    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'paid'                   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'need_invoicing'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'filled_out_date'        => new sfValidatorDateTime(array('required' => false)),
      'funding_status_comment' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'invoice_number'         => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'court_date_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'required' => false)),
      'appear_by_whom_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppearByWhom'), 'required' => false)),
      'status_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('fee[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fee';
  }

}
