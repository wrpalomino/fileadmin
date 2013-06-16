<?php

/**
 * informant module helper.
 *
 * @package    PhpProject1
 * @subpackage informant
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class informantGeneratorHelper extends BaseInformantGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$informant_page_links)) ? Link::$informant_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'informant_'.$section.'_links'})) ? Link::${'informant_'.$section.'_links'} : array();
  }
 
}
