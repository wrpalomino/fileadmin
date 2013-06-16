<?php

/**
 * Document form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentForm extends BaseDocumentForm
{
  private $mandatory_fields;
  private $LETTER_ADDRESS_WIDTH;
  
  public function configure()
  {
    $this->mandatory_fields = array('code', 'court_date_id', 'user_file_id', 'document_type_id', 'updated_by_id');
    
    $this->LETTER_ADDRESS_WIDTH = 35;  // make the textarea wider.
    
    $this->widgetSchema['code'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['court_date_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['user_file_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['document_type_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['updated_by_id'] = new sfWidgetFormInputHidden();
    
    // added by William, 17/05/2013: save some parameters for the document
    $this->mandatory_fields[] = 'description';
    $this->widgetSchema['description'] = new sfWidgetFormInputHidden();
    
    // added by William, 17/05/2013: save the document date
    $this->mandatory_fields[] = 'doc_date';
    $this->widgetSchema['doc_date'] = new sfWidgetFormInputHidden();
    
    // added by William, 18/05/2013: save extra parameter for buffer document ONLY
    $this->mandatory_fields[] = 'name';
    $this->widgetSchema['name'] = new sfWidgetFormInputHidden();
    
    
    if ($this->isNew()) {
      $doc_params = sfContext::getInstance()->getUser()->getAttribute('doc_params', null);
      if ($doc_params) {
        $this->setDefault('code', $doc_params['code']);
        $this->setDefault('court_date_id', $doc_params['court_date_id']);
        $this->setDefault('user_file_id', $doc_params['user_file_id']);
        $this->setDefault('document_type_id', $doc_params['document_type_id']);
        $this->setDefault('updated_by_id', $doc_params['updated_by_id']);
      }
    }
    
    // lets check if it comes from new or edit
    $doc_obj = Doctrine::getTable('Document')->find(sfContext::getInstance()->getRequest()->getParameter('id'));
    if ($doc_obj) {  // edit
      $doc = ($doc_obj) ? $doc_obj->getDocumentType()->getShortName() : null;
    }
    else { // new
      $doc = sfContext::getInstance()->getRequest()->getParameter('doc');
    }
    if ($doc) sfContext::getInstance()->getUser()->setAttribute ('doc', $doc);
    else $doc = sfContext::getInstance()->getUser()->getAttribute ('doc', '');
    
    $func = 'loadDocTpl'.$doc;
    $this->$func($doc);
    
    // added by William, 02/06/2013: to add inplacesave for textareas
    if (sfContext::getInstance()->getUser()->hasCredential('EDIT-DOCTEXT')) $this->setSaveInPlace();
    
    /*$this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array('callback' => array($this, 'setCustomValues')))
    );*/ 
    
    $document_decorator = new DocumentFormSchemaFormatter($this->getWidgetSchema());
    $this->widgetSchema->addFormFormatter('DocumentFormatter', $document_decorator);
    $this->widgetSchema->setFormFormatterName('DocumentFormatter');
  }
  
  public function setSaveInPlace()
  {
    // only for textareas
    $ta_fields = array('field17', 'field18', 'field19');
    
    foreach ($ta_fields as $ta_field) {
      $getMethod = 'get'.ucfirst($ta_field);
      $text = $this->getObject()->$getMethod();
      $secure_text = (($text != '') && (strpos($text, "%%") === false)); // do not edit templates with vars
      $secure_field = (isset($this->widgetSchema[$ta_field]) && ($this->widgetSchema[$ta_field] instanceof sfWidgetFormTextarea));
      if ($secure_field && $secure_text) { 
        $attr = $this->widgetSchema[$ta_field]->getAttributes();
        if ( !empty($attr) && isset($attr['class']) ) $attr['class'].= ' editableTextArea';
        else $attr['class'] = 'editableTextArea';
        $this->widgetSchema[$ta_field]->setAttributes($attr);
        //echo '==='.$this->getObject()->getField17().'====';
      }
    }
  }
  
  
  /*public function setCustomValues($validator, $values)  // it does not work!!!!!!!!
  {
    if ($values['name'] != '') {
      $temp = explode('-', $values['code']);
      $temp[2] = $values['name'];
      $values['code'] = implode('-', $temp);
      $values['name'] = '';
    }
    return $values;
  }*/
  
  
  public static function CheckboxsFormatter2($widget, $inputs) 
  {
    return self::CheckboxsFormatter($widget, $inputs, array('columns' => 2));
  }
  
  
  public static function CheckboxsFormatter($widget, $inputs, $params=array()) 
  {
    $result = '';
    $cont = 0;
    $columns = (isset($params['columns'])) ? $params['columns'] : 1;
    
    foreach ($inputs as $input) {
      if ($cont == 0) $result .= '<tr>';
      elseif ($cont % $columns == 0)  $result .= '</tr><tr>';
      
      $result .= '<td>' . $input ['input'] . ' </td><td>  ' . $input ['label'] . '</td>';
      ++$cont;
    }
    
    if ($result != '') {
      while ($cont % $columns != 0) {
        $result .= '<td>&nbsp;</td><td></td>';
        ++$cont;
      }
      $result = '<table class="choice_checks">'.$result.'</tr></table>';
    }
      
    return $result;
  }
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /**************************************** CLIENT section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /**************************************** CORRESPONDENCE ****************************************/
  // Adjournment Letter - First Mention
  public function loadDocTplAdlefm($doc, $extra_fields=array())
  {
    $address_textarea_rows = 4;
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5',
                    'field6',   'field7',   'field8',   'field9',   'field17'
        );
    foreach ($extra_fields as $xfield) $fields[] = $xfield;
    
    // set a drop box with default texts if the document has default texts
    $text_arr = CommonObject::retrieveDefaultValues($doc);
    if ($text_arr) {      
      $this->widgetSchema['field16'] = new sfWidgetFormChoice(
              array('choices' => $text_arr),
              array('class' => 'doc_field hidden', 'onchange' => "loadFromDropBoxToTextArea(this, 'document_field18')")
              );
      $this->widgetSchema['field18'] = new sfWidgetFormTextarea(
              array(), 
              array('style' => 'display:none; width:580px; height:50px; border:none; font:inherit')
              );
      $fields[] = 'field16';
      $fields[] = 'field18';
    }
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field3'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field3']->setAttributes(array('class' => 'doc_field', 'rows' => '4'));
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field', 'rows' => $address_textarea_rows, 'cols' => $this->LETTER_ADDRESS_WIDTH));
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field_long_important');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field_important');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '15'));
  }
  
  // Adjournment Letter - General
  public function loadDocTplAdlege($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Appointment - Make & Bring Docs
  public function loadDocTplApmabd($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Appointment - Make
  public function loadDocTplAplema($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Appointment - Confirm
  public function loadDocTplApcomf($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Brief - Forward Copy
  public function loadDocTplBrfwcp($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Brief - Received Make Appt (Through Staff)
  public function loadDocTplBrrmat($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Brief - Received Make Appt
  public function loadDocTplBrrmap($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Brief - Waiting & Will Forward Copy
  public function loadDocTplBrwwfc($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Brief - Waiting & Will Ring on Reciept
  public function loadDocTplBrwwrr($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Callover Letter
  public function loadDocTplClovle($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Cease to Act - No Contact
  public function loadDocTplCanoco($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Cease to Act - No Funding
  public function loadDocTplCanofu($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Cease to Act - Not Sent Legal Aid Docs
  public function loadDocTplCansla($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Document - Provide
  public function loadDocTplDocpro($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Fail to Answer Summons
  public function loadDocTplFtasum($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Fail to Answer Bail
  public function loadDocTplFtabai($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Legal Aid - Provide Signed Form
  public function loadDocTplLapsfo($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Legal Aid - Form Filled Out Over Phone
  public function loadDocTplLaffop($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Legal Aid - Provide Filled Out Form
  public function loadDocTplLapfof($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Legal Aid - New Means After 12 Months
  public function loadDocTplLanmam($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Legal Aid Refused
  public function loadDocTplLarefu($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Letter - Miscellaneous
  public function loadDocTplLemisc($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Psychologist - Confirm Appt & Fees
  public function loadDocTplPocafe($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Psychologist - Confirm Appt (Legal Aid)
  public function loadDocTplPocoac($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Psychiatrist - Confirm Appt & Fees
  public function loadDocTplPicafe($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Psychiatrist - Confirm Appt (Legal Aid)
  public function loadDocTplPicoac($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Result Letter - Interim
  public function loadDocTplRelein($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Result Letter - Final Magistrates
  public function loadDocTplRelefm($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Result Letter - Final Count/Supreme
  public function loadDocTplRelefc($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  
  /***************************************** AUTHORITIES ******************************************/
  // Bank Authority
  public function loadDocTplBanaut($doc)
  {
    $this->loadDocTplClkacl($doc, array('field1'));
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    unset($this['field2']);
  }
  
  // Caveat Authority
  public function loadDocTplCavaut($doc)
  {
    $this->loadDocTplClkacl($doc);
    unset($this['field2'], $this['field3']);
  }

  // Centrelink Authority (Client)
  public function loadDocTplClkacl($doc, $extra_fields=array())
  {
    $rows = 4;
    
    $fields = array('field2',   'field3',   'field4',   'field5',   'field8',   'field9');
    foreach ($extra_fields as $xfield) $fields[] = $xfield;
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field8'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_important');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field third', 'rows' => $rows));
    $this->widgetSchema['field8']->setAttributes(array('class' => 'doc_field third', 'rows' => $rows));
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');    
  }
  
  // Centrelink Authority (non-Client)
  public function loadDocTplClkanc($doc) 
  {
    $this->loadDocTplClkacl($doc, array('field1'));
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
  }
  
  // Credit Card Authority
  public function loadDocTplCrcdau($doc)
  {
    $this->loadDocTplClkacl($doc);
    unset($this['field2']);
  }
  
  // Credit Card Authority (non-Client)
  public function loadDocTplCcaunc($doc)
  {
    $this->loadDocTplClkacl($doc, array('field6'));
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field_important');
    unset($this['field2'], $this['field5']);
  }
  
  // Fax - Enclosing File Authority
  public function loadDocTplFaxefa($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // File Collection Authority
  public function loadDocTplFicoau($doc)
  {
    // NO TEMPLATE FOR THIS DOCUMENT TYPE, USING SIMILAR (Solicitor - File Authority), IT MAY REQUIRE CHANGE CONTENT
    $this->loadDocTplMefage($doc);
  }
  
  // General - File Authority
  public function loadDocTplGefiau($doc)
  {
    // NO TEMPLATE FOR THIS DOCUMENT TYPE, USING SIMILAR (Solicitor - File Authority), IT MAY REQUIRE CHANGE CONTENT
    $this->loadDocTplMefage($doc);
  }
  
  // Letter - Enclosing File Authority
  public function loadDocTplLeefau($doc)
  {
    // NO TEMPLATE FOR THIS DOCUMENT TYPE, USING SIMILAR (Letter - Informant), IT MAY REQUIRE CHANGE CONTENT
    $this->loadDocTplCccole($doc);
  }
  
  // Medical - File Authority (General)
  public function loadDocTplMefage($doc) 
  {
    $this->loadDocTplClkacl($doc);
    unset($this['field2']);
  }
  
  // Medical - File Authority (Justice health)
  public function loadDocTplMefajh($doc) 
  {
    $fields = array('field1',   'field2');
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_important');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
  }
  
  // Solicitor - File Authority
  public function loadDocTplSofiau($doc) 
  {
    $this->loadDocTplMefage($doc);
  }
  
  // Solicitor Holding Trust Monies - File Authority
  public function loadDocTplSohtmo($doc) 
  {
    $this->loadDocTplMefage($doc);
  }
  
  
  /********************************************* FORMS ************************************************/
  // Affidavit - Sworn
  public function loadDocTplAffswo($doc, $extra_fields=array())
  {
    $doc_extra_fields = array('field1', 'field3', 'field8', 'field11', 'field12', 'field13', 'field17');
    if (!empty($extra_fields)) $doc_extra_fields = array_merge($doc_extra_fields,$extra_fields);
    $this->loadDocTplF32adj($doc, $doc_extra_fields);
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field8'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => 4));
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '7'));
        
    // increase the size of fields for client and prosecutor/informant/or other
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long');
  }
  
  // Affidavit - Affirmed
  public function loadDocTplAffaff($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Affidavit (Solicitor Attesting) - Sworn
  public function loadDocTplAffsas($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Affidavit (Solicitor Attesting) - Affirmed
  public function loadDocTplAffsaa($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Affidavit - Exhibit Cover Sheet
  public function loadDocTplAffecs($doc)
  {
    $this->loadDocTplF32adj($doc);
  }
  
  // Character Reference - Fax Cover
  public function loadDocTplCrfxco($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Character Reference Guide - New Client
  public function loadDocTplCrgunc($doc) 
  {
    $this->loadDocTplAdlefm($doc);
    unset($this['field4']);
  }

  // Character Reference Guide - 3rd party
  public function loadDocTplCrgutp($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Character Reference - Magistrates` Court
  public function loadDocTplCrmaco($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Character Reference - Other Court
  public function loadDocTplCrotco($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // FOI Request Form
  public function loadDocTplFoirqf($doc)
  {
    $fields = array('field1',   'field2',   'field3',   'field4',   'field17');
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field3'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field3']->setAttributes(array('class' => 'doc_field', 'rows' => '3'));
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '15'));
  }
  
  // FOI Request - Provide Signed Form
  public function loadDocTplFoirps($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // FOI Request - Cover Letter
  public function loadDocTplFoircl($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Restoration of Licence - Standard Questions
  public function loadDocTplRelisq($doc)
  {
    // this document does not required any form, it is plain text only
  }
  
  // Statutory Declaration - Misc
  public function loadDocTplStdemi($doc)
  {
    $this->loadDocTplClkacl($doc, array('field17'));
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '7'));
  }
  
  // Statutory Declaration - Misc (Solicitor Attesting)
  public function loadDocTplStdesa($doc)
  {
    $this->loadDocTplStdemi($doc);
  }
  
  // Statutory Declaration - No Income
  public function loadDocTplStdeni($doc)
  {
    $this->loadDocTplStdemi($doc);
  }
  
  // Statutory Declaration - No Income (Solicitor Attesting)
  public function loadDocTplStdens($doc)
  {
    $this->loadDocTplStdemi($doc);
  }
  
  
  /***************************************** INSTRUCTIONS *****************************************/
  // Country Plea Outline
  public function loadDocTplCoplou($doc)
  {
    $this->loadDocTplGenins($doc);
    //unset($this['field17']);
  }
  
  // General Instructions
  public function loadDocTplGenins($doc)
  {
    $fields = array('field1',   'field2',   'field4',   'field5',   'field17');
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field third', 'rows' => 3));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 40));
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /*************************************** INFORMANT section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /**************************************** CORRESPONDENCE ****************************************/
  // Alibi Notice
  public function loadDocTplAlinot($doc)
  {
    $this->loadDocTplF32adj($doc, array('field3', 'field8', 'field17'));
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field_long', 'rows' => 6));
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 18));
  }
  
  // Appeal Notice - Fax
  public function loadDocTplApnofx($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Chief Commissioner - Costs letter
  public function loadDocTplCccole($doc)
  {
    $this->loadDocTplAdlefm($doc, array('field10'));
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_important');
  }
  
  // Contest Mention - Fax
  public function loadDocTplComefx($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Damages/Restitution - Details Sought
  public function loadDocTplDrdeso($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Diversion Letter
  public function loadDocTplDivlet($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Documents - Request Further
  public function loadDocTplDorefu($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Fax - Informant
  public function loadDocTplFaxinf($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Fail to Appear - Summons Single Informant
  public function loadDocTplFtassi($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Fail to Appear - Summons Multiple Informants
  public function loadDocTplFtasmi($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Infringement Notice - Objection Letter
  public function loadDocTplInoble($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Interview Recording Request
  public function loadDocTplInrere($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Letter - Informant
  public function loadDocTplLetinf($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Rebail - Multiple Informants
  public function loadDocTplRemuin($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Rebail - Single Informant
  public function loadDocTplResiin($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Section 32C - Confidential Comms. Application to Issue Subpoena
  public function loadDocTplS32cas($doc)
  {
    $this->loadDocTplAffswo($doc, array('field18', 'field19'));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 4));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field_long with_border', 'rows' => 4));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field_long with_border', 'rows' => 4));
    unset($this['field5']);
  }
  
  // Section 32C - Confidential Comms. (Magistrates)
  public function loadDocTplS32cma($doc)
  {
    $this->loadDocTplAffswo($doc);
    $this->widgetSchema['field5'] = new sfWidgetFormInputText(array(), array('class' => 'doc_field_long'));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 5));
  }
  
  // Section 32C - Confidential Comms. (Other Courts)
  public function loadDocTplS32coc($doc)
  {
    $this->loadDocTplS32cma($doc);
  }
  
  // Section 342 - Prior Sex (Magistrates)
  public function loadDocTplS34psm($doc)
  {
    $this->loadDocTplS32cma($doc);
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 13));
    unset($this['field13']);
  }
  
  // Section 342 - Prior Sex (Other Courts)
  public function loadDocTplS34pso($doc)
  {
    $this->loadDocTplS34psm($doc);
  }
  
  // Witness Priors - Request
  public function loadDocTplWiprre($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  
  /******************************************* BRIEFS *********************************************/
  // Brief Request 1
  public function loadDocTplBrirq1($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Brief Request 2
  public function loadDocTplBrirq2($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Brief Request 3
  public function loadDocTplBrirq3($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Brief Request 4
  public function loadDocTplBrirq4($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  
  /***************************************** PROSECUTORS ******************************************/
  // Fax - Enclosing Adjournment
  public function loadDocTplFxenad($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Fax - Enclosing Documents
  public function loadDocTplFxendc($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Fax - Miscellaneous
  public function loadDocTplFxmisc($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Letter to Prosecutors
  public function loadDocTplLttops($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Summary Case Conference Letter
  public function loadDocTplSccolt($doc)
  {
    $this->loadDocTplCccole($doc);
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 20));
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /************************************** COURT DATE section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /********************************************* RESULTS *************************************************/
  // Case Study
  public function loadDocTplCasstu($doc)
  {
    $this->loadDocTplAdlefm($doc, array('field18', 'field19'));
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field_long', 'rows' => 3));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 8));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field_long', 'rows' => 6));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field_long', 'rows' => 6));
  }
  
  // Email Result to Solicitor
  public function loadDocTplErtsol($doc)
  {
    $this->loadDocTplAdlefm($doc, array('field10', 'field11', 'field12', 'field13'));
    
    $yes_no_options = Doctrine::getTable('UserFile')->getYesNoNcOptions();
    $this->widgetSchema['field11'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field12'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    $this->widgetSchema['field13'] = new sfWidgetFormChoice(array('choices' => $yes_no_options));
    
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 5));
    unset($this['field9']);
  }
  
  // Filenote - of Result
  public function loadDocTplFilore($doc, $extra_fields=array())
  {
    $this->loadDocTplAdlefm($doc, $extra_fields);
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 6));
  }

  // Result - Final Letter (Mags)
  public function loadDocTplReflma($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Result - Final Letter (Other)
  public function loadDocTplReflot($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Result - Interim Letter
  public function loadDocTplReinle($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Result Sheet - Final
  public function loadDocTplReshfi($doc)
  {
    $this->loadDocTplFilore($doc, array('field10'));
    $this->widgetSchema['field3']->setAttributes(array('class' => 'doc_field', 'rows' => 3));
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long');
  }
  
  // Result Sheet
  public function loadDocTplReshee($doc)
  {
    $rows = 3;
    
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5',   'field6',
                    'field7',   'field8',   'field9',   'field10',  'field11',  'field12',
                    'field13',  'field14',  'field15',  'field16',  'field17',  'field18',
        );
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field3'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short with_border centered');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_short smaller_font');
    $this->widgetSchema['field3']->setAttributes(array('class' => 'doc_field smaller_font', 'rows' => $rows));
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field larger_font');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field', 'rows' => $rows));
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field with_border full');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field_long_important');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field with_border full');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field smaller_font');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field with_border full');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field'); 
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field16']->setAttribute('class', 'doc_field smaller_font');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 20));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field_long with_border', 'rows' => 20));
  }
  
  
  /********************************* RESULTS : DRINK DRIVE LETTERS ********************************/
  // Drink Driving Result
  public function loadDocTplDrdrre($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Interlock Removal
  public function loadDocTplInlrev($doc)
  {
    $this->loadDocTplAdlefm($doc);
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 2));
  }
  
  // License Restoration Pending Letter
  public function loadDocTplLrpelt($doc)
  {
    $this->loadDocTplAdlefm($doc);
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 2));
  }
  
  // Result of License Restoration
  public function loadDocTplRelirs($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  
  // CONSIDER MOVE THIS SECTION TO AGENCIES: PRISON
  /************************************* RESULTS : CUSTODY STATUS *********************************/
  // Request CRN Number (ALREADY DEFINED IN PRISONS) 
  public function loadDocTplRcrnn1($doc) 
  {
    $this->loadDocTplRcrnnb($doc);
  }
  
  // Request CRN Number and Location (ALREADY DEFINED IN PRISONS) 
  public function loadDocTplRcrna1($doc) 
  {
    $this->loadDocTplRcrnal($doc);
  }
  
  // Request Gaol (SIMILAR TO "Request Prison Location")
  public function loadDocTplRqsgao($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // YTC Location (ALREADY DEFINED IN PRISONS) 
  public function loadDocTplYtclo2($doc) 
  {
    $this->loadDocTplYtcloc($doc);
  } 
 
  
  /************************************** SUMMARY ADJOURNMENTS ************************************/
  // Adjourn to Contest Mention
  public function loadDocTplAdcome($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Adjourn to Contest Mention -  No response to SCC Request
  public function loadDocTplAdcmnr($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Adjourn to Consolidation Plea
  public function loadDocTplAdcopl($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Adjourn to Guilty Plea
  public function loadDocTplAdgupl($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Adjourn to Summary case Conference
  public function loadDocTplAdsucc($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // First Mention on Summons - Adjourn to Further Mention
  public function loadDocTplFmsafm($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Miscellaneous - Adjourn to Further Mention
  public function loadDocTplMisafm($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // No Brief - Adjourn to Further Mention
  public function loadDocTplNobafm($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // No Instructions - Adjourn to Further Mention
  public function loadDocTplNiatfm($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Time Certainty
  public function loadDocTplTimcer($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  
  /******************************************* CHILDREN ***************************************************/
  // Affidavit of Service public (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplAfofs1($doc) 
  {
    $this->loadDocTplAfofse($doc);
  }
  
  // Bail Application - First Time (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplBafit1($doc)
  {
    $this->loadDocTplBafiti($doc);
  }
  
  // Bail Application - Previous Refusal (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplBaprr1($doc)
  {
    $this->loadDocTplBaprre($doc);
  }
  
  // Bail Application - Variation of Conditions (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplBavoc1($doc)
  {
    $this->loadDocTplBavoco($doc);
  }
  
  // Cease to Act (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplCetoa1($doc) 
  {
    $this->loadDocTplCetoac($doc);
  }
  
  // Certified Extract - Request (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplCeexr1($doc)
  {
    $this->loadDocTplCeexre($doc);
  }
  
  // Digital Recording - Request (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplDirer1($doc)
  {
    $this->loadDocTplDirere($doc);
  }
  
  // Fax to Children`s Court
  public function loadDocTplFxchco($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Gaol Order (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplGaoor1($doc) 
  {
    $this->loadDocTplGaoord($doc);
  }
  
  // Gaol Order - fax to YTC Enclosing (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplGofty1($doc) 
  {
    $this->loadDocTplGoftye($doc);
  }
  
  // Gaol Order - fax to Magistrate to Sign (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplGoftm1($doc) 
  {
    $this->loadDocTplGoftms($doc);
  }
  
  // General Application (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplGenap1($doc) 
  {
    $this->loadDocTplGenapp($doc);
  }
  
  // Letter to Children`s Court
  public function loadDocTplLechco($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Ropes Program
  public function loadDocTplRoppro($doc)
  {
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5',
                    'field6',   'field7',   'field8',   'field9',   'field10',
                    'field11',  'field12',  'field13',  'field14',
        );
    $this->useFields(array_merge($this->mandatory_fields, $fields));
      
    $this->widgetSchema['field7'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field8'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field full');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field full');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field', 'rows' => '3'));
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field', 'rows' => '3'));
    $this->widgetSchema['field8']->setAttributes(array('class' => 'doc_field', 'rows' => '3'));
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field full');
    
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field_short');
  }
  
  // Time Certainty (ALREADY DEFINED IN SUMMARY ADJOURNMENTS) 
  public function loadDocTplTimce1($doc)
  {
    $this->loadDocTplTimcer($doc);
  }
  
  // Witness Summons (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplWitsu1($doc) 
  {
    $this->loadDocTplWitsum($doc);
  }
  
  
  /***************************************** MAGISTRATES ******************************************/
  // Affidavit of Service
  public function loadDocTplAfofse($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Bail Application - First Time
  public function loadDocTplBafiti($doc, $extra_fields=array())
  {
    $fields = array('field1',     'field2',     'field3',     'field4',     'field5',
                    'field6',     'field7',     'field8',     'field9',     'field10',
                    'field11',    'field12',    'field13',    'field14',    'field15',
                    'field16',    'field17',    'field18');
   
    if (!empty($extra_fields)) $fields = array_merge($fields, $extra_fields);
    $this->useFields(array_merge($this->mandatory_fields, $fields));
        
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['field14'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getBailApplicationOptions("to"),
        'expanded' => true,
        'multiple' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    
    $this->widgetSchema['field16'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getBailApplicationOptions("summary_indictable"),
        'expanded' => true,
        'multiple' => true)
    );
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field full');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field full', 'rows' => '3'));
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field_long_important');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field_short important');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field smaller_font');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field half', 'rows' => '4'));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => '4'));
    
    if ($doc != 'bavoco') {
      $documentDetailForm = new DocumentDetailForm($this->object->DocumentDetail[0], array('doc' => $doc));
      $this->embedForm('DocumentDetail', $documentDetailForm);
    }
  }
  
  // Bail Application - Previous Refusal
  public function loadDocTplBaprre($doc)
  {
    $this->loadDocTplBafiti($doc, array('field19', 'field20'));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => '4'));
    $this->widgetSchema['field20']->setAttributes(array('class' => 'doc_field full with_border', 'rows' => '2'));
  }
  
  // Bail Application - Variation of Conditions
  public function loadDocTplBavoco($doc)
  {
    $this->loadDocTplBafiti($doc) ;
    $this->widgetSchema['field16'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => '4'));
    $this->widgetSchema['field17'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => '4'));
  }
  
    // Cease to Act
  public function loadDocTplCetoac($doc)
  {
    $fields = array('field3',   'field4',   'field7',  'field8',   'field9',   
                    'field10',    'field17');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field3'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field7'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    
    $this->widgetSchema['field3']->setAttributes(array('class' => 'doc_field', 'rows' => '5'));
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field', 'rows' => '4'));
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '10'));
  }
  
  // Certified Extract - Request
  public function loadDocTplCeexre($doc)
  {
    $this->loadDocTplCccole($doc);
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field', 'rows' => '5'));
  }
  
  // Digital Recording - Request
  public function loadDocTplDirere($doc)
  {
    $fields = array('field3',   'field4',   'field8',     'field9',     'field10',
                    'field11',  'field12',  'field13',    'field14',    'field15',    'field17');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field15'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field15']->setAttributes(array('class' => 'doc_field', 'rows' => '4'));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '4'));
  }
  
  // Case Abridgement - Application
  public function loadDocTplCaabap($doc)
  {
    $fields = array('field3',   'field4',     'field6',     'field7',     'field8',
                    'field9',   'field10',    'field11',    'field12',    'field13',
                    'field14',    'field15',  'field17');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    $yes_no_options = Doctrine::getTable('UserFile')->getYesNoNcOptions(false, false);
    
    $this->widgetSchema['field7'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    $this->widgetSchema['field13'] = new sfWidgetFormChoice(array('choices' => $yes_no_options, 'expanded' => true));
    $this->widgetSchema['field14'] = new sfWidgetFormChoice(array('choices' => $yes_no_options, 'expanded' => true));
    $this->widgetSchema['field15'] = new sfWidgetFormChoice(array('choices' => $yes_no_options, 'expanded' => true));
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field', 'rows' => '2', 'cols' => $this->LETTER_ADDRESS_WIDTH));
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    //$this->widgetSchema['field13']->setAttribute('class', 'doc_field');
    //$this->widgetSchema['field14']->setAttribute('class', 'doc_field');
    //$this->widgetSchema['field15']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long with_border', 'rows' => '4'));
  }

  // Fax to Court Registry/Coordinator 
  public function loadDocTplFxcorc($doc, $extra_fields=array())
  {
    $rows = ($doc != 'fxcorc') ? 30 : 25; 
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5',
                    'field6',   'field7',   'field8',   'field9',   'field10',   
                    'field11',  'field17');
    
    if (!empty($extra_fields)) $fields = array_merge($fields, $extra_fields);
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
  
    $this->widgetSchema['field3'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => '4'));
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_important');
    $this->widgetSchema['field5']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field_long_important');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field_short_important');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => $rows));  
  }
  
  // Gaol Order
  public function loadDocTplGaoord($doc)
  {
    $fields = array('field1',     'field2',     'field3',     'field4',   'field5',
                    'field6',     'field7',     'field8',     'field9',   'field10',
                    'field11',    'field12',    'field13',    'field14',  'field15',
                    'field16',    'field17',    'field18');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => 2, 'cols' => $this->LETTER_ADDRESS_WIDTH));
    
    $yes_no = array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions(false, false), 'expanded' => true);
    $this->widgetSchema['field12'] = new sfWidgetFormChoice($yes_no);
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');

    $this->widgetSchema['field13']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field16']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field full', 'rows' => 3));  
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 3));  
  }
  
  // Gaol Order - fax to YTC Enclosing
  public function loadDocTplGoftye($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Gaol Order - fax to Magistrate to Sign
  public function loadDocTplGoftms($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // General Application
  public function loadDocTplGenapp($doc)
  {
    $fields = array('field3',   'field4',   'field5',     'field7',    'field8',
                    'field10',  'field11',  'field17',    'field18');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field7'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field11'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field_long', 'rows' => '2'));
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field', 'rows' => '4'));
    //$this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field11']->setAttributes(array('class' => 'doc_field_long', 'rows' => '2'));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '6'));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field_long', 'rows' => '6'));
  }
  
  // Letter to Magistrate`s Court
  public function loadDocTplLemaco($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Video Link Request
  public function loadDocTplVilkre($doc)
  {
    $fields = array('field3',     'field4',     'field8',     'field9',   'field10',
                    'field11',    'field12',    'field13',    'field14',  'field15');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field13'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getHearingTypeOptions(), 
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter'))
        ));
    //$this->validatorSchema['field13'] = new sfValidatorChoice(array('choices' => array_keys($hearing_types_options)));
    
    $this->widgetSchema['field14'] = new sfWidgetFormChoice(array(
        'choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions(false), 
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter'))
        ));
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('style', 'width:20px');
    $this->widgetSchema['field14']->setAttribute('style', 'width:20px');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field');
  }
  
  // Witness Summons
  public function loadDocTplWitsum($doc)
  {
    $fields = array('field1',     'field2',     'field3',     'field4',     'field5',
                    'field6',     'field7',     'field8',     'field9',     'field10',
                    'field11',    'field12',    'field13',    'field14',    'field15',
                    'field16',    'field17',    'field18',    'field19');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => '4'));
    $this->widgetSchema['field2'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => '3', 'cols' => $this->LETTER_ADDRESS_WIDTH));
    $this->widgetSchema['field11'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full with_border', 'rows' => '3'));
    $this->widgetSchema['field14'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => '4'));
    $this->widgetSchema['field15'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => '2', 'cols' => $this->LETTER_ADDRESS_WIDTH));
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field16']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field full with_border', 'rows' => '2'));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full with_border', 'rows' => '4'));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full with_border', 'rows' => '2'));
    
    $documentDetailForm = new DocumentDetailForm($this->object->DocumentDetail[0], array('doc' => $doc));
    $this->embedForm('DocumentDetail', $documentDetailForm);
  }
  
  // Application to Vary Bail
  public function loadDocTplApvaba($doc)
  {
    $fields = array('field1',     'field2',     'field3',     'field4',     'field5',
                    'field6',     'field7',     'field8',     'field9',     'field10',
                    'field11',    'field12',    'field13',    'field14',    'field15',
                    'field16',    'field17',    'field18',    'field19');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field17'] = new sfWidgetFormInput(array(), array('class' => 'doc_field_long'));
    $this->widgetSchema['field2'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => '2', 'cols' => $this->LETTER_ADDRESS_WIDTH));
        
    $this->widgetSchema['field1'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getVaryBailApplicationOptions('amount_conditions'),
        'expanded' => true,
        'multiple' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter'))
        ));
    $this->widgetSchema['field9'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getVaryBailApplicationOptions('admitted_conditions'), 
        'expanded' => true,
        'multiple' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter'))
        ));
    $this->widgetSchema['field11'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getVaryBailApplicationOptions('surety'), 
        'expanded' => true,
        ));
    $this->widgetSchema['field12'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getVaryBailApplicationOptions('vary_conditions'), 
        'expanded' => true,
        ));
    
    $this->widgetSchema['field16'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'varying the amount of bail fixed'));
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field5']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');    
    $this->widgetSchema['field10']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 10));
    
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field_short');
    
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => '4'));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => '5'));
  }
  
  // Notice of Appeal s51
  public function loadDocTplNoap51($doc)
  {
    $fields = array('field2',     'field3',     'field4',     'field5',
                    'field6',     'field7',     'field8',     'field9',     'field10',
                    'field11',    'field12',    'field13',    'field14',    'field15',
                    'field16',    'field17');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field2'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => '2', 'cols' => $this->LETTER_ADDRESS_WIDTH));
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field5']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field16']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field full', 'rows' => '4'));
  }
  
  // Request for contested form12
  public function loadDocTplRecofr($doc)
  {
    $fields = array('field1',     'field2',     'field3',     'field4',     'field5',
                    'field6',     'field7',     'field8',     'field9',     'field10',
                    'field11',    'field12',    'field13',    'field14',    'field15',
                    'field16',    'field17',    'field18',    'field19');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field2'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => '2', 'cols' => $this->LETTER_ADDRESS_WIDTH));
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field5'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getRequestContestedOptions(),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter'))
        ));
    
    $yes_no = array('choices' => Doctrine::getTable('UserFile')->getYesNoNcOptions(false, false), 'expanded' => true);
    $this->widgetSchema['field8'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field10'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field11'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field12'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field13'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field14'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field15'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field16'] = new sfWidgetFormChoice($yes_no);
    $this->widgetSchema['field1'] = new sfWidgetFormChoice($yes_no);
 
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field_short'); 
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field full', 'rows' => '8'));    
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field half', 'rows' => '1'));    
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => '1'));  
    
    $documentDetailForm = new DocumentDetailForm($this->object->DocumentDetail[0], array('doc' => $doc));
    $this->embedForm('DocumentDetail', $documentDetailForm);
    
    $documentDetailForm2 = new DocumentDetailForm($this->object->DocumentDetail[1], array('doc' => $doc));
    $this->embedForm('DocumentDetail2', $documentDetailForm2);
  }
  
  // Audio Visual Link Form44 (ALREADY DEFINED IN COMMITTAL STREAM) 
  public function loadDocTplVlntc1($user_file) 
  {
    $this->loadDocTplVlntcr($user_file);
  }
  
  // Sexual Offences List FormA
  public function loadDocTplSeolfa($doc)
  {
    
  }
  
  // Sexual Offences List FormB
  public function loadDocTplSeolfb($doc)
  {
    
  }
  
  
  /****************************************** COMMITTAL STREAM **********************************************/
  // Application - Form 31
  public function loadDocTplApfr31($doc)
  {
    $fields = array('field3',     'field4',     'field7',     'field9',     'field10',
                    'field11',    'field12',    'field13',    'field14',    'field15',
                    'field17');

    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field12'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field15'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttributes(array('class' => 'doc_field', 'rows' => '5'));
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field15']->setAttributes(array('class' => 'doc_field', 'rows' => '3', 'cols' => $this->LETTER_ADDRESS_WIDTH));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '8'));
    
  }
  
  // Cease Abridgement - Notice
  public function loadDocTplCeabno($doc)
  {
    $this->loadDocTplCaabap($doc);
  }
  
  // Cease to Act - Committal
  public function loadDocTplCetacm($doc)
  {
    $this->loadDocTplCetoac($doc);
  }
  
  // Form 32 - Cross-examine Witnesses
  public function loadDocTplF32cew($doc)
  {
    $this->loadDocTplF32adj($doc, array('field17', 'field18', 'field19'));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 4));  
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field_long', 'rows' => 4));  
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field_long', 'rows' => 4));  
  }
  
  // Form 32 - Straight Hand-up
  public function loadDocTplF32shu($doc)
  {
    $this->loadDocTplF32cew($doc);
  }
  
  // Form 32 - Adjournment
  public function loadDocTplF32adj($doc, $extra_fields=array())
  {
    $fields = array('field2', 'field4', 'field5',  'field6', 'field7', 'field9', 'field10', 'field11', 'field17');
    foreach ($extra_fields as $xfield) $fields[] = $xfield;
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field7'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    //$this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field', 'rows' => '3'));
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field', 'rows' => '2', 'cols' => $this->LETTER_ADDRESS_WIDTH));
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 4));
    //$this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    
    // bigger text boxes
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long');
  }
  
  // Fax to Committals Co-ordinator
  public function loadDocTplFxcoco($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Fax - Filing Hearing Without Solicitor & Form 25
  public function loadDocTplFxff25($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Form 25 - Appearance
  public function loadDocTplF25apa($doc)
  {
    $this->loadDocTplF32adj($doc);
  }
  
  // Letter to Committal Co-ordinator
  public function loadDocTplLecoco($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Special Mention - Consent
  public function loadDocTplSpmeco($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Special Mention - No Consent
  public function loadDocTplSpmenc($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Video Link - Notification to Central Records
  public function loadDocTplVlntcr($doc)
  {
    $fields = array('field3',     'field4',     'field7',     'field8',
                    'field10',    'field11',    'field12',    'field13');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field7'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field', 'rows' => '3', 'cols' => $this->LETTER_ADDRESS_WIDTH));
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field');
  }
  
  // Video Link - Booking Request
  public function loadDocTplVlbore($doc)
  {
    $this->loadDocTplVilkre($doc);
  }
  
  
  /******************************************** COUNTY ***************************************************/
  // Affidavit of Service (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplAfofs2($doc) 
  {
    $this->loadDocTplAfofse($doc);
  }
  
  // Bail Application - Affidavit in Support
  public function loadDocTplBaafsu($doc)
  {
    $this->loadDocTplAffswo($doc);
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field_long', 'rows' => '1'));
  }
  
  // Bail Application - Notice
  public function loadDocTplBanoti($doc)
  {
    $this->loadDocTplAffswo($doc, array('field18'));
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field_long', 'rows' => '1'));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field_long', 'rows' => '5'));
  }
  
  // Bail Application - variation of Conditions (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplBavoc2($doc) 
  {
    $this->loadDocTplBavoco($doc);
  }
  
  // Defence Response for Initial Directions Hearing
  public function loadDocTplDrfidh($doc)
  {
    $this->loadDocTplAffswo($doc, array('field13', 'field14', 'field15', 'field18'));
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field half', 'rows' => '6'));
  }
  
  // Crown Opening - Reply Only
  public function loadDocTplCoreon($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Crown Opening - Admissions Sought
  public function loadDocTplCoadso($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Fax - To County Court
  public function loadDocTplFxtocc($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Fax - To Judge`s Associate (ALREADY DEFINED IN HIGH COURT) 
  public function loadDocTplFxtoj1($doc) 
  {
    $this->loadDocTplFxtoja($doc);
  }
  
  // Gaol Order (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplGaoor2($doc) 
  {
    $this->loadDocTplGaoord($doc);
  }
  
  // General Application (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplGenap2($doc) 
  {
    $this->loadDocTplGenapp($doc);
  }
  
  // Legal Aid - Application For Funding
  public function loadDocTplLaapfu($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Letter - To County Court
  public function loadDocTplLecocr($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Solicitor Acting - Notice
  public function loadDocTplSoacno($doc)
  {
    $this->loadDocTplAffswo($doc, array('field14', 'field15'));
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field_short');
  }
  
  // Solicitor Ceased to Act - Notice
  public function loadDocTplSocano($doc)
  {
    $this->loadDocTplSoacno($doc);
  }
  
  // Subpoena - Attend
  public function loadDocTplSpatte($doc)
  {
    $this->loadDocTplAffswo($doc, array('field14', 'field15', 'field16'));
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field', 'rows' => '4', 'cols' => $this->LETTER_ADDRESS_WIDTH));
 
    $subpoena_ordered_options = CommonTable::getSubpoenaOrderedOptions();
    $this->widgetSchema['field16'] = new sfWidgetFormChoice(array(
        'choices' => $subpoena_ordered_options, 
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter'))
        ));
  }
  
  // Subpoena - Produce
  public function loadDocTplSpprod($doc)
  {
    $this->loadDocTplSpatte($doc);
  }
  
  // Subpoena - Produce and Attend
  public function loadDocTplSpprat($doc)
  {
    $this->loadDocTplSpatte($doc);
  }
  
  /**************************************** COUNTY - APPEAL ***************************************/
  // Letter - To County Court (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplLecoc1($doc) 
  {
    $this->loadDocTplLecocr($doc);
  }
  
  // Fax to County Court -  General (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplFxtoc1($doc) 
  {
    $this->loadDocTplFxtocc($doc);
  }
  
  // Fax - To Judge`s Associate (ALREADY DEFINED IN HIGH COURT) 
  public function loadDocTplFxtoj2($doc) 
  {
    $this->loadDocTplFxtoja($doc);
  }
  
  // Notice of Appeal Fax to Informant
  public function loadDocTplNoafti($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Subpoena - Attend (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplSpatt1($doc) 
  {
    $this->loadDocTplSpatte($doc);
  }
  
  // Subpoena - Produce (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplSppro1($doc) 
  {
    $this->loadDocTplSpprod($doc);
  }
  
  // Subpoena - Produce and Attend (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplSppra1($doc) 
  {
    $this->loadDocTplSpprat($doc);
  }
  
  
  /******************************************* SUPREME ********************************************/
  // Affidavit - Exhibit Cover Sheet (ALREADY DEFINED IN FORMS [CLIENT]) 
  public function loadDocTplAffec1($doc) 
  {
    $this->loadDocTplAffecs($doc);
  }
  
  // Affidavit of Service (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocTplAfofs3($doc) 
  {
    $this->loadDocTplAfofse($doc);  
  }
  
  // Bail Application - Affidavit in Support (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplBaafs1($doc) 
  {
    $this->loadDocTplBaafsu($doc);
  }
  
  // Bail Application - Notice (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplBanot1($doc) 
  {
    $this->loadDocTplBanoti($doc);
  }
  
  // Bail Variation - Notice
  public function loadDocTplBavano($doc)
  {
    $this->loadDocTplBanoti($doc);
  }
  
  // Fax - To Judge`s Associate (ALREADY DEFINED IN HIGH COURT) 
  public function loadDocTplFxtoj3($doc) 
  {
    $this->loadDocTplFxtoja($doc);
  }
  
  // Fax - To Supreme Court
  public function loadDocTplFxtosc($doc)
  {
    $this->loadDocTplFxcorc($doc); 
  }
  
  // Letter - To Supreme Court
  public function loadDocTplLetosc($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Notice to Addressee and Application
  public function loadDocTplNoadap($doc)
  {
    $this->loadDocTplAffswo($doc, array('field14', 'field15', 'field16'));
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field_long');
 
    $addressee_declaration_options = CommonTable::getAddresseeDeclarationOptions();
    $this->widgetSchema['field16'] = new sfWidgetFormChoice(array(
        'choices' => $addressee_declaration_options, 
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter'))
        ));
  }
  
  // Solicitor Ceased to Act - Notice (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplSocan1($doc) 
  {
    $this->loadDocTplSocano($doc);
  }
  
  // Subpoena - Attend (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplSpatt2($doc) 
  {
    $this->loadDocTplSpatte($doc);
  }
  
  // Subpoena - Produce (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplSppro2($doc) 
  {
    $this->loadDocTplSpprod($doc);
  }
  
  // Subpoena - Produce and Attend (ALREADY DEFINED IN COUNTY) 
  public function loadDocTplSppra2($doc) 
  {
    $this->loadDocTplSpprat($doc);
  }
  
  
  /**************************************** COURT OF APPEAL ***************************************/
  // Appeal Against Conviction - Notice
  public function loadDocTplApacno($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Appeal Against Sentence - Notice
  public function loadDocTplApasno($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Fax - Abandoning Appeal
  public function loadDocTplFxabap($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Fax - To Court of Appeal Judge
  public function loadDocTplFxcaju($doc)
  {
    $this->loadDocTplFxtoja($doc);
  }
  
  // Folder Coversheet
  public function loadDocTplFolcsh($doc)
  {
    $this->loadDocTplAffswo($doc);
    $this->widgetSchema['field8']->setAttributes(array('class' => 'doc_field third', 'rows' => '3'));
    $this->widgetSchema['field12'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => '6', 'cols' => $this->LETTER_ADDRESS_WIDTH));
  }
  
  // Folder - Spine v OPP
  public function loadDocTplFospvo($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Fax to Court of Appeal
  public function loadDocTplFxtoca($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Letter to Court of Appeal
  public function loadDocTplLttoca($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Notice that Solicitor Acts
  public function loadDocTplNosoac($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Particulars (Must go with Each Appeal)
  public function loadDocTplPmgwea($doc)
  {
    $this->loadDocTplAffswo($doc, array('field14', 'field18', 'field19'));
    
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field full', 'rows' => '1'));
    $this->widgetSchema['field14'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => '3'));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field full', 'rows' => '4'));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => '3'));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => '3'));
  }
  
  // VGRS  Request For Recording
  public function loadDocTplVgrsrr($doc)
  {
    $this->loadDocTplPmgwea($doc);
  }
  
  // Extension of Time Application
  public function loadDocTplExtiap($doc)
  {
    $fields = array('field2',   'field3');
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field3'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field3']->setAttributes(array('class' => 'doc_field fourth', 'rows' => '2'));
  }
  
  
  /******************************************* HIGH COURT *****************************************/
  // Letter to High Court
  public function loadDocTplLetohc($doc)
  {
     $this->loadDocTplCccole($doc);
  }
  
  // Fax to High Court
  public function loadDocTplFxtohc($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Fax to Judge`s Associate
  public function loadDocTplFxtoja($doc)
  {
    $this->loadDocTplFxcorc($doc, array('field12'));
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /*************************************** BARRISTER section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /*************************************** BARRISTER DETAILS **************************************/
  // Basics to Include in Trial Brief
  public function loadDocTplBaintb($doc)
  {
    // this document does not required any form, it is plain text only
  }
  
  
  /******************************************* BACK SHEETS ****************************************/
  // Appeal Police (Informant)
  public function loadDocTplAppoin($doc)
  {
    $this->loadDocTplAffswo($doc, array('field14', 'field15'));
    
    // formatting the fields
    $this->widgetSchema['field3'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => 4));
    $this->widgetSchema['field8'] = new sfWidgetFormInputText(array(), array('class' => 'doc_field'));
   
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field', 'rows' => 3));
    
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field14']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field15']->setAttribute('class', 'doc_field');
    
    $this->widgetSchema['field17']->setAttribute('rows', 40);
  }
  
  // Appeal O.P.P.
  public function loadDocTplAppopp($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  // Appeal C.D.P.P.
  public function loadDocTplApcdpp($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  // Appeal Other Prosecuting Agency
  public function loadDocTplApopra($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  // Appeal Other Individual Named as Informant
  public function loadDocTplAoinai($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  // Commonwealth Director of Public Prosecutions (C.D.P.P.)
  public function loadDocTplCdppro($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  // Director`s Appeal C.D.P.P.
  public function loadDocTplDacdpp($doc)
  {
    $this->loadDocTplAppoin($doc);
    $this->widgetSchema['field10'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field', 'rows' => 2, 'cols' => 48));
  }
  
  // Director`s Appeal O.P.P.
  public function loadDocTplDapopp($doc)
  {
    $this->loadDocTplDacdpp($doc);
  }
  
  // Officer of Public Prosecutions (O.P.P.)
  public function loadDocTplOfoppr($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  // Other Individual Named as Informant
  public function loadDocTplOinain($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  // Other Prosecuting Agency
  public function loadDocTplOtprag($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  // Police (Informant)
  public function loadDocTplPolinf($doc)
  {
    $this->loadDocTplAppoin($doc);
  }
  
  
  /***************************************** CORRESPONDENCE ***************************************/
  // Fax to Barrister
  public function loadDocTplFxtoba($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Letter to Barrister
  public function loadDocTplLttoba($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Memorandum to Counsel
  public function loadDocTplMetocn($doc)
  {
    $fields = array('field9', 'field17');
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field'); 
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 38));
  }
  
  // Print Spine (Wide Folder)
  public function loadDocTplPspnwf($doc)
  {
    $this->loadDocTplPspnnf($doc);
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => 3));
    $this->widgetSchema['field8'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => 4));
  }
  
  // Print Spine (Narrow Folder)
  public function loadDocTplPspnnf($doc, $extra_fields=array())
  {
    $doc_extra_fields = array('field1', 'field3', 'field8', 'field17');
    if (!empty($extra_fields)) $doc_extra_fields = array_merge($doc_extra_fields,$extra_fields);
    $this->loadDocTplF32adj($doc, $doc_extra_fields);
    
    $this->widgetSchema['field4'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => 3));
    $this->widgetSchema['field8'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => 5));
    $this->widgetSchema['field10'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => 3));
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field_short');    
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 42));
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /****************************************** FEE section *****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////

  /******************************************* AGREEMENTS *****************************************/  
  // Lump sum one day
  public function loadDocTplFalsod($doc, $extra_fields=array())
  {
    $doc_extra_fields = array('field11', 'field12', 'field13', 'field14', 'field15');
    $extra_fields = array_merge($extra_fields, $doc_extra_fields);
    $this->loadDocTplAdlefm($doc, $extra_fields);
    
    //$this->widgetSchema['field11'] = new sfWidgetFormChoice(array('choices' => CommonTable::getBankAccountOptions()));
    $this->widgetSchema['field11'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field_long', 'rows' => 4));
    
    //$this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 10));
    $this->widgetSchema['field13']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 10));
    $this->widgetSchema['field14']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 10));
    $this->widgetSchema['field15']->setAttributes(array('class' => 'doc_field', 'size' => 10));
    
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 3));
  }
  
  // Lump sum more than one day
  public function loadDocTplFalsmd($doc)
  {
    $this->loadDocTplFalsod($doc, array('field10', 'field16'));
    $this->widgetSchema['field10']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 10));
    $this->widgetSchema['field16']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 10));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 4));
  }
  
  // Schedule fees
  public function loadDocTplFascfe($doc)
  {
    $this->loadDocTplFalsmd($doc);
  }
  
  // General Cover Letter
  public function loadDocTplFagecl($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  // Lump sum Cover Letter
  public function loadDocTplFalscl($doc)
  {
    $this->loadDocTplAdlefm($doc);
  }
  
  
  /******************************************** INVOICES ******************************************/
  // New Trust Inv - Monies Owing  
  public function loadDocTplTrmoin($doc)
  {    
    $fields = array('field1',   'field2',   'field4',   'field5',
                    'field7',   'field8',   'field17',  
                    'field3',
                    'field6',   'field9',   'field10',  'field11',  'field12');
    $this->useFields(array_merge($this->mandatory_fields, $fields));
    
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field3'] = new sfWidgetFormChoice(array('choices' => CommonTable::getBankAccountOptions()), array('class' => 'doc_field'));
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_important');
    $this->widgetSchema['field5']->setAttributes(array('class' => 'doc_field', 'rows' => 3));
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field_long_important');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field_important');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => 4));
    
    $this->widgetSchema['field6']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 8));
    $this->widgetSchema['field9']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 8));
    $this->widgetSchema['field10']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 8));
    $this->widgetSchema['field11']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 8));
    $this->widgetSchema['field12']->setAttributes(array('class' => 'doc_field_numeric', 'size' => 8));
  }
  
  // New Trust Inv - No Monies Owing
  public function loadDocTplTrnmin($doc)
  {
    $this->loadDocTplTrmoin($doc);
  }
  
  // New Standard Inv
  public function loadDocTplStdinv($doc)
  {
    $this->loadDocTplTrmoin($doc);
    $arr = sfConfig::get('app_appowner_bankaccounts');
    $this->setDefault('field3', $arr['business']);
  }
  
  // New Non - Standard Inv
  public function loadDocTplNstinv($doc)
  {
    $this->loadDocTplStdinv($doc);
  }
  
  /******************************************** RECEIPTS ******************************************/
  // Paid Receipt
  public function loadDocTplPaircp($doc)
  {
    $this->loadDocTplAdlefm($doc, array('field11'));
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_numeric');
  }
  
  // Interim Receipt
  public function loadDocTplIntrcp($doc)
  {
    $this->loadDocTplAdlefm($doc, array('field11'));
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_numeric');
  }
 
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** LEGAL section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /******************************************* VLA DETAILS ****************************************/
  // Fax to VLA
  public function loadDocTplFxtvla($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Miscellaneous Letter to VLA
  public function loadDocTplMltvla($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  
  /******************************************* COMPLIANCE *****************************************/
  // legal Aid Compliance Filenote
  public function loadDocTplLacofn($doc)
  {
    $fields = array('field1',   'field2',   'field3',   'field4',   'field5',
                    'field6',   'field7',   'field8',   'field9',   'field10',
                    'field11',  'field12',  'field13',  'field14',  'field15',
                    'field16',  'field17',  'field18',  'field19');
    
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $documentDetailForm = new DocumentDetailForm($this->object->DocumentDetail[0], array('doc' => $doc));
    $this->embedForm('DocumentDetail', $documentDetailForm);
    
    $documentDetailForm2 = new DocumentDetailForm($this->object->DocumentDetail[1], array('doc' => $doc));
    $this->embedForm('DocumentDetail2', $documentDetailForm2);
    
    $this->widgetSchema['field14'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field5']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field6']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field14']->setAttributes(array('class' => 'doc_field full', 'rows' => 3));
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => 8));
    
        
    //$this->widgetSchema['field2']->setAttribute('class', 'doc_field');
    //$this->widgetSchema['field3']->setAttributes(array('class' => 'doc_field fourth', 'rows' => '2'));
  }
  
  
  /************************************* COMPLIANCE: WORKSHEETS ************************************/
  // Appeal
  public function loadDocTplAppeal($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field6', 'field7', 'field8', 'field9', 'field18', 'field19'));
        
    $this->widgetSchema['field4'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Copy of Notice of Appeal on file'));
    $this->widgetSchema['field6'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of the charges'));
    $this->widgetSchema['field8'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Assessment of the strengths and weaknesses'));
    $this->widgetSchema['field9'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Indication of the likely appropriate penalty'));
    $this->widgetSchema['field5'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetAppealOptions('conviction_sentence'),
        'expanded' => true)
    );
    $this->widgetSchema['field7'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetAppealOptions('advice_grounds'),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
  }
  
  // Bail Application
  public function loadDocTplBaialc($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field6', 'field18', 'field19'));

    $this->widgetSchema['field4'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Copy of Notice of Appeal on file'));    
    $this->widgetSchema['field5'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetBailApplicationOptions('grounds_strengths'),
        'expanded' => true,
        'multiple' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    $this->widgetSchema['field6'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetBailApplicationOptions('practitioner_assessment'),
        'expanded' => true,
        'multiple' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
  }
  
  // Committals
  public function loadDocTplComtal($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field6', 'field7', 'field8', 'field9', 'field10', 'field11'));
    
    $this->widgetSchema['field4'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetCommittalOptions('sexual_committal'),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    $this->widgetSchema['field5'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetCommittalOptions('one_two_days'),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    $this->widgetSchema['field6'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetCommittalOptions('eligilibity_criteria'),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    $this->widgetSchema['field7'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetCommittalOptions('change_deal'),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    $this->widgetSchema['field9'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetCommittalOptions('cross_examination'),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    $this->widgetSchema['field8'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'strong likelihood that an early plea will be identified'));    
    $this->widgetSchema['field10'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'The evidence (or lack thereof) points to insufficient'));    
    $this->widgetSchema['field11'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'A sexual assault case where aid is sought'));    
    
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field full with_border', 'rows' => 4));
  }
  
  // Consolidation
  public function loadDocTplConsod($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field18'));
    
    $this->widgetSchema['field4'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of the charges'));
    $this->widgetSchema['field5'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Matters yet to be listed at plea'));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 6));
  }
  
  // Guilty - Commonwealth
  public function loadDocTplGuicom($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field18', 'field19', 'field20'));
    
    $this->widgetSchema['field4'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of the charges'));
    $this->widgetSchema['field5'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'MATTER CANNOT BE DEALT WITH BY'));
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 6));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => 6));
    $this->widgetSchema['field20']->setAttributes(array('class' => 'doc_field full', 'rows' => 6));
  }
  
  // Guilty - State
  public function loadDocTplGuista($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field6', 'field18', 'field19'));
    $this->widgetSchema['field4'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of the charges'));
    $this->widgetSchema['field5'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of prior convictions'));
    $this->widgetSchema['field6'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetGuiltyStateOptions(),
        'expanded' => true,
        'multiple' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
  }
  
  // Medical Report
  public function loadDocTplMedrep($doc, $extra_fields=array())
  {
    $fields = array('field1',     'field2',     'field3',     'field17');
    
    if (!empty($extra_fields)) $fields = array_merge($fields, $extra_fields);
    $this->useFields(array_merge($this->mandatory_fields, $fields));
  
    $this->widgetSchema['field3'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field2']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');    
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
  }
  
  // Not Guilty -Commonwealth
  public function loadDocTplNoguco($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field6', 'field7', 'field18', 'field19'));
    $this->widgetSchema['field4'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of the charges'));
    
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => '2'));
    $this->widgetSchema['field6'] = new sfWidgetFormTextarea(array(),array('class' => 'doc_field full', 'rows' => '2'));
    $this->widgetSchema['field7'] = new sfWidgetFormTextarea(array(),array('class' => 'doc_field full', 'rows' => '2'));
        
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
  }
  
  // Not Guilty - State
  public function loadDocTplNogust($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field6', 'field7', 'field18', 'field19', 'field20'));
    
    $this->widgetSchema['field4'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of the charges'));
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea(array(), array('class' => 'doc_field full', 'rows' => '2'));
    
    $this->widgetSchema['field6'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetNotGuiltyStateOptions('crown_case'),
        'expanded' => true,
        'multiple' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    $this->widgetSchema['field7'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetNotGuiltyStateOptions('likely_penalty'),
        'expanded' => true,
        'multiple' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 3));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => 3));
    $this->widgetSchema['field20']->setAttributes(array('class' => 'doc_field full', 'rows' => 3));
  }
  
  // Traffic Prosecution
  public function loadDocTplTrapro($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field18', 'field19'));
    $this->widgetSchema['field4'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of the charges'));
    $this->widgetSchema['field5'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Full details of prior convictions'));
    
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
    $this->widgetSchema['field19']->setAttributes(array('class' => 'doc_field full', 'rows' => 4));
  }
  
  // Trial
  public function loadDocTplTrialx($doc)
  {
    $this->loadDocTplMedrep($doc, array('field4', 'field5', 'field6', 'field7', 'field18'));
    
    $this->widgetSchema['field5'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'Before recommending that assistance'));
    $this->widgetSchema['field6'] = new sfWidgetFormInputCheckbox(array('value_attribute_value' => 'It is desirable, in the interests of justice'));
    
    $this->widgetSchema['field4'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetTrialOptions('category'),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter2')))
    );
    $this->widgetSchema['field7'] = new sfWidgetFormChoice(array(
        'choices' => CommonTable::getWorksheetTrialOptions('recommendations'),
        'expanded' => true,
        'renderer_options' => array('formatter' => array('DocumentForm', 'CheckboxsFormatter')))
    );
    
    $this->widgetSchema['field7']->getRenderer()->setAttribute('columns', 3);
    
    $this->widgetSchema['field18']->setAttributes(array('class' => 'doc_field full', 'rows' => 3));
  }
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** AGENCY section ***************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /********************************************** CTLD ********************************************/
  // CTLD Fax
  public function loadDocTplCtldfx($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // CTLD Letter
  public function loadDocTplCtldlt($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Confirm Barrister
  public function loadDocTplCombar($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Confirm Barrister Fax
  public function loadDocTplCobafx($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Confirm that Plea
  public function loadDocTplComple($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Confirm that Plea Fax
  public function loadDocTplCoplfx($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Form 2 11-E
  public function loadDocTplFm211e($doc)
  {
    $this->loadDocTplAffswo($doc);
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long doc_field_numeric');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field17']->setAttribute('rows', 36);    
  }
  
  // Enclosing 2 11-E
  public function loadDocTplEn211e($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Enclosing 2 11-E Fax
  public function loadDocTplE211fx($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  
  /************************************* OFFICE OF CORRECTIONS ************************************/
  // Fax to Corrections
  public function loadDocTplFxtoct($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Letter to Correction
  public function loadDocTplLttoct($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  
  /**************************************** JUVENILE JUSTICE **************************************/
  // Fax to Juvenile Justice
  public function loadDocTplFxtojj($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Letter to Juvenile Justice
  public function loadDocTplLttojj($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // YTC Location (ALREADY DEFINED IN PRISONS) 
  public function loadDocTplYtclo1($doc) 
  {
    $this->loadDocTplYtcloc($doc);
  }
  
  
  /********************************************* PRISONS ******************************************/
  /*// Change Gaol Location
  public function loadDocTplChgalo($doc)
  {
    // THIS IS NOT A DOCUMENT, MUST BE REMOVED FROM HERE
  }*/
  
  // Fax to Prison
  public function loadDocTplFxtopr($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Letter to Prison
  public function loadDocTplLttopr($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Phone Conference
  public function loadDocTplPhocof($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Request CRN Number
  public function loadDocTplRcrnnb($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // equest CRN Number & Location
  public function loadDocTplRcrnal($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Request Prison Location
  public function loadDocTplReprlo($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Video Conference
  public function loadDocTplVidcof($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Video/Phone at Dame Phyllis Frost
  public function loadDocTplVpadpf($doc)
  {
    
  }
  
  // YTC Location
  public function loadDocTplYtcloc($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  
  /************************************** APPEALS COSTS BOARD *************************************/
  // Appeals Cost Certificate
  public function loadDocTplApcoce($doc)
  {
    $fields = array('field3', 'field4', 'field5',  'field6', 'field7', 'field8');
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field6'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field7'] = new sfWidgetFormTextarea();
    
    $this->widgetSchema['field3']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field5']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field6']->setAttributes(array('class' => 'doc_field', 'rows' => '4'));
    $this->widgetSchema['field7']->setAttributes(array('class' => 'doc_field', 'rows' => '3', 'cols' => 40));
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field');
  }
  
  // Appeals Costs Board Letter
  public function loadDocTplApcobl($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Appeals Costs Board Fax
  public function loadDocTplApcobf($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  
  /*********************************** ABORIGINAL LEGAL SERVICES **********************************/
  // Fax to Aboriginal Legal Services
  public function loadDocTplFxtals($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Letter to Aboriginal Legal Services
  public function loadDocTplLttals($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  
  /************************************ COMMUNITY LEGAL SERVICES **********************************/
  // Fax to Community Legal Services
  public function loadDocTplFxtcls($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Letter to Community Legal Services
  public function loadDocTplLttcls($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** ADMIN section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /************************************** MISC CORRESPONDENCE *************************************/
  // Affidavit 3rd Party
  public function loadDocTplAfthpa($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Affidavit 3rd Party (Solicitor Attesting)
  public function loadDocTplA3psat($doc)
  {
    $this->loadDocTplAffswo($doc);
  }
  
  // Affidavit 3rd Party - Exhibit Cover Sheet
  public function loadDocTplA3pecs($doc)
  {
    $this->loadDocTplF32adj($doc);
  }
  
  // Fax Cover - This File
  public function loadDocTplFxcvtf($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // Fax Cover - Any File
  public function loadDocTplFxcvaf($doc)
  {
    $this->loadDocTplFxcorc($doc);
  }
  
  // File Note - Add to This File
  public function loadDocTplFnattf($doc, $extra_fields=array())
  {
    $fields = array('field1',   'field4',   'field7',   'field8',   'field9',   'field10',   'field17'); 
    $fields = array_merge($fields, $extra_fields);
    $this->useFields(array_merge($this->mandatory_fields, $fields));

    $this->widgetSchema['field3'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field5'] = new sfWidgetFormTextarea();
    $this->widgetSchema['field9'] = new sfWidgetFormDoctrineChoice(array('model' => 'SfGuardUser', 'table_method' => 'getSolicitorsCB', 'method' => 'obtainFullName'));    
    
    $this->widgetSchema['field1']->setAttribute('class', 'doc_field_short');
    $this->widgetSchema['field4']->setAttribute('class', 'doc_field larger_font');
    $this->widgetSchema['field7']->setAttribute('class', 'doc_field_long_important');
    $this->widgetSchema['field8']->setAttribute('class', 'doc_field_important');
    $this->widgetSchema['field9']->setAttribute('class', 'doc_field');
    $this->widgetSchema['field10']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field17']->setAttributes(array('class' => 'doc_field_long', 'rows' => '20'));
  }
  
  // File Note - Not Added to This File
  public function loadDocTplFnnatf($doc)
  {
    $this->loadDocTplFnattf($doc);
  }
  
  // Folder Spine - Wide
  public function loadDocTplFlspwd($doc)
  {
    $this->loadDocTplPspnwf($doc);
  }
  
  // Folder Spine - Narrow
  public function loadDocTplFlspna($doc)
  {
    $this->loadDocTplPspnnf($doc);
  }
  
  // Miscellaneous Letter - This File
  public function loadDocTplMlttfi($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Miscellaneous Letter - Any File
  public function loadDocTplMltafi($doc)
  {
    $this->loadDocTplCccole($doc);
  }
  
  // Phone Message - Add to This File
  public function loadDocTplPmattf($doc)
  {
    $this->loadDocTplFnattf($doc, array('field11', 'field12', 'field13'));
    $this->widgetSchema['field11']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field12']->setAttribute('class', 'doc_field_long');
    $this->widgetSchema['field13']->setAttribute('class', 'doc_field_long');
  }
  
  // Phone Message - Any File
  public function loadDocTplPmanfi($doc)
  {
    $this->loadDocTplPmattf($doc);
  }
  
  // Statutory Declaration 3rd Party
  public function loadDocTplSde3pa($doc)
  {
    $this->loadDocTplStdemi($doc);
  }
  
  // Statutory Declaration 3rd Party (Solicitor Attesting)
  public function loadDocTplSd3psa($doc)
  {
    $this->loadDocTplStdemi($doc);
  }
  
  
  // added on 15/02/2013
  function getDocumentDate($date_format="j F Y", $html_elem='span', $add_hidden=true, $print=true)
  {
    //$document_date = $this->getObject()->getCreatedAt();
    //$date = ($document_date) ? date($date_format, strtotime($document_date)) : date($date_format);
    
    $temp = time();
    if ($this->getObject()->getDocDate()) {
      $temp = strtotime($this->getObject()->getDocDate());
    }
    else {
      if ($this->getObject()->getCode()) {
        $temp_arr = explode('-', $this->getObject()->getCode());
        if (isset($temp[2])) $temp = $temp_arr[2];
      }      
    }
    $date = date($date_format, $temp);
    
    if ($html_elem != NULL) {
      $formatted_lined = '<'.$html_elem.' class="document_date" title="'.$date_format.'">'.$date.'</'.$html_elem.'>';
      $this->setDefault('doc_date', date('Y-m-d H:i:s', $temp));
    }
    else {
      $formatted_lined = $date;
    }
    
    if ($print)  echo $formatted_lined; //.(($add_hidden) ? $this['name']->renderRow() : '');
    else  return $formatted_lined; //.(($add_hidden) ? $this['name']->renderRow() : '');
  }
  
}
