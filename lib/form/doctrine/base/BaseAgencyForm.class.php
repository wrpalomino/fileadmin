<?php

/**
 * Agency form base class.
 *
 * @method Agency getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAgencyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormInputText(),
      'reference_number'  => new sfWidgetFormInputText(),
      'street'            => new sfWidgetFormInputText(),
      'suburb'            => new sfWidgetFormInputText(),
      'postcode'          => new sfWidgetFormInputText(),
      'city'              => new sfWidgetFormInputText(),
      'state'             => new sfWidgetFormInputText(),
      'phone'             => new sfWidgetFormInputText(),
      'general_phone'     => new sfWidgetFormInputText(),
      'fax'               => new sfWidgetFormInputText(),
      'general_fax'       => new sfWidgetFormInputText(),
      'email'             => new sfWidgetFormInputText(),
      'website'           => new sfWidgetFormInputText(),
      'logo_file'         => new sfWidgetFormInputText(),
      'sf_guard_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Group'), 'add_empty' => true)),
      'subgroup_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Subgroup'), 'add_empty' => true)),
      'status_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'users_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 120)),
      'reference_number'  => new sfValidatorString(array('max_length' => 60, 'required' => false)),
      'street'            => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'suburb'            => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'postcode'          => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'city'              => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'state'             => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'phone'             => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'general_phone'     => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'fax'               => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'general_fax'       => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'email'             => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'website'           => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'logo_file'         => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'sf_guard_group_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Group'), 'required' => false)),
      'subgroup_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Subgroup'), 'required' => false)),
      'status_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'users_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('agency[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Agency';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['users_list']))
    {
      $this->setDefault('users_list', $this->object->Users->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveUsersList($con);

    parent::doSave($con);
  }

  public function saveUsersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['users_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Users->getPrimaryKeys();
    $values = $this->getValue('users_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Users', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Users', array_values($link));
    }
  }

}
