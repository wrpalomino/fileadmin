<?php

/**
 * court module helper.
 *
 * @package    PhpProject1
 * @subpackage court
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class courtGeneratorHelper extends BaseCourtGeneratorHelper
{
  private $tabs = false;
  private $formtemplate = null;
  
  function setTabs($set)
  {
    $this->tabs = $set;
  }
  
  function getTabs()
  {
    return $this->tabs;
  }
  
  function setFormTemplate($frm, $tabs)
  {
    $this->formtemplate = $frm;
    $this->tabs = $tabs;
  }
  
  function getFormTemplate()
  {
    return $this->formtemplate;
  }
  
  function getPageLinks()
  { 
    return (isset(Link::$court_page_links)) ? Link::$court_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'court_'.$section.'_links'})) ? Link::${'court_'.$section.'_links'} : array();
  }
  
  /*public function linkToNew($params)
  {
     if (sfContext::getInstance()->getModuleName())
     return parent::linkToNew($params);
  }*/
  
  
  // customize the objects' edit link
  public function linkToEdit($object, $params)
  {
    return '
      <li class="sf_admin_action_edit">
        <a href="#" onclick="openBox(\''.url_for($this->getUrlForAction('edit'), array('id' => $object->getId(), 'edit_pager' => 0, 'shbx' => 1, '_frm' => 'CourtDateFeeCal')).'\', 850, 600, false);">Edit Fee</a>
      </li>';
  }
  
}
