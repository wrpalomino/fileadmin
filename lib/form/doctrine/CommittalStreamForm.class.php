<?php

/**
 * CommittalStream form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommittalStreamForm extends BaseCommittalStreamForm
{
  public function configure()
  {
    $this->widgetSchema->moveField('brief_status_id', sfWidgetFormSchema::BEFORE, 'hub_due_date');
    $this->widgetSchema['brief_status_id']->setOption('table_method', 'getBriefStatus');
    $this->widgetSchema['form_32_required'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
   
    unset($this['court_date_id']);
    //$this->widgetSchema['court_date_id']->setOption('method', 'getReadableCourtDate');
    //$this->widgetSchema['court_date_id']->setOption('table_method', 'getCourtDatesForUserFile');
    //$this->widgetSchema['court_date_id']->setOption('add_empty', true);
    
    $this->hideField('user_file_id');

    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
