<?php

/**
 * BaseReceipt
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $number
 * @property decimal $amount_paid
 * @property string $full_part
 * @property date $date
 * @property date $for_what_date
 * @property integer $status_id
 * @property integer $fee_id
 * @property integer $court_date_id
 * @property integer $received_by_id
 * @property integer $document_id
 * @property Status $Status
 * @property Fee $Fee
 * @property CourtDate $CourtDate
 * @property sfGuardUser $ReceivedBy
 * @property Document $Document
 * 
 * @method string      getNumber()         Returns the current record's "number" value
 * @method decimal     getAmountPaid()     Returns the current record's "amount_paid" value
 * @method string      getFullPart()       Returns the current record's "full_part" value
 * @method date        getDate()           Returns the current record's "date" value
 * @method date        getForWhatDate()    Returns the current record's "for_what_date" value
 * @method integer     getStatusId()       Returns the current record's "status_id" value
 * @method integer     getFeeId()          Returns the current record's "fee_id" value
 * @method integer     getCourtDateId()    Returns the current record's "court_date_id" value
 * @method integer     getReceivedById()   Returns the current record's "received_by_id" value
 * @method integer     getDocumentId()     Returns the current record's "document_id" value
 * @method Status      getStatus()         Returns the current record's "Status" value
 * @method Fee         getFee()            Returns the current record's "Fee" value
 * @method CourtDate   getCourtDate()      Returns the current record's "CourtDate" value
 * @method sfGuardUser getReceivedBy()     Returns the current record's "ReceivedBy" value
 * @method Document    getDocument()       Returns the current record's "Document" value
 * @method Receipt     setNumber()         Sets the current record's "number" value
 * @method Receipt     setAmountPaid()     Sets the current record's "amount_paid" value
 * @method Receipt     setFullPart()       Sets the current record's "full_part" value
 * @method Receipt     setDate()           Sets the current record's "date" value
 * @method Receipt     setForWhatDate()    Sets the current record's "for_what_date" value
 * @method Receipt     setStatusId()       Sets the current record's "status_id" value
 * @method Receipt     setFeeId()          Sets the current record's "fee_id" value
 * @method Receipt     setCourtDateId()    Sets the current record's "court_date_id" value
 * @method Receipt     setReceivedById()   Sets the current record's "received_by_id" value
 * @method Receipt     setDocumentId()     Sets the current record's "document_id" value
 * @method Receipt     setStatus()         Sets the current record's "Status" value
 * @method Receipt     setFee()            Sets the current record's "Fee" value
 * @method Receipt     setCourtDate()      Sets the current record's "CourtDate" value
 * @method Receipt     setReceivedBy()     Sets the current record's "ReceivedBy" value
 * @method Receipt     setDocument()       Sets the current record's "Document" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseReceipt extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('receipt');
        $this->hasColumn('number', 'string', 60, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 60,
             ));
        $this->hasColumn('amount_paid', 'decimal', 10, array(
             'type' => 'decimal',
             'length' => 10,
             'scale' => 2,
             'notnull' => true,
             ));
        $this->hasColumn('full_part', 'string', 20, array(
             'type' => 'string',
             'length' => 20,
             ));
        $this->hasColumn('date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('for_what_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('status_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('fee_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('court_date_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('received_by_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('document_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Status', array(
             'local' => 'status_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Fee', array(
             'local' => 'fee_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('CourtDate', array(
             'local' => 'court_date_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('sfGuardUser as ReceivedBy', array(
             'local' => 'received_by_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Document', array(
             'local' => 'document_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}