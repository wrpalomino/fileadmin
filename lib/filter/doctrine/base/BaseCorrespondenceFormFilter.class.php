<?php

/**
 * Correspondence filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCorrespondenceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject'                => new sfWidgetFormFilterInput(),
      'receiver_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Receiver'), 'add_empty' => true)),
      'receiver_name'          => new sfWidgetFormFilterInput(),
      'receiver_address'       => new sfWidgetFormFilterInput(),
      'cc_addresses_list'      => new sfWidgetFormFilterInput(),
      'notes'                  => new sfWidgetFormFilterInput(),
      'sender_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sender'), 'add_empty' => true)),
      'backsheet_printed_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'delivered_date'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'returned_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'ctype'                  => new sfWidgetFormFilterInput(),
      'user_file_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'court_date_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'receiver_group_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardGroup'), 'add_empty' => true)),
      'sent_by_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SentBy'), 'add_empty' => true)),
      'document_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'subject'                => new sfValidatorPass(array('required' => false)),
      'receiver_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Receiver'), 'column' => 'id')),
      'receiver_name'          => new sfValidatorPass(array('required' => false)),
      'receiver_address'       => new sfValidatorPass(array('required' => false)),
      'cc_addresses_list'      => new sfValidatorPass(array('required' => false)),
      'notes'                  => new sfValidatorPass(array('required' => false)),
      'sender_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sender'), 'column' => 'id')),
      'backsheet_printed_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'delivered_date'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'returned_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'ctype'                  => new sfValidatorPass(array('required' => false)),
      'user_file_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserFile'), 'column' => 'id')),
      'court_date_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CourtDate'), 'column' => 'id')),
      'receiver_group_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardGroup'), 'column' => 'id')),
      'sent_by_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('SentBy'), 'column' => 'id')),
      'document_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Document'), 'column' => 'id')),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('correspondence_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondence';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'subject'                => 'Text',
      'receiver_id'            => 'ForeignKey',
      'receiver_name'          => 'Text',
      'receiver_address'       => 'Text',
      'cc_addresses_list'      => 'Text',
      'notes'                  => 'Text',
      'sender_id'              => 'ForeignKey',
      'backsheet_printed_date' => 'Date',
      'delivered_date'         => 'Date',
      'returned_date'          => 'Date',
      'ctype'                  => 'Text',
      'user_file_id'           => 'ForeignKey',
      'court_date_id'          => 'ForeignKey',
      'receiver_group_id'      => 'ForeignKey',
      'sent_by_id'             => 'ForeignKey',
      'document_id'            => 'ForeignKey',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
