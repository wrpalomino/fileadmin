<?php

/**
 * Correspondence form base class.
 *
 * @method Correspondence getObject() Returns the current form's model object
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCorrespondenceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'subject'                => new sfWidgetFormInputText(),
      'receiver_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Receiver'), 'add_empty' => true)),
      'receiver_name'          => new sfWidgetFormInputText(),
      'receiver_address'       => new sfWidgetFormInputText(),
      'cc_addresses_list'      => new sfWidgetFormTextarea(),
      'notes'                  => new sfWidgetFormTextarea(),
      'sender_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sender'), 'add_empty' => false)),
      'backsheet_printed_date' => new sfWidgetFormDateTime(),
      'delivered_date'         => new sfWidgetFormDate(),
      'returned_date'          => new sfWidgetFormDate(),
      'ctype'                  => new sfWidgetFormInputText(),
      'user_file_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'add_empty' => true)),
      'court_date_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'add_empty' => true)),
      'receiver_group_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardGroup'), 'add_empty' => true)),
      'sent_by_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SentBy'), 'add_empty' => true)),
      'document_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'add_empty' => true)),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'subject'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'receiver_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Receiver'), 'required' => false)),
      'receiver_name'          => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'receiver_address'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'cc_addresses_list'      => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'notes'                  => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'sender_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sender'))),
      'backsheet_printed_date' => new sfValidatorDateTime(array('required' => false)),
      'delivered_date'         => new sfValidatorDate(array('required' => false)),
      'returned_date'          => new sfValidatorDate(array('required' => false)),
      'ctype'                  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'user_file_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserFile'), 'required' => false)),
      'court_date_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CourtDate'), 'required' => false)),
      'receiver_group_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardGroup'), 'required' => false)),
      'sent_by_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SentBy'), 'required' => false)),
      'document_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Document'), 'required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('correspondence[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Correspondence';
  }

}
