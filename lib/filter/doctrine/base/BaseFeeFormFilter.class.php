<?php

/**
 * Fee filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFeeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'amount'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'vla'                    => new sfWidgetFormFilterInput(),
      'paid'                   => new sfWidgetFormFilterInput(),
      'need_invoicing'         => new sfWidgetFormFilterInput(),
      'filled_out_date'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'funding_status_comment' => new sfWidgetFormFilterInput(),
      'invoice_number'         => new sfWidgetFormFilterInput(),
      'court_date_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'appear_by_whom_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppearByWhom'), 'add_empty' => true)),
      'status_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'amount'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'vla'                    => new sfValidatorPass(array('required' => false)),
      'paid'                   => new sfValidatorPass(array('required' => false)),
      'need_invoicing'         => new sfValidatorPass(array('required' => false)),
      'filled_out_date'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'funding_status_comment' => new sfValidatorPass(array('required' => false)),
      'invoice_number'         => new sfValidatorPass(array('required' => false)),
      'court_date_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtDate'), 'column' => 'id')),
      'appear_by_whom_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppearByWhom'), 'column' => 'id')),
      'status_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Status'), 'column' => 'id')),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('fee_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fee';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'amount'                 => 'Number',
      'vla'                    => 'Text',
      'paid'                   => 'Text',
      'need_invoicing'         => 'Text',
      'filled_out_date'        => 'Date',
      'funding_status_comment' => 'Text',
      'invoice_number'         => 'Text',
      'court_date_id'          => 'ForeignKey',
      'appear_by_whom_id'      => 'ForeignKey',
      'status_id'              => 'ForeignKey',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
