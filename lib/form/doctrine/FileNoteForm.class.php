<?php

/**
 * FileNote form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FileNoteForm extends BaseFileNoteForm
{
  public function configure()
  {
    $this->widgetSchema['date'] = new sfWidgetFormDateTime(array(
        'date' => array('format' => '%day%/%month%/%year%', 'can_be_empty' => false)
        ));
    $this->setDefault('date', time());
    
    $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    $this->widgetSchema['user_file_id']->setOption('add_empty', false);
    
    $this->validatorSchema['note_by']->setOption('required', true);
    $this->validatorSchema['note']->setOption('required', true);
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
