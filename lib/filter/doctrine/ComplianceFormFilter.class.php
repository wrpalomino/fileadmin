<?php

/**
 * Compliance filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ComplianceFormFilter extends BaseComplianceFormFilter
{
  public function configure()
  {
    $this->widgetSchema['legal_aid_id']->setOption('method', 'getReferenceNumber');
    
    $this->widgetSchema['12months_proof_of_means'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['2years_proof_of_means'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['release_custody_proof_of_means'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['docs_for_self_employment'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['bank_statements_for_3months'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['recent_payslip_employeer_letter'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['separation_certificate'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['letter_for_new_address'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['deteals_for_caveat_provided'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['client_instructions_on_file'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['charges'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['priors'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['fap_bank_statements_for_3months'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['negotiation_informant_prosecutor'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['final_result_letter_sent'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['worksheet_on_file'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setFormChoiceValues')))
    );
  }
  
  public function setFormChoiceValues($validator, $values)
  {
    if (isset($values['12months_proof_of_means']))          $values['12months_proof_of_means'] = array('text' => $values['12months_proof_of_means']);
    if (isset($values['2years_proof_of_means']))            $values['2years_proof_of_means'] = array('text' => $values['2years_proof_of_means']);
    if (isset($values['release_custody_proof_of_means']))   $values['release_custody_proof_of_means'] = array('text' => $values['release_custody_proof_of_means']);
    if (isset($values['docs_for_self_employment']))         $values['docs_for_self_employment'] = array('text' => $values['docs_for_self_employment']);
    if (isset($values['bank_statements_for_3months']))      $values['bank_statements_for_3months'] = array('text' => $values['bank_statements_for_3months']);
    if (isset($values['recent_payslip_employeer_letter']))  $values['recent_payslip_employeer_letter'] = array('text' => $values['recent_payslip_employeer_letter']);
    if (isset($values['separation_certificate']))           $values['separation_certificate'] = array('text' => $values['separation_certificate']);
    if (isset($values['letter_for_new_address']))           $values['letter_for_new_address'] = array('text' => $values['letter_for_new_address']);
    if (isset($values['deteals_for_caveat_provided']))      $values['deteals_for_caveat_provided'] = array('text' => $values['deteals_for_caveat_provided']);
    if (isset($values['client_instructions_on_file']))      $values['client_instructions_on_file'] = array('text' => $values['client_instructions_on_file']);
    if (isset($values['charges']))                          $values['charges'] = array('text' => $values['charges']);
    if (isset($values['priors']))                           $values['priors'] = array('text' => $values['priors']);
    if (isset($values['fap_bank_statements_for_3months']))  $values['fap_bank_statements_for_3months'] = array('text' => $values['fap_bank_statements_for_3months']);
    if (isset($values['negotiation_informant_prosecutor'])) $values['negotiation_informant_prosecutor'] = array('text' => $values['negotiation_informant_prosecutor']);
    if (isset($values['final_result_letter_sent']))         $values['final_result_letter_sent'] = array('text' => $values['final_result_letter_sent']);
    if (isset($values['worksheet_on_file']))                $values['worksheet_on_file'] = array('text' => $values['worksheet_on_file']);
    return $values;
  }
}
