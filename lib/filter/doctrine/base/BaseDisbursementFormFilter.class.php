<?php

/**
 * Disbursement filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDisbursementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'provider'             => new sfWidgetFormFilterInput(),
      'amount'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'invoice_number'       => new sfWidgetFormFilterInput(),
      'date'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'paid'                 => new sfWidgetFormFilterInput(),
      'disbursement_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DisbursementType'), 'add_empty' => true)),
      'court_date_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'provider'             => new sfValidatorPass(array('required' => false)),
      'amount'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'invoice_number'       => new sfValidatorPass(array('required' => false)),
      'date'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'paid'                 => new sfValidatorPass(array('required' => false)),
      'disbursement_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DisbursementType'), 'column' => 'id')),
      'court_date_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtDate'), 'column' => 'id')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('disbursement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Disbursement';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'provider'             => 'Text',
      'amount'               => 'Number',
      'invoice_number'       => 'Text',
      'date'                 => 'Date',
      'paid'                 => 'Text',
      'disbursement_type_id' => 'ForeignKey',
      'court_date_id'        => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
