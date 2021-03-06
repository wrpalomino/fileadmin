<?php

/**
 * BaseSentBy
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $value
 * @property Doctrine_Collection $Correspondence
 * @property Doctrine_Collection $FeeAgreement
 * 
 * @method string              getValue()          Returns the current record's "value" value
 * @method Doctrine_Collection getCorrespondence() Returns the current record's "Correspondence" collection
 * @method Doctrine_Collection getFeeAgreement()   Returns the current record's "FeeAgreement" collection
 * @method SentBy              setValue()          Sets the current record's "value" value
 * @method SentBy              setCorrespondence() Sets the current record's "Correspondence" collection
 * @method SentBy              setFeeAgreement()   Sets the current record's "FeeAgreement" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseSentBy extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sent_by');
        $this->hasColumn('value', 'string', 120, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 120,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Correspondence', array(
             'local' => 'id',
             'foreign' => 'sent_by_id'));

        $this->hasMany('FeeAgreement', array(
             'local' => 'id',
             'foreign' => 'sent_by_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}