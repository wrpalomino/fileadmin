<?php

/**
 * uploadedFile module helper.
 *
 * @package    PhpProject1
 * @subpackage uploadedFile
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class uploadedFileGeneratorHelper extends BaseUploadedFileGeneratorHelper
{
  function getPageLinks()
  { 
    //return (isset(Link::$client_page_links)) ? Link::$client_page_links : array();\
    return array();
  }
  
  function getSectionLinks($section)
  {
    //return (isset(Link::${'client_'.$section.'_links'})) ? Link::${'client_'.$section.'_links'} : array();
    return array();
  }
}
