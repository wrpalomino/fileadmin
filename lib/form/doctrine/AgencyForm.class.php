<?php

/**
 * Agency form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AgencyForm extends BaseAgencyForm
{
  public function configure()
  {
    $this->useFields(array(
        'name',             'phone',        'reference_number',   'fax',      
        /*'officer_id',*/   'email',        'sf_guard_group_id',  'subgroup_id',
        'street',           'suburb',       'postcode',           'state',
        'users_list'
    ));
    $this->widgetSchema['name']->setAttribute('size', '50');
 
    $code = $this->loadValues();
    
    // special form for Court
    if ($code != 'COU') {
      unset($this['users_list'], $this['subgroup_id']);
      
      $this->widgetSchema['state'] = new sfWidgetFormChoice(array(
        'choices'  => Doctrine_Core::getTable('sfGuardUserProfile')->getStates(),
        'expanded' => false,
      ));
    }
    else {
      $this->widgetSchema['subgroup_id']->setOption('table_method', 'getCourtSubGroupsCB');
      
      $this->validatorSchema->setOption('allow_extra_fields', true);

      // separate the users who have access by type
      $this->separateUserByGroup();
      
      $this->validatorSchema->setPostValidator(
        new sfValidatorCallback(array('callback' => array($this, 'setCustomValues')))
      ); 
      
      // hide this field, necessary to save the data but annoying for the final user
      $this->hideField('sf_guard_group_id');
    }
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
  
  public function loadValues($default_values=array())
  {
    // set the agency group
    if (isset($default_values['agency_code'])) {
      $code = $default_values['agency_code'];
    }
    else {
      // get the agency group
      $code = isset($_GET['code']) ? $_GET['code'] : '';
      if ($code != '') sfContext::getInstance()->getUser()->setAttribute('agency_code', $code);
      else $code = sfContext::getInstance()->getUser()->getAttribute('agency_code', 'CLD');
    }
    
    $this->widgetSchema['sf_guard_group_id']->addOption('table_method', 'get'.$code.'GroupId');
    $this->widgetSchema['sf_guard_group_id']->setOption('add_empty', false);
    $this->widgetSchema['sf_guard_group_id']->setLabel('Group');
    
    return $code;
  }
  
  
  public function separateUserByGroup()
  {
    // unset the main combo box
    //unset($this['users_list']);
    $this->widgetSchema['users_list']->setAttribute('style', 'display:none');
    $this->widgetSchema['users_list']->setLabel(false);
    
    // load the different groups of users combo boxes
    $this->widgetSchema['users_list_jud'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardUser', 
        'query' => Doctrine::getTable('sfGuardUser')->getUsersByGroupCB(array('JUD', 'MAG')),
        'add_empty' => '-- Select Judge/Magistrate --',
        'label' => 'Judge/Magistrate',
        'method' => 'obtainFullName'
    ));
    
    $this->validatorSchema['users_list_jud'] = new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardUser', 'required' => false));  
    
    $this->widgetSchema['users_list_crc'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardUser', 
        'query' => Doctrine::getTable('sfGuardUser')->getUsersByGroupCB('CRC'),
        'add_empty' => '-- Select Criminal Coordinator --',
        'label' => 'Criminal Coordinator',
        'method' => 'obtainFullName'
    ));
    $this->validatorSchema['users_list_crc'] = new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardUser', 'required' => false));
    
    $this->widgetSchema['users_list_soc'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardUser', 
        'query' => Doctrine::getTable('sfGuardUser')->getUsersByGroupCB('SOC'),
        'add_empty' => '-- Select Sexual Offence Coordinator --',
        'label' => 'Sexual Offence Coordinator',
        'method' => 'obtainFullName'
    ));
    $this->validatorSchema['users_list_soc'] = new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardUser', 'required' => false));
    
    $this->widgetSchema['users_list_reg'] = new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardUser', 
        'query' => Doctrine::getTable('sfGuardUser')->getUsersByGroupCB('REG'),
        'add_empty' => '-- Select Registry --',
        'label' => 'Registry',
        'method' => 'obtainFullName'
    ));
    $this->validatorSchema['users_list_reg'] = new sfValidatorDoctrineChoice(array('multiple' => false, 'model' => 'sfGuardUser', 'required' => false));
      
    // set the combo boxes default values
    /*if ($this->isNew) {
      $this->setDefaults(array(
        'users_list_jud' => Doctrine::getTable('sfGuardUser')->getUsersByGroupCB('JUD'),
        'users_list_ccr' => Doctrine::getTable('sfGuardUser')->getUsersByGroupCB('CRC'),
        'users_list_soc' => Doctrine::getTable('sfGuardUser')->getUsersByGroupCB('SOC'),
        'users_list_reg' => Doctrine::getTable('sfGuardUser')->getUsersByGroupCB('REG'),
      ));
    }
    else {*/
      $this->setDefaults(array(
        'users_list_jud' => $this->object->retrieveUserByGroup('code', 'JUD'),
        'users_list_crc' => $this->object->retrieveUserByGroup('code', 'CRC'),
        'users_list_soc' => $this->object->retrieveUserByGroup('code', 'SOC'),
        'users_list_reg' => $this->object->retrieveUserByGroup('code', 'REG'),
      ));
    //}
  }
  
  
  public function setCustomValues($validator, $values)
  {
    // set users combo boxes to the main combobox before saving, if this combo boxes exist
    //if (isset($values['users_list_sup'])) {
      foreach ($values['users_list'] as $k =>  $v)  unset($values['users_list'][$k]);   //clean the multiple choice combobox;
      $cont = 0;
      if ($values['users_list_jud'] != '') $values['users_list'][$cont++] = $values['users_list_jud'];
      if ($values['users_list_crc'] != '') $values['users_list'][$cont++] = $values['users_list_crc'];
      if ($values['users_list_soc'] != '') $values['users_list'][$cont++] = $values['users_list_soc'];
      if ($values['users_list_reg'] != '') $values['users_list'][$cont++] = $values['users_list_reg'];
    //}
    
    return $values;
  }
    
}
