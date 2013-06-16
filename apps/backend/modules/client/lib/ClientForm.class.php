<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ClientForm extends sfGuardUserForm
{
  public function configure()
  { 
    parent::configure();
    
    // added by William, 11/05/2013: to update non-closed user files that include this client
    $this->widgetSchema['update_related_files'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['update_related_files']->setDefault(1);
    $this->validatorSchema['update_related_files'] = new sfValidatorPass();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'honorific_id',     'street',          'suburb',     'postcode',     'city',     'state',    
        'home_phone',       'work_phone',      'mobile',     'other_phone',  'fax',      'dob',
        'preferred_contact_id',
        'criminal_crn',     'centrelink_crn',   'hcc_expiration_date',
    ));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
    
    $this->widgetSchema['sfGuardUserProfiles']['honorific_id']->setOption('table_method', 'loadCivil');
    
    $this->useFields(array('username', 'last_name', 'first_name', 'email_address', 'sfGuardUserProfiles', 'groups_list'));
    
    // set the dafault values for username and group for this type of user
    $this->setUserDefaultValues('client');
    
    // hide this field, necessary to save the data but annoying for the final user
    $this->hideField('groups_list');
    
    // for the add/edit button widget
    if (  (sfContext::getInstance()->getModuleName() == 'client') &&
          !sfContext::getInstance()->getRequest()->getParameter('shbx') ) {
      
      $current_file = CommonObject::getSessionUserFileData('fileId');
      if ($current_file) {
        $uFile = Doctrine::getTable('UserFile')->find($current_file);        
      }
      else {
        // modified by William, 17/02/2013: (Symfony bug) only returns one value even if table has more than 1 record
        //$uFileCollection = $this->object->getClientUserFiles();
        $uFileCollection = $this->object->getId() ? Doctrine::getTable('UserFile')->findBy('client_id', $this->object->getId()) : null;
        $uFile = ($uFileCollection) ? $uFileCollection[sizeof($uFileCollection)-1] : null;
      }
      //foreach ($uFileCollection as $k => $filess) echo $k.': '.$filess->getId().'<br/>';

      if ($uFile) {    
        $uFileForm = new UserFileForm($uFile);
        $uFileForm->useFields(array('bail_on_this', 'in_custody', 'prison_id'));
        $uFileForm->widgetSchema['prison_id']->setLabel('Prison location');

        $this->embedForm('ClientUserFiles', $uFileForm);
        $this->widgetSchema['ClientUserFiles']->setLabel("File Info");
      }
    }
    
  }
  
  
  // added by William, 11/05/2013: to update non-closed user files that include this client
  public function doSave($con = null)
  {
    parent::doSave($con);
    
    if ( isset($this->widgetSchema['update_related_files']) && ($this->getValue('update_related_files')>0) ) {
      $client_id = $this->getObject()->getId();
      $file_closed_status_id = 38;
      $user_files = Doctrine::getTable('UserFile')->findBySql('client_id = ? AND status_id != ?', array($client_id, $file_closed_status_id));
      
      if ($user_files) {        
        foreach ($user_files as $user_file) {
          $user_file->setUserData($client_id, $this->getObject());
          $user_file->save($con);
        }
      }
    }
  }

}

?>