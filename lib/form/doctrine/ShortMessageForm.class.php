<?php

/**
 * ShortMessage form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShortMessageForm extends BaseShortMessageForm
{
  public function configure()
  {
    sfApplicationConfiguration::getActive()->loadHelpers(array('Url', 'Tag'));
    
    $limit_characters = array(
        'onKeyDown' => "limitText(this, 160)",
        'onKeyUp' => "limitText(this, 160)"
        );
    
    $this->widgetSchema['template'] = new sfWidgetFormDoctrineChoice(array('model' => 'ShortMessageTemplate', 'add_empty' => true));
    $this->validatorSchema['template'] = new sfValidatorDoctrineChoice(array('model' => 'ShortMessageTemplate', 'required' => false));
    $this->widgetSchema->moveField('template', sfWidgetFormSchema::BEFORE, 'message');
    $this->widgetSchema['template']->setAttribute('onchange', "loadSMSTemplate(this, '".url_for('smsTemplate/getTemplate')."')");
    
    $this->widgetSchema['message'] = new sfWidgetFormTextarea(array(), array_merge(array('cols' => 60), $limit_characters));
    
    $this->widgetSchema->setHelp('message', '<span class="help"><font>HINT:</font> Only 160 characters allowed</span>');
    
    $this->hideField(array('user_id', 'user_file_id'));   // hide and display text field (true)
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'sendSMS')))
    );
  }
  
  public function sendSMS($validator, $values)
  {
    if (!$this->getObject()->sendSMS($values)) {
      throw new sfValidatorError($validator, 'SMS could not be sent. <b>ERROR:</b> '.$this->getObject()->getSendMessageStatus());
    }
    else {
      sfContext::getInstance()->getUser()->setFlash('notice', $this->getObject()->getSendMessageStatus(), false);
    }
    
    return $values;
  }
  
}
