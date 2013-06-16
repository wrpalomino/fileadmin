<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ClientFormFilter extends sfGuardUserFormFilter
{
  public function configure()
  { 
    parent::configure();
    
    // use this in filters with embedded filter forms to avoid security validation
    $this->disableLocalCSRFProtection();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array(
        'street',       'suburb',     'postcode',     'city',     'state',    'home_phone', 
        'work_phone',   'mobile',     'other_phone',  'fax',      'dob',      'preferred_contact_id',
    ));
    
    $this->useFields(array('last_name', 'first_name', 'email_address', 'sfGuardUserProfiles'));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
     
    $uFileFormFilter = new UserFileFormFilter();
    $uFileFormFilter->useFields(array('bail_on_this', 'in_custody', 'prison_id'));
    $uFileFormFilter->widgetSchema['prison_id']->setLabel('Prison location');
    $this->embedForm('ClientUserFiles', $uFileFormFilter);
    $this->widgetSchema['ClientUserFiles']->setLabel("File Info");
  }
  
  public function addClientUserFilesColumnQuery(Doctrine_Query $query, $field, $values)
  { 
    if ($this->isFilterArrayEmpty($values)) return;
    
    // we initiate the query to only select the ids
    $q = new Doctrine_Query();
    $q->select('uf.client_id')->from('UserFile uf');
    
    // get the embedded form
    $userFileFormFilter = $this->getEmbeddedForm('ClientUserFiles');

    // set the initial query we just created
    $userFileFormFilter ->setQuery($q);
    
    // get the filtering query
    $q = $userFileFormFilter ->buildQuery($values);

    // I will explain that one more just after
    $params = $q->getParams();

    // add the subquery to our initial query
    $query->andWhere($query->getRootAlias().'.id IN ('.$q->getDql().')', $params['where'] );
  
    //echo $query;
    return $query;
  }
  
}
?>