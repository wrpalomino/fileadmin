<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class JudgeForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array('work_phone', 'fax'));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
       
    $this->useFields(array('username', 'groups_list', 'last_name', /*'first_name', 'email_address', sfGuardUserProfiles'*/));
    
    $this->widgetSchema['last_name']->setLabel("Last Name&nbsp;*");
    //$this->widgetSchema['first_name']->setLabel("Judge's First Name&nbsp;*");
       
    // set the dafault values for username and group for this type of user
    $this->setUserDefaultValues('judgeMagistrate');
    
    // hide this field, necessary to save the data but annoying for the final user
    //$this->hideField('groups_list');
    
    $rUserForm = new AssociateForm($this->object->RelatedUserProfiles[0]->getUser());
    
    $this->embedForm('Associate', $rUserForm);
    
    // validate only if there is values in the embedded form
    $this->validatorSchema['Associate'] = new sfValidatorPass(array('required' => false));
    
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setSpecialValues')))
    );
  }
  
  
  protected function doSave($con = null)
  {
    if (null === $con) {
      $con = $this->getConnection();
    }

    $forms = $this->embeddedForms;
    if (is_null($this->getValue('Associate'))) {
      unset($forms['Associate']);                         // avoid to save embedded form's object
      unset($this->object->RelatedUserProfiles[0]);   // let the emdedded user to handle his profile
    }
    else { // this is a special case because there sub embedded forms      
      if ($this->object->RelatedUserProfiles[0]->getUser()->getId() == '') { // let the emdedded user to handle his profile
        unset($this->object->RelatedUserProfiles[0]);   // let the emdedded user to handle his profile
      }
      else { // let the main object to handle his child object's profile
        unset($forms['Associate']);
      }
    }
    
    $this->updateObject();
    $this->getObject()->save($con);

    // embedded forms
    $this->saveEmbeddedForms($con, $forms);
    
    // fix some problems with related tables
    if (!is_null($this->getValue('Associate'))) {  // we are editing an existing object
      $associate = $this->getEmbeddedForm('Associate')->getObject();  
      $values_arr = $this->getValue('Associate');
      
      // update agency related_user_id    
      Doctrine_Query::create()
      ->update('SfGuardUserProfile up')
      ->set('up.related_user_id=?',$this->getObject()->getId())
      ->where('up.id=?', $associate->getUserProfiles()->getId())
      ->execute();
      
      // save user group
      $group = new sfGuardUserGroup();
      $group->setUserId($associate->getId());
      $group->setGroupId($values_arr['groups_list']);
      $ug = Doctrine::getTable('SfGuardUserGroup')->findBySql('user_id = ? AND group_id = ?', array($associate->getId(), $values_arr['groups_list']));
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
    foreach ($values['Associate'] as $k => $value) {
      if ($k == 'sfGuardUserProfiles') {
        foreach ($values['Associate'][$k] as $k1 => $value1) {
          if ( !($this->widgetSchema['Associate'][$k][$k1] instanceof sfWidgetFormInputHidden) && ($value1 != NULL) ) {
            $verify_required_fields = true;
            break;
          }
        }
      }
      else if ( !($this->widgetSchema['Associate'][$k] instanceof sfWidgetFormInputHidden) && ($value != NULL) && ($k != 'groups_list') ) {    
        $verify_required_fields = true;
      }
      
      if ($verify_required_fields) break;
    }
    
    if ($verify_required_fields) {
      foreach ($values['Associate'] as $k => $value) {
        if ( $this->getEmbeddedForm('Associate')->validatorSchema[$k]->getOption('required') && ($value == NULL) ) {
          throw new sfValidatorError($validator, 'To save Associate the required information must be filled!');
        }
      }
    }
    else { // all input fields in the embedded form are empty then unset the array values
      foreach($values['Associate'] as $k => $v)  unset($values['Associate'][$k]);
      unset($values['Associate']);
    }
    
    return $values;
  }
  
}
?>