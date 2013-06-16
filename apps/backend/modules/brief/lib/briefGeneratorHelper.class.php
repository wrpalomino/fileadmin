<?php

/**
 * brief module helper.
 *
 * @package    PhpProject1
 * @subpackage brief
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class briefGeneratorHelper extends BaseBriefGeneratorHelper
{
  function getPageLinks()
  {
    return (isset(Link::$informant_page_links)) ? Link::$informant_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    $plinks = (isset(Link::${'informant_'.$section.'_links'})) ? Link::${'informant_'.$section.'_links'} : array();
    if (CommonObject::CountForThisUserFile('Brief') == 0) {
      $nlink = array('inf_new'  => array('text' => 'New Brief Request', 'href' => 'brief/new', 'action' => 'new'));
      $plinks = array_merge($nlink, $plinks);
    }
    return $plinks;
  }
  
  function linkToReset($object, $params)
  {
    return '<input type="reset" value="Reset">';
  }
}
