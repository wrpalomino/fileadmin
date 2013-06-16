<?php

/**
 * DocumentTemplate filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentTemplateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'template_file'      => new sfWidgetFormFilterInput(),
      'template_word_file' => new sfWidgetFormFilterInput(),
      'field1_params'      => new sfWidgetFormFilterInput(),
      'field2_params'      => new sfWidgetFormFilterInput(),
      'field3_params'      => new sfWidgetFormFilterInput(),
      'field4_params'      => new sfWidgetFormFilterInput(),
      'field5_params'      => new sfWidgetFormFilterInput(),
      'field6_params'      => new sfWidgetFormFilterInput(),
      'field7_params'      => new sfWidgetFormFilterInput(),
      'field8_params'      => new sfWidgetFormFilterInput(),
      'field9_params'      => new sfWidgetFormFilterInput(),
      'field10_params'     => new sfWidgetFormFilterInput(),
      'field11_params'     => new sfWidgetFormFilterInput(),
      'field12_params'     => new sfWidgetFormFilterInput(),
      'field13_params'     => new sfWidgetFormFilterInput(),
      'field14_params'     => new sfWidgetFormFilterInput(),
      'field15_params'     => new sfWidgetFormFilterInput(),
      'field16_params'     => new sfWidgetFormFilterInput(),
      'field17_params'     => new sfWidgetFormFilterInput(),
      'field18_params'     => new sfWidgetFormFilterInput(),
      'field19_params'     => new sfWidgetFormFilterInput(),
      'field20_params'     => new sfWidgetFormFilterInput(),
      'document_type_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'add_empty' => true)),
      'admin_section_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AdminSection'), 'add_empty' => true)),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'               => new sfValidatorPass(array('required' => false)),
      'is_active'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'template_file'      => new sfValidatorPass(array('required' => false)),
      'template_word_file' => new sfValidatorPass(array('required' => false)),
      'field1_params'      => new sfValidatorPass(array('required' => false)),
      'field2_params'      => new sfValidatorPass(array('required' => false)),
      'field3_params'      => new sfValidatorPass(array('required' => false)),
      'field4_params'      => new sfValidatorPass(array('required' => false)),
      'field5_params'      => new sfValidatorPass(array('required' => false)),
      'field6_params'      => new sfValidatorPass(array('required' => false)),
      'field7_params'      => new sfValidatorPass(array('required' => false)),
      'field8_params'      => new sfValidatorPass(array('required' => false)),
      'field9_params'      => new sfValidatorPass(array('required' => false)),
      'field10_params'     => new sfValidatorPass(array('required' => false)),
      'field11_params'     => new sfValidatorPass(array('required' => false)),
      'field12_params'     => new sfValidatorPass(array('required' => false)),
      'field13_params'     => new sfValidatorPass(array('required' => false)),
      'field14_params'     => new sfValidatorPass(array('required' => false)),
      'field15_params'     => new sfValidatorPass(array('required' => false)),
      'field16_params'     => new sfValidatorPass(array('required' => false)),
      'field17_params'     => new sfValidatorPass(array('required' => false)),
      'field18_params'     => new sfValidatorPass(array('required' => false)),
      'field19_params'     => new sfValidatorPass(array('required' => false)),
      'field20_params'     => new sfValidatorPass(array('required' => false)),
      'document_type_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DocumentType'), 'column' => 'id')),
      'admin_section_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AdminSection'), 'column' => 'id')),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('document_template_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentTemplate';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'name'               => 'Text',
      'is_active'          => 'Boolean',
      'template_file'      => 'Text',
      'template_word_file' => 'Text',
      'field1_params'      => 'Text',
      'field2_params'      => 'Text',
      'field3_params'      => 'Text',
      'field4_params'      => 'Text',
      'field5_params'      => 'Text',
      'field6_params'      => 'Text',
      'field7_params'      => 'Text',
      'field8_params'      => 'Text',
      'field9_params'      => 'Text',
      'field10_params'     => 'Text',
      'field11_params'     => 'Text',
      'field12_params'     => 'Text',
      'field13_params'     => 'Text',
      'field14_params'     => 'Text',
      'field15_params'     => 'Text',
      'field16_params'     => 'Text',
      'field17_params'     => 'Text',
      'field18_params'     => 'Text',
      'field19_params'     => 'Text',
      'field20_params'     => 'Text',
      'document_type_id'   => 'ForeignKey',
      'admin_section_id'   => 'ForeignKey',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
