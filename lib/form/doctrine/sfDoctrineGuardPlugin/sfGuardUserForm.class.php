<?php

/**
 * sfGuardUser form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
    $fields_to_use = array(
        'last_name',      'first_name',       'username',           'email_address',
        'password',       'is_active',        'is_super_admin',     'agencies_list',
        'groups_list'
    );
    
    if (sfContext::getInstance()->getUser()->getGuardUser()->getId() == 1) {
      $fields_to_use[] = 'permissions_list';
    }
    
    $this->useFields($fields_to_use);
    
    // user can have only one role
    $this->widgetSchema['groups_list']->setOption('multiple', false);
    $this->widgetSchema['groups_list']->setOption('method', 'getName');
    $this->widgetSchema['groups_list']->setOption('table_method', 'getUsersCB');
    
    // user by default will be linked to one agency
    $this->widgetSchema['agencies_list']->setOption('multiple', false);
    $this->widgetSchema['agencies_list']->setOption('add_empty', true);
    
    // make these fields mandatory
    $this->validatorSchema['first_name']->setOption('required', true);
    $this->validatorSchema['last_name']->setOption('required', true);
    
    // add created_at, updated_at as plain text when object is editable
    $this->setDatesFieldAsText();

    // new validator for email field
    $this->validatorSchema['email_address'] = new sfValidatorEmail();
    $this->validatorSchema['email_address']->setOption('required', false);
    $this->widgetSchema['email_address']->setAttribute('size', 30);
     
    if ($this->isNew()) {
      $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
      $this->validatorSchema['password'] = new sfValidatorString(array('min_length' => 4, 'max_length' => 255));
    }
    else {
      $this->addPasswordChangeFields();
      
      // adding new fields for no modificable fields
      $this->widgetSchema['last_login_text'] = new sfWidgetFormInputText(array('label' => 'Last login'), $this->asText());
      $this->setDefault('last_login_text', $this->getObject()->get('last_login'));
      $this->widgetSchema->moveField('last_login_text', sfWidgetFormSchema::AFTER, 'groups_list');
    
      // new validators
      $this->validatorSchema['last_login_text'] = new sfValidatorString(array('max_length' => 255, 'required' => false)); 
    }
   
    
    // add the profile form for the user
    $user_profile = new sfGuardUserProfileForm($this->object->getUserProfiles());
    unset($user_profile['user_id']);
    
    $this->embedForm('sfGuardUserProfiles', $user_profile);         // bad formatting of fields
    //$this->embedMergeForm('SfGuardUserProfiles', $user_profile);  // optional method to mergeForm
    
    $this->widgetSchema['sfGuardUserProfiles']->setLabel('Contact Details');
    $this->validatorSchema['sfGuardUserProfiles'] = new sfValidatorPass(array('required' => false));

    // for the add/edit button widget
    if (  (sfContext::getInstance()->getModuleName() == 'prosecutor') &&
          !sfContext::getInstance()->getRequest()->getParameter('shbx') ) {
      $this->widgetSchema['agencies_list'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => 'Agency', 
        'form_module' => 'prosecution', 
        'add_empty' => true,
        ));
    }
    
    // for the add/edit button widget
    if (  (sfContext::getInstance()->getModuleName() == 'informant') &&
          !sfContext::getInstance()->getRequest()->getParameter('shbx') ) {
      $this->widgetSchema['agencies_list'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => 'Agency', 
        'form_module' => 'agency?code=POL',
        'add_empty' => true,
        ));
    }
    
    $this->mergePostValidator(
    //$this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setSpecialValues')))
    ); 
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
  
  public function setSpecialValues($validator, $values)
  {
    if (isset($values['sfGuardUserProfiles']['preferred_contact_id'])) {
      if (empty($values['sfGuardUserProfiles']['preferred_contact_id'])) {
        unset($values['sfGuardUserProfiles']['preferred_contact_id']);
      }
    }
    if (isset($values['sfGuardUserProfiles']['dob']['year'])) {
      $values['sfGuardUserProfiles']['dob'] = $values['sfGuardUserProfiles']['dob']['year'].'-'.$values['sfGuardUserProfiles']['dob']['month'].'-'.$values['sfGuardUserProfiles']['dob']['day'];
    }
    if (isset($values['sfGuardUserProfiles']['hcc_expiration_date']['year'])) {
      $values['sfGuardUserProfiles']['hcc_expiration_date'] = $values['sfGuardUserProfiles']['hcc_expiration_date']['year'].'-'.$values['sfGuardUserProfiles']['hcc_expiration_date']['month'].'-'.$values['sfGuardUserProfiles']['hcc_expiration_date']['day'];
    }
    
    // trim these values before saving
    if (isset($values['last_name']))      $values['last_name'] = trim($values['last_name']);
    if (isset($values['first_name']))     $values['first_name'] = trim($values['first_name']);
    if (isset($values['email_address']))  $values['email_address'] = trim($values['email_address']);
    
    return $values;
  }
  
  
  public function addPasswordChangeFields()
  {
    // remove the current password field
    unset ($this['password']);
    
    // setting modify password functionality, retrieve the old password is not possible, it is encrypted, it can only be compared.
    if (strtolower(sfContext::getInstance()->getActionName()) != 'show') {      
      $this->widgetSchema['new_password'] = new sfWidgetFormInputPassword();
      $this->widgetSchema['repeat_new_password'] = new sfWidgetFormInputPassword();
      $this->validatorSchema['new_password'] = new sfValidatorString(array('min_length' => 4, 'max_length' => 255, 'required' => false));
      $this->validatorSchema['repeat_new_password'] = new sfValidatorString(array('min_length' => 4, 'max_length' => 255, 'required' => false));

      $this->widgetSchema->moveField('repeat_new_password', sfWidgetFormSchema::AFTER, 'username');
      $this->widgetSchema->moveField('new_password', sfWidgetFormSchema::AFTER, 'username');

      $this->validatorSchema->setPostValidator(
        new sfValidatorCallback(array('callback' => array($this, 'setNewPassword')))
      );

      $this->mergePostValidator(new sfValidatorSchemaCompare('new_password', sfValidatorSchemaCompare::EQUAL, 'repeat_new_password', array(), array('invalid' => 'The two password must be the same.')));
    }
  }
  
  public function setNewPassword($validator, $values)
  {
    if ( ($values['new_password'] != '')&&($values['new_password'] == $values['repeat_new_password']) ) {
      $values['password'] = $values['new_password'];
    }
    return $values;
  }
  
}
