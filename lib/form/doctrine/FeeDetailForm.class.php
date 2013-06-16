<?php

/**
 * FeeDetail form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FeeDetailForm extends BaseFeeDetailForm
{
  public function configure()
  {
    $this->useFields(array('amount', 'barrister_fee', 'disbursement', 'preparation_fee', 'appearance_fee', 'date', 'by_who_id', 'type_id'));
    $session_user = sfContext::getInstance()->getUser();

    $amouns_att = array('size' => 6, 'style' => 'text-align:right');
    
    if ( (!$session_user->hasCredential('EDIT-FEEDETAILPAID'))&&($this->getOption('fdt') == 4) ) {
      $amouns_att['readonly'] = 'readonly';
    }
    
    // added by William, 26/05/2013
    $this->widgetSchema['type_id'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['type_id']->setOption('required', false);
    $this->widgetSchema['type_id']->setLabel('hidden');
    if ($this->isNew()) {  // set the type Id and by_whom id (person who enters info) only if it is new  
      $this->setDefault('type_id', $this->getOption('fdt'));
      //echo $this->getOption('fdt');
      
      $by_whom_id = $session_user->getGuardUser()->getId();
      $this->setDefault('by_who_id', $by_whom_id);
    }
    
    $this->widgetSchema['date'] = new sfWidgetFormDate();
    $this->widgetSchema['by_who_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['by_who_id']->setOption('table_method', 'getSolicitorsCB');
    
    $this->widgetSchema['amount']->setAttributes($amouns_att);
    $this->widgetSchema['disbursement']->setAttributes($amouns_att);
    $this->widgetSchema['barrister_fee']->setAttributes($amouns_att);
    $this->widgetSchema['preparation_fee']->setAttributes($amouns_att);
    $this->widgetSchema['appearance_fee']->setAttributes($amouns_att);
    $this->widgetSchema['disbursement']->setLabel('Disburs.');
    $this->widgetSchema['barrister_fee']->setLabel('Barrister');
    $this->widgetSchema['preparation_fee']->setLabel('Preparation');
    $this->widgetSchema['appearance_fee']->setLabel('Apperance');
    
    // this formatting is applied only if form is called directly, without admin generator templates
    $first = ($this->getOption('first') !== null) ? $this->getOption('first') : false;
    $custom_decorator = new ExtendedFormSchemaFormatter($this->getWidgetSchema(), array('header' => $first, 'no_delete' => true));
    $this->widgetSchema->addFormFormatter('Myformatter', $custom_decorator);
    $this->widgetSchema->setFormFormatterName('Myformatter');
     
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
}
