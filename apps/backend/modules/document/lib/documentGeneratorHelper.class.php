<?php

/**
 * document module helper.
 *
 * @package    PhpProject1
 * @subpackage document
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class documentGeneratorHelper extends BaseDocumentGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$admin_page_links)) ? Link::$admin_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'admin_'.$section.'_links'})) ? Link::${'admin_'.$section.'_links'} : array();
  }
  
  function get_partial_subfolder($templateName, $subfolder, $vars = array())
  {
    $context = sfContext::getInstance();

    // partial is in another module?
    if (false !== $sep = strpos($templateName, '/')) {
      $moduleName   = substr($templateName, 0, $sep);
      $templateName = substr($templateName, $sep + 1);
    }
    else {
      $moduleName = $context->getActionStack()->getLastEntry()->getModuleName();
    }
    
    // modified by William, 27/05/2012
    //$actionName = '_'.$templateName;
    $actionName = $subfolder.'/_'.$templateName;

    $class = sfConfig::get('mod_'.strtolower($moduleName).'_partial_view_class', 'sf').'PartialView';
    $view = new $class($context, $moduleName, $actionName, '');
    $view->setPartialVars(true === sfConfig::get('sf_escaping_strategy') ? sfOutputEscaper::unescape($vars) : $vars);

    return $view->render();
  }
  
  
  // customize the objects' edit link
  public function linkToEdit($object, $params)
  {
    return '
      <li class="sf_admin_action_edit">
        <a href="#" onclick="openBox(\''.url_for($this->getUrlForAction('edit'), array('id' => $object->getId())).'\', 1050, 650, false);">Edit</a>
      </li>';
  }
  
}
