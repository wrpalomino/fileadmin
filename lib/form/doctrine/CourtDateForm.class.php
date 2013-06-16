<?php

/**
 * CourtDate form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CourtDateForm extends BaseCourtDateForm
{
  public function configure()
  {
    /*$this->useFields(array(
        'court_id', 'date', 'listing_id', 'time', 'appearing_id', 'court_note_id', 'coordinator_id', 'user_file_id'
    ));*/
    if (sfContext::getInstance()->getModuleName() == 'file') {
      unset($this['judge_id'],        $this['result'],              $this['instruction'], 
            $this['user_file_id'],    $this['court_note_id'],       $this['coordinator_id'],
            $this['barrister_id'],    $this['appearing_type_id']/*,   $this['appearing_id']*/
           );
      
      $this->widgetSchema['appearing_id']->setOption('method', 'obtainFullName');
      $this->widgetSchema['appearing_id']->setOption('table_method', 'getSolicitorsCB');
   
      $this->widgetSchema['court_id']->setAttribute('style', 'width:200px');
      $this->widgetSchema['listing_id']->setAttribute('style', 'width:150px');
    }
    else {
      //unset($this['coordinator_id']);
      $this->widgetSchema['result']->setAttributes(array('cols' => '70', 'rows' => '12'));
      $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
      $this->widgetSchema['court_note_id']->setLabel('Note');
      
      $this->widgetSchema['instruction'] = new sfWidgetFormTextarea(array(), array('cols' => '70', 'rows' => '4'));
      
      $this->widgetSchema['judge_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Judge'), 
        'form_module' => 'judge', 
        'add_empty' => true,
        'method' => 'obtainFullName',
        'table_method' => 'getJudgesCB'
        ));
      
      $this->widgetSchema['judge_id']->setLabel('Before');
      $this->validatorSchema['judge_id']->setOption('required', false);
      //$this->widgetSchema['judge_id']->setOption('method', 'obtainFullName');
      //$this->widgetSchema['judge_id']->setOption('table_method', 'getJudgesCB');
      
      $this->widgetSchema['appearing_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Appearing'), 
        'form_module' => 'user?_frm=MyAccount', 
        'add_empty' => true,
        'method' => 'obtainFullName',
        'table_method' => 'getSolicitorsCB'
        ));
      
      // added by William, 26/05/2013: add barrister
      $this->widgetSchema['barrister_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Barrister'), 
        'form_module' => 'user?_frm=MyAccount', 
        'add_empty' => true,
        'method' => 'obtainFullName',
        'table_method' => 'getBarristersCB'
        ));
      
      //$this->widgetSchema['appearing_id']->setOption('method', 'obtainFullName');
      //$this->widgetSchema['appearing_id']->setOption('table_method', 'getSolicitorsCB');
      
      // for the add/edit button widget
      if (!sfContext::getInstance()->getRequest()->getParameter('shbx') ) {
        $this->widgetSchema['court_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
          'model' => 'Agency', 
          'form_module' => 'agency?code=COU', 
          'add_empty' => true,
        ));
      }
      
      // for the add/edit button widget
      //if (!sfContext::getInstance()->getRequest()->getParameter('shbx') ) {
        $this->widgetSchema['listing_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
          'model' => 'Listing', 
          'form_module' => 'listing', 
          'add_empty' => true,
          'order_by' => array('name', 'asc')  
        ));
        
        $this->widgetSchema['court_note_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
          'model' => 'CourtNote', 
          'form_module' => 'courtNote', 
          'add_empty' => true,
          'method' => 'getValue',
          'order_by' => array('value', 'asc')  
        ));
      //}
      
      $this->hideField('user_file_id');
      
      $this->addFee();
      $this->widgetSchema['Fee']->setLabel(false);
    }
    
    // add class to year to validate past dates
    $this->widgetSchema['date']->setAttribute('class', 'validateYear');

    // set method to load values to show
    $this->widgetSchema['court_id']->setOption('table_method', 'getCourtsCB');
    
    //$this->widgetSchema['coordinator_id']->setOption('method', 'obtainFullName');
    //$this->widgetSchema['coordinator_id']->setOption('table_method', 'getCoordinatorsCB');
    
    if (sfContext::getInstance()->getModuleName() == 'file') {
      // remove emptys
      $this->widgetSchema['court_id']->setOption('add_empty', false);
    }
    
    // sort some dropboxes
    $this->widgetSchema['listing_id']->addOption('order_by', array('name', 'asc'));
    
    // adding some extra validators
    //$this->widgetSchema['time'] = new sfWidgetFormTime();
    $this->widgetSchema['time'] = $this->formattedWidgetFormTime();
    $this->validatorSchema['time'] = new sfValidatorTime(array('required' => false));
    $this->validatorSchema['court_id']->setOption('required', true);
        
    /*$this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setSpecialValues')))
    );*/
    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
        new sfValidatorCallback(array('callback' => array($this, 'setSpecialValues'))),
        new sfValidatorCallback(array('callback' => array($this, 'setSpecialFeeValues')))
        )));
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
    
    // this formatting is applied only if form is called directly, without admin generator templates
    $first = ($this->getOption('first') !== null) ? $this->getOption('first') : false;
    $custom_decorator = new ExtendedFormSchemaFormatter($this->getWidgetSchema(), array('header' => $first));
    $this->widgetSchema->addFormFormatter('Myformatter', $custom_decorator);
    $this->widgetSchema->setFormFormatterName('Myformatter');
  }
  
  
  protected function doSave($con = null)
  {
    if ( (sfContext::getInstance()->getModuleName() == 'court')&&($this->widgetSchema['Fee']) ) {
      $forms = $this->embeddedForms;
      if (is_null($this->getValue('Fee'))) {
        if (null === $con) $con = $this->getConnection();     
        unset($forms['Fee']);
        $this->updateObject();
        $this->getObject()->save($con);
    
        $this->saveEmbeddedForms($con, $forms); // embedded forms
      }
      else parent::doSave($con);
    }
    else parent::doSave($con);
  }
  
  
  public function setSpecialValues($validator, $values)
  {
    // added by William, 02/05/2013
    if (sfConfig::get("app_icloudservice_active")) $this->saveICalDate($validator, $values);
    
    $values['time'] = $values['date'].' '.$values['time'];
    
    return $values;
  }

  
  public function setSpecialFeeValues($validator, $values)
  {
    if (sfContext::getInstance()->getModuleName() == 'file')  return $values;  // do not update fees
    
    $verify_required_fields = false;
    
    // fix a problem with dates: value is passed as arr instead as string
    $fee_detail_types = Fee::getFeeTypes('array');
    foreach ($values['Fee'] as $k => $value) { 
      if (in_array($k, $fee_detail_types)) {
        if (is_array($values['Fee'][$k]['date'])) {
          $datex = $values['Fee'][$k]['date'];
          $values['Fee'][$k]['date'] = empty($datex['year']) ? '0000' : $datex['year'];
          $values['Fee'][$k]['date'].= empty($datex['month']) ? '-00' : '-'.$datex['month'];
          $values['Fee'][$k]['date'].= empty($datex['day']) ? '-00' : '-'.$datex['day'];
        }
      }
    }
      
    foreach ($values['Fee'] as $k => $value) {
      //echo $k.' => '. $value.'<br/>';
      
      if (in_array($k, $fee_detail_types)) {
        foreach ($values['Fee'][$k] as $k1 => $value1) {
          //echo '.......'.$k1.' => '. $value1.'<br/>';
          
          // modified by William, 26/05/2013: only validate amounts
          /*if ( !($this->widgetSchema['Fee'][$k][$k1] instanceof sfWidgetFormInputHidden) && ($value1 != NULL) ) {
            if ($value1 != '0000-00-00') {  // do not consider the date empty values
              echo 'verify1';
              $verify_required_fields = true;
              break;
            }
          }*/
          if ( ($this->widgetSchema['Fee'][$k][$k1] instanceof sfWidgetFormInputText) && ($value1 != NULL) ) {
            //echo 'verify1';
            $verify_required_fields = true;
            break;
          }
          
        }
      }
      else if ( !($this->widgetSchema['Fee'][$k] instanceof sfWidgetFormInputHidden) && ($value != NULL) && ($k != 'groups_list') ) {    
        //echo 'verify2';
        $verify_required_fields = true;
      }
      
      if ($verify_required_fields) break;
    }
    
    if ($verify_required_fields) {
      //echo "verify";
      foreach ($values['Fee'] as $k => $value) {
        //echo $k .'=>'. $value.'<br/>';
        //if (!is_array($value)) {  // do not consider the fee details
          if ( $this->getEmbeddedForm('Fee')->validatorSchema[$k]->getOption('required') && ($value == NULL) ) {
            throw new sfValidatorError($validator, 'To save Fee and its details VLA? information must be filled!');
          }
        //}
      }
    }
    else { // all input fields in the embedded form are empty then unset the array values
      //echo "clear";
      foreach($values['Fee'] as $k => $v)  unset($values['Fee'][$k]);
      unset($values['Fee']);
    } 
    return $values;
  }
  
  
  public function saveICalDate($validator, $values)
  {
    // save only if new and it is not inside the user file form!
    if ( $this->isNew() && (sfContext::getInstance()->getModuleName() != 'file') ) {
      if (!$this->getObject()->saveICalDate($values)) {
        throw new sfValidatorError($validator, 'ICalendar date could not be saved. <b>ERROR:</b> '.$this->getObject()->getSaveICalDateStatus());
      }
      else {
        sfContext::getInstance()->getUser()->setFlash('info', $this->getObject()->getSaveICalDateStatus());
      }
    }
  }
  
  
  public function addFee()
  {
    $fee = $this->getObject()->getFee();
    $fee_form = new FeeForm($fee[0]);
    //unset($fee_form['court_id']);
    $this->embedForm('Fee', $fee_form);
    
    // validate only if there is values in the embedded form
    $this->validatorSchema['Fee'] = new sfValidatorPass(array('required' => false));    
  }
  
}
