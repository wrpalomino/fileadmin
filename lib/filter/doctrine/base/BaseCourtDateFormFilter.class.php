<?php

/**
 * CourtDate filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCourtDateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'time'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'result'            => new sfWidgetFormFilterInput(),
      'instruction'       => new sfWidgetFormFilterInput(),
      'user_file_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'court_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Court'), 'add_empty' => true)),
      'listing_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Listing'), 'add_empty' => true)),
      'court_note_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtNote'), 'add_empty' => true)),
      'appearing_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AppearingType'), 'add_empty' => true)),
      'judge_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Judge'), 'add_empty' => true)),
      'appearing_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Appearing'), 'add_empty' => true)),
      'coordinator_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Coordinator'), 'add_empty' => true)),
      'barrister_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Barrister'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'time'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'result'            => new sfValidatorPass(array('required' => false)),
      'instruction'       => new sfValidatorPass(array('required' => false)),
      'user_file_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserFile'), 'column' => 'id')),
      'court_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Court'), 'column' => 'id')),
      'listing_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Listing'), 'column' => 'id')),
      'court_note_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtNote'), 'column' => 'id')),
      'appearing_type_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AppearingType'), 'column' => 'id')),
      'judge_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Judge'), 'column' => 'id')),
      'appearing_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Appearing'), 'column' => 'id')),
      'coordinator_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Coordinator'), 'column' => 'id')),
      'barrister_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Barrister'), 'column' => 'id')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('court_date_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CourtDate';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'date'              => 'Date',
      'time'              => 'Date',
      'result'            => 'Text',
      'instruction'       => 'Text',
      'user_file_id'      => 'ForeignKey',
      'court_id'          => 'ForeignKey',
      'listing_id'        => 'ForeignKey',
      'court_note_id'     => 'ForeignKey',
      'appearing_type_id' => 'ForeignKey',
      'judge_id'          => 'ForeignKey',
      'appearing_id'      => 'ForeignKey',
      'coordinator_id'    => 'ForeignKey',
      'barrister_id'      => 'ForeignKey',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
