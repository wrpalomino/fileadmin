<?php

/**
 * sfGuardUser filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserFormFilter extends PluginsfGuardUserFormFilter
{
  public function configure()
  {    
    $this->useFields(array(
        'last_name',  'first_name',     'username',  'email_address',  'password', 
        'is_active',  'is_super_admin', 'agencies_list', 'groups_list'
    ));
    $this->widgetSchema['first_name']->setOption('with_empty', false);
    $this->widgetSchema['last_name']->setOption('with_empty', false);
    
    // user by default will be linked to one agency
    $this->widgetSchema['agencies_list']->setOption('multiple', false);
    $this->widgetSchema['agencies_list']->setOption('add_empty', true);
    
    // user can have only one role
    //$this->widgetSchema['groups_list']->setOption('multiple', false);
    
    // add the profile form for the user
    $user_profile = new sfGuardUserProfileFormFilter();
    unset($user_profile['user_id']);
    $this->embedForm('sfGuardUserProfiles', $user_profile);         // bad formatting of fields
  }
  
  
  public function addSfGuardUserProfilesColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if ($this->isFilterArrayEmpty($values)) return;
    
    // we initiate the query to only select the ids
    $q = new Doctrine_Query();
    
    $rootAlias = 'up';
    $q->select($rootAlias.'.user_id')->from('sfGuardUserProfile '.$rootAlias);

    // get the embedded form
    $userProfileFormFilter = $this->getEmbeddedForm('sfGuardUserProfiles');

    // set the initial query we just created
    $userProfileFormFilter ->setQuery($q);

    // get the filtering query
    $q = $userProfileFormFilter ->buildQuery($values);

    // I will explain that one more just after
    $params = $q->getParams();

    // add the subquery to our initial query
    $query->andWhere($query->getRootAlias().'.id IN ('.$q->getDql().')', $params['where'] );
  
    //echo $query;
    return $query;
  }
  
}
