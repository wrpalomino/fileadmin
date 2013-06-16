<?php

require_once dirname(__FILE__).'/../lib/correspondenceGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/correspondenceGeneratorHelper.class.php';

/**
 * correspondence actions.
 *
 * @package    fileadmin
 * @subpackage correspondence
 * @author     William Palomino
 * @version    3.0
 */
class correspondenceActions extends autoCorrespondenceActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
      
    $this->verifyClientFile('Sent Documents');
  }
}
