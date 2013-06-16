<?php

/**
 * brief module configuration.
 *
 * @package    PhpProject1
 * @subpackage brief
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class briefGeneratorConfiguration extends BaseBriefGeneratorConfiguration
{
  public function getPagerMaxPerPage()
  {
    if ($max = sfContext::getInstance()->getUser()->getAttribute('brief.max_per_page'))
      return $max;
    else
      return parent::getPagerMaxPerPage();
  }
}
