<?php

/**
 * CourtDate form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */


// Commented by William, 02/05/2013: file set to be deleted, replacing code in lib/forms/CortDateForm.class.php

/*class CourtDateForm extends BaseCourtDateForm
{
  public function configure()
  {
    $this->useFields(array(
        'court_id', 'date',  'time', 'appearing_id', 'court_note_id', 'coordinator_id', 'user_file_id'
    ));
    $this->widgetSchema['court_note_id']->setLabel('Note');
    
    // set method to load values to show
    $this->widgetSchema['court_id']->setOption('table_method', 'getCourtsCB'); 
    $this->widgetSchema['appearing_id']->setOption('table_method', 'getSolicitorsCB');
    $this->widgetSchema['coordinator_id']->setOption('table_method', 'getCoordinatorsCB');
    $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    
    // remove emptys
    $this->widgetSchema['court_id']->setOption('add_empty', false);
    
    // adding some extra validators
    $this->widgetSchema['time'] = new sfWidgetFormTime();
    $this->validatorSchema['time'] = new sfValidatorTime(array('required' => false));
    $this->validatorSchema['court_id']->setOption('required', true);
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
    
    $custom_decorator = new ExtendedFormSchemaFormatter($this->getWidgetSchema());
    $this->widgetSchema->addFormFormatter('Myformatter', $custom_decorator);
    $this->widgetSchema->setFormFormatterName('Myformatter');
  }
  
}*/
