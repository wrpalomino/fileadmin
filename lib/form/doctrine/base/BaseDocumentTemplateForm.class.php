<?php

/**
 * DocumentTemplate form base class.
 *
 * @method DocumentTemplate getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDocumentTemplateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'name'               => new sfWidgetFormInputText(),
      'is_active'          => new sfWidgetFormInputCheckbox(),
      'template_file'      => new sfWidgetFormInputText(),
      'template_word_file' => new sfWidgetFormInputText(),
      'field1_params'      => new sfWidgetFormInputText(),
      'field2_params'      => new sfWidgetFormInputText(),
      'field3_params'      => new sfWidgetFormInputText(),
      'field4_params'      => new sfWidgetFormInputText(),
      'field5_params'      => new sfWidgetFormInputText(),
      'field6_params'      => new sfWidgetFormInputText(),
      'field7_params'      => new sfWidgetFormInputText(),
      'field8_params'      => new sfWidgetFormInputText(),
      'field9_params'      => new sfWidgetFormInputText(),
      'field10_params'     => new sfWidgetFormInputText(),
      'field11_params'     => new sfWidgetFormInputText(),
      'field12_params'     => new sfWidgetFormInputText(),
      'field13_params'     => new sfWidgetFormInputText(),
      'field14_params'     => new sfWidgetFormInputText(),
      'field15_params'     => new sfWidgetFormInputText(),
      'field16_params'     => new sfWidgetFormInputText(),
      'field17_params'     => new sfWidgetFormInputText(),
      'field18_params'     => new sfWidgetFormInputText(),
      'field19_params'     => new sfWidgetFormInputText(),
      'field20_params'     => new sfWidgetFormInputText(),
      'document_type_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'add_empty' => true)),
      'admin_section_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdminSection'), 'add_empty' => true)),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'               => new sfValidatorString(array('max_length' => 120)),
      'is_active'          => new sfValidatorBoolean(array('required' => false)),
      'template_file'      => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'template_word_file' => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'field1_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field2_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field3_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field4_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field5_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field6_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field7_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field8_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field9_params'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field10_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field11_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field12_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field13_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field14_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field15_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field16_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field17_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field18_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field19_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'field20_params'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'document_type_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'required' => false)),
      'admin_section_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdminSection'), 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('document_template[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentTemplate';
  }

}
