<?php

/**
 * client module helper.
 *
 * @package    PhpProject1
 * @subpackage client
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class clientGeneratorHelper extends BaseClientGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$client_page_links)) ? Link::$client_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'client_'.$section.'_links'})) ? Link::${'client_'.$section.'_links'} : array();
  }
  
  function getSendTo()
  {
    $option_num = 0; //default
    $file_id = CommonObject::getSessionUserFileData('fileId');
    if ($file_id) {
      $userFile = Doctrine::getTable('UserFile')->find($file_id);
      if ($userFile) $option_num = $userFile->getCorrespondenceSentOption();
    }
    
    $arr = array();
    $cont = 0;
    foreach (Link::$client_send_to as $option) {
      if ($cont == $option_num) $option['checked'] = 'checked';
      $arr[] = $option;
      $cont++;
    }
    
    //return Link::$client_send_to;
    return $arr;
  }
  
}
