<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class BarristerForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    
    // add an extra field to check user willingness to link object to the file
    $this->addLinkToFileField();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        /*'home_phone',*/       'work_phone',     'mobile',     'other_phone',     
        'fax', 'related_user_id'
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    $this->useFields(array('username', 'last_name', 'first_name', 'email_address', 'sfGuardUserProfiles', 'groups_list'));
    //$this->widgetSchema['last_name']->setLabel('Barrister');
    
    // set the dafault values for username and group for this type of user
    $this->setUserDefaultValues('barrister');
    
    // hide this field, necessary to save the data but annoying for the final user
    $this->hideField('groups_list');
   
    // modified by William, 14/03/2013: clerk will be pick up from a list, no entered
    /*$rUserForm = new ClerkForm($this->object->RelatedUserProfiles[0]->getUser());
    $this->embedForm('Clerk', $rUserForm);
    
    // validate only if there is values in the embedded form
    $this->validatorSchema['Clerk'] = new sfValidatorPass(array('required' => false));
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setSpecialValues')))
    );*/
    
    $this->widgetSchema['sfGuardUserProfiles']['related_user_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => 'sfGuardUser', 
        'form_module' => 'clerk', 
        'add_empty' => true,
        'method' => 'obtainFullName',
        'table_method' => 'getClerksCB'
        ));
    $this->widgetSchema['sfGuardUserProfiles']['related_user_id']->setLabel('Clerk');
  }
  
  
  // added by William, 01/05/2013: to link the user to a file after saving
  public function doSave($con = null)
  {
    parent::doSave($con);
    
    if ( $this->isNew() && isset($this->widgetSchema['link_to_file']) && ($this->getValue('link_to_file')>0) ) {
      $user_file = Doctrine::getTable('UserFile')->find($this->getValue('link_to_file'));
      if ($user_file) {
        $user_file->setBarristerId($this->getObject()->getId());
        $user_file->save($con);
      }
    }
  }
  
  
  // modified by William, 14/03/2013: clerk will be pick up from a list, no entered
  /*protected function doSave($con = null)
  {
    if (null === $con) {
      $con = $this->getConnection();
    }

    $forms = $this->embeddedForms;
    if (is_null($this->getValue('Clerk'))) {
      unset($forms['Clerk']);                         // avoid to save embedded form's object
      unset($this->object->RelatedUserProfiles[0]);   // let the emdedded user to handle his profile
    }
    else { // this is a special case because there sub embedded forms      
      if ($this->object->RelatedUserProfiles[0]->getUser()->getId() == '') { // let the emdedded user to handle his profile
        unset($this->object->RelatedUserProfiles[0]);   // let the emdedded user to handle his profile
      }
      else { // let the main object to handle his child object's profile
        unset($forms['Clerk']);
      }
    }
    
    $this->updateObject();
    $this->getObject()->save($con);

    // embedded forms
    $this->saveEmbeddedForms($con, $forms);
    
    // fix some problems with related tables
    if (!is_null($this->getValue('Clerk'))) {  // we are editing an existing object
      $clerk = $this->getEmbeddedForm('Clerk')->getObject();  
      $values_arr = $this->getValue('Clerk');
      
      // update agency related_user_id    
      Doctrine_Query::create()
      ->update('SfGuardUserProfile up')
      ->set('up.related_user_id=?',$this->getObject()->getId())
      ->where('up.id=?', $clerk->getUserProfiles()->getId())
      ->execute();
      
      // save user group
      $group = new sfGuardUserGroup();
      $group->setUserId($clerk->getId());
      $group->setGroupId($values_arr['groups_list']);
      $ug = Doctrine::getTable('SfGuardUserGroup')->findBySql('user_id = ? AND group_id = ?', array($clerk->getId(), $values_arr['groups_list']));
      if (count($ug) == 0) {
        $group->save();
      }
    }
    
    // save user group for main object if needed
    $groups_list = $this->getValue('groups_list');
    $group2 = new sfGuardUserGroup();
    $group2->setUserId($this->getObject()->getId());
    $group2->setGroupId($groups_list[0]);
    $ug2 = Doctrine::getTable('SfGuardUserGroup')->findBySql('user_id = ? AND group_id = ?', array($this->getObject()->getId(), $groups_list[0]));
    if (count($ug2) == 0) {
      $group2->save();
    }
  }
  
  
  public function setSpecialValues($validator, $values)
  {
    $verify_required_fields = false;
    foreach ($values['Clerk'] as $k => $value) {
      if ($k == 'sfGuardUserProfiles') {
        foreach ($values['Clerk'][$k] as $k1 => $value1) {
          if ( !($this->widgetSchema['Clerk'][$k][$k1] instanceof sfWidgetFormInputHidden) && ($value1 != NULL) ) {
            $verify_required_fields = true;
            break;
          }
        }
      }
      else if ( !($this->widgetSchema['Clerk'][$k] instanceof sfWidgetFormInputHidden) && ($value != NULL) && ($k != 'groups_list') ) {    
        $verify_required_fields = true;
      }
      
      if ($verify_required_fields) break;
    }
    
    if ($verify_required_fields) {
      foreach ($values['Clerk'] as $k => $value) {
        if ( $this->getEmbeddedForm('Clerk')->validatorSchema[$k]->getOption('required') && ($value == NULL) ) {
          throw new sfValidatorError($validator, 'To save Clerk the required information must be filled!');
        }
      }
    }
    else { // all input fields in the embedded form are empty then unset the array values
      foreach($values['Clerk'] as $k => $v)  unset($values['Clerk'][$k]);
      unset($values['Clerk']);
    }
    
    return $values;
  }*/
  
}

?>