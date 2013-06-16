<?php

/**
 * Brief filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BriefFormFilter extends BaseBriefFormFilter
{
  public function configure()
  {
    $this->useFields(array(
        'request1',           'request2',       'request3',             'request4',   
        'scanned',            'hub_scanned',    'depositions_added',    'roi_tape_received',  
        'photographs_added',  'status_id',      'user_file_id'
    ));
    
    // create the Y-N-NA comboboxes for these fields
    $this->widgetSchema['scanned'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));    
    $this->widgetSchema['hub_scanned'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['depositions_added'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));    
    $this->widgetSchema['roi_tape_received'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));    
    $this->widgetSchema['photographs_added'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    
    // setting methods for fields
    $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    $this->widgetSchema['status_id']->setOption('table_method', 'getBriefStatus');
  }
}
