<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'street'               => new sfWidgetFormInputText(),
      'suburb'               => new sfWidgetFormInputText(),
      'postcode'             => new sfWidgetFormInputText(),
      'city'                 => new sfWidgetFormInputText(),
      'state'                => new sfWidgetFormInputText(),
      'home_phone'           => new sfWidgetFormInputText(),
      'work_phone'           => new sfWidgetFormInputText(),
      'mobile'               => new sfWidgetFormInputText(),
      'other_phone'          => new sfWidgetFormInputText(),
      'fax'                  => new sfWidgetFormInputText(),
      'dob'                  => new sfWidgetFormDate(),
      'picture_file'         => new sfWidgetFormInputText(),
      'badge_number'         => new sfWidgetFormInputText(),
      'signature_file'       => new sfWidgetFormInputText(),
      'criminal_crn'         => new sfWidgetFormInputText(),
      'centrelink_crn'       => new sfWidgetFormInputText(),
      'hcc_expiration_date'  => new sfWidgetFormDate(),
      'referral_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Referral'), 'add_empty' => true)),
      'user_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'related_user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RelatedUser'), 'add_empty' => true)),
      'preferred_contact_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PreferredContact'), 'add_empty' => true)),
      'honorific_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Honorific'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'street'               => new sfValidatorString(array('max_length' => 120)),
      'suburb'               => new sfValidatorString(array('max_length' => 60)),
      'postcode'             => new sfValidatorString(array('max_length' => 30)),
      'city'                 => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'state'                => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'home_phone'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'work_phone'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mobile'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'other_phone'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'fax'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'dob'                  => new sfValidatorDate(array('required' => false)),
      'picture_file'         => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'badge_number'         => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'signature_file'       => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'criminal_crn'         => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'centrelink_crn'       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'hcc_expiration_date'  => new sfValidatorDate(array('required' => false)),
      'referral_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Referral'), 'required' => false)),
      'user_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'related_user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RelatedUser'), 'required' => false)),
      'preferred_contact_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PreferredContact'), 'required' => false)),
      'honorific_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Honorific'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

}
