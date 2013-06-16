<?php

/**
 * Invoice filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInvoiceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'number'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'amount'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amount_paid'   => new sfWidgetFormFilterInput(),
      'amount_due'    => new sfWidgetFormFilterInput(),
      'fee_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'), 'add_empty' => true)),
      'type_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('InvoiceType'), 'add_empty' => true)),
      'status_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'court_date_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'document_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'number'        => new sfValidatorPass(array('required' => false)),
      'date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'amount'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'amount_paid'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'amount_due'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fee_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fee'), 'column' => 'id')),
      'type_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('InvoiceType'), 'column' => 'id')),
      'status_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Status'), 'column' => 'id')),
      'court_date_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtDate'), 'column' => 'id')),
      'document_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Document'), 'column' => 'id')),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('invoice_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invoice';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'number'        => 'Text',
      'date'          => 'Date',
      'amount'        => 'Number',
      'amount_paid'   => 'Number',
      'amount_due'    => 'Number',
      'fee_id'        => 'ForeignKey',
      'type_id'       => 'ForeignKey',
      'status_id'     => 'ForeignKey',
      'court_date_id' => 'ForeignKey',
      'document_id'   => 'ForeignKey',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
