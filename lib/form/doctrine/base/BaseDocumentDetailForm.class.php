<?php

/**
 * DocumentDetail form base class.
 *
 * @method DocumentDetail getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentDetailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
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
      'document_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => false)),
      'document_template_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentTemplate'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
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
      'document_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'))),
      'document_template_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentTemplate'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('document_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentDetail';
  }

}
