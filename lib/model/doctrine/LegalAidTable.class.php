<?php

/**
 * LegalAidTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class LegalAidTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object LegalAidTable
     */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('LegalAid');
  }
    
  public function mainFilter(Doctrine_Query $q)
  {
    return CommonTable::mainFilter($q, $this->getComponentName()); 
  }
}