<?php

/**
 * AidGrant filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AidGrantFormFilter extends BaseAidGrantFormFilter
{
  public function configure()
  {
    $this->widgetSchema['legal_aid_id']->setOption('method', 'getReferenceNumber');
  }
}
