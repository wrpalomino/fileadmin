<?php

/**
 * Compliance filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseComplianceFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'original_grant_date'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'specific_category_applied_in'     => new sfWidgetFormFilterInput(),
      '12months_proof_of_means'          => new sfWidgetFormFilterInput(),
      '12months_proof_of_means_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      '2years_proof_of_means'            => new sfWidgetFormFilterInput(),
      '2years_proof_of_means_date'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'release_custody_proof_of_means'   => new sfWidgetFormFilterInput(),
      'docs_for_self_employment'         => new sfWidgetFormFilterInput(),
      'bank_statements_for_3months'      => new sfWidgetFormFilterInput(),
      'recent_payslip_employeer_letter'  => new sfWidgetFormFilterInput(),
      'separation_certificate'           => new sfWidgetFormFilterInput(),
      'letter_for_new_address'           => new sfWidgetFormFilterInput(),
      'deteals_for_caveat_provided'      => new sfWidgetFormFilterInput(),
      'client_instructions_on_file'      => new sfWidgetFormFilterInput(),
      'charges'                          => new sfWidgetFormFilterInput(),
      'priors'                           => new sfWidgetFormFilterInput(),
      'centrelink_crn'                   => new sfWidgetFormFilterInput(),
      'expiry_date_on_hcc'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pay_board_amount'                 => new sfWidgetFormFilterInput(),
      'name_of_fap'                      => new sfWidgetFormFilterInput(),
      'expiry_date_of_fap_hcc'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fap_bank_statements_for_3months'  => new sfWidgetFormFilterInput(),
      'negotiation_informant_prosecutor' => new sfWidgetFormFilterInput(),
      'final_result_letter_sent'         => new sfWidgetFormFilterInput(),
      'worksheet_on_file'                => new sfWidgetFormFilterInput(),
      'issues_with_this_grant_of_aid'    => new sfWidgetFormFilterInput(),
      'legal_aid_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LegalAid'), 'add_empty' => true)),
      'who_live_with_id'                 => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WhoLiveWith'), 'add_empty' => true)),
      'created_at'                       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'original_grant_date'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'specific_category_applied_in'     => new sfValidatorPass(array('required' => false)),
      '12months_proof_of_means'          => new sfValidatorPass(array('required' => false)),
      '12months_proof_of_means_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      '2years_proof_of_means'            => new sfValidatorPass(array('required' => false)),
      '2years_proof_of_means_date'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'release_custody_proof_of_means'   => new sfValidatorPass(array('required' => false)),
      'docs_for_self_employment'         => new sfValidatorPass(array('required' => false)),
      'bank_statements_for_3months'      => new sfValidatorPass(array('required' => false)),
      'recent_payslip_employeer_letter'  => new sfValidatorPass(array('required' => false)),
      'separation_certificate'           => new sfValidatorPass(array('required' => false)),
      'letter_for_new_address'           => new sfValidatorPass(array('required' => false)),
      'deteals_for_caveat_provided'      => new sfValidatorPass(array('required' => false)),
      'client_instructions_on_file'      => new sfValidatorPass(array('required' => false)),
      'charges'                          => new sfValidatorPass(array('required' => false)),
      'priors'                           => new sfValidatorPass(array('required' => false)),
      'centrelink_crn'                   => new sfValidatorPass(array('required' => false)),
      'expiry_date_on_hcc'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'pay_board_amount'                 => new sfValidatorPass(array('required' => false)),
      'name_of_fap'                      => new sfValidatorPass(array('required' => false)),
      'expiry_date_of_fap_hcc'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fap_bank_statements_for_3months'  => new sfValidatorPass(array('required' => false)),
      'negotiation_informant_prosecutor' => new sfValidatorPass(array('required' => false)),
      'final_result_letter_sent'         => new sfValidatorPass(array('required' => false)),
      'worksheet_on_file'                => new sfValidatorPass(array('required' => false)),
      'issues_with_this_grant_of_aid'    => new sfValidatorPass(array('required' => false)),
      'legal_aid_id'                     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LegalAid'), 'column' => 'id')),
      'who_live_with_id'                 => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('WhoLiveWith'), 'column' => 'id')),
      'created_at'                       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('compliance_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Compliance';
  }

  public function getFields()
  {
    return array(
      'id'                               => 'Number',
      'original_grant_date'              => 'Date',
      'specific_category_applied_in'     => 'Text',
      '12months_proof_of_means'          => 'Text',
      '12months_proof_of_means_date'     => 'Date',
      '2years_proof_of_means'            => 'Text',
      '2years_proof_of_means_date'       => 'Date',
      'release_custody_proof_of_means'   => 'Text',
      'docs_for_self_employment'         => 'Text',
      'bank_statements_for_3months'      => 'Text',
      'recent_payslip_employeer_letter'  => 'Text',
      'separation_certificate'           => 'Text',
      'letter_for_new_address'           => 'Text',
      'deteals_for_caveat_provided'      => 'Text',
      'client_instructions_on_file'      => 'Text',
      'charges'                          => 'Text',
      'priors'                           => 'Text',
      'centrelink_crn'                   => 'Text',
      'expiry_date_on_hcc'               => 'Date',
      'pay_board_amount'                 => 'Text',
      'name_of_fap'                      => 'Text',
      'expiry_date_of_fap_hcc'           => 'Date',
      'fap_bank_statements_for_3months'  => 'Text',
      'negotiation_informant_prosecutor' => 'Text',
      'final_result_letter_sent'         => 'Text',
      'worksheet_on_file'                => 'Text',
      'issues_with_this_grant_of_aid'    => 'Text',
      'legal_aid_id'                     => 'ForeignKey',
      'who_live_with_id'                 => 'ForeignKey',
      'created_at'                       => 'Date',
      'updated_at'                       => 'Date',
    );
  }
}
