<?php

/**
 * CourtDate filter form.
 *
 * @package    PhpProject1
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CourtDateFormFilter extends BaseCourtDateFormFilter
{
  public function configure()
  {
    $this->useFields(array(
        'court_id', 'date', 'listing_id', 'appearing_id', 'court_note_id', 'coordinator_id', 'user_file_id'
    ));
    
    // set method to load values to show
    $this->widgetSchema['court_id']->setOption('table_method', 'getCourtsCB');
    $this->widgetSchema['appearing_id']->setOption('table_method', 'getSolicitorsCB');
    $this->widgetSchema['coordinator_id']->setOption('table_method', 'getCoordinatorsCB');
    
    $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
  }
}
