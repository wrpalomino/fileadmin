<?php

/**
 * CommittalStream form base class.
 *
 * @method CommittalStream getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommittalStreamForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'form_25_sent_date'   => new sfWidgetFormDate(),
      'hub_due_date'        => new sfWidgetFormDate(),
      'received_date'       => new sfWidgetFormDate(),
      'form_32_required'    => new sfWidgetFormInputText(),
      'form_32_due_date'    => new sfWidgetFormDate(),
      'form_32_filled_date' => new sfWidgetFormDate(),
      'user_file_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'court_date_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'brief_status_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BriefStatus'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'form_25_sent_date'   => new sfValidatorDate(array('required' => false)),
      'hub_due_date'        => new sfValidatorDate(array('required' => false)),
      'received_date'       => new sfValidatorDate(array('required' => false)),
      'form_32_required'    => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'form_32_due_date'    => new sfValidatorDate(array('required' => false)),
      'form_32_filled_date' => new sfValidatorDate(array('required' => false)),
      'user_file_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'court_date_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'required' => false)),
      'brief_status_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BriefStatus'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('committal_stream[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CommittalStream';
  }

}
