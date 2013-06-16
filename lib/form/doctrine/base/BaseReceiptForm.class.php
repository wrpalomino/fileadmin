<?php

/**
 * Receipt form base class.
 *
 * @method Receipt getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReceiptForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'number'         => new sfWidgetFormInputText(),
      'amount_paid'    => new sfWidgetFormInputText(),
      'full_part'      => new sfWidgetFormInputText(),
      'date'           => new sfWidgetFormDate(),
      'for_what_date'  => new sfWidgetFormDate(),
      'status_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'add_empty' => true)),
      'fee_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'), 'add_empty' => true)),
      'court_date_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'received_by_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ReceivedBy'), 'add_empty' => true)),
      'document_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'number'         => new sfValidatorString(array('max_length' => 60)),
      'amount_paid'    => new sfValidatorNumber(),
      'full_part'      => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'date'           => new sfValidatorDate(),
      'for_what_date'  => new sfValidatorDate(array('required' => false)),
      'status_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Status'), 'required' => false)),
      'fee_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'), 'required' => false)),
      'court_date_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'required' => false)),
      'received_by_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ReceivedBy'), 'required' => false)),
      'document_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Receipt', 'column' => array('number')))
    );

    $this->widgetSchema->setNameFormat('receipt[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Receipt';
  }

}
