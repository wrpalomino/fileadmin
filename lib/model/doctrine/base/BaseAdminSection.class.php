<?php

/**
 * BaseAdminSection
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $code
 * @property string $name
 * @property boolean $is_active
 * @property integer $parent_id
 * @property AdminSection $ParentSection
 * @property Doctrine_Collection $AdminContent
 * @property Doctrine_Collection $AdminSection
 * @property Doctrine_Collection $DocumentTemplate
 * @property Doctrine_Collection $DocumentType
 * 
 * @method string              getCode()             Returns the current record's "code" value
 * @method string              getName()             Returns the current record's "name" value
 * @method boolean             getIsActive()         Returns the current record's "is_active" value
 * @method integer             getParentId()         Returns the current record's "parent_id" value
 * @method AdminSection        getParentSection()    Returns the current record's "ParentSection" value
 * @method Doctrine_Collection getAdminContent()     Returns the current record's "AdminContent" collection
 * @method Doctrine_Collection getAdminSection()     Returns the current record's "AdminSection" collection
 * @method Doctrine_Collection getDocumentTemplate() Returns the current record's "DocumentTemplate" collection
 * @method Doctrine_Collection getDocumentType()     Returns the current record's "DocumentType" collection
 * @method AdminSection        setCode()             Sets the current record's "code" value
 * @method AdminSection        setName()             Sets the current record's "name" value
 * @method AdminSection        setIsActive()         Sets the current record's "is_active" value
 * @method AdminSection        setParentId()         Sets the current record's "parent_id" value
 * @method AdminSection        setParentSection()    Sets the current record's "ParentSection" value
 * @method AdminSection        setAdminContent()     Sets the current record's "AdminContent" collection
 * @method AdminSection        setAdminSection()     Sets the current record's "AdminSection" collection
 * @method AdminSection        setDocumentTemplate() Sets the current record's "DocumentTemplate" collection
 * @method AdminSection        setDocumentType()     Sets the current record's "DocumentType" collection
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAdminSection extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('admin_section');
        $this->hasColumn('code', 'string', 120, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 120,
             ));
        $this->hasColumn('name', 'string', 120, array(
             'type' => 'string',
             'length' => 120,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('parent_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AdminSection as ParentSection', array(
             'local' => 'parent_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('AdminContent', array(
             'local' => 'id',
             'foreign' => 'admin_section_id'));

        $this->hasMany('AdminSection', array(
             'local' => 'id',
             'foreign' => 'parent_id'));

        $this->hasMany('DocumentTemplate', array(
             'local' => 'id',
             'foreign' => 'admin_section_id'));

        $this->hasMany('DocumentType', array(
             'local' => 'id',
             'foreign' => 'admin_section_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}