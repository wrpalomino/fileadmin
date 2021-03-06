<?php

/**
 * BaseLocation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $suburb
 * @property string $postcode
 * 
 * @method string   getSuburb()   Returns the current record's "suburb" value
 * @method string   getPostcode() Returns the current record's "postcode" value
 * @method Location setSuburb()   Sets the current record's "suburb" value
 * @method Location setPostcode() Sets the current record's "postcode" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLocation extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('location');
        $this->hasColumn('suburb', 'string', 120, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 120,
             ));
        $this->hasColumn('postcode', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 20,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}