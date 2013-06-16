<?php

/**
 * file module helper.
 *
 * @package    PhpProject1
 * @subpackage file
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fileGeneratorHelper extends BaseFileGeneratorHelper
{
  private $tabs = false;
  
  function getPageLinks()
  { 
    return (isset(Link::$admin_page_links)) ? Link::$admin_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'admin_'.$section.'_links'})) ? Link::${'admin_'.$section.'_links'} : array();
  }
  
  function linkToClear($object, $params)
  {
    // simulate new to clear the form
    //return '<li class="sf_admin_action_new">'.link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new')).'</li>';
    return link_to(__($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('new'));
  }
  
  function linkToReset($object, $params)
  {
    return '<input type="reset" value="Reset">';
  }
  
  function setTabs($set)
  {
    $this->tabs = $set;
  }
  
  function getTabs()
  {
    return $this->tabs;
  }
  
  
  public function linkToCloneFile($object, $params)
  {
    return '<li style="float:right"><input type="submit" value="'.__($params['label'], array(), 'sf_admin').'" name="clone_file" id="clone_file" onclick="return confirm(\'Do you really want to clone this file?\')" /></li>';
  }
  
}
