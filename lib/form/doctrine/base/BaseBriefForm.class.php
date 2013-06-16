<?php

/**
 * Brief form base class.
 *
 * @method Brief getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBriefForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'request1'            => new sfWidgetFormDate(),
      'request2'            => new sfWidgetFormDate(),
      'request3'            => new sfWidgetFormDate(),
      'request4'            => new sfWidgetFormDate(),
      'interview_recording' => new sfWidgetFormInputText(),
      'scanned'             => new sfWidgetFormInputText(),
      'hub_scanned'         => new sfWidgetFormInputText(),
      'depositions_added'   => new sfWidgetFormInputText(),
      'roi_tape_received'   => new sfWidgetFormInputText(),
      'photographs_added'   => new sfWidgetFormInputText(),
      'priors_received'     => new sfWidgetFormInputText(),
      'statements_received' => new sfWidgetFormInputText(),
      'charges_received'    => new sfWidgetFormInputText(),
      'summary_received'    => new sfWidgetFormInputText(),
      'user_file_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'status_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'request1'            => new sfValidatorDate(array('required' => false)),
      'request2'            => new sfValidatorDate(array('required' => false)),
      'request3'            => new sfValidatorDate(array('required' => false)),
      'request4'            => new sfValidatorDate(array('required' => false)),
      'interview_recording' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'scanned'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'hub_scanned'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'depositions_added'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'roi_tape_received'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'photographs_added'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'priors_received'     => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'statements_received' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'charges_received'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'summary_received'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'user_file_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'status_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('brief[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Brief';
  }

}
