<?php

/**
 * Compliance form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ComplianceForm extends BaseComplianceForm
{
  public function configure()
  {
    //unset($this['legal_aid_id']);
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
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
  public function render($attributes = array())
  {
    $original_render = parent::render($attributes);
    $result = '';
    $columns = 2;
    $cont = 0;
    
    $arr = explode('<div class="sf_admin_form_row', $original_render);
    unset($arr[0]);
    
    foreach ($arr as $k => $v) {
      //echo $v.'<br/>';
      if ($cont == 0) $result .= '<tr>';
      elseif ($cont % $columns == 0)  $result .= '</tr><tr>';
      $result .= '<div class="sf_admin_form_row'.$v;
      ++$cont;
    }
    
    if ($result != '') {
      while ($cont % $columns != 0) {
        $result .= '<td></td>';
        ++$cont;
      }
      $result = '<table id="layout">'.$result.'</tr></table>';
      $original_render = $result;
      
      echo $original_render;
    }
    
    echo "=================";

    return "=================";
  }
  
}
