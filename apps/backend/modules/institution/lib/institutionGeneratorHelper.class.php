<?php

/**
 * institution module helper.
 *
 * @package    PhpProject1
 * @subpackage institution
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class institutionGeneratorHelper extends BaseInstitutionGeneratorHelper
{
  // use the admin module page links
  function getPageLinks()
  { 
    return (isset(Link::$admin_page_links)) ? Link::$admin_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'admin_'.$section.'_links'})) ? Link::${'admin_'.$section.'_links'} : array();
  }
  
  /*function getPageLinks()
  { 
    return array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'institution_'.$section.'_links'})) ? Link::${'institution_'.$section.'_links'} : array();
  }*/
}
