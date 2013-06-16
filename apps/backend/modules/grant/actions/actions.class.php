<?php

require_once dirname(__FILE__).'/../lib/grantGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/grantGeneratorHelper.class.php';

/**
 * grant actions.
 *
 * @package    fileadmin
 * @subpackage grant
 * @author     William Palomino
 * @version    3.0
 */
class grantActions extends autoGrantActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
}
