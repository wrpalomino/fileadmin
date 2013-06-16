<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ProsecutionForm extends AgencyForm
{
  public function configure()
  { 
    $this->useFields(array(
        'subgroup_id',      'name',         'phone',                
        'fax',              'email',        'sf_guard_group_id',
        'street',           'suburb',       'postcode',           'state'
    ));
    $this->widgetSchema['name']->setLabel('Office');
    $this->widgetSchema['subgroup_id']->setLabel('Prosecution');
    
    $this->widgetSchema['state'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine_Core::getTable('sfGuardUserProfile')->getStates(),
      'expanded' => false,
    ));
    
    // set methods to filter data to display
    $this->widgetSchema['subgroup_id']->setoption('table_method', 'getProsecutionSubGroupsCB');
    $this->widgetSchema['subgroup_id']->setOption('add_empty', false);
    
    // set agency group values
    $this->loadValues(array('agency_code' => 'PRS'));
    
    // hide this field, necessary to save the data but annoying for the final user
    $this->hideField('sf_guard_group_id');
    
    //$prosecutor = new ProsecutorForm($this->getObject()->getOfficer());
    //$this->embedForm('Officer', $prosecutor);
    
    // validate only if there is values in the embedded form
    //$this->validatorSchema['Officer'] = new sfValidatorPass(array('required' => false));
    
    //$this->validatorSchema->setPostValidator(
      //new sfValidatorCallback(array('callback' => array($this, 'setSpecialValues')))
    //);
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
  
  /*protected function doSave($con = null)
  {
    if (null === $con) {
      $con = $this->getConnection();
    }

    $forms = $this->embeddedForms;
    if (is_null($this->getValue('Officer'))) {
      unset($forms['Officer']);               // avoid to save embedded form's object
      $this->getObject()->setOfficer(null);   // avoid to save related object with main object
    }
    
    $this->updateObject();
    $this->getObject()->save($con);

    // embedded forms
    $this->saveEmbeddedForms($con, $forms);
    
    // fix some problems with related tables
    if (!is_null($this->getValue('Officer'))) {  // we are editing an existing object
      $prosecutor = $this->getEmbeddedForm('Officer')->getObject();  
      $values_arr = $this->getValue('Officer');
      
      // update agency officer_id    
      Doctrine_Query::create()
      ->update('Agency a')
      ->set('a.officer_id=?',$prosecutor->getId())
      ->where('a.id=?', $this->getObject()->getId())
      ->execute();
      
      // save user group
      $group = new sfGuardUserGroup();
      $group->setUserId($prosecutor->getId());
      $group->setGroupId($values_arr['groups_list']);
      $ug = Doctrine::getTable('SfGuardUserGroup')->findBySql('user_id = ? AND group_id = ?', array($prosecutor->getId(), $values_arr['groups_list']));
      if (count($ug) == 0) {
        $group->save();
      }
    }
    
  }
  
  
  public function setSpecialValues($validator, $values)
  {
    $verify_required_fields = false;
    foreach ($values['Officer'] as $k => $value) {
      if ($k == 'sfGuardUserProfiles') {
        foreach ($values['Officer'][$k] as $k1 => $value1) {
          if ( !($this->widgetSchema['Officer'][$k][$k1] instanceof sfWidgetFormInputHidden) && ($value1 != NULL) ) {
            $verify_required_fields = true;
            break;
          }
        }
      }
      else if ( !($this->widgetSchema['Officer'][$k] instanceof sfWidgetFormInputHidden) && ($value != NULL) && ($k != 'groups_list') ) {    
        $verify_required_fields = true;
      }
      
      if ($verify_required_fields) break;
    }
    
    if ($verify_required_fields) {
      foreach ($values['Officer'] as $k => $value) {
        if ( $this->getEmbeddedForm('Officer')->validatorSchema[$k]->getOption('required') && ($value == NULL) ) {
          throw new sfValidatorError($validator, 'To save Officer the required information must be filled!');
        }
      }
    }
    else { // all input fields in the embedded form are empty then unset the array values
      foreach($values['Officer'] as $k => $v)  unset($values['Officer'][$k]);
      unset($values['Officer']);
    } 
    return $values;
  }*/
  
}

?>