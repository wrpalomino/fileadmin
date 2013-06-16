<?php

/**
 * LegalAid filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLegalAidFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reference_number'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date_sent_given'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_aided_for'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'last_date_invoiced'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'user_file_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'office_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Office'), 'add_empty' => true)),
      'assigment_officer_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AssignmentOfficer'), 'add_empty' => true)),
      'vla_app_status_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VlaStatus'), 'add_empty' => true)),
      'aid_status_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AidStatus'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'reference_number'     => new sfValidatorPass(array('required' => false)),
      'date_sent_given'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_aided_for'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'last_date_invoiced'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'user_file_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserFile'), 'column' => 'id')),
      'office_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Office'), 'column' => 'id')),
      'assigment_officer_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AssignmentOfficer'), 'column' => 'id')),
      'vla_app_status_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('VlaStatus'), 'column' => 'id')),
      'aid_status_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AidStatus'), 'column' => 'id')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('legal_aid_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LegalAid';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'reference_number'     => 'Text',
      'date_sent_given'      => 'Date',
      'date_aided_for'       => 'Date',
      'last_date_invoiced'   => 'Date',
      'user_file_id'         => 'ForeignKey',
      'office_id'            => 'ForeignKey',
      'assigment_officer_id' => 'ForeignKey',
      'vla_app_status_id'    => 'ForeignKey',
      'aid_status_id'        => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
