<?php

/**
 * BaseFileAttachement
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $description
 * @property string $document_file
 * @property integer $user_file_id
 * @property integer $document_id
 * @property integer $document_type_id
 * @property integer $correspondence_id
 * @property integer $updated_by_id
 * @property UserFile $UserFile
 * @property Document $Document
 * @property DocumentType $DocumentType
 * @property Correspondence $Correspondence
 * @property sfGuardUser $User
 * 
 * @method string          getName()              Returns the current record's "name" value
 * @method string          getDescription()       Returns the current record's "description" value
 * @method string          getDocumentFile()      Returns the current record's "document_file" value
 * @method integer         getUserFileId()        Returns the current record's "user_file_id" value
 * @method integer         getDocumentId()        Returns the current record's "document_id" value
 * @method integer         getDocumentTypeId()    Returns the current record's "document_type_id" value
 * @method integer         getCorrespondenceId()  Returns the current record's "correspondence_id" value
 * @method integer         getUpdatedById()       Returns the current record's "updated_by_id" value
 * @method UserFile        getUserFile()          Returns the current record's "UserFile" value
 * @method Document        getDocument()          Returns the current record's "Document" value
 * @method DocumentType    getDocumentType()      Returns the current record's "DocumentType" value
 * @method Correspondence  getCorrespondence()    Returns the current record's "Correspondence" value
 * @method sfGuardUser     getUser()              Returns the current record's "User" value
 * @method FileAttachement setName()              Sets the current record's "name" value
 * @method FileAttachement setDescription()       Sets the current record's "description" value
 * @method FileAttachement setDocumentFile()      Sets the current record's "document_file" value
 * @method FileAttachement setUserFileId()        Sets the current record's "user_file_id" value
 * @method FileAttachement setDocumentId()        Sets the current record's "document_id" value
 * @method FileAttachement setDocumentTypeId()    Sets the current record's "document_type_id" value
 * @method FileAttachement setCorrespondenceId()  Sets the current record's "correspondence_id" value
 * @method FileAttachement setUpdatedById()       Sets the current record's "updated_by_id" value
 * @method FileAttachement setUserFile()          Sets the current record's "UserFile" value
 * @method FileAttachement setDocument()          Sets the current record's "Document" value
 * @method FileAttachement setDocumentType()      Sets the current record's "DocumentType" value
 * @method FileAttachement setCorrespondence()    Sets the current record's "Correspondence" value
 * @method FileAttachement setUser()              Sets the current record's "User" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFileAttachement extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('file_attachement');
        $this->hasColumn('name', 'string', 120, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 120,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('document_file', 'string', 120, array(
             'type' => 'string',
             'length' => 120,
             ));
        $this->hasColumn('user_file_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('document_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('document_type_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('correspondence_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('updated_by_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('UserFile', array(
             'local' => 'user_file_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Document', array(
             'local' => 'document_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('DocumentType', array(
             'local' => 'document_type_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('Correspondence', array(
             'local' => 'correspondence_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('sfGuardUser as User', array(
             'local' => 'updated_by_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}