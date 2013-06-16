<?php

/**
 * Brief filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBriefFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'request1'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'request2'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'request3'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'request4'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'interview_recording' => new sfWidgetFormFilterInput(),
      'scanned'             => new sfWidgetFormFilterInput(),
      'hub_scanned'         => new sfWidgetFormFilterInput(),
      'depositions_added'   => new sfWidgetFormFilterInput(),
      'roi_tape_received'   => new sfWidgetFormFilterInput(),
      'photographs_added'   => new sfWidgetFormFilterInput(),
      'priors_received'     => new sfWidgetFormFilterInput(),
      'statements_received' => new sfWidgetFormFilterInput(),
      'charges_received'    => new sfWidgetFormFilterInput(),
      'summary_received'    => new sfWidgetFormFilterInput(),
      'user_file_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'status_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'request1'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'request2'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'request3'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'request4'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'interview_recording' => new sfValidatorPass(array('required' => false)),
      'scanned'             => new sfValidatorPass(array('required' => false)),
      'hub_scanned'         => new sfValidatorPass(array('required' => false)),
      'depositions_added'   => new sfValidatorPass(array('required' => false)),
      'roi_tape_received'   => new sfValidatorPass(array('required' => false)),
      'photographs_added'   => new sfValidatorPass(array('required' => false)),
      'priors_received'     => new sfValidatorPass(array('required' => false)),
      'statements_received' => new sfValidatorPass(array('required' => false)),
      'charges_received'    => new sfValidatorPass(array('required' => false)),
      'summary_received'    => new sfValidatorPass(array('required' => false)),
      'user_file_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserFile'), 'column' => 'id')),
      'status_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Status'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('brief_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Brief';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'request1'            => 'Date',
      'request2'            => 'Date',
      'request3'            => 'Date',
      'request4'            => 'Date',
      'interview_recording' => 'Text',
      'scanned'             => 'Text',
      'hub_scanned'         => 'Text',
      'depositions_added'   => 'Text',
      'roi_tape_received'   => 'Text',
      'photographs_added'   => 'Text',
      'priors_received'     => 'Text',
      'statements_received' => 'Text',
      'charges_received'    => 'Text',
      'summary_received'    => 'Text',
      'user_file_id'        => 'ForeignKey',
      'status_id'           => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
