<?php

/**
 * BaseStatusType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $short_name
 * @property string $description
 * @property boolean $is_active
 * @property Doctrine_Collection $Status
 * 
 * @method string              getName()        Returns the current record's "name" value
 * @method string              getShortName()   Returns the current record's "short_name" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method boolean             getIsActive()    Returns the current record's "is_active" value
 * @method Doctrine_Collection getStatus()      Returns the current record's "Status" collection
 * @method StatusType          setName()        Sets the current record's "name" value
 * @method StatusType          setShortName()   Sets the current record's "short_name" value
 * @method StatusType          setDescription() Sets the current record's "description" value
 * @method StatusType          setIsActive()    Sets the current record's "is_active" value
 * @method StatusType          setStatus()      Sets the current record's "Status" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseStatusType extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('status_type');
        $this->hasColumn('name', 'string', 120, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 120,
             ));
        $this->hasColumn('short_name', 'string', 30, array(
             'type' => 'string',
             'length' => 30,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Status', array(
             'local' => 'id',
             'foreign' => 'status_type_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}