<?php

/**
 * barrister module helper.
 *
 * @package    PhpProject1
 * @subpackage barrister
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class barristerGeneratorHelper extends BaseBarristerGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$barrister_page_links)) ? Link::$barrister_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'barrister_'.$section.'_links'})) ? Link::${'barrister_'.$section.'_links'} : array();
  }
  
  function getExtraOptions()
  {
    return Link::$barrister_extra_options;
  }
}
