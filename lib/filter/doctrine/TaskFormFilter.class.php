<?php

/**
 * Task filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TaskFormFilter extends BaseTaskFormFilter
{
  public function configure()
  {
    $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    $this->widgetSchema['task_by_id']->setOption('table_method', 'getSolicitorsCB');
    $this->widgetSchema['task_by_id']->setOption('method', 'obtainFullName');
    
    //$this->widgetSchema['task_by2_id']->setOption('table_method', 'getSolicitorsCB');
    //$this->widgetSchema['task_by2_id']->setOption('method', 'obtainFullName');
    
    $this->widgetSchema['task_for_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['task_for_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['task_for_id']->setOption('renderer_options', array(
        'model' => 'SfGuardUser',
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=todo&action=autocompletetaskfor'), //$autocomplete_url, //$this->getOption('url'),
        'config' => "{max: 20}",  //, minChars: 2}",
        'method' => 'obtainFullName'
    ));
  }
}
