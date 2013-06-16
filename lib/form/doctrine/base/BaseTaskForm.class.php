<?php

/**
 * Task form base class.
 *
 * @method Task getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTaskForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'task_by_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TaskBy'), 'add_empty' => false)),
      'task_by2_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TaskBy2'), 'add_empty' => true)),
      'task_for_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TaskFor'), 'add_empty' => true)),
      'due_date'     => new sfWidgetFormDate(),
      'description'  => new sfWidgetFormTextarea(),
      'done'         => new sfWidgetFormInputCheckbox(),
      'user_file_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'user_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => false)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'task_by_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TaskBy'))),
      'task_by2_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TaskBy2'), 'required' => false)),
      'task_for_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TaskFor'), 'required' => false)),
      'due_date'     => new sfValidatorDate(),
      'description'  => new sfValidatorString(array('max_length' => 3000, 'required' => false)),
      'done'         => new sfValidatorBoolean(array('required' => false)),
      'user_file_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'required' => false)),
      'user_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'))),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('task[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Task';
  }

}
