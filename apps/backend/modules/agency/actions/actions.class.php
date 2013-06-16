<?php

require_once dirname(__FILE__).'/../lib/agencyGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/agencyGeneratorHelper.class.php';

/**
 * downloadPDF actions.
 *
 * @package    fileadmin
 * @subpackage downloadPDF
 * @author     William Palomino
 * @version    3.0
 */
class agencyActions extends autoAgencyActions
{
  public function preExecute() 
  {
    parent::preExecute();
    
    // keeps the form in the shadowbox for all the actions
    if (sfContext::getInstance()->getRequest()->getParameter('shbx')) {
      $this->partial_links = false;
      $this->edit_pager = false;
      $this->setLayout('form_layout');
      $this->no_title = false;
      $this->mode = 'search';
      $this->shadow_box = true;
    }
    
    // to show documents according to the sub section
    //$sub_section_code = sfContext::getInstance()->getRequest()->getParameter('code');
    $sub_section_code = isset($_GET['code']) ? $_GET['code'] : '';
    if ($sub_section_code != '') sfContext::getInstance()->getUser()->setAttribute('agency_code', $sub_section_code);
    else $sub_section_code = sfContext::getInstance()->getUser()->getAttribute('agency_code', 'CLD');
    
    //echo $sub_section_code;
    
    if ($sub_section_code) {
      $sub_sections = array(
          'CLD' => 'criminal_trial_listing_dir',
          'OOC' => 'office_of_corrections',
          'JJS' => 'juvenile_justice',
          'PRI' => 'prisons',
          'ACB' => 'appeals_costs_board',
          'ALS' => 'aboriginal_legal_services',
          'CLS' => 'community_legal_services'
      );
      if (isset($sub_sections[$sub_section_code])) {
        $this->section_links = $this->helper->getSectionLinks($sub_sections[$sub_section_code]);
      }
    }
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    if (sfContext::getInstance()->getRequest()->getParameter('shbx')) {
      parent::executeIndex($request);
    }
    else {
      $request = $this->setMainFilter($request);
      parent::executeIndex($request);
      $this->editPagerRedirection($request);
    }
  }
  
}
