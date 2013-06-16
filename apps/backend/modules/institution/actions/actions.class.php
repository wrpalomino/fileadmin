<?php

require_once dirname(__FILE__).'/../lib/institutionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/institutionGeneratorHelper.class.php';

/**
 * institution actions.
 *
 * @package    fileadmin
 * @subpackage institution
 * @author     William Palomino
 * @version    3.0
 */
class institutionActions extends autoInstitutionActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);       
    $this->editPagerRedirection($request);
  }
}
