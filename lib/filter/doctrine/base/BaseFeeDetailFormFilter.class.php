<?php

/**
 * FeeDetail filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFeeDetailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'amount'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'barrister_fee'   => new sfWidgetFormFilterInput(),
      'disbursement'    => new sfWidgetFormFilterInput(),
      'preparation_fee' => new sfWidgetFormFilterInput(),
      'appearance_fee'  => new sfWidgetFormFilterInput(),
      'date'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'comment'         => new sfWidgetFormFilterInput(),
      'fee_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'), 'add_empty' => true)),
      'type_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FeeDetailType'), 'add_empty' => true)),
      'by_who_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ByWho'), 'add_empty' => true)),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'amount'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'barrister_fee'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'disbursement'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'preparation_fee' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'appearance_fee'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'date'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'comment'         => new sfValidatorPass(array('required' => false)),
      'fee_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fee'), 'column' => 'id')),
      'type_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FeeDetailType'), 'column' => 'id')),
      'by_who_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ByWho'), 'column' => 'id')),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('fee_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FeeDetail';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'amount'          => 'Number',
      'barrister_fee'   => 'Number',
      'disbursement'    => 'Number',
      'preparation_fee' => 'Number',
      'appearance_fee'  => 'Number',
      'date'            => 'Date',
      'comment'         => 'Text',
      'fee_id'          => 'ForeignKey',
      'type_id'         => 'ForeignKey',
      'by_who_id'       => 'ForeignKey',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
