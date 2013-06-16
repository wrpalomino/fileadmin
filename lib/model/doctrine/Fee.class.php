<?php

/**
 * Fee
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Fee extends BaseFee
{
  public function obtainUserFileId($player)
  {    
    return $this->getCourtDate()->getUserFileId();
  }
  
  public function obtainClientId($player)
  {
    return $this->getCourtDate()->getUserFile()->getClientId();
  }
  
  
  static function getFeeTypes($type='obj', $which='active')
  {
    $q = Doctrine::getTable('FeeDetailType')->createQuery('ft');
    if ($which == 'active') $q->addWhere('ft.is_active=?', 1);
    $q->orderBy('ft.id ASC');
    $fee_details_types = $q->execute();
    
    if ($type == 'obj')  return $fee_details_types;
    else {
      $fee_types_arr = array();
      foreach ($fee_details_types as $fdt) $fee_types_arr[] = $fdt->getValueForId();
      return $fee_types_arr;
    }
  }
  
  public function save(Doctrine_Connection $conn = null)
  {
    $this->setVla(trim($this->getVla()));
    if ($this->getVla()) {
      return parent::save();
    }
    else {
      return null;
    }
  }
}