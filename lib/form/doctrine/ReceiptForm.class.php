<?php

/**
 * Receipt form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReceiptForm extends BaseReceiptForm
{
  public function configure()
  {
    $this->widgetSchema['full_part'] = new sfWidgetFormChoice(array('choices' => CommonTable::getFullPartOptions()));
    $this->widgetSchema['received_by_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['received_by_id']->setOption('table_method', 'getSolicitorsCB');
    
    $this->widgetSchema['court_date_id']->setOption('method', 'getReadableCourtDate');
    $this->widgetSchema['court_date_id']->setOption('table_method', 'getCourtDatesForUserFile');
    
    $this->widgetSchema['status_id']->setOption('table_method', 'getPaymentDocumentsStatus');
    $this->widgetSchema['status_id']->setOption('add_empty', false);
    
    $this->validatorSchema['amount_paid'] = new sfValidatorNumber();
    
    $this->setDefault('date', time());
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
