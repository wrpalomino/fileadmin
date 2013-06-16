<?php

/**
 * agency module helper.
 *
 * @package    PhpProject1
 * @subpackage agency
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class agencyGeneratorHelper extends BaseAgencyGeneratorHelper
{ 
  function getPageLinks()
  { 
    return (isset(Link::$agency_page_links)) ? Link::$agency_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'agency_'.$section.'_links'})) ? Link::${'agency_'.$section.'_links'} : array();
  }
}
