<?php

/**
 * ShortMessage
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ShortMessage extends BaseShortMessage
{
  private $send_message_status;
  
  function sendSMS($values)
  {
    $send_OK = false;
    $sms_api = new SmsBroadcast("smsservice");
    
    // SMS FUN
    // only verify account
    //$send_OK = $sms_api->makeCall(array('message' => $this->getMessage(), 'send_to' => $this->getSmsTo()));
    // send message
    //$send_OK = $sms_api->makeCall(array('message' => $this->getMessage(), 'send_to' => $this->getSmsTo(), 'send' => 1));
    
    // SMSBROADCAST
    $send_OK = $sms_api->makeCall(array('message' => $values['message'], 'to' => $values['sms_to'], 'from' => $values['sms_from']));
    $this->send_message_status = $sms_api->getSendMessageStatus();
    return $send_OK;
  }
  
  public function getSendMessageStatus()
  {
    return $this->send_message_status;
  }
  
  public function getSenderName()
  {
    return sfContext::getInstance()->getUser()->getGuardUser()->obtainFullName();
  }
}