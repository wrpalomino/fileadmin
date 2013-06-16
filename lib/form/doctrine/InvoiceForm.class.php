<?php

/**
 * Invoice form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InvoiceForm extends BaseInvoiceForm
{
  public function configure()
  {
    $this->widgetSchema['court_date_id']->setOption('method', 'getReadableCourtDate');
    $this->widgetSchema['court_date_id']->setOption('table_method', 'getCourtDatesForUserFile');
    
    $this->widgetSchema['status_id']->setOption('table_method', 'getPaymentDocumentsStatus');
    $this->widgetSchema['status_id']->setOption('add_empty', false);
    
    $this->validatorSchema['amount'] = new sfValidatorNumber();
    $this->validatorSchema['amount_paid'] = new sfValidatorNumber(array('required' => false));
    $this->validatorSchema['amount_due'] = new sfValidatorNumber(array('required' => false));
    
    $this->validatorSchema['court_date_id'] = new sfValidatorNumber(array('required' => true));
    $this->validatorSchema['type_id'] = new sfValidatorNumber(array('required' => true));
    
    $this->setDefault('date', time());
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
