<?php

/**
 * Appeal filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAppealFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date_convicted'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_of_sentence'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'counsel_appearing'   => new sfWidgetFormFilterInput(),
      'client_in_custody'   => new sfWidgetFormFilterInput(),
      'client_to_attend'    => new sfWidgetFormFilterInput(),
      'appear_by_telecourt' => new sfWidgetFormFilterInput(),
      'court_convicted_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtConvicted'), 'add_empty' => true)),
      'court_date_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'date_convicted'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_of_sentence'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'counsel_appearing'   => new sfValidatorPass(array('required' => false)),
      'client_in_custody'   => new sfValidatorPass(array('required' => false)),
      'client_to_attend'    => new sfValidatorPass(array('required' => false)),
      'appear_by_telecourt' => new sfValidatorPass(array('required' => false)),
      'court_convicted_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtConvicted'), 'column' => 'id')),
      'court_date_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtDate'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('appeal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Appeal';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'date_convicted'      => 'Date',
      'date_of_sentence'    => 'Date',
      'counsel_appearing'   => 'Text',
      'client_in_custody'   => 'Text',
      'client_to_attend'    => 'Text',
      'appear_by_telecourt' => 'Text',
      'court_convicted_id'  => 'ForeignKey',
      'court_date_id'       => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
