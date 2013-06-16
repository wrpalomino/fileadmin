<?php

/**
 * fileFee module helper.
 *
 * @package    PhpProject1
 * @subpackage fileFee
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fileFeeGeneratorHelper extends BaseFileFeeGeneratorHelper
{
  function getPageLinks()
  { 
    return (isset(Link::$fee_page_links)) ? Link::$fee_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    return (isset(Link::${'fee_'.$section.'_links'})) ? Link::${'fee_'.$section.'_links'} : array();
  }
  
  function getSectionLink($section, $index)
  {    
    $section_links = $this->getSectionLinks($section);
    $lk = $section_links[$index];
    $module_name = sfContext::getInstance()->getModuleName();
    $action_name = sfContext::getInstance()->getActionName();
    
    if (isset($lk['target'])) {
        echo '<a href="'.urldecode($lk['href']).'" target="'.$lk['target'].'" class="external_lnk">'.$lk['text'].'</a>';
    }
    else if ($lk['href'] == '#') {
      $js = isset($lk['js']) ? $lk['js'] : '';
      echo '<a href="'.urldecode($lk['href']).'" '.$js.'>'.$lk['text'].'</a>';
    }
    else {
      link_to($lk['text'], sfOutputEscaper::unescape($lk['href']), $module_name.'/'.$action_name==$lk['href'] ? array("class" => "selected") : array() );
    }
  }
  
}
