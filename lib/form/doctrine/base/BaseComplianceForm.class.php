<?php

/**
 * Compliance form base class.
 *
 * @method Compliance getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComplianceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                               => new sfWidgetFormInputHidden(),
      'original_grant_date'              => new sfWidgetFormDate(),
      'specific_category_applied_in'     => new sfWidgetFormInputText(),
      '12months_proof_of_means'          => new sfWidgetFormInputText(),
      '12months_proof_of_means_date'     => new sfWidgetFormDate(),
      '2years_proof_of_means'            => new sfWidgetFormInputText(),
      '2years_proof_of_means_date'       => new sfWidgetFormDate(),
      'release_custody_proof_of_means'   => new sfWidgetFormInputText(),
      'docs_for_self_employment'         => new sfWidgetFormInputText(),
      'bank_statements_for_3months'      => new sfWidgetFormInputText(),
      'recent_payslip_employeer_letter'  => new sfWidgetFormInputText(),
      'separation_certificate'           => new sfWidgetFormInputText(),
      'letter_for_new_address'           => new sfWidgetFormInputText(),
      'deteals_for_caveat_provided'      => new sfWidgetFormInputText(),
      'client_instructions_on_file'      => new sfWidgetFormInputText(),
      'charges'                          => new sfWidgetFormInputText(),
      'priors'                           => new sfWidgetFormInputText(),
      'centrelink_crn'                   => new sfWidgetFormInputText(),
      'expiry_date_on_hcc'               => new sfWidgetFormDate(),
      'pay_board_amount'                 => new sfWidgetFormInputText(),
      'name_of_fap'                      => new sfWidgetFormInputText(),
      'expiry_date_of_fap_hcc'           => new sfWidgetFormDate(),
      'fap_bank_statements_for_3months'  => new sfWidgetFormInputText(),
      'negotiation_informant_prosecutor' => new sfWidgetFormInputText(),
      'final_result_letter_sent'         => new sfWidgetFormInputText(),
      'worksheet_on_file'                => new sfWidgetFormInputText(),
      'issues_with_this_grant_of_aid'    => new sfWidgetFormInputText(),
      'legal_aid_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LegalAid'), 'add_empty' => false)),
      'who_live_with_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WhoLiveWith'), 'add_empty' => true)),
      'created_at'                       => new sfWidgetFormDateTime(),
      'updated_at'                       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'original_grant_date'              => new sfValidatorDate(array('required' => false)),
      'specific_category_applied_in'     => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      '12months_proof_of_means'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      '12months_proof_of_means_date'     => new sfValidatorDate(array('required' => false)),
      '2years_proof_of_means'            => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      '2years_proof_of_means_date'       => new sfValidatorDate(array('required' => false)),
      'release_custody_proof_of_means'   => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'docs_for_self_employment'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'bank_statements_for_3months'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'recent_payslip_employeer_letter'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'separation_certificate'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'letter_for_new_address'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'deteals_for_caveat_provided'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'client_instructions_on_file'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'charges'                          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'priors'                           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'centrelink_crn'                   => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'expiry_date_on_hcc'               => new sfValidatorDate(array('required' => false)),
      'pay_board_amount'                 => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'name_of_fap'                      => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'expiry_date_of_fap_hcc'           => new sfValidatorDate(array('required' => false)),
      'fap_bank_statements_for_3months'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'negotiation_informant_prosecutor' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'final_result_letter_sent'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'worksheet_on_file'                => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'issues_with_this_grant_of_aid'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'legal_aid_id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LegalAid'))),
      'who_live_with_id'                 => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('WhoLiveWith'), 'required' => false)),
      'created_at'                       => new sfValidatorDateTime(),
      'updated_at'                       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('compliance[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Compliance';
  }

}
