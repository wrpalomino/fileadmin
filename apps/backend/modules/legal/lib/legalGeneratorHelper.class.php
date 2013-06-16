<?php

/**
 * legal module helper.
 *
 * @package    PhpProject1
 * @subpackage legal
 * @author     Your name here
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class legalGeneratorHelper extends BaseLegalGeneratorHelper
{
  public $elodge_text = 'Data: Grant Help Desk (e-Lodgement)<br/><br/>Victoria Legal Aid<br/>
    Melbourne, VIC 3000<br/><br/>Tel: (03) 9606 5352<br/>Fax: (03) 9269 0250';
  
  function getPageLinks()
  { 
    return (isset(Link::$legal_page_links)) ? Link::$legal_page_links : array();
  }
  
  function getSectionLinks($section)
  {
    $plinks = (isset(Link::${'legal_'.$section.'_links'})) ? Link::${'legal_'.$section.'_links'} : array();
    //$plinks = (isset(Link::${'informant_'.$section.'_links'})) ? Link::${'informant_'.$section.'_links'} : array();
    if (CommonObject::CountForThisUserFile('LegalAid') == 0) {
      $nlink = array('vla_new'  => array('text' => 'New VLA', 'href' => 'legal/new', 'action' => 'new'));
      $plinks = array_merge($nlink, $plinks);
    }
    return $plinks;
  }
  
}
