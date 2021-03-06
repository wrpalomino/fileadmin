<?php

/**
 * BaseTask
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $task_by_id
 * @property integer $task_by2_id
 * @property integer $task_for_id
 * @property date $due_date
 * @property string $description
 * @property boolean $done
 * @property integer $user_file_id
 * @property integer $user_id
 * @property sfGuardUser $User
 * @property UserFile $UserFile
 * @property sfGuardUser $TaskBy
 * @property sfGuardUser $TaskBy2
 * @property sfGuardUser $TaskFor
 * 
 * @method integer     getTaskById()     Returns the current record's "task_by_id" value
 * @method integer     getTaskBy2Id()    Returns the current record's "task_by2_id" value
 * @method integer     getTaskForId()    Returns the current record's "task_for_id" value
 * @method date        getDueDate()      Returns the current record's "due_date" value
 * @method string      getDescription()  Returns the current record's "description" value
 * @method boolean     getDone()         Returns the current record's "done" value
 * @method integer     getUserFileId()   Returns the current record's "user_file_id" value
 * @method integer     getUserId()       Returns the current record's "user_id" value
 * @method sfGuardUser getUser()         Returns the current record's "User" value
 * @method UserFile    getUserFile()     Returns the current record's "UserFile" value
 * @method sfGuardUser getTaskBy()       Returns the current record's "TaskBy" value
 * @method sfGuardUser getTaskBy2()      Returns the current record's "TaskBy2" value
 * @method sfGuardUser getTaskFor()      Returns the current record's "TaskFor" value
 * @method Task        setTaskById()     Sets the current record's "task_by_id" value
 * @method Task        setTaskBy2Id()    Sets the current record's "task_by2_id" value
 * @method Task        setTaskForId()    Sets the current record's "task_for_id" value
 * @method Task        setDueDate()      Sets the current record's "due_date" value
 * @method Task        setDescription()  Sets the current record's "description" value
 * @method Task        setDone()         Sets the current record's "done" value
 * @method Task        setUserFileId()   Sets the current record's "user_file_id" value
 * @method Task        setUserId()       Sets the current record's "user_id" value
 * @method Task        setUser()         Sets the current record's "User" value
 * @method Task        setUserFile()     Sets the current record's "UserFile" value
 * @method Task        setTaskBy()       Sets the current record's "TaskBy" value
 * @method Task        setTaskBy2()      Sets the current record's "TaskBy2" value
 * @method Task        setTaskFor()      Sets the current record's "TaskFor" value
 * 
 * @package    PhpProject1
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseTask extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('task');
        $this->hasColumn('task_by_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('task_by2_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('task_for_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('due_date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('description', 'string', 3000, array(
             'type' => 'string',
             'length' => 3000,
             ));
        $this->hasColumn('done', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('user_file_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('UserFile', array(
             'local' => 'user_file_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('sfGuardUser as TaskBy', array(
             'local' => 'task_by_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardUser as TaskBy2', array(
             'local' => 'task_by2_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('sfGuardUser as TaskFor', array(
             'local' => 'task_for_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}