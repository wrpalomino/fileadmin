<?php

/**
 * committalStream module helper.
 *
 * @package    PhpProject1
 * @subpackage committalStream
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class committalStreamGeneratorHelper extends BaseCommittalStreamGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$court_page_links)) ? Link::$court_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    $plinks = (isset(Link::${'court_'.$section.'_links'})) ? Link::${'court_'.$section.'_links'} : array();
    //$plinks = (isset(Link::${'informant_'.$section.'_links'})) ? Link::${'informant_'.$section.'_links'} : array();
    if (CommonObject::CountForThisUserFile('CommittalStream') == 0) {
      $nlink = array('cst_new'  => array('text' => 'New Committal Stream', 'href' => 'committalStream/new', 'action' => 'new'));
      $plinks = array_merge($nlink, $plinks);
    }
    return $plinks;
  }
}
