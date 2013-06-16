<?php

/**
 * Charge form base class.
 *
 * @method Charge getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseChargeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'item'         => new sfWidgetFormInputText(),
      'section'      => new sfWidgetFormInputText(),
      'acts'         => new sfWidgetFormInputText(),
      'charge'       => new sfWidgetFormInputText(),
      'comment'      => new sfWidgetFormInputText(),
      'date'         => new sfWidgetFormDate(),
      'user_file_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'type_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ChargeType'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'item'         => new sfValidatorString(array('max_length' => 20)),
      'section'      => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'acts'         => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'charge'       => new sfValidatorString(array('max_length' => 255)),
      'comment'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'date'         => new sfValidatorDate(array('required' => false)),
      'user_file_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'type_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ChargeType'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('charge[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Charge';
  }

}
