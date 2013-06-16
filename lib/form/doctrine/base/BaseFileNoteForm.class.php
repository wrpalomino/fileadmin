<?php

/**
 * FileNote form base class.
 *
 * @method FileNote getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFileNoteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'date'         => new sfWidgetFormDateTime(),
      'note_by'      => new sfWidgetFormInputText(),
      'note_to'      => new sfWidgetFormInputText(),
      'note'         => new sfWidgetFormTextarea(),
      'is_by_phone'  => new sfWidgetFormInputCheckbox(),
      'user_file_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'date'         => new sfValidatorDateTime(array('required' => false)),
      'note_by'      => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'note_to'      => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'note'         => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'is_by_phone'  => new sfValidatorBoolean(array('required' => false)),
      'user_file_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('file_note[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FileNote';
  }

}
