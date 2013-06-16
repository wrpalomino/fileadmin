<?php

/**
 * Document filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDocumentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'                 => new sfWidgetFormFilterInput(),
      'description'          => new sfWidgetFormFilterInput(),
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
      'field11'              => new sfWidgetFormFilterInput(),
      'field12'              => new sfWidgetFormFilterInput(),
      'field13'              => new sfWidgetFormFilterInput(),
      'field14'              => new sfWidgetFormFilterInput(),
      'field15'              => new sfWidgetFormFilterInput(),
      'field16'              => new sfWidgetFormFilterInput(),
      'field17'              => new sfWidgetFormFilterInput(),
      'field18'              => new sfWidgetFormFilterInput(),
      'field19'              => new sfWidgetFormFilterInput(),
      'field20'              => new sfWidgetFormFilterInput(),
      'doc_date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'court_date_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'user_file_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'document_type_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentType'), 'add_empty' => true)),
      'document_template_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DocumentTemplate'), 'add_empty' => true)),
      'updated_by_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'code'                 => new sfValidatorPass(array('required' => false)),
      'name'                 => new sfValidatorPass(array('required' => false)),
      'description'          => new sfValidatorPass(array('required' => false)),
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
      'field11'              => new sfValidatorPass(array('required' => false)),
      'field12'              => new sfValidatorPass(array('required' => false)),
      'field13'              => new sfValidatorPass(array('required' => false)),
      'field14'              => new sfValidatorPass(array('required' => false)),
      'field15'              => new sfValidatorPass(array('required' => false)),
      'field16'              => new sfValidatorPass(array('required' => false)),
      'field17'              => new sfValidatorPass(array('required' => false)),
      'field18'              => new sfValidatorPass(array('required' => false)),
      'field19'              => new sfValidatorPass(array('required' => false)),
      'field20'              => new sfValidatorPass(array('required' => false)),
      'doc_date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'court_date_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtDate'), 'column' => 'id')),
      'user_file_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserFile'), 'column' => 'id')),
      'document_type_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DocumentType'), 'column' => 'id')),
      'document_template_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DocumentTemplate'), 'column' => 'id')),
      'updated_by_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('document_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Document';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'code'                 => 'Text',
      'name'                 => 'Text',
      'description'          => 'Text',
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
      'field11'              => 'Text',
      'field12'              => 'Text',
      'field13'              => 'Text',
      'field14'              => 'Text',
      'field15'              => 'Text',
      'field16'              => 'Text',
      'field17'              => 'Text',
      'field18'              => 'Text',
      'field19'              => 'Text',
      'field20'              => 'Text',
      'doc_date'             => 'Date',
      'court_date_id'        => 'ForeignKey',
      'user_file_id'         => 'ForeignKey',
      'document_type_id'     => 'ForeignKey',
      'document_template_id' => 'ForeignKey',
      'updated_by_id'        => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
