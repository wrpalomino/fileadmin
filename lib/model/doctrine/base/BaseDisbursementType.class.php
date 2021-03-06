<?php

/**
 * BaseDisbursementType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $value
 * @property Doctrine_Collection $Disbursement
 * 
 * @method string              getValue()        Returns the current record's "value" value
 * @method Doctrine_Collection getDisbursement() Returns the current record's "Disbursement" collection
 * @method DisbursementType    setValue()        Sets the current record's "value" value
 * @method DisbursementType    setDisbursement() Sets the current record's "Disbursement" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDisbursementType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('disbursement_type');
        $this->hasColumn('value', 'string', 120, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 120,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Disbursement', array(
             'local' => 'id',
             'foreign' => 'disbursement_type_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}