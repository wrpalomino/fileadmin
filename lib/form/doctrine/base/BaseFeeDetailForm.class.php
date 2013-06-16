<?php

/**
 * FeeDetail form base class.
 *
 * @method FeeDetail getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFeeDetailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'amount'          => new sfWidgetFormInputText(),
      'barrister_fee'   => new sfWidgetFormInputText(),
      'disbursement'    => new sfWidgetFormInputText(),
      'preparation_fee' => new sfWidgetFormInputText(),
      'appearance_fee'  => new sfWidgetFormInputText(),
      'date'            => new sfWidgetFormDateTime(),
      'comment'         => new sfWidgetFormInputText(),
      'fee_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'), 'add_empty' => false)),
      'type_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FeeDetailType'), 'add_empty' => true)),
      'by_who_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ByWho'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'amount'          => new sfValidatorNumber(),
      'barrister_fee'   => new sfValidatorNumber(array('required' => false)),
      'disbursement'    => new sfValidatorNumber(array('required' => false)),
      'preparation_fee' => new sfValidatorNumber(array('required' => false)),
      'appearance_fee'  => new sfValidatorNumber(array('required' => false)),
      'date'            => new sfValidatorDateTime(),
      'comment'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fee_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'))),
      'type_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FeeDetailType'), 'required' => false)),
      'by_who_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ByWho'), 'required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('fee_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FeeDetail';
  }

}
