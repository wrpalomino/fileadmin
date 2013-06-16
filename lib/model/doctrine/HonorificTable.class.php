<?php

/**
 * HonorificTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class HonorificTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object HonorificTable
     */ 
  public static function getInstance()
  {
    return Doctrine_Core::getTable('Honorific');
  }
  
  
  
  public function loadHonorificByType($type)
  {
    $q = $this->createQuery('ho')
    ->Where('ho.type=?', $type);
    return $q;
  }
  
  public function loadCivil()   { return $this->loadHonorificByType('CIVIL'); }
  
  public function loadMilitia() { return $this->loadHonorificByType('MILITIA'); }
  
  public function loadMilitia2() 
  { 
    $q = $this->createQuery('ho')
    ->Where('ho.type=?', 'MILITIA')
    ->orWhere('ho.id=?', 4)
    ->orWhere('ho.id=?', 6);
    return $q;
  }
  
}