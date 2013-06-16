<?php

/**
 * DocumentDetail filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentDetailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'field1'               => new sfWidgetFormFilterInput(),
      'field2'               => new sfWidgetFormFilterInput(),
      'field3'               => new sfWidgetFormFilterInput(),
      'field4'               => new sfWidgetFormFilterInput(),
      'field5'               => new sfWidgetFormFilterInput(),
      'field6'               => new sfWidgetFormFilterInput(),
      'field7'               => new sfWidgetFormFilterInput(),
      'field8'               => new sfWidgetFormFilterInput(),
      'field9'               => new sfWidgetFormFilterInput(),
      'field10'              => new sfWidgetFormFilterInput(),
      'document_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'document_template_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentTemplate'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'field1'               => new sfValidatorPass(array('required' => false)),
      'field2'               => new sfValidatorPass(array('required' => false)),
      'field3'               => new sfValidatorPass(array('required' => false)),
      'field4'               => new sfValidatorPass(array('required' => false)),
      'field5'               => new sfValidatorPass(array('required' => false)),
      'field6'               => new sfValidatorPass(array('required' => false)),
      'field7'               => new sfValidatorPass(array('required' => false)),
      'field8'               => new sfValidatorPass(array('required' => false)),
      'field9'               => new sfValidatorPass(array('required' => false)),
      'field10'              => new sfValidatorPass(array('required' => false)),
      'document_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Document'), 'column' => 'id')),
      'document_template_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DocumentTemplate'), 'column' => 'id')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('document_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocumentDetail';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'field1'               => 'Text',
      'field2'               => 'Text',
      'field3'               => 'Text',
      'field4'               => 'Text',
      'field5'               => 'Text',
      'field6'               => 'Text',
      'field7'               => 'Text',
      'field8'               => 'Text',
      'field9'               => 'Text',
      'field10'              => 'Text',
      'document_id'          => 'ForeignKey',
      'document_template_id' => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
