<?php

/**
 * LegalAid form base class.
 *
 * @method LegalAid getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLegalAidForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'reference_number'     => new sfWidgetFormInputText(),
      'date_sent_given'      => new sfWidgetFormDate(),
      'date_aided_for'       => new sfWidgetFormDate(),
      'last_date_invoiced'   => new sfWidgetFormDate(),
      'user_file_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => false)),
      'office_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Office'), 'add_empty' => true)),
      'assigment_officer_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AssignmentOfficer'), 'add_empty' => true)),
      'vla_app_status_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('VlaStatus'), 'add_empty' => true)),
      'aid_status_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AidStatus'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reference_number'     => new sfValidatorString(array('max_length' => 120)),
      'date_sent_given'      => new sfValidatorDate(array('required' => false)),
      'date_aided_for'       => new sfValidatorDate(array('required' => false)),
      'last_date_invoiced'   => new sfValidatorDate(array('required' => false)),
      'user_file_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'))),
      'office_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Office'), 'required' => false)),
      'assigment_officer_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AssignmentOfficer'), 'required' => false)),
      'vla_app_status_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('VlaStatus'), 'required' => false)),
      'aid_status_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AidStatus'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('legal_aid[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LegalAid';
  }

}
