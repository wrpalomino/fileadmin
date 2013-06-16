<?php

/**
 * FeeAgreement form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FeeAgreementForm extends BaseFeeAgreementForm
{
  public function configure()
  {
    $common_fields = array('by_what_date', 'account_type_id', 'fee_agreement_type_id');
    $type = $this->getOption('type');
    $extra_fields = ($type == 1) ? array('lump_sum', 'gst', 'total') : (($type == 2) ? array('lump_sum', 'hourly_fee', 'gst', 'estimate_total') : array('hourly_fee', 'estimate_total', 'counsel_daily_fee', 'instructor_daily_fee'));
    $this->useFields(array_merge($extra_fields, $common_fields));
    //echo $type;
    
    switch ($type) {
      case 1:
        break;
      case 2:
        $this->widgetSchema['lump_sum']->setLabel('1st appearance');
        $this->widgetSchema['hourly_fee']->setLabel('2nd appearance');
        break;
      case 3:
        $this->widgetSchema['counsel_daily_fee']->setLabel('Counsel');
        $this->widgetSchema['instructor_daily_fee']->setLabel('Instructor');
        break;
    }
    $this->widgetSchema['fee_agreement_type_id'] = new sfWidgetFormInputHidden();
    if ($this->widgetSchema['lump_sum'])    $this->validatorSchema['lump_sum'] = new sfValidatorNumber(array('required' => false));
    if ($this->widgetSchema['hourly_fee'])  $this->validatorSchema['hourly_fee'] = new sfValidatorNumber(array('required' => false));
    if ($this->widgetSchema['gst'])         $this->validatorSchema['gst'] = new sfValidatorNumber(array('required' => false));
    
    // force trust account type as default
    $this->widgetSchema['account_type_id']->setOption('add_empty', false);
    
    $this->setDefault('fee_agreement_type_id', $this->getOption('type'));
    $this->widgetSchema['fee_agreement_type_id']->setAttributes($this->fixedValue());
    
  }
}
