<?php

/**
 * Listing form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ListingForm extends BaseListingForm
{
  public function configure()
  {
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
