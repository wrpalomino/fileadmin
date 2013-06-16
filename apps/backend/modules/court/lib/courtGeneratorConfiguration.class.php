<?php

/**
 * court module configuration.
 *
 * @package    PhpProject1
 * @subpackage court
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class courtGeneratorConfiguration extends BaseCourtGeneratorConfiguration
{
  public function getPagerMaxPerPage()
  {
    if ($max = sfContext::getInstance()->getUser()->getAttribute('court.max_per_page'))
      return $max;
    else
      return parent::getPagerMaxPerPage();
  }
}
