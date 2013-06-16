<?php

/**
 * todo module helper.
 *
 * @package    PhpProject1
 * @subpackage todo
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class todoGeneratorHelper extends BaseTodoGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$todo_page_links)) ? Link::$todo_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'todo_'.$section.'_links'})) ? Link::${'todo_'.$section.'_links'} : array();
  }
  
}
