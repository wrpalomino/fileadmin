<?php

/**
 * CourtDate form base class.
 *
 * @method CourtDate getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCourtDateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'date'              => new sfWidgetFormDate(),
      'time'              => new sfWidgetFormDateTime(),
      'result'            => new sfWidgetFormTextarea(),
      'instruction'       => new sfWidgetFormInputText(),
      'user_file_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'court_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Court'), 'add_empty' => true)),
      'listing_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Listing'), 'add_empty' => true)),
      'court_note_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtNote'), 'add_empty' => true)),
      'appearing_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppearingType'), 'add_empty' => true)),
      'judge_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Judge'), 'add_empty' => false)),
      'appearing_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Appearing'), 'add_empty' => true)),
      'coordinator_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Coordinator'), 'add_empty' => true)),
      'barrister_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Barrister'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'              => new sfValidatorDate(),
      'time'              => new sfValidatorDateTime(array('required' => false)),
      'result'            => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'instruction'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_file_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'court_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Court'), 'required' => false)),
      'listing_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Listing'), 'required' => false)),
      'court_note_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtNote'), 'required' => false)),
      'appearing_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AppearingType'), 'required' => false)),
      'judge_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Judge'))),
      'appearing_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Appearing'), 'required' => false)),
      'coordinator_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Coordinator'), 'required' => false)),
      'barrister_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Barrister'), 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('court_date[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CourtDate';
  }

}
