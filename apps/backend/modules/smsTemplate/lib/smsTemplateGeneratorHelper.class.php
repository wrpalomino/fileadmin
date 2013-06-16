<?php

/**
 * smsTemplate module helper.
 *
 * @package    PhpProject1
 * @subpackage smsTemplate
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class smsTemplateGeneratorHelper extends BaseSmsTemplateGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$admin_page_links)) ? Link::$admin_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'admin_'.$section.'_links'})) ? Link::${'admin_'.$section.'_links'} : array();
  }
}
