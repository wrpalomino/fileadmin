<?php

/**
 * Document form base class.
 *
 * @method Document getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'code'                 => new sfWidgetFormInputText(),
      'name'                 => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormInputText(),
      'field1'               => new sfWidgetFormInputText(),
      'field2'               => new sfWidgetFormInputText(),
      'field3'               => new sfWidgetFormInputText(),
      'field4'               => new sfWidgetFormInputText(),
      'field5'               => new sfWidgetFormInputText(),
      'field6'               => new sfWidgetFormInputText(),
      'field7'               => new sfWidgetFormInputText(),
      'field8'               => new sfWidgetFormInputText(),
      'field9'               => new sfWidgetFormInputText(),
      'field10'              => new sfWidgetFormInputText(),
      'field11'              => new sfWidgetFormInputText(),
      'field12'              => new sfWidgetFormInputText(),
      'field13'              => new sfWidgetFormInputText(),
      'field14'              => new sfWidgetFormInputText(),
      'field15'              => new sfWidgetFormInputText(),
      'field16'              => new sfWidgetFormInputText(),
      'field17'              => new sfWidgetFormTextarea(),
      'field18'              => new sfWidgetFormTextarea(),
      'field19'              => new sfWidgetFormTextarea(),
      'field20'              => new sfWidgetFormTextarea(),
      'doc_date'             => new sfWidgetFormDateTime(),
      'court_date_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'user_file_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'document_type_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'add_empty' => true)),
      'document_template_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentTemplate'), 'add_empty' => true)),
      'updated_by_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'                 => new sfValidatorString(array('max_length' => 60)),
      'name'                 => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'description'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field1'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field2'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field3'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field4'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field5'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field6'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field7'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field8'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field9'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field10'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field11'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field12'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field13'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field14'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field15'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field16'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field17'              => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'field18'              => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'field19'              => new sfValidatorString(array('max_length' => 6000, 'required' => false)),
      'field20'              => new sfValidatorString(array('required' => false)),
      'doc_date'             => new sfValidatorDateTime(array('required' => false)),
      'court_date_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'required' => false)),
      'user_file_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'document_type_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'required' => false)),
      'document_template_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentTemplate'), 'required' => false)),
      'updated_by_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('document[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document';
  }

}
