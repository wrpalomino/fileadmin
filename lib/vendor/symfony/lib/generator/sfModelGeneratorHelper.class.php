<?php

/**
 * Model generator helper.
 *
 * @package    symfony
 * @subpackage generator
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfModelGeneratorHelper.class.php 22914 2009-10-10 12:24:29Z Kris.Wallsmith $
 */
abstract class sfModelGeneratorHelper
{
  abstract public function getUrlForAction($action);
  
  // added by Wiliam, 04/02/2012: to force routing to model/action instead of module/action
  public function fixUrlForAction($action, $object)
  { 
    $url = $this->getUrlForAction($action);
    
    // modified by William, 07/04/2012: not useful for this project => return original fucntion
    /*$module_route_prefix = str_replace('_'.$action, '', $url);
    
    if ($module_route_prefix != $url) {
      $object_route_prefix = $object->getTable()->getTableName();
      if ($module_route_prefix != $object_route_prefix) {
        $url = $object_route_prefix.'_'.$action;        
      }
    }*/
    return $url;
  }

  public function linkToNew($params)
  {
      
    return '<li class="sf_admin_action_new">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new')).'</li>';
  }

  public function linkToEdit($object, $params)
  {
    
    //return '<li class="sf_admin_action_edit">'.link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('edit'), $object).'</li>';
    return '<li class="sf_admin_action_edit">'.link_to(__($params['label'], array(), 'sf_admin'), $this->fixUrlForAction('edit', $object), $object).'</li>';
  }
  
  public function linkToDelete($object, $params)
  {
    if ($object->isNew())
    {
      return '';
    }

    //return '<li class="sf_admin_action_delete">'.link_to(__($params['label'], array(), 'sf_admin'), $this->getUrlForAction('delete'), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'])).'</li>';
    return '<li class="sf_admin_action_delete">'.link_to(__($params['label'], array(), 'sf_admin'), $this->fixUrlForAction('delete', $object), $object, array('method' => 'delete', 'confirm' => !empty($params['confirm']) ? __($params['confirm'], array(), 'sf_admin') : $params['confirm'])).'</li>';
  }

  public function linkToList($params)
  {
    return '<li class="sf_admin_action_list">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list')).'</li>';
  }

  public function linkToSave($object, $params)
  {
    return '<li class="sf_admin_action_save"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" /></li>';
  }

  public function linkToSaveAndAdd($object, $params)
  {
    if (!$object->isNew())
    {
      return '';
    }

    return '<li class="sf_admin_action_save_and_add"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="_save_and_add" /></li>';
  }
}
