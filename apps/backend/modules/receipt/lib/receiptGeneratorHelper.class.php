<?php

/**
 * receipt module helper.
 *
 * @package    PhpProject1
 * @subpackage receipt
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class receiptGeneratorHelper extends BaseReceiptGeneratorHelper
{
  function getPageLinks()
  { 
    //return (isset(Link::$fee_page_links)) ? Link::$fee_page_links : array();
    return array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'fee_'.$section.'_links'})) ? Link::${'fee_'.$section.'_links'} : array();
  }
}
