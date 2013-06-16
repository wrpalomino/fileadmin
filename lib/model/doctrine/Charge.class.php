<?php

/**
 * Charge
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Charge extends BaseCharge
{
  public function getFileNumber()
  {
    return $this->getUserFile()->getNumber();
  }
  
  public function obtainUserFileId($player)
  {    
    return $this->getUserFileId();
  }
  
  public function obtainClientId($player)
  {
    return $this->getUserFile()->getClientId();
  }
  
}