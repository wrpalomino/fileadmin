<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ProsecutionFormFilter extends AgencyFormFilter
{
  public function configure()
  {
    // use this in filters with embedded filter forms to avoid security vaidation
    $this->disableLocalCSRFProtection();

    $this->useFields(array(
        'subgroup_id',      'name',       'phone',                
        'fax',              'email',      'sf_guard_group_id',    
    ));
    $this->widgetSchema['name']->setLabel('Office');
    $this->widgetSchema['subgroup_id']->setLabel('Prosecution');
    
    // hide the 'sf_guard_group_id' in filters
    $this->hideField('sf_guard_group_id');
    
    // set methods to filter data to display
    $this->widgetSchema['subgroup_id']->setoption('table_method', 'getProsecutionSubGroupsCB');

    $this->loadValues();
    
    //$proFormFilter = new ProsecutorFormFilter();
    //$this->embedForm('officer', $proFormFilter);
    
  }
  
  /*public function addOfficerColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if ($this->isFilterArrayEmpty($values)) return;
    
    // we initiate the query to only select the ids
    $q = new Doctrine_Query();
    $q->select('gu.id')->from('SfGuardUser gu');

    // get the embedded form
    $officerFormFilter = $this->getEmbeddedForm('officer');

    // set the initial query we just created
    $officerFormFilter ->setQuery($q);
    
    // get the filtering query
    $q = $officerFormFilter ->buildQuery($values);
    
    //foreach ($values as $k => $v)  echo $k .'=>'. $v['text'].'<br/>';

    // I will explain that one more just after
    $params = $q->getParams();

    // bc it's a reverse relationship between user & agency, main form 'id' must be replaced with 'officer_id'
    // add the subquery to our initial query
    $query->andWhere($query->getRootAlias().'.officer_id IN ('.$q->getDql().')', $params['where'] );

    //echo $query;
    return $query;
  }*/
  
}
?>