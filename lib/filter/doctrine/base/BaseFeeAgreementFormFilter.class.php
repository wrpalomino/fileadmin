<?php

/**
 * FeeAgreement filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFeeAgreementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'lump_sum'              => new sfWidgetFormFilterInput(),
      'gst'                   => new sfWidgetFormFilterInput(),
      'total'                 => new sfWidgetFormFilterInput(),
      'hourly_fee'            => new sfWidgetFormFilterInput(),
      'estimate_total'        => new sfWidgetFormFilterInput(),
      'counsel_daily_fee'     => new sfWidgetFormFilterInput(),
      'instructor_daily_fee'  => new sfWidgetFormFilterInput(),
      'by_what_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'sent_date'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'account_type_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AccountType'), 'add_empty' => true)),
      'sent_by_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SentBy'), 'add_empty' => true)),
      'fee_agreement_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FeeAgreementType'), 'add_empty' => true)),
      'court_date_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'user_file_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'lump_sum'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'gst'                   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'total'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'hourly_fee'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'estimate_total'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'counsel_daily_fee'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'instructor_daily_fee'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'by_what_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'sent_date'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'account_type_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AccountType'), 'column' => 'id')),
      'sent_by_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SentBy'), 'column' => 'id')),
      'fee_agreement_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FeeAgreementType'), 'column' => 'id')),
      'court_date_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtDate'), 'column' => 'id')),
      'user_file_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserFile'), 'column' => 'id')),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('fee_agreement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FeeAgreement';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'lump_sum'              => 'Number',
      'gst'                   => 'Number',
      'total'                 => 'Number',
      'hourly_fee'            => 'Number',
      'estimate_total'        => 'Number',
      'counsel_daily_fee'     => 'Number',
      'instructor_daily_fee'  => 'Number',
      'by_what_date'          => 'Date',
      'sent_date'             => 'Date',
      'account_type_id'       => 'ForeignKey',
      'sent_by_id'            => 'ForeignKey',
      'fee_agreement_type_id' => 'ForeignKey',
      'court_date_id'         => 'ForeignKey',
      'user_file_id'          => 'ForeignKey',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
