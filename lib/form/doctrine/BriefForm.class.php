<?php

/**
 * Brief form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BriefForm extends BaseBriefForm
{
  public function configure()
  {
    // set on generator.yml
    /*$this->useFields(array(
        'request1',           'request2',       'request3',             'request4',   
        'scanned',            'hub_scanned',    'depositions_added',    'roi_tape_received',  
        'photographs_added',  'status_id',      'user_file_id'
    ));*/
    
    //$this->hideField('user_file_id');
    $this->validatorSchema->setOption('allow_extra_fields', true);
        
    // create the Y-N-NA comboboxes for these fields
    $this->widgetSchema['scanned'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['scanned'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys(Doctrine::getTable('UserFile')->getYesNoNcOptions())));
    
    $this->widgetSchema['roi_tape_received'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['roi_tape_received'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys(Doctrine::getTable('UserFile')->getYesNoNcOptions())));
        
    $this->widgetSchema['priors_received'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['priors_received'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys(Doctrine::getTable('UserFile')->getYesNoNcOptions())));
    
    $this->widgetSchema['statements_received'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['statements_received'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys(Doctrine::getTable('UserFile')->getYesNoNcOptions())));
    
    $this->widgetSchema['charges_received'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['charges_received'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys(Doctrine::getTable('UserFile')->getYesNoNcOptions())));
    
    $this->widgetSchema['summary_received'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['summary_received'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys(Doctrine::getTable('UserFile')->getYesNoNcOptions())));
    
    $this->widgetSchema['photographs_added'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['photographs_added'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys(Doctrine::getTable('UserFile')->getYesNoNcOptions())));
    
    $this->widgetSchema['interview_recording'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->validatorSchema['interview_recording'] = new sfValidatorChoice(array('required' => false, 'choices' => array_keys(Doctrine::getTable('UserFile')->getYesNoNcOptions())));
    
    // setting methods for fields
    $this->widgetSchema['status_id']->setOption('table_method', 'getBriefStatus');
    $this->widgetSchema['status_id']->setAttribute('onchange', 'popMessage(this)');
    
    $this->widgetSchema['request1']->setLabel("<a href='#' onclick=\"briefrequest(1, 'brirq1');\">Request1</a>");
    $this->widgetSchema['request2']->setLabel("<a href='#' onclick=\"briefrequest(2, 'brirq2');\">Request2</a>");
    $this->widgetSchema['request3']->setLabel("<a href='#' onclick=\"briefrequest(3, 'brirq3');\">Request3</a>");
    $this->widgetSchema['request4']->setLabel("<a href='#' onclick=\"briefrequest(4, 'brirq4');\">Request4</a>");
    
    $this->widgetSchema['roi_tape_received']->setLabel("<a href='#' onclick=\"openBox('document/new?doc=letinf');\">Roi received</a>");
    $this->widgetSchema['priors_received']->setLabel("<a href='#' onclick=\"openBox('document/new?doc=letinf');\">Priors Received</a>");
    $this->widgetSchema['statements_received']->setLabel("<a href='#' onclick=\"openBox('document/new?doc=letinf');\">Statements Received</a>");
    $this->widgetSchema['charges_received']->setLabel("<a href='#' onclick=\"openBox('document/new?doc=letinf');\">Charges Received</a>");
    $this->widgetSchema['summary_received']->setLabel("<a href='#' onclick=\"openBox('document/new?doc=letinf');\">Summary_received</a>");    
    
    // making some fields required
    $this->validatorSchema['request1']->setOption('required', true);
    
    //$this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    $this->hideField('user_file_id');
            
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
