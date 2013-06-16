<?php

/**
 * UserFile form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserFileForm extends BaseUserFileForm
{
  public function configure()
  {    
    // better than $this->useFields()
    unset($this['barrister_backsheet_options'], $this['barrister_fee'] /*, $this['barrister_id']*/);
    
    // added by William, 11/05/2013: to update client and non-closed user files that includes this client
    $this->widgetSchema['update_related_client_files'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['update_related_client_files']->setDefault(1);
    $this->validatorSchema['update_related_client_files'] = new sfValidatorPass();
    
    
    $this->setDefault('number', $this->getObject()->getNewFileNumber());
    $this->widgetSchema['number']->setAttribute('readonly', 'readonly');
    
    $this->setDefault('first_instructions_date', time());
    
    $state_choices = Doctrine_Core::getTable('sfGuardUserProfile')->getStates(); 
    $this->widgetSchema['state'] = new sfWidgetFormChoice(array(
      'choices'  => $state_choices, 'expanded' => false,
    ));
    $this->widgetSchema['state2'] = new sfWidgetFormChoice(array(
      'choices'  => $state_choices, 'expanded' => false,
    ));
        
    $this->widgetSchema['correspondence_title']->setLabel('Dear "First Name"');
    
    //$this->widgetSchema['instruction']->setAttributes(array('rows' => 20, 'cols' => 120));
    $this->widgetSchema['instruction']->setAttributes(array('rows' => 15, 'cols' => 60));
    
    $this->widgetSchema['honorific_id']->setOption('table_method', 'loadCivil');
    
    $this->widgetSchema['instruction_on_file'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['in_custody'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions()));
    $this->widgetSchema['bail_on_this'] = new sfWidgetFormChoice(array('choices' => Doctrine::getTable('UserFile')->getBailOnThisOptions()));
    
    $this->widgetSchema['correspondence_sent_option'] = new sfWidgetFormChoice(array('choices' => CommonTable::getCorrespondenceSentOptions()));
    
    
    //$this->widgetSchema['prison_id']->setOption('table_method', 'getPrisonsCB');
    $this->widgetSchema['prison_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Prison'), 
        'form_module' => 'agency?code=PRI', 
        'add_empty' => true,
        //'method' => 'obtainFullName',
        'table_method' => 'getPrisonsCB'
        ));
    
    $this->widgetSchema['status_id']->setOption('table_method', 'getUserFileStatus');
    $this->widgetSchema['status_id']->setOption('add_empty', false);
    
    $this->widgetSchema['client_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Client'), 
        'form_module' => 'client', 
        'add_empty' => true,
        'method' => 'obtainFullName',
        'table_method' => 'getClientsCB'
        ));
    //$this->widgetSchema['client_id']->setAttribute('onChange', 'updateLoadUserDataHref()');
    $this->widgetSchema['client_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['client_id']->setOption('renderer_options', array(
        'model' => $this->getRelatedModelName('Client'),
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=file&action=autocompleteclient'), //$autocomplete_url, //$this->getOption('url'),
        'config' => "{max: 20}",  //, minChars: 2}",
        'method' => 'obtainFullName'
    ));
    $this->widgetSchema->setHelp('client_id', '<span class="help"><font>HINT:</font> This Field is only for searching, nothing typed here will be saved, if you need to create or edit a user use the Add/Edit button</span>');
    
    /*$this->widgetSchema['client_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(array(
        'url' => 'autocompleteclient',
        'model' => $this->getRelatedModelName('Client'), 
        'value_callback' => 'findOneById',
        'config' => "{max: 10}"
        ));*/
    //$this->setValidator('client_id', new sfValidatorPass());
    
    $this->widgetSchema['informant_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Informant'), 
        'form_module' => 'informant', 
        'add_empty' => true,
        'method' => 'obtainFullName',
        'table_method' => 'getInformantsCB'
        ));
    $this->widgetSchema['informant_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['informant_id']->setOption('renderer_options', array(
        'model' => $this->getRelatedModelName('Informant'),
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=file&action=autocompleteinformant'), //$autocomplete_url, //$this->getOption('url'),
        'config' => "{max: 20}",  //, minChars: 2}",
        'method' => 'obtainFullName'
    ));
    $this->widgetSchema->setHelp('informant_id', '<span class="help"><font>HINT:</font> This Field is only for searching, nothing typed here will be saved, if you need to create or edit a user use the Add/Edit button</span>');
    
    $this->widgetSchema['prosecution_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Prosecution'), 
        'form_module' => 'prosecution', 
        'add_empty' => true,
        'table_method' => 'getProsecutionsCB'
        ));
    $this->widgetSchema['prosecution_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    $this->widgetSchema['prosecution_id']->setOption('renderer_options', array(
        'model' => $this->getRelatedModelName('Prosecution'),
        'url'   => sfContext::getInstance()->getController()->genUrl('@default?module=file&action=autocompleteprosecution'), //$autocomplete_url, //$this->getOption('url'),
        'config' => "{max: 20}",  //, minChars: 2}",
        /*'method' => 'obtainFullName'*/
        ));
    $this->widgetSchema->setHelp('prosecution_id', '<span class="help"><font>HINT:</font> This Field is only for searching, nothing typed here will be saved, if you need to create or edit a prosecution use the Add/Edit button</span>');
    
    $this->widgetSchema['prosecutor_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Prosecutor'), 
        'form_module' => 'prosecutor', 
        'add_empty' => true,
        'method' => 'obtainFullName',
        'table_method' => 'getProsecutorsCB'
        ));
    
    $this->widgetSchema['barrister_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Barrister'), 
        'form_module' => 'barrister', 
        'add_empty' => true,
        'method' => 'obtainFullName',
        'table_method' => 'getBarristersCB'
        ));
       
    $this->widgetSchema['solicitor_id']->setOption('method', 'obtainFullName');
    $this->widgetSchema['solicitor_id']->setOption('table_method', 'getSolicitorsCB');  
    
    $this->embedRelations(array('FileCourtDates' => array(
      'considerNewFormEmptyFields'    => array('time', 'listing_id', 'date', /*'coordinator_id'*/),
      'noNewForm'                     => false,
      'newFormLabel'                  => 'New',
      'newFormClass'                  => 'CourtDateForm',
      'newFormClassArgs'              => array(array('sf_user' => $this->getOption('sf_user'), 'first' => true)),
      'displayEmptyRelations'         => false,
      'existingRelationsFormLabel'    => 'Saved',
      'formClass'                     => 'CourtDateForm',
      'formClassArgs'                 => array(),
      'newFormAfterExistingRelations' => true,
      'formFormatter'                 => null,
      'multipleNewForms'              => true,
      'newFormsInitialCount'          => 1,
      'newFormsContainerForm'         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
      'newRelationButtonLabel'        => 'Add Court Date',
      'newRelationAddByCloning'       => true,
      'newRelationUseJSFramework'     => 'jQuery',
      'customEmbeddedFormLabelMethod' => false
      ),
                                'FileCharges' => array(
      'considerNewFormEmptyFields'    => array('item', 'section', 'acts', 'charge', 'comment', 'date', 'type_id'),
      'noNewForm'                     => false,
      'newFormLabel'                  => 'New',
      'newFormClass'                  => 'ChargeForm',
      'newFormClassArgs'              => array(array('sf_user' => $this->getOption('sf_user'), 'first' => true)),
      'displayEmptyRelations'         => false,
      'existingRelationsFormLabel'    => 'Saved',
      'formClass'                     => 'ChargeForm',
      'formClassArgs'                 => array(),
      'newFormAfterExistingRelations' => true,
      'formFormatter'                 => null,
      'multipleNewForms'              => true,
      'newFormsInitialCount'          => 1,
      'newFormsContainerForm'         => null, // pass BaseForm object here or we will create ahNewRelationsContainerForm
      'newRelationButtonLabel'        => 'Add Charge',
      'newRelationAddByCloning'       => true,
      'newRelationUseJSFramework'     => 'jQuery',
      'customEmbeddedFormLabelMethod' => false
      )
    ));
    
    $this->validatorSchema->setPostValidator(
            new sfValidatorCallback(array('callback' => array($this, 'setCustomValues')))
    );
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
  
  // update file number, to avoid concurrency
  public function setCustomValues($validator, $values) 
  {
    if ($this->isNew) {
      $values['number'] = $this->getObject()->getNewFileNumber();
    }
    return $values;
  }
  
  
  // added by William, 11/05/2013: to update client and non-closed user files that includes this client
  public function doSave($con = null)
  {
    parent::doSave($con);
    
    if ( isset($this->widgetSchema['update_related_client_files']) && ($this->getValue('update_related_client_files')>0) ) {
      $client_id = $this->getObject()->getClientId();
      $file_id = $this->getObject()->getId();
      $file_closed_status_id = 38;
      
      $client = Doctrine::getTable('SfGuardUser')->find($client_id);
      if ($client) {
        $client->setDataFromFile($this->getObject());
        $client->save($con);
      }
      
      $user_files = Doctrine::getTable('UserFile')->findBySql('client_id = ? AND status_id != ? AND id != ?', array($client_id, $file_closed_status_id, $file_id));
      if ($user_files) {
        foreach ($user_files as $user_file) {
          $user_file->setUserData($client_id, $this->getObject(), 'userfile');
          $user_file->save($con);
        }
      }
    }
  }
  
  
}