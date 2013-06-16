<?php

/**
 * CommittalStream filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommittalStreamFormFilter extends BaseCommittalStreamFormFilter
{
  public function configure()
  {
    unset($this['court_date_id']);
    $this->widgetSchema->moveField('brief_status_id', sfWidgetFormSchema::BEFORE, 'hub_due_date');
    $this->widgetSchema['brief_status_id']->setOption('table_method', 'getBriefStatus');
    //unset($this['brief_status_id']);
    
    $this->widgetSchema['form_32_required'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    //$this->widgetSchema['court_date_id']->setOption('method', 'getReadableCourtDate');
  }
}
