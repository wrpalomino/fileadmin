<?php

/**
 * FileAttachement form base class.
 *
 * @method FileAttachement getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFileAttachementForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormInputText(),
      'document_file'     => new sfWidgetFormInputText(),
      'user_file_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'document_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'document_type_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'add_empty' => true)),
      'correspondence_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondence'), 'add_empty' => true)),
      'updated_by_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 120)),
      'description'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'document_file'     => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'user_file_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'document_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'required' => false)),
      'document_type_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'required' => false)),
      'correspondence_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Correspondence'), 'required' => false)),
      'updated_by_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('file_attachement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FileAttachement';
  }

}
