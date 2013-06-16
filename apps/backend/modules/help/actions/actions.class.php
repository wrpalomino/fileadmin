<?php

require_once dirname(__FILE__).'/../lib/helpGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/helpGeneratorHelper.class.php';

/**
 * help actions.
 *
 * @package    fileadmin
 * @subpackage help
 * @author     William Palomino
 * @version    3.0
 */
class helpActions extends autoHelpActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
}
