<?php

/**
 * Task form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TaskForm extends BaseTaskForm
{
  public function configure()
  {
    unset($this['user_id']);
    
    $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    $this->widgetSchema['task_by_id']->setOption('table_method', 'getSolicitorsCB');
    $this->widgetSchema['task_by_id']->setOption('method', 'obtainFullName');
    
    $this->widgetSchema['task_by2_id']->setOption('table_method', 'getSolicitorsCB');
    $this->widgetSchema['task_by2_id']->setOption('method', 'obtainFullName');
    
    $this->widgetSchema['task_for_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['task_for_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['task_for_id']->setOption('renderer_options', array(
        'model' => 'SfGuardUser',
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=todo&action=autocompletetaskfor'), //$autocomplete_url, //$this->getOption('url'),
        'config' => "{max: 20}",  //, minChars: 2}",
        'method' => 'obtainFullName'
    ));
    
    $this->widgetSchema->setHelp('task_for_id', '<span class="help"><font>HINT:</font> This Field is only to select, anything typed that is not in the result list will not be saved</span>');
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
