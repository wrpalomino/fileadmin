<?php

/**
 * AidGrantTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AidGrantTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AidGrantTable
     */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('AidGrant');
  }
    
  public function mainFilter(Doctrine_Query $q)
  {
    //return CommonTable::mainFilter($q, $this->getComponentName());
    return $q;
  }
}