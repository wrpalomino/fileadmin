<?php

/**
 * Fee form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FeeForm extends BaseFeeForm
{
  public function configure()
  {
    $this->useFields(array('vla', 'paid', 'need_invoicing'));

    $this->fee_details_types = Fee::getFeeTypes(); //array('solicitor_claim', 'invoiced', 'received', 'paid'); 

    // set some default values and format
    //$this->widgetSchema['vla']->setAttribute('size', '5');
    $this->widgetSchema['vla'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['vla']->setOption('required', true);
    
    $this->widgetSchema['need_invoicing'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['need_invoicing']->setAttribute('style', 'width:140px');
    $this->widgetSchema['paid']->setAttribute('style', 'width:110px');
    
    $fee_detail_objs = $this->getObject()->getFeeDetails();
    //echo count($fee_detail_objs);
    
    //if (count($fee_detail_objs) == 0) {  //there is not relationships
      foreach ($this->fee_details_types as $k => $fee_detail_type) {
        /*if ($fee_detail_objs[$k]->getFee()->getId() == null)  {
          $fee_detail_objs[$k]->getFee()->setId($this->getObject()->getId());
        }*/
        
        $detail = $fee_detail_type->getValueForId();
        $first = ($k == 0) ? true : false;
        
        $fee_detail_objx = $fee_detail_objs[$k];
        if ($fee_detail_objs) {
          foreach ($fee_detail_objs as $fee_detail_obj) {
            if ($fee_detail_obj->getTypeId() == $fee_detail_type->getId()) {
              $fee_detail_objx = $fee_detail_obj;
              break;
            }
          }
        }
      
        //$fee_detail =  new FeeDetail();
        //$fee_detail->Fee = $this->getObject();
        //$fee_detail_form = new FeeDetailForm($fee_detail, array('first' => $first));
        //$this->embedForm($detail, $fee_detail_form);
        $detail_form = new FeeDetailForm($fee_detail_objx, array('first' => $first, 'fdt' => $fee_detail_type->getId()));
        unset($detail_form['fee_id']);
        $this->embedForm($detail, $detail_form);
        
        // no validation required, save the subforms anyway
        $this->validatorSchema[$detail] = new sfValidatorPass(array('required' => false));
      }
    //}
    //else {
      //$this->embedRelation('FeeDetail');
    //}
        
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
  
  /*public function setSpecialFeeDetailsValues($validator, $values)
  {    
    $fee_types_arr = array();
    foreach ($this->fee_detail_types as $fdt) $fee_types_arr[] = $fdt->getValueForId();
   
    foreach ($values['Fee'] as $k => $value) {  
      if (in_array($k, $fee_types_arr)) {
        $clear_fee_detail = true;
        foreach ($values['Fee'][$k] as $k1 => $value1) {            // only validate textboxes
          if ( ($this->widgetSchema['Fee'][$k][$k1] instanceof sfWidgetFormInputText) && !empty($value1) ) {
            $clear_fee_detail = false;
            break;
          }
        }
        if ($clear_fee_detail) {
          foreach ($values['Fee'][$k] as $k1 => $value1)  unset($values['Fee'][$k][$k1]);
          unset($values['Fee'][$k]);
        }
      }
    } 
    return $values;
  }*/
 
}
