<?php

/**
 * AdminContent form base class.
 *
 * @method AdminContent getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdminContentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'code'             => new sfWidgetFormInputText(),
      'value'            => new sfWidgetFormTextarea(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'type'             => new sfWidgetFormInputText(),
      'format_params'    => new sfWidgetFormInputText(),
      'document_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'add_empty' => true)),
      'admin_section_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdminSection'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'             => new sfValidatorString(array('max_length' => 120)),
      'value'            => new sfValidatorString(array('max_length' => 10000, 'required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'type'             => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'format_params'    => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'document_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'required' => false)),
      'admin_section_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AdminSection'), 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('admin_content[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AdminContent';
  }

}
