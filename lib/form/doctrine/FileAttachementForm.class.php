<?php

/**
 * FileAttachement form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FileAttachementForm extends BaseFileAttachementForm
{
  public function configure()
  {
    $this->useFields(array('description', 'name', 'document_file', 'user_file_id', 'updated_by_id'));
    $this->widgetSchema['name'] = new sfWidgetFormInputHidden();
    $this->setDefault('name', 'upload');
    $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    
    $this->hideField('user_file_id');
    
    $this->widgetSchema['updated_by_id']->setOption('table_method', 'getSolicitorsCB');
    $this->widgetSchema['updated_by_id']->setOption('method', 'obtainFullName');
    
    $this->validatorSchema->setOption('allow_extra_fields', true);
    //$this->setDatesFieldAsText();
    
    // making the entry_number value persistent to save files
    $ufile_number = '';
    if (sfcontext::getInstance()->getActionName() != 'create') {
      $ufile_number = $this->getObject()->getUserFile()->getNumber();
      if ($ufile_number != '') sfContext::getInstance()->getUser()->setAttribute('ufile_number', $ufile_number);
      else $ufile_number = sfContext::getInstance()->getUser()->getAttribute('ufile_number', '000000');
    }
    else  {
      $ufile_number = sfContext::getInstance()->getUser()->getAttribute('ufile_number', '000000');
    }
    
    $this->widgetSchema['document_file'] = new sfWidgetFormInputFileEditable(array(
      'file_src'  => DIRECTORY_SEPARATOR.basename(sfConfig::get('sf_upload_dir')).DIRECTORY_SEPARATOR.$ufile_number.DIRECTORY_SEPARATOR.$this->getObject()->getDocumentFile(),
      'edit_mode' => !$this->isNew(),
    ));
    
    // new validators
    $this->validatorSchema['document_file'] = new sfValidatorFile(array (
        'max_size' => 10000000,
        'mime_types' => array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif', 
                              'application/excel', 'application/pdf', 'application/msword', 'application/octet-stream'),
        'path' => sfConfig::get('sf_upload_dir').DIRECTORY_SEPARATOR.$ufile_number,
	'required' => false,
    ));
    $this->validatorSchema['document_file_delete'] = new sfValidatorBoolean();

    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
    
  }
}
