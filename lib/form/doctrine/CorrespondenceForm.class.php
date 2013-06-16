<?php

/**
 * Correspondence form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CorrespondenceForm extends BaseCorrespondenceForm
{
  public function configure()
  {
    $this->useFields(array(
        'subject',        'receiver_name',  'receiver_address',   'notes',      'sender_id',  
        'delivered_date', 'returned_date',  'user_file_id',       'sent_by_id'
        ));
  }
}
