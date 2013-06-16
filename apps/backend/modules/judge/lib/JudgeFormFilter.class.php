<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class JudgeFormFilter extends sfGuardUserFormFilter
{
  public function configure()
  { 
    parent::configure();

    // use this in filters with embedded filter forms to avoid security vaidation
    $this->disableLocalCSRFProtection();
    
    $this->useFieldsEmbeddedForm('sfGuardUserProfiles', array('work_phone', 'fax'));
    $this->widgetSchema['sfGuardUserProfiles']->setLabel("Contact Info");
       
    $this->useFields(array('last_name', 'first_name', 'email_address', 'sfGuardUserProfiles'));
    
    $this->widgetSchema['last_name']->setLabel("Judge's Last Name");
    $this->widgetSchema['first_name']->setLabel("Judge's First Name");
    
    $rUserFormFilter = new AssociateFormFilter();
    
    $this->embedForm('Associate', $rUserFormFilter);
  }
  
  
  public function addAssociateColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if ($this->isFilterArrayEmpty($values)) return;
    
    // we initiate the query to only select the ids
    $q = new Doctrine_Query();
    $q->select('gu.id, cup.related_user_id')
        ->from('SfGuardUser gu')
        ->leftJoin('gu.UserProfiles cup');

    // get the embedded form
    $associateFormFilter = $this->getEmbeddedForm('Associate');

    // set the initial query we just created
    $associateFormFilter ->setQuery($q);
    
    // get the filtering query
    $q = $associateFormFilter ->buildQuery($values);

    // I will explain that one more just after
    $params = $q->getParams();

    // add the subquery to our initial query
    // special case when the embeded form does not have the field to compare but the subembedded form
    $stmt = $q->execute();
    if ($stmt) {
      $related_user_ids = array();
      foreach ($stmt as $k => $v)  {
        //echo $k .'=>'. $v->getUserProfiles()->getRelatedUserId().'<br/>';  
        $related_user_ids[] = $v->getUserProfiles()->getRelatedUserId();
      }
      if (count($related_user_ids)) {
        $query->andWhere($query->getRootAlias().'.id IN ('.implode(',', $related_user_ids).')');
      }
    }
    //$query->andWhere($query->getRootAlias().'.id IN ('.$q->getDql().')', $params['where'] );
  
    //echo $query;
    return $query;
  }
}
?>