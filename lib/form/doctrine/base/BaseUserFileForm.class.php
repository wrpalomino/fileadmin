<?php

/**
 * UserFile form base class.
 *
 * @method UserFile getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserFileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'number'                      => new sfWidgetFormInputText(),
      'charge_first_name'           => new sfWidgetFormInputText(),
      'charge_last_name'            => new sfWidgetFormInputText(),
      'first_name'                  => new sfWidgetFormInputText(),
      'last_name'                   => new sfWidgetFormInputText(),
      'honorific_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Honorific'), 'add_empty' => true)),
      'preferred_contact_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PreferredContact'), 'add_empty' => true)),
      'correspondence_title'        => new sfWidgetFormInputCheckbox(),
      'correspondence_real_name'    => new sfWidgetFormInputCheckbox(),
      'correspondence_sent_option'  => new sfWidgetFormInputText(),
      'street'                      => new sfWidgetFormInputText(),
      'suburb'                      => new sfWidgetFormInputText(),
      'postcode'                    => new sfWidgetFormInputText(),
      'city'                        => new sfWidgetFormInputText(),
      'state'                       => new sfWidgetFormInputText(),
      'street2'                     => new sfWidgetFormInputText(),
      'suburb2'                     => new sfWidgetFormInputText(),
      'postcode2'                   => new sfWidgetFormInputText(),
      'city2'                       => new sfWidgetFormInputText(),
      'state2'                      => new sfWidgetFormInputText(),
      'home_phone'                  => new sfWidgetFormInputText(),
      'work_phone'                  => new sfWidgetFormInputText(),
      'mobile'                      => new sfWidgetFormInputText(),
      'other_phone'                 => new sfWidgetFormInputText(),
      'fax'                         => new sfWidgetFormInputText(),
      'email'                       => new sfWidgetFormInputText(),
      'first_instructions_date'     => new sfWidgetFormDate(),
      'case_number'                 => new sfWidgetFormInputText(),
      'instruction_on_file'         => new sfWidgetFormInputText(),
      'instruction'                 => new sfWidgetFormTextarea(),
      'barrister_backsheet_options' => new sfWidgetFormInputText(),
      'barrister_fee'               => new sfWidgetFormInputText(),
      'in_custody'                  => new sfWidgetFormInputText(),
      'bail_on_this'                => new sfWidgetFormInputText(),
      'client_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Client'), 'add_empty' => false)),
      'solicitor_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Solicitor'), 'add_empty' => true)),
      'informant_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Informant'), 'add_empty' => true)),
      'prosecutor_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Prosecutor'), 'add_empty' => true)),
      'barrister_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Barrister'), 'add_empty' => true)),
      'prosecution_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Prosecution'), 'add_empty' => true)),
      'prison_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Prison'), 'add_empty' => true)),
      'status_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'created_at'                  => new sfWidgetFormDateTime(),
      'updated_at'                  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'number'                      => new sfValidatorString(array('max_length' => 120)),
      'charge_first_name'           => new sfValidatorString(array('max_length' => 255)),
      'charge_last_name'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'first_name'                  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'                   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'honorific_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Honorific'), 'required' => false)),
      'preferred_contact_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PreferredContact'), 'required' => false)),
      'correspondence_title'        => new sfValidatorBoolean(array('required' => false)),
      'correspondence_real_name'    => new sfValidatorBoolean(array('required' => false)),
      'correspondence_sent_option'  => new sfValidatorInteger(array('required' => false)),
      'street'                      => new sfValidatorString(array('max_length' => 120)),
      'suburb'                      => new sfValidatorString(array('max_length' => 60)),
      'postcode'                    => new sfValidatorString(array('max_length' => 30)),
      'city'                        => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'state'                       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'street2'                     => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'suburb2'                     => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'postcode2'                   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'city2'                       => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'state2'                      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'home_phone'                  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'work_phone'                  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'mobile'                      => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'other_phone'                 => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'fax'                         => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'email'                       => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'first_instructions_date'     => new sfValidatorDate(array('required' => false)),
      'case_number'                 => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'instruction_on_file'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'instruction'                 => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'barrister_backsheet_options' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'barrister_fee'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'in_custody'                  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'bail_on_this'                => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'client_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Client'))),
      'solicitor_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Solicitor'), 'required' => false)),
      'informant_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Informant'), 'required' => false)),
      'prosecutor_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Prosecutor'), 'required' => false)),
      'barrister_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Barrister'), 'required' => false)),
      'prosecution_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Prosecution'), 'required' => false)),
      'prison_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Prison'), 'required' => false)),
      'status_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'required' => false)),
      'created_at'                  => new sfValidatorDateTime(),
      'updated_at'                  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'UserFile', 'column' => array('number')))
    );

    $this->widgetSchema->setNameFormat('user_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserFile';
  }

}
