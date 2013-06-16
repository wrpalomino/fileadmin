<?php

/**
 * UserFile filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserFileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'number'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'charge_first_name'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'charge_last_name'            => new sfWidgetFormFilterInput(),
      'first_name'                  => new sfWidgetFormFilterInput(),
      'last_name'                   => new sfWidgetFormFilterInput(),
      'honorific_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Honorific'), 'add_empty' => true)),
      'preferred_contact_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PreferredContact'), 'add_empty' => true)),
      'correspondence_title'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'correspondence_real_name'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'correspondence_sent_option'  => new sfWidgetFormFilterInput(),
      'street'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'suburb'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'postcode'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'city'                        => new sfWidgetFormFilterInput(),
      'state'                       => new sfWidgetFormFilterInput(),
      'street2'                     => new sfWidgetFormFilterInput(),
      'suburb2'                     => new sfWidgetFormFilterInput(),
      'postcode2'                   => new sfWidgetFormFilterInput(),
      'city2'                       => new sfWidgetFormFilterInput(),
      'state2'                      => new sfWidgetFormFilterInput(),
      'home_phone'                  => new sfWidgetFormFilterInput(),
      'work_phone'                  => new sfWidgetFormFilterInput(),
      'mobile'                      => new sfWidgetFormFilterInput(),
      'other_phone'                 => new sfWidgetFormFilterInput(),
      'fax'                         => new sfWidgetFormFilterInput(),
      'email'                       => new sfWidgetFormFilterInput(),
      'first_instructions_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'case_number'                 => new sfWidgetFormFilterInput(),
      'instruction_on_file'         => new sfWidgetFormFilterInput(),
      'instruction'                 => new sfWidgetFormFilterInput(),
      'barrister_backsheet_options' => new sfWidgetFormFilterInput(),
      'barrister_fee'               => new sfWidgetFormFilterInput(),
      'in_custody'                  => new sfWidgetFormFilterInput(),
      'bail_on_this'                => new sfWidgetFormFilterInput(),
      'client_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => true)),
      'solicitor_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Solicitor'), 'add_empty' => true)),
      'informant_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Informant'), 'add_empty' => true)),
      'prosecutor_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Prosecutor'), 'add_empty' => true)),
      'barrister_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Barrister'), 'add_empty' => true)),
      'prosecution_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Prosecution'), 'add_empty' => true)),
      'prison_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Prison'), 'add_empty' => true)),
      'status_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'created_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'number'                      => new sfValidatorPass(array('required' => false)),
      'charge_first_name'           => new sfValidatorPass(array('required' => false)),
      'charge_last_name'            => new sfValidatorPass(array('required' => false)),
      'first_name'                  => new sfValidatorPass(array('required' => false)),
      'last_name'                   => new sfValidatorPass(array('required' => false)),
      'honorific_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Honorific'), 'column' => 'id')),
      'preferred_contact_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PreferredContact'), 'column' => 'id')),
      'correspondence_title'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'correspondence_real_name'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'correspondence_sent_option'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'street'                      => new sfValidatorPass(array('required' => false)),
      'suburb'                      => new sfValidatorPass(array('required' => false)),
      'postcode'                    => new sfValidatorPass(array('required' => false)),
      'city'                        => new sfValidatorPass(array('required' => false)),
      'state'                       => new sfValidatorPass(array('required' => false)),
      'street2'                     => new sfValidatorPass(array('required' => false)),
      'suburb2'                     => new sfValidatorPass(array('required' => false)),
      'postcode2'                   => new sfValidatorPass(array('required' => false)),
      'city2'                       => new sfValidatorPass(array('required' => false)),
      'state2'                      => new sfValidatorPass(array('required' => false)),
      'home_phone'                  => new sfValidatorPass(array('required' => false)),
      'work_phone'                  => new sfValidatorPass(array('required' => false)),
      'mobile'                      => new sfValidatorPass(array('required' => false)),
      'other_phone'                 => new sfValidatorPass(array('required' => false)),
      'fax'                         => new sfValidatorPass(array('required' => false)),
      'email'                       => new sfValidatorPass(array('required' => false)),
      'first_instructions_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'case_number'                 => new sfValidatorPass(array('required' => false)),
      'instruction_on_file'         => new sfValidatorPass(array('required' => false)),
      'instruction'                 => new sfValidatorPass(array('required' => false)),
      'barrister_backsheet_options' => new sfValidatorPass(array('required' => false)),
      'barrister_fee'               => new sfValidatorPass(array('required' => false)),
      'in_custody'                  => new sfValidatorPass(array('required' => false)),
      'bail_on_this'                => new sfValidatorPass(array('required' => false)),
      'client_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Client'), 'column' => 'id')),
      'solicitor_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Solicitor'), 'column' => 'id')),
      'informant_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Informant'), 'column' => 'id')),
      'prosecutor_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Prosecutor'), 'column' => 'id')),
      'barrister_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Barrister'), 'column' => 'id')),
      'prosecution_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Prosecution'), 'column' => 'id')),
      'prison_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Prison'), 'column' => 'id')),
      'status_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Status'), 'column' => 'id')),
      'created_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('user_file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserFile';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'number'                      => 'Text',
      'charge_first_name'           => 'Text',
      'charge_last_name'            => 'Text',
      'first_name'                  => 'Text',
      'last_name'                   => 'Text',
      'honorific_id'                => 'ForeignKey',
      'preferred_contact_id'        => 'ForeignKey',
      'correspondence_title'        => 'Boolean',
      'correspondence_real_name'    => 'Boolean',
      'correspondence_sent_option'  => 'Number',
      'street'                      => 'Text',
      'suburb'                      => 'Text',
      'postcode'                    => 'Text',
      'city'                        => 'Text',
      'state'                       => 'Text',
      'street2'                     => 'Text',
      'suburb2'                     => 'Text',
      'postcode2'                   => 'Text',
      'city2'                       => 'Text',
      'state2'                      => 'Text',
      'home_phone'                  => 'Text',
      'work_phone'                  => 'Text',
      'mobile'                      => 'Text',
      'other_phone'                 => 'Text',
      'fax'                         => 'Text',
      'email'                       => 'Text',
      'first_instructions_date'     => 'Date',
      'case_number'                 => 'Text',
      'instruction_on_file'         => 'Text',
      'instruction'                 => 'Text',
      'barrister_backsheet_options' => 'Text',
      'barrister_fee'               => 'Text',
      'in_custody'                  => 'Text',
      'bail_on_this'                => 'Text',
      'client_id'                   => 'ForeignKey',
      'solicitor_id'                => 'ForeignKey',
      'informant_id'                => 'ForeignKey',
      'prosecutor_id'               => 'ForeignKey',
      'barrister_id'                => 'ForeignKey',
      'prosecution_id'              => 'ForeignKey',
      'prison_id'                   => 'ForeignKey',
      'status_id'                   => 'ForeignKey',
      'created_at'                  => 'Date',
      'updated_at'                  => 'Date',
    );
  }
}
