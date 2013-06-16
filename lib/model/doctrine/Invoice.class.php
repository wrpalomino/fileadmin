<?php

/**
 * Invoice
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Invoice extends BaseInvoice
{
  public function getTypeName()
  {
    return $this->getInvoiceType()->getValue();
  }
  
  public function calculateAmountDue()
  {
    return number_format(($this->getAmount() - $this->getAmountPaid()), sfConfig::get("app_precision"));
  }
  
  public function calculateAmountGst()
  {
    return number_format(($this->getAmount()/100)*sfConfig::get("app_gst"), sfConfig::get("app_precision"));
  }
}