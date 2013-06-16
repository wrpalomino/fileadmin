<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'street'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'suburb'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'postcode'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'city'                 => new sfWidgetFormFilterInput(),
      'state'                => new sfWidgetFormFilterInput(),
      'home_phone'           => new sfWidgetFormFilterInput(),
      'work_phone'           => new sfWidgetFormFilterInput(),
      'mobile'               => new sfWidgetFormFilterInput(),
      'other_phone'          => new sfWidgetFormFilterInput(),
      'fax'                  => new sfWidgetFormFilterInput(),
      'dob'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'picture_file'         => new sfWidgetFormFilterInput(),
      'badge_number'         => new sfWidgetFormFilterInput(),
      'signature_file'       => new sfWidgetFormFilterInput(),
      'criminal_crn'         => new sfWidgetFormFilterInput(),
      'centrelink_crn'       => new sfWidgetFormFilterInput(),
      'hcc_expiration_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'referral_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Referral'), 'add_empty' => true)),
      'user_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'related_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RelatedUser'), 'add_empty' => true)),
      'preferred_contact_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PreferredContact'), 'add_empty' => true)),
      'honorific_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Honorific'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'street'               => new sfValidatorPass(array('required' => false)),
      'suburb'               => new sfValidatorPass(array('required' => false)),
      'postcode'             => new sfValidatorPass(array('required' => false)),
      'city'                 => new sfValidatorPass(array('required' => false)),
      'state'                => new sfValidatorPass(array('required' => false)),
      'home_phone'           => new sfValidatorPass(array('required' => false)),
      'work_phone'           => new sfValidatorPass(array('required' => false)),
      'mobile'               => new sfValidatorPass(array('required' => false)),
      'other_phone'          => new sfValidatorPass(array('required' => false)),
      'fax'                  => new sfValidatorPass(array('required' => false)),
      'dob'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'picture_file'         => new sfValidatorPass(array('required' => false)),
      'badge_number'         => new sfValidatorPass(array('required' => false)),
      'signature_file'       => new sfValidatorPass(array('required' => false)),
      'criminal_crn'         => new sfValidatorPass(array('required' => false)),
      'centrelink_crn'       => new sfValidatorPass(array('required' => false)),
      'hcc_expiration_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'referral_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Referral'), 'column' => 'id')),
      'user_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'related_user_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RelatedUser'), 'column' => 'id')),
      'preferred_contact_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PreferredContact'), 'column' => 'id')),
      'honorific_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Honorific'), 'column' => 'id')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'street'               => 'Text',
      'suburb'               => 'Text',
      'postcode'             => 'Text',
      'city'                 => 'Text',
      'state'                => 'Text',
      'home_phone'           => 'Text',
      'work_phone'           => 'Text',
      'mobile'               => 'Text',
      'other_phone'          => 'Text',
      'fax'                  => 'Text',
      'dob'                  => 'Date',
      'picture_file'         => 'Text',
      'badge_number'         => 'Text',
      'signature_file'       => 'Text',
      'criminal_crn'         => 'Text',
      'centrelink_crn'       => 'Text',
      'hcc_expiration_date'  => 'Date',
      'referral_id'          => 'ForeignKey',
      'user_id'              => 'ForeignKey',
      'related_user_id'      => 'ForeignKey',
      'preferred_contact_id' => 'ForeignKey',
      'honorific_id'         => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
