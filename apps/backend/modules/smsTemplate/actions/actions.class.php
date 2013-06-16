<?php

require_once dirname(__FILE__).'/../lib/smsTemplateGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/smsTemplateGeneratorHelper.class.php';

/**
 * smsTemplate actions.
 *
 * @package    fileadmin
 * @subpackage smsTemplate
 * @author     William Palomino
 * @version    3.0
 */
class smsTemplateActions extends autoSmsTemplateActions
{
  public function executeGetTemplate(sfWebRequest $request)
  {
    if ($request->getParameter('id')) {
      $smsTempObj = Doctrine::getTable('ShortMessageTemplate')->find($request->getParameter('id'));
      if ($smsTempObj) die($smsTempObj->getMessage());
    }
  }
}
