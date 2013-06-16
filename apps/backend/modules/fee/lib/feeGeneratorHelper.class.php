<?php

/**
 * fee module helper.
 *
 * @package    PhpProject1
 * @subpackage fee
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class feeGeneratorHelper extends BaseFeeGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$fee_page_links)) ? Link::$fee_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'fee_'.$section.'_links'})) ? Link::${'fee_'.$section.'_links'} : array();
  }
}
