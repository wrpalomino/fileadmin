<?php

/**
 * UserFile form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserFileFeeForm extends BaseUserFileForm
{
  public function configure()
  {    
    $this->usefields(array('number'));
    
    $this->setDefault('number', $this->getObject()->getNewFileNumber());
    $this->widgetSchema['number']->setAttribute('readonly', 'readonly');
    $this->widgetSchema['number']->setLabel('File Number');
      
    $code = $this->loadValues();
    if ($code == 'FAG')  {
      
      $fee_agreements = array('lump_sum_one_day', 'lump_sum_more_than_one_day', 'schedule_fees');
      $fee_agreement_objs = $this->getObject()->getFileFeeAgreements();
      
      foreach ($fee_agreements as $k => $detail) {
        $first = ($detail == 'lump_sum_one_day') ? true : false;       
        $detail_form = new FeeAgreementForm($fee_agreement_objs[$k], array('first' => $first, 'type' => $k+1));
        unset($detail_form['user_file_id']);
        $this->embedForm($detail, $detail_form);
        
        // no validation required, save the subforms anyway
        //$this->validatorSchema[$detail] = new sfValidatorPass(array('required' => false));
      }
    }
    else {
      $this->embedRelations(array('FileCourtDates' => array(
        'considerNewFormEmptyFields'    => array('listing_id', 'date', 'appearing_id'),
        'noNewForm'                     => true,
        'newFormLabel'                  => false,
        'newFormClass'                  => 'CourtDateFeeForm',
        'newFormClassArgs'              => array(array('sf_user' => $this->getOption('sf_user'), 'first' => true)),
        'displayEmptyRelations'         => false,
        'existingRelationsFormLabel'    => 'Fees',
        'formClass'                     => 'CourtDateFeeForm',
        'formClassArgs'                 => array(array('ah_add_delete_checkbox' => false)),
        'newFormAfterExistingRelations' => false,
        'formFormatter'                 => null,
        'multipleNewForms'              => false,
        'newFormsInitialCount'          => 0,
        'newFormsContainerForm'         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
        'newRelationButtonLabel'        => '',
        'newRelationAddByCloning'       => false,
        'newRelationUseJSFramework'     => 'jQuery',
        'customEmbeddedFormLabelMethod' => false,
        ),
      ));
    }
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
  public function loadValues($default_values=array())
  {
    // set the agency group
    if (isset($default_values['fileFee_code'])) {
      $code = $default_values['fileFee_code'];
    }
    else {
      // get the agency group
      $code = isset($_GET['code']) ? $_GET['code'] : '';
      if ($code != '') sfContext::getInstance()->getUser()->setAttribute('fileFee_code', $code);
      else $code = sfContext::getInstance()->getUser()->getAttribute('fileFee_code', 'FEE');
    }
    
    return $code;
  }
  
  protected function doSave($con = null)
  {
    if (null === $con) {
      $con = $this->getConnection();
    }
    $forms = $this->embeddedForms;
    
    //foreach ($forms as $k => $v)  echo $k .'=>'. $v;
    
    // do not save the empty fees for each court date
    foreach ($forms['FileCourtDates'] as $k => $v) {
      if ($k != '_csrf_token') {
        foreach ( $this->values['FileCourtDates'][$k] as $k1 => $v1)    
          $arr = $this->values['FileCourtDates'][$k];
      
          if ( (!isset($arr['Fee'])) || (is_null($this->values['FileCourtDates'][$k]['Fee'])) ) {
            unset($forms['FileCourtDates']->embeddedForms[$k]->embeddedForms['Fee']);               // avoid to save embedded form's object
            $n = new Doctrine_Collection('Fee');
            $this->embeddedForms['FileCourtDates']->embeddedForms[$k]->getObject()->setFee($n);
          }
        }
    }
    
    $this->updateObject();
    //$this->getObject()->save($con);

    // embedded forms
    $this->saveEmbeddedForms($con, $forms);
  }
  
}