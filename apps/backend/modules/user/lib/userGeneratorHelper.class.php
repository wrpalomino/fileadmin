<?php

/**
 * user module helper.
 *
 * @package    PhpProject1
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userGeneratorHelper extends BaseUserGeneratorHelper
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
    return (isset(Link::$user_page_links)) ? Link::$user_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'user_'.$section.'_links'})) ? Link::${'user_'.$section.'_links'} : array();
  }*/
}
