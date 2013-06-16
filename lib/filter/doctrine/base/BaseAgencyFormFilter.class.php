<?php

/**
 * Agency filter form base class.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAgencyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'reference_number'  => new sfWidgetFormFilterInput(),
      'street'            => new sfWidgetFormFilterInput(),
      'suburb'            => new sfWidgetFormFilterInput(),
      'postcode'          => new sfWidgetFormFilterInput(),
      'city'              => new sfWidgetFormFilterInput(),
      'state'             => new sfWidgetFormFilterInput(),
      'phone'             => new sfWidgetFormFilterInput(),
      'general_phone'     => new sfWidgetFormFilterInput(),
      'fax'               => new sfWidgetFormFilterInput(),
      'general_fax'       => new sfWidgetFormFilterInput(),
      'email'             => new sfWidgetFormFilterInput(),
      'website'           => new sfWidgetFormFilterInput(),
      'logo_file'         => new sfWidgetFormFilterInput(),
      'sf_guard_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Group'), 'add_empty' => true)),
      'subgroup_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Subgroup'), 'add_empty' => true)),
      'status_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'users_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'reference_number'  => new sfValidatorPass(array('required' => false)),
      'street'            => new sfValidatorPass(array('required' => false)),
      'suburb'            => new sfValidatorPass(array('required' => false)),
      'postcode'          => new sfValidatorPass(array('required' => false)),
      'city'              => new sfValidatorPass(array('required' => false)),
      'state'             => new sfValidatorPass(array('required' => false)),
      'phone'             => new sfValidatorPass(array('required' => false)),
      'general_phone'     => new sfValidatorPass(array('required' => false)),
      'fax'               => new sfValidatorPass(array('required' => false)),
      'general_fax'       => new sfValidatorPass(array('required' => false)),
      'email'             => new sfValidatorPass(array('required' => false)),
      'website'           => new sfValidatorPass(array('required' => false)),
      'logo_file'         => new sfValidatorPass(array('required' => false)),
      'sf_guard_group_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Group'), 'column' => 'id')),
      'subgroup_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Subgroup'), 'column' => 'id')),
      'status_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Status'), 'column' => 'id')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'users_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('agency_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addUsersListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfGuardUserAgency sfGuardUserAgency')
      ->andWhereIn('sfGuardUserAgency.user_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Agency';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'reference_number'  => 'Text',
      'street'            => 'Text',
      'suburb'            => 'Text',
      'postcode'          => 'Text',
      'city'              => 'Text',
      'state'             => 'Text',
      'phone'             => 'Text',
      'general_phone'     => 'Text',
      'fax'               => 'Text',
      'general_fax'       => 'Text',
      'email'             => 'Text',
      'website'           => 'Text',
      'logo_file'         => 'Text',
      'sf_guard_group_id' => 'ForeignKey',
      'subgroup_id'       => 'ForeignKey',
      'status_id'         => 'ForeignKey',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'users_list'        => 'ManyKey',
    );
  }
}
