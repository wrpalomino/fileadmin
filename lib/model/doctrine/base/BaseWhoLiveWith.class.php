<?php

/**
 * BaseWhoLiveWith
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $value
 * @property boolean $is_active
 * @property Doctrine_Collection $Compliance
 * 
 * @method string              getValue()      Returns the current record's "value" value
 * @method boolean             getIsActive()   Returns the current record's "is_active" value
 * @method Doctrine_Collection getCompliance() Returns the current record's "Compliance" collection
 * @method WhoLiveWith         setValue()      Sets the current record's "value" value
 * @method WhoLiveWith         setIsActive()   Sets the current record's "is_active" value
 * @method WhoLiveWith         setCompliance() Sets the current record's "Compliance" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWhoLiveWith extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('who_live_with');
        $this->hasColumn('value', 'string', 120, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 120,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Compliance', array(
             'local' => 'id',
             'foreign' => 'who_live_with_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}