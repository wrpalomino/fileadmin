<?php

/**
 * Appeal form base class.
 *
 * @method Appeal getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAppealForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'date_convicted'      => new sfWidgetFormDate(),
      'date_of_sentence'    => new sfWidgetFormDate(),
      'counsel_appearing'   => new sfWidgetFormInputText(),
      'client_in_custody'   => new sfWidgetFormInputText(),
      'client_to_attend'    => new sfWidgetFormInputText(),
      'appear_by_telecourt' => new sfWidgetFormInputText(),
      'court_convicted_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtConvicted'), 'add_empty' => true)),
      'court_date_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date_convicted'      => new sfValidatorDate(array('required' => false)),
      'date_of_sentence'    => new sfValidatorDate(array('required' => false)),
      'counsel_appearing'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'client_in_custody'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'client_to_attend'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'appear_by_telecourt' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'court_convicted_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtConvicted'), 'required' => false)),
      'court_date_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'))),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('appeal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Appeal';
  }

}
