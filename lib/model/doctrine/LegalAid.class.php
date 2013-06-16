<?php

/**
 * LegalAid
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class LegalAid extends BaseLegalAid
{
  public function obtainClientId($module_name)
  {
    return $this->getUserFile()->getClientId();
  }
  
  public function obtainUserFileId($module_name)
  {
    return $this->getUserFileId();
  }
}