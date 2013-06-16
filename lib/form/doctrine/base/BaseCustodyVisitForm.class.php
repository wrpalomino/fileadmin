<?php

/**
 * CustodyVisit form base class.
 *
 * @method CustodyVisit getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCustodyVisitForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'date'           => new sfWidgetFormDateTime(),
      'by_who'         => new sfWidgetFormInputText(),
      'is_by_phone'    => new sfWidgetFormInputCheckbox(),
      'visit_place'    => new sfWidgetFormInputText(),
      'what_discussed' => new sfWidgetFormInputText(),
      'user_file_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'           => new sfValidatorDateTime(),
      'by_who'         => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'is_by_phone'    => new sfValidatorBoolean(array('required' => false)),
      'visit_place'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'what_discussed' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_file_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('custody_visit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CustodyVisit';
  }

}
