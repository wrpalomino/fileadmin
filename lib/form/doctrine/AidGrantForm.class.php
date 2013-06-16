<?php

/**
 * AidGrant form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AidGrantForm extends BaseAidGrantForm
{
  public function configure()
  {
    $this->widgetSchema['legal_aid_id']->setOption('method', 'getReferenceNumber');
  }
}
