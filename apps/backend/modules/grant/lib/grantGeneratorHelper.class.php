<?php

/**
 * grant module helper.
 *
 * @package    PhpProject1
 * @subpackage grant
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class grantGeneratorHelper extends BaseGrantGeneratorHelper
{  
  function getPageLinks()
  { 
    return (isset(Link::$legal_page_links)) ? Link::$legal_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'legal_'.$section.'_links'})) ? Link::${'legal_'.$section.'_links'} : array();
  }
}
