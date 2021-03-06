<?php

/**
 * BaseDocument
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $field1
 * @property string $field2
 * @property string $field3
 * @property string $field4
 * @property string $field5
 * @property string $field6
 * @property string $field7
 * @property string $field8
 * @property string $field9
 * @property string $field10
 * @property string $field11
 * @property string $field12
 * @property string $field13
 * @property string $field14
 * @property string $field15
 * @property string $field16
 * @property string $field17
 * @property string $field18
 * @property string $field19
 * @property blob $field20
 * @property timestamp $doc_date
 * @property integer $court_date_id
 * @property integer $user_file_id
 * @property integer $document_type_id
 * @property integer $document_template_id
 * @property integer $updated_by_id
 * @property CourtDate $CourtDate
 * @property UserFile $UserFile
 * @property DocumentType $DocumentType
 * @property DocumentTemplate $DocumentTemplate
 * @property sfGuardUser $User
 * @property Doctrine_Collection $Correspondence
 * @property Doctrine_Collection $DocumentDetail
 * @property Doctrine_Collection $FileAttachement
 * @property Doctrine_Collection $Invoice
 * @property Doctrine_Collection $Receipt
 * 
 * @method string              getCode()                 Returns the current record's "code" value
 * @method string              getName()                 Returns the current record's "name" value
 * @method string              getDescription()          Returns the current record's "description" value
 * @method string              getField1()               Returns the current record's "field1" value
 * @method string              getField2()               Returns the current record's "field2" value
 * @method string              getField3()               Returns the current record's "field3" value
 * @method string              getField4()               Returns the current record's "field4" value
 * @method string              getField5()               Returns the current record's "field5" value
 * @method string              getField6()               Returns the current record's "field6" value
 * @method string              getField7()               Returns the current record's "field7" value
 * @method string              getField8()               Returns the current record's "field8" value
 * @method string              getField9()               Returns the current record's "field9" value
 * @method string              getField10()              Returns the current record's "field10" value
 * @method string              getField11()              Returns the current record's "field11" value
 * @method string              getField12()              Returns the current record's "field12" value
 * @method string              getField13()              Returns the current record's "field13" value
 * @method string              getField14()              Returns the current record's "field14" value
 * @method string              getField15()              Returns the current record's "field15" value
 * @method string              getField16()              Returns the current record's "field16" value
 * @method string              getField17()              Returns the current record's "field17" value
 * @method string              getField18()              Returns the current record's "field18" value
 * @method string              getField19()              Returns the current record's "field19" value
 * @method blob                getField20()              Returns the current record's "field20" value
 * @method timestamp           getDocDate()              Returns the current record's "doc_date" value
 * @method integer             getCourtDateId()          Returns the current record's "court_date_id" value
 * @method integer             getUserFileId()           Returns the current record's "user_file_id" value
 * @method integer             getDocumentTypeId()       Returns the current record's "document_type_id" value
 * @method integer             getDocumentTemplateId()   Returns the current record's "document_template_id" value
 * @method integer             getUpdatedById()          Returns the current record's "updated_by_id" value
 * @method CourtDate           getCourtDate()            Returns the current record's "CourtDate" value
 * @method UserFile            getUserFile()             Returns the current record's "UserFile" value
 * @method DocumentType        getDocumentType()         Returns the current record's "DocumentType" value
 * @method DocumentTemplate    getDocumentTemplate()     Returns the current record's "DocumentTemplate" value
 * @method sfGuardUser         getUser()                 Returns the current record's "User" value
 * @method Doctrine_Collection getCorrespondence()       Returns the current record's "Correspondence" collection
 * @method Doctrine_Collection getDocumentDetail()       Returns the current record's "DocumentDetail" collection
 * @method Doctrine_Collection getFileAttachement()      Returns the current record's "FileAttachement" collection
 * @method Doctrine_Collection getInvoice()              Returns the current record's "Invoice" collection
 * @method Doctrine_Collection getReceipt()              Returns the current record's "Receipt" collection
 * @method Document            setCode()                 Sets the current record's "code" value
 * @method Document            setName()                 Sets the current record's "name" value
 * @method Document            setDescription()          Sets the current record's "description" value
 * @method Document            setField1()               Sets the current record's "field1" value
 * @method Document            setField2()               Sets the current record's "field2" value
 * @method Document            setField3()               Sets the current record's "field3" value
 * @method Document            setField4()               Sets the current record's "field4" value
 * @method Document            setField5()               Sets the current record's "field5" value
 * @method Document            setField6()               Sets the current record's "field6" value
 * @method Document            setField7()               Sets the current record's "field7" value
 * @method Document            setField8()               Sets the current record's "field8" value
 * @method Document            setField9()               Sets the current record's "field9" value
 * @method Document            setField10()              Sets the current record's "field10" value
 * @method Document            setField11()              Sets the current record's "field11" value
 * @method Document            setField12()              Sets the current record's "field12" value
 * @method Document            setField13()              Sets the current record's "field13" value
 * @method Document            setField14()              Sets the current record's "field14" value
 * @method Document            setField15()              Sets the current record's "field15" value
 * @method Document            setField16()              Sets the current record's "field16" value
 * @method Document            setField17()              Sets the current record's "field17" value
 * @method Document            setField18()              Sets the current record's "field18" value
 * @method Document            setField19()              Sets the current record's "field19" value
 * @method Document            setField20()              Sets the current record's "field20" value
 * @method Document            setDocDate()              Sets the current record's "doc_date" value
 * @method Document            setCourtDateId()          Sets the current record's "court_date_id" value
 * @method Document            setUserFileId()           Sets the current record's "user_file_id" value
 * @method Document            setDocumentTypeId()       Sets the current record's "document_type_id" value
 * @method Document            setDocumentTemplateId()   Sets the current record's "document_template_id" value
 * @method Document            setUpdatedById()          Sets the current record's "updated_by_id" value
 * @method Document            setCourtDate()            Sets the current record's "CourtDate" value
 * @method Document            setUserFile()             Sets the current record's "UserFile" value
 * @method Document            setDocumentType()         Sets the current record's "DocumentType" value
 * @method Document            setDocumentTemplate()     Sets the current record's "DocumentTemplate" value
 * @method Document            setUser()                 Sets the current record's "User" value
 * @method Document            setCorrespondence()       Sets the current record's "Correspondence" collection
 * @method Document            setDocumentDetail()       Sets the current record's "DocumentDetail" collection
 * @method Document            setFileAttachement()      Sets the current record's "FileAttachement" collection
 * @method Document            setInvoice()              Sets the current record's "Invoice" collection
 * @method Document            setReceipt()              Sets the current record's "Receipt" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDocument extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('document');
        $this->hasColumn('code', 'string', 60, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 60,
             ));
        $this->hasColumn('name', 'string', 120, array(
             'type' => 'string',
             'length' => 120,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field1', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field2', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field3', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field4', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field5', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field6', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field7', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field8', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field9', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field10', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field11', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field12', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field13', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field14', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field15', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field16', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('field17', 'string', 6000, array(
             'type' => 'string',
             'length' => 6000,
             ));
        $this->hasColumn('field18', 'string', 6000, array(
             'type' => 'string',
             'length' => 6000,
             ));
        $this->hasColumn('field19', 'string', 6000, array(
             'type' => 'string',
             'length' => 6000,
             ));
        $this->hasColumn('field20', 'blob', null, array(
             'type' => 'blob',
             ));
        $this->hasColumn('doc_date', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('court_date_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('user_file_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('document_type_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('document_template_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('updated_by_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('CourtDate', array(
             'local' => 'court_date_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('UserFile', array(
             'local' => 'user_file_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('DocumentType', array(
             'local' => 'document_type_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('DocumentTemplate', array(
             'local' => 'document_template_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'updated_by_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('Correspondence', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('DocumentDetail', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('FileAttachement', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('Invoice', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $this->hasMany('Receipt', array(
             'local' => 'id',
             'foreign' => 'document_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}