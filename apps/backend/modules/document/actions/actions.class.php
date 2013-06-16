<?php

require_once dirname(__FILE__).'/../lib/documentGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/documentGeneratorHelper.class.php';

require_once dirname(__FILE__).'/../../../../../web/js/calendar/classes/tc_calendar.php';

/**
 * document actions.
 *
 * @package    fileadmin
 * @subpackage document
 * @author     William Palomino
 * @version    3.0
 */
class documentActions extends autoDocumentActions
{  
  public function preExecute() 
  {
    // get the relative path to the temp folder for attached files
    $this->temp_dir_path = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    // use normal preexecute script, no the customized templates preexecute for editing and saving
    if (sfContext::getInstance()->getActionName() == 'index') {
      parent::preExecute();
      $this->setLayout('layout');
    }
    else {
      $this->configuration = new DocumentGeneratorConfiguration();
      if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName()))) {
        $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }
      $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));
      $this->helper = new DocumentGeneratorHelper();
      $this->edit_pager = false;
      $this->partial_links = false;
      $this->no_title = true;
      $this->helper->formlist = false;
    
      $this->loadDocumentData();
    }
  }
  
  
  public function loadDocumentData()
  {
    $request = sfContext::getInstance()->getRequest();
    
    // keeps the form in the shadowbox for all the actions
    $this->helper->document_tpl_file = 'empty';
    $this->helper->show_settings = true;
    $this->helper->show_buttons = true;
    $this->helper->allow_address_change = false;  // allow change address in the document
    $this->helper->document_tpl_file_fmt = $request->getParameter('fmt');
    //$this->helper->document_type_id = null;
    
    // load logo according user
    $this->helper->logo = "document_logo_frankston.jpg"; // default
    
    switch ($this->getUser()->getUserName()) {
      case 'david': 
      case 'madeleine':
      case 'rachel':    
        $this->helper->logo = "document_logo_dandenong.jpg";
        $this->helper->address = sfConfig::get('app_appowner_address2');
        break;
      case 'michael':   
      case 'rebecca':
      case 'lillie':
      case 'sophie':    
        $this->helper->logo = "document_logo_frankston.jpg";
        $this->helper->address = sfConfig::get('app_appowner_address1');
        break;
      case 'nancy':     
        $this->helper->logo = "document_logo_ringwood.jpg";
        $this->helper->address = sfConfig::get('app_appowner_address3');
        break;
      default:          
        $this->helper->logo = "document_logo_frankston.jpg";
        $this->helper->address = sfConfig::get('app_appowner_address1');
        break;
    }
    
    // lets check if it comes from new or edit
    $doc_obj = Doctrine::getTable('Document')->find($request->getParameter('id'));
    if ($doc_obj) {  // edit
      $doc = $doc_obj->getDocumentType()->getShortName();
      //$this->helper->document_type_id = $doc_obj->getDocumentType()->getId();
    }
    else { // new
      $doc = $request->getParameter('doc');
      //$doc_type = Doctrine::getTable('DocumentType')->findOneBy('short_name', $doc);
      //$this->helper->document_type_id = ($doc_type) ? $doc_type->getId() : null;
    }
    if ($doc) sfContext::getInstance()->getUser()->setAttribute ('doc', $doc);
    else $doc = sfContext::getInstance()->getUser()->getAttribute ('doc', null);
    
    $this->user_file = CommonObject::getSessionUserFileData();  // get the current user file
    $this->last_court_date = null;                              // get the last court date,
    $this->committal_stream = null;
    if ($this->user_file) {
      $court_dates = $this->user_file->getFileCourtDates();
      if (count($court_dates)) $this->last_court_date = $court_dates[count($court_dates)-1];
      $this->committal_stream = $this->user_file->getUCommittalStream();
    }
    
    if ( ($doc) && ($doc != 'none') )  {
      //$this->edit_pager = false;
      //$this->setLayout('form_layout');
      //$this->mode = 'search';
      $this->shadow_box = true;
      $this->helper->document_tpl_file = $doc;
      
      $this->mapSubfolder($doc);
    }
    
    // get special parameters for some documents
    $receipt_id = $request->getParameter('receipt_id');
    if ($receipt_id) $this->helper->receipt_id = $receipt_id;
    
    $invoice_id = $request->getParameter('invoice_id');
    if ($invoice_id) $this->helper->invoice_id = $invoice_id;
    
    // set a name for attached files
    $this->helper->attached_doc_name = 'document';
    if ($this->helper->document_tpl_file != 'empty') {
      $this->helper->attached_doc_name = $this->helper->document_tpl_file;
      if ($this->user_file) $this->helper->attached_doc_name.= '_'.$this->user_file->getNumber();
    }
    
    // added by William, 17/05/2013: to load saved doc instead of new one
    $info = Document::docExists($this, $doc_obj, $request);
    $this->helper->doc_exists = $info['txt'];
    $this->helper->doc_exists_id = $info['id'];
    $this->helper->doc_buffer_id = $info['buffer_id'];
    $this->helper->doc_load = $info['load'];
  }
  
  
  public function executeIndex(sfWebRequest $request)
  {
    if (sfContext::getInstance()->getRequest()->getParameter('doc')) {
      parent::executeIndex($request);
    }
    else {
      $request = $this->setMainFilter($request);
      parent::executeIndex($request);
      $this->editPagerRedirection($request);
      
      $this->verifyClientFile('Saved Documents');
    }
  }
  
  
  public function executeNew(sfWebRequest $request) 
  {
    if ($this->helper->document_tpl_file != 'empty') {
      $document = new Document();
      $this->setNewDocumentParams($this->user_file, $this->helper->document_tpl_file);
      $func = 'loadDocDat'.ucfirst($this->helper->document_tpl_file);
      $document = $this->$func($this->user_file);
      $this->document = $document;
      $this->form = new DocumentForm($document);
    }
    else {
      $this->getUser()->setFlash('error', 'There is not template for this document request!', false);
      //parent::executeNew($request);  // just in case there is an error and the script reaches this far
      $this->setTemplate('noDocument');
    }
  }
  
  
  public function setNewDocumentParams($user_file, $doc)
  {
    // let's find the document type id
    $doc_type = Doctrine::getTable('DocumentType')->findOneBy('short_name', $doc);
    $doc_params = array('code' => '',               'court_date_id' => '',      'user_file_id' => '', 
                        'document_type_id' => '',   'updated_by_id' => '',      'new' => true);
      
    // let's check if the document for this type and this file exists
    if ( ($user_file) && ($doc_type) ) {
      $doc_params['code'] = (int)$user_file->getNumber().'-'.$doc.'-'.time();
      if ($this->last_court_date !== null) $doc_params['court_date_id'] = $this->last_court_date->getId();
      $doc_params['user_file_id'] = $user_file->getId();
      $doc_params['document_type_id'] = $doc_type->getId();
      $doc_params['updated_by_id'] = $this->getUser()->getGuardUser()->getId();

      // lets the normal edit and create procedures works
      /*$found_doc = Doctrine::getTable('Document')->findBySql('user_file_id = ? AND document_type_id = ?', array($user_file->getId(), $doc_type->getId()));
      if ($found_doc) {  // perform overwrite when saving
        $doc_params['new'] = false;
      }*/
    }
      
    // save the doc_settings to use it in the form
    sfContext::getInstance()->getUser()->setAttribute('doc_params', $doc_params);
  }
  
  
  public function mapSubfolder($doc)
  {
    $client_doc_lnks = array_keys(array_merge(
            Link::$client_correspondence_links, Link::$client_authorities_links, 
            Link::$client_forms_links, Link::$client_instructions_links
            ));
    
    $informant_brd_lnks = array('brirq1', 'brirq2', 'brirq3', 'brirq4');
    $informant_only_lnks = array_merge(Link::$informant_correspondence_links, array_combine($informant_brd_lnks, $informant_brd_lnks));
    $informant_doc_lnks = array_keys(array_merge(
            $informant_only_lnks, Link::$prosecutor_default_links //Link::$informant_prosecutors_links,
            ));
  
    $court_doc_lnks_results = array_merge(
            //Link::getCourtResultsLinks(1), // includes the three commented links groups
            Link::$court_results_links, 
            Link::$court_results_drink_drive_letters_links,
            Link::$court_results_custody_status_links   // this section is taken from agency_doc_lnks);
            );
    $court_doc_lnks0 = array_merge(
            Link::$court_summary_adjournments_links,
            Link::$court_children_links, Link::$court_magistrates_links,
            Link::$court_committal_stream_links, Link::$court_county_links,
            Link::$court_appeal_links, Link::$court_supreme_links,
            Link::$court_court_appeal_links, Link::$court_high_court_links
            );
    $court_doc_lnks = array_keys(array_merge($court_doc_lnks_results, $court_doc_lnks0));
    
    $barrister_doc_lnks0 = array_merge(
            Link::$barrister_default_links, Link::$barrister_backsheets_links,
            Link::$barrister_correspondence_links
            );
    $barrister_doc_lnks = array_keys($barrister_doc_lnks0);
    
    $fee_doc_lnks = array_keys(array_merge(
            Link::$fee_agreements_links, Link::$fee_invoices_links,
            Link::$fee_receipts_links
            ));
    
    $legal_doc_lnks = array_keys(array_merge(
            Link::$legal_vla_details_links, 
            //Link::$legal_indictable_links, Link::$legal_forms_links, // not sure if they're documents
            Link::$legal_compliance_links, Link::$legal_worksheets_links
            ));
    
    $agency_doc_lnks = array_keys(array_merge(
            Link::$agency_criminal_trial_listing_dir_links, Link::$agency_office_of_corrections_links,
            Link::$agency_juvenile_justice_links, Link::$agency_prisons_links,
            Link::$agency_appeals_costs_board_links, Link::$agency_aboriginal_legal_services_links,
            Link::$agency_community_legal_services_links
            ));
    
    $admin_doc_lnks = array_keys(Link::$admin_correspondence_links);
    
    $sections = array(
        'client' => $client_doc_lnks,           'informant' => $informant_doc_lnks,
        'court' => $court_doc_lnks,             'barrister' => $barrister_doc_lnks,   
        'fee' => $fee_doc_lnks,                 'legal' => $legal_doc_lnks,
        'agency' => $agency_doc_lnks,           'admin' => $admin_doc_lnks,
    );
    
    $this->helper->section = '';
    foreach ($sections as $k => $section) {
      if (in_array($doc, $section)) {
        $this->helper->section = $k;
        break;
      }
    }
    
    // allow change address only to these documents
    if (array_key_exists($doc, Link::$client_correspondence_links)) {
      $this->helper->allow_address_change = true;
    }
    
    // add recipient (file client' email by default, it can be changed according to the type of document)
    if ($this->user_file) {
      if (array_key_exists($doc, $informant_only_lnks)) {
        $email = $this->user_file->getInformant()->getEmailAddress();
        $fax = $this->user_file->getInformant()->getUserProfiles()->getFax();
      }
      elseif (array_key_exists($doc, Link::$prosecutor_default_links)) {
        $email = $this->user_file->getProsecutor()->getEmailAddress();
        $fax = $this->user_file->getProsecutor()->getUserProfiles()->getFax();
      } 
      elseif (array_key_exists($doc, $barrister_doc_lnks0)) {
        $email = $this->user_file->getBarrister()->getEmailAddress();
        $fax = $this->user_file->getBarrister()->getUserProfiles()->getFax();
      } 
      elseif (array_key_exists($doc, $court_doc_lnks0)) {
        if ($this->last_court_date) {        
          $email = $this->last_court_date->getCourt()->getEmail();
          $fax = $this->last_court_date->getCourt()->getFax();
          
          $users = $this->last_court_date->getCourt()->getUsers();
          if ($users) {
            foreach ($users as $userx) { // get criminal coordinator email
              if (Doctrine::getTable('sfGuardUser')->userBelongsGroup($userx->getId(), 'code', 'CRC')) {
                $email = $userx->getEmailAddress();
              }
            }
          }
          
        }
      } 
      else {
        $email = $this->user_file->getEmail();
        $fax = $this->user_file->getFax();
      }
      if ($fax != "") {
        $faxservice = sfConfig::get('app_faxservice');
        $fax.= "@".$faxservice["domain"];
      }
    }
    $this->helper->recipient = isset($email) ? $email : '';
    
    $doc_type = Doctrine::getTable('DocumentType')->findOneBy('short_name', $doc);
    $this->helper->email_subject = ($doc_type) ? $doc_type->getName() : '';
    if ($this->user_file) $this->helper->email_subject.= ' | File Number: '.$this->user_file->getNumber();
    
    $this->helper->fax_recipient = '';
    $this->helper->fax_subject = '';
    if (isset($fax)) {
      $this->helper->fax_recipient = str_replace(array(" ", "(", ")", "-"), array(""), $fax);
      $this->helper->fax_subject = 'FAX: '.$this->helper->email_subject;
    }
  }
  
  
  public function loadCommonDocDat($user_file, $return_type='document', $type='letter')
  {
    $document = new Document();
    
    // set default data
    if ($type != 'letter') {
      $this->helper->show_settings = false;
      $this->helper->ref_number = '';
    }
    
    // load default content into the text area if there is something to load for a certain document
    $document->setField17($this->getPartial('default_values', array('obj' => $this, 'field' => 'document_field17')));
    
    // return null if no user file defined => blank document
    if (!$user_file) return ($return_type == 'document') ? $document : array('document' => $document, 'last_court_date' => $this->last_court_date);
    
    // set data from user file
    $document->setUserFileId($user_file->getId());
    $document->setField1($user_file->getNumber());
    
    if ($type == 'invoice') {
      $document->setField2('');  // invoice number
      $this->helper->ref_number = $user_file->getNumber();
    }
    else {
      $document->setField2($user_file->getSolicitor()->getEmailAddress());
    }
    $document->setField4(strtoupper($user_file->getFullName()));
    
    if ( ($type == 'letter') || ($type == 'invoice') ) {
      $to_address = $user_file->getFullAddress();
      
      if ($this->helper->allow_address_change) {
        $type_address = $this->getUser()->getAttribute('corresponce_address');
        switch ($type_address) {
          case "other":   $to_address = $user_file->getFullAddress(null, null, 'other');        break;
          case "prison":  
          case "prisonx": $to_address = $user_file->getPrison()->getFullAddress('with_name');   break;
        }
      }
      $document->setField5($to_address);
      $document->setField6($user_file->getClient()->getFirstName());
    }
    
    if ($this->last_court_date) {
      $document->setField7(strtoupper($this->last_court_date->getCourt()->getName()));      
      $timestamp = strtotime($this->last_court_date->getDate());
      $document->setField8(date("d F Y", $timestamp));   
    }
    
    // this will be a drop box for solicitor
    $document->setField9($user_file->getSolicitorId());

    return ($return_type == 'document') ? $document : array('document' => $document, 'last_court_date' => $this->last_court_date);
  }
  
  
  public function executeSendFax(sfWebRequest $request)
  {
    $html = 'does not work';
    $elayout = $request->getParameter('elayout');
    if ($elayout) {
      $html = $elayout;
    }    
    $action = ($request->getParameter('action')) ? $request->getParameter('action') : 'fax';
 
    try {
      // create an API client instance
      $pdfservice = sfConfig::get("app_pdfservice");
      $client = new PdfCrowd($pdfservice["user"], $pdfservice["apikey"]);
      
      if ( ($action == 'view') || ($action == 'download') ) {
        // being sure no other content will be output
        $this->setLayout(false);
        sfConfig::set('sf_web_debug', false);
        
        // convert the html content to pdf
        $pdf = $client->convertHtml($html);
      
        /*// or read the content form a file (for testing purpose only)
        $this->forward404Unless(file_exists($this->temp_dir_path.'example.pdf'));     // check if the file exists
        $pdf = readfile($pdfpath);*/
        
        // Adding the file to the HTTP Response object
        $this->getResponse()->clearHttpHeaders();
        $this->getResponse()->setHttpHeader('Pragma: public', true);
        $this->getResponse()->setContentType('application/pdf');
        $this->getResponse()->setHttpHeader("Cache-Control: no-cache");
        $this->getResponse()->setHttpHeader("Accept-Ranges: none");
        if ($action == 'download') $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment; filename="document.pdf"');
        $this->getResponse()->sendHttpHeaders();
      
        $this->getResponse()->setContent($pdf);
      }
      else {        
        $faxservice = sfConfig::get('app_faxservice');
        $fax_to = ($request->getParameter('email_to')) ? $request->getParameter('email_to') : $faxservice["faxnumber"];
        $fax_subject =($request->getParameter('email_subject')) ? $request->getParameter('email_subject') : 'FAX';
        
        // fix fax format to be sent by email
        if (strpos($fax_to, "@".$faxservice["domain"]) === false) {
          $fax_to.= "@".$faxservice["domain"];
        }
    
        $message = $this->getMailer()->compose();
        $message->setSubject($fax_subject);
        $message->setTo($fax_to);
        $message->setFrom(array($faxservice["faxfromemail"] => sfConfig::get("app_server_emailfromtitle")));
        $message->setBody("The attached document of this email has been sent as a fax", 'text/html');
        $message = $this->generatePDFFile($html, $client, $message);
        
        $this->sendEmailProcess($message, $fax_to, $fax_subject, 2);
      }
      
      return sfView::NONE;
    }
    catch(PdfcrowdException $why) {
      die("Pdfcrowd Error: " . $why);
    }
    
  }
  
  
  public function generateHTMLFile($html, $message=null, $doc_name=null)
  {
    if ($doc_name === null) $doc_name = $this->helper->attached_doc_name;
    if (file_exists($this->temp_dir_path.$doc_name.".html")) unlink ($this->temp_dir_path.$doc_name.".html"); // first, delete file if exists
    
    $out_file = fopen($this->temp_dir_path.$doc_name.".html", "wb");
    fwrite($out_file, $html);
    fclose($out_file);
    
    if ($message) {
      $message->attach(Swift_Attachment::fromPath($this->temp_dir_path.$doc_name.".html"));
      return $message;
    }
  }
  
  
  public function generateDOCFile($html, $message=null, $doc_name=null)
  {
    $htmltodoc= new htmlToDoc(); 
     
    if ($doc_name === null) $doc_name = $this->helper->attached_doc_name;
    //else $this->helper->attached_doc_name = $doc_name;
    
    // save the doc content to a file and attach it to the email
    if (file_exists($this->temp_dir_path.$doc_name.".doc")) unlink ($this->temp_dir_path.$doc_name.".doc"); // first, delete file if exists
    //$out_file = fopen($this->temp_dir_path.$doc_name.".doc", "wb");
    $htmltodoc->createDoc($html, $this->temp_dir_path.$doc_name.".doc");
    //$htmltodoc->createDocFromURL("http://yahoo.com","test"); 
    //fclose($out_file);
    
    if ($message) {
      $message->attach(Swift_Attachment::fromPath($this->temp_dir_path.$doc_name.".doc"));
      return $message;
    }
  }
  
  public function generatePDFFile($html, $client=null, $message=null, $doc_name=null)
  {
    if ($client === null) {
      $pdfservice = sfConfig::get("app_pdfservice");
      $client = new PdfCrowd($pdfservice["user"], $pdfservice["apikey"]);
    }
    if ($doc_name === null) $doc_name = $this->helper->attached_doc_name;
    else $this->helper->attached_doc_name = $doc_name;
    
    // save the pdf content to a file and attach it to the email
    if (file_exists($this->temp_dir_path.$doc_name.".pdf")) unlink ($this->temp_dir_path.$doc_name.".pdf"); // first, delete file if exists
    $out_file = fopen($this->temp_dir_path.$doc_name.".pdf", "wb");
    $client->convertHtml($html, $out_file);
    fclose($out_file);
    
    if ($message) {
      $message->attach(Swift_Attachment::fromPath($this->temp_dir_path.$doc_name.".pdf"));
      return $message;
    }
  }
  
  
  // notify owner if fax is more than 3 pages
  function notifyFaxSent($fax_subject)
  {
    $faxservice = sfConfig::get('app_faxservice');
    $max_pages = sfConfig::get("app_server_notifyfaxpages");  
  
    if (MyUtil::getPdfFilePages($this->temp_dir_path.$this->helper->attached_doc_name.".pdf") > $max_pages) {
      $notify_msg = $this->getMailer()->compose();
      $notify_msg->setSubject("MORE THAN ".$max_pages." PAGES - ".$fax_subject);
      $notify_msg->setTo(sfConfig::get("app_server_owneremail"));
      $notify_msg->setFrom(array($faxservice["faxfromemail"] => sfConfig::get("app_server_emailfromtitle")));
      $notify_msg->setBody("The document '".$fax_subject."' has been faxed with more than ".$max_pages." pages", 'text/html');
      
      // no message created on success or failure, internal message only
      //$this->getMailer()->send($notify_msg));
    }
  }
  
  
  public function executeSendEmail(sfWebRequest $request)
  {    
    $html = $html_for_pdf = 'does not work';
    $elayout = $request->getParameter('elayout');
    if ($elayout) {
      $html_for_pdf = $elayout;   // get the original to convert into pdf
      
      // covert all external file style into inline style: email servers remove class labels anyway
      $css = file_get_contents (dirname(__FILE__).'/../../../../../web/css/document/print.css'); 
      $cssToInlineStyles = new CSSToInlineStyles($elayout, $css);
      $html = $cssToInlineStyles->convert();
  
      //remove no necessary stuff: 'class', 'id', 'css' elements and labels
      $html = preg_replace("/<link[^>]+\>/i", "", $html);
      $html = preg_replace('/class=".*?"/', '', $html);
      $html = preg_replace('/id=".*?"/', '', $html);
      
      //$html = mb_convert_encoding($html, "HTML-ENTITIES", "UTF-8");
    }
    
    $email_to = ($request->getParameter('email_to')) ? $request->getParameter('email_to') : sfConfig::get("app_server_emailto");
    $email_body = ($request->getParameter('email_body')) ? $request->getParameter('email_body') : '';
    $email_subject =($request->getParameter('email_subject')) ? $request->getParameter('email_subject') : 'Document';
    $html = '<p>'.$email_body.'</p>'.$html;
    
    $message = $this->getMailer()->compose();
    $message->setSubject($email_subject);
    $message->setTo($email_to);
    $message->setFrom(array(sfConfig::get("app_server_emailfrom") => sfConfig::get("app_server_emailfromtitle")));
    $message->setBody($html, "text/html");
    
    if ($this->helper->document_tpl_file_fmt) {
      if ($this->helper->document_tpl_file_fmt == 'pdf') $message = $this->generatePDFFile($html_for_pdf, null, $message);
      elseif ($this->helper->document_tpl_file_fmt == 'doc') {
        $message = $this->generateHTMLFile($html, $message);
        //$message = $this->generateDOCFile($html, $message);
      }
    }
    
    $this->sendEmailProcess($message, $email_to, $email_subject);
  }
  
  
  public function sendEmailProcess($message, $receiver_address, $subject, $type=1)
  {
    $sendByObj = Doctrine::getTable('SentBy')->find($type);
    $type_name = ($sendByObj) ? $sendByObj->getValue() : 'email';
    
    if ($this->getMailer()->send($message)) {
      $correspondence = new Correspondence();
      
      $current_client = $this->getUser()->getAttribute('client', null);
      if ($current_client !== null) {
        $user_file = ($current_client['last_file_id']) ? Doctrine::getTable('UserFile')->find($current_client['last_file_id']) : null;
        if ($user_file) {
          $correspondence->setReceiverId($user_file->getClientId());
          $correspondence->setReceiverName($user_file->getFullName());
          $correspondence->setUserFileId($user_file->getId());
          
          if ($this->last_court_date !== null) $correspondence->setCourtDateId($this->last_court_date->getId());
        }
      }
      $correspondence->setReceiverAddress($receiver_address);
      
      $correspondence->setSubject($subject);
      $correspondence->setSenderId($this->getUser()->getGuardUser()->getId());
      $correspondence->setDeliveredDate(date("Y-m-d"));
      $correspondence->setSentById($type); 
      
      $correspondence->save();
            
      if ($type == 1) die($type_name." was sent successfully.\nCorrespondence item was saved too!");
      else {
        $this->notifyFaxSent($subject);
        die($type_name." was sent successfully by email, this does not mean the fax reached the destinatary, please check your email for confirmation.\nCorrespondence item was saved, but it may need be updated after confirmation!");
      }
    }
    else {
      die("It was a problem sending the ".$type_name.", try again later.\nNo correspondence item was saved!");
    }
  }
  
  public function executeSaveInPlace(sfWebRequest $request)  
  {
    die(AdminContent::saveText($this->helper->document_tpl_file, $request));
    return sfView::NONE;
  }
  
  
  // necessary function to run the calendar "Change Document Date" in the document template
  public function executeCalendar(sfWebRequest $request)  {}
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /**************************************** CLIENT section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /**************************************** CORRESPONDENCE ****************************************/
  // Adjournment Letter - First Mention
  public function loadDocDatAdlefm($user_file)
  {
    return $this->loadCommonDocDat($user_file);  // return value bc other functions will use it
  }
  
  // Adjournment Letter - General
  public function loadDocDatAdlege($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Appointment - Make & Bring Docs
  public function loadDocDatApmabd($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Appointment - Make
  public function loadDocDatAplema($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Appointment - Confirm
  public function loadDocDatApcomf($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Brief - Forward Copy
  public function loadDocDatBrfwcp($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Brief - Received Make Appt (Through Staff)
  public function loadDocDatBrrmat($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Brief - Received Make Appt
  public function loadDocDatBrrmap($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Brief - Waiting & Will Forward Copy
  public function loadDocDatBrwwfc($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Brief - Waiting & Will Ring on Reciept
  public function loadDocDatBrwwrr($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Callover Letter
  public function loadDocDatClovle($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Cease to Act - No Contact
  public function loadDocDatCanoco($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Cease to Act - No Funding
  public function loadDocDatCanofu($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Cease to Act - Not Sent Legal Aid Docs
  public function loadDocDatCansla($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Document - Provide
  public function loadDocDatDocpro($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Fail to Answer Summons
  public function loadDocDatFtasum($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Fail to Answer Bail
  public function loadDocDatFtabai($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Legal Aid - Provide Signed Form
  public function loadDocDatLapsfo($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Legal Aid - Form Filled Out Over Phone
  public function loadDocDatLaffop($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Legal Aid - Provide Filled Out Form
  public function loadDocDatLapfof($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Legal Aid - New Means After 12 Months
  public function loadDocDatLanmam($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Legal Aid Refused
  public function loadDocDatLarefu($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Letter - Miscellaneous
  public function loadDocDatLemisc($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Psychologist - Confirm Appt & Fees
  public function loadDocDatPocafe($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Psychologist - Confirm Appt (Legal Aid)
  public function loadDocDatPocoac($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Psychiatrist - Confirm Appt & Fees
  public function loadDocDatPicafe($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Psychiatrist - Confirm Appt (Legal Aid)
  public function loadDocDatPicoac($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Result Letter - Interim
  public function loadDocDatRelein($user_file)
  {
    //return $this->loadDocDatAdlefm($user_file);
    return $this->loadDocDatReflma($user_file);
  }
  
  // Result Letter - Final Magistrates
  public function loadDocDatRelefm($user_file)
  {
    //return $this->loadDocDatAdlefm($user_file);
    return $this->loadDocDatReflma($user_file);
  }
  
  // Result Letter - Final Count/Supreme
  public function loadDocDatRelefc($user_file)
  {
    //return $this->loadDocDatAdlefm($user_file);
    return $this->loadDocDatReflma($user_file);
  }
  
  
  /***************************************** AUTHORITIES ******************************************/
  // Bank Authority
  public function loadDocDatBanaut($user_file)
  {
    return $this->loadDocDatClkacl($user_file, array('field3' => ''));
  }
  
  // Caveat Authority
  public function loadDocDatCavaut($user_file)
  {
    return $this->loadDocDatClkacl($user_file);
  }

  // Centrelink Authority (Client)
  public function loadDocDatClkacl($user_file, $extra_values=array())
  {
    $document = new Document();
    $document->setField3("CentreLink");
    foreach ($extra_values as $field => $value) {
      $method = 'set'.ucfirst($field);
      $document->$method($value);
    }
    $document->setField8($this->helper->address);
    
    if ($user_file) {
      $document->setUserFileId($user_file->getId());
      $document->setField1($user_file->getClient()->getUserProfiles()->getDobFormatted('d/m/Y'));
      $document->setField2($user_file->getClient()->getUserProfiles()->getCentrelinkCrn());
      $document->setField4(strtoupper($user_file->getFullName()));
      $document->setField5($user_file->getFullAddress());
      $document->setField9($user_file->getSolicitorId());   // this will be a drop box for solicitor
    }
    
    return $document;
  }
  
  // Centrelink Authority (non-Client)
  public function loadDocDatClkanc($user_file)
  {
    return $this->loadDocDatClkacl($user_file);
  }
  
  // Credit Card Authority
  public function loadDocDatCrcdau($user_file)
  {
    return $this->loadDocDatClkacl($user_file, array('field3' => ''));
  }
  
  // Credit Card Authority (non-Client)
  public function loadDocDatCcaunc($user_file)
  {
    $document = $this->loadDocDatClkacl($user_file, array('field3' => ''));
    $document->setField6($document->getField4());
    $document->setField4("");
    return $document;
  }
  
  // Fax - Enclosing File Authority
  public function loadDocDatFaxefa($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // File Collection Authority
  public function loadDocDatFicoau($user_file)
  {
    // NO TEMPLATE FOR THIS DOCUMENT TYPE, USING SIMILAR (Solicitor - File Authority), IT MAY REQUIRE CHANGE CONTENT
    return $this->loadDocDatClkacl($user_file, array('field3' => ''));
  }
  
  // General - File Authority
  public function loadDocDatGefiau($user_file)
  {
    // NO TEMPLATE FOR THIS DOCUMENT TYPE, USING SIMILAR (Solicitor - File Authority), IT MAY REQUIRE CHANGE CONTENT
    return $this->loadDocDatClkacl($user_file, array('field3' => ''));
  }
  
  // Letter - Enclosing File Authority
  public function loadDocDatLeefau($user_file)
  {
    // NO TEMPLATE FOR THIS DOCUMENT TYPE, USING SIMILAR (Letter - Informant), IT MAY REQUIRE CHANGE CONTENT
    $document = $this->loadDocDatCccole($user_file);
 
    $document->setField4('');
    $document->setField5('');
    $document->setField6('');
    return $document;
  }
  
  // Medical - File Authority (General)
  public function loadDocDatMefage($user_file)
  {
    return $this->loadDocDatClkacl($user_file, array('field3' => ''));
  }
  
  // Medical - File Authority (Justice health)
  public function loadDocDatMefajh($user_file)
  {
    $document = new Document();
    if ($user_file) {
      $document->setUserFileId($user_file->getId());
      $document->setField1(strtoupper($user_file->getFullName()));
      $document->setField2($user_file->getClient()->getUserProfiles()->getCriminalCrn());
    }
    return $document;
  }
  
  // Solicitor - File Authority
  public function loadDocDatSofiau($user_file)
  {
    return $this->loadDocDatClkacl($user_file, array('field3' => ''));
  }
  
  // Solicitor Holding Trust Monies - File Authority
  public function loadDocDatSohtmo($user_file)
  {
    return $this->loadDocDatClkacl($user_file, array('field3' => ''));
  }

  
  /******************************************** FORMS *********************************************/
  // Affidavit - Sworn
  public function loadDocDatAffswo($user_file, $return_type='document')
  {
    $data_arr = $this->loadDocDatF32adj($user_file, $return_type);
    if ($return_type=='document') $document = &$data_arr; else $document = &$data_arr['document'];
    
    $document->setField2(sfConfig::get("app_appowner_phone"));
    $document->setField3(sfConfig::get("app_appowner_fax"));
    $document->setField6(sfConfig::get("app_appowner_solicitorcode"));
    $document->setField8($this->helper->address);
    $document->setField11("The Accused");
    
    return $data_arr;
  }
  
  // Affidavit - Affirmed
  public function loadDocDatAffaff($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Affidavit (Solicitor Attesting) - Sworn
  public function loadDocDatAffsas($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Affidavit (Solicitor Attesting) - Affirmed
  public function loadDocDatAffsaa($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Affidavit - Exhibit Cover Sheet
  public function loadDocDatAffecs($user_file)
  {
    return $this->loadDocDatF32adj($user_file);
  }
  
  // Character Reference - Fax Cover
  public function loadDocDatCrfxco($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Character Reference Guide - New Client
  public function loadDocDatCrgunc($user_file)
  {
    $document = $this->loadDocDatAdlefm($user_file);
    $document->setField6('Sir/Madam');
    return $document;
  }
  
  // Character Reference Guide - 3rd party
  public function loadDocDatCrgutp($user_file)
  {
    $document = $this->loadDocDatAdlefm($user_file);
    $document->setField6('');
    return $document;
  }
  
  // Character Reference - Magistrates` Court
  public function loadDocDatCrmaco($user_file)
  {
    return $this->loadDocDatCrgunc($user_file);
  }
  
  // Character Reference - Other Court
  public function loadDocDatCrotco($user_file)
  {
    return $this->loadDocDatCrgunc($user_file);
  }
  
  // FOI Request Form
  public function loadDocDatFoirqf($user_file)
  {
    $document = new Document();
    if ($user_file) {   
      $document->setUserFileId($user_file->getId());
      $document->setField1(ucfirst($user_file->getFirstName()));
      $document->setField2(ucfirst($user_file->getLastName()));
      $document->setField3($user_file->getFullAddress());
      $document->setField4($user_file->getFullName());
    }
    
    return $document;
  }
  
  // FOI Request - Provide Signed Form
  public function loadDocDatFoirps($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // FOI Request - Cover Letter
  public function loadDocDatFoircl($user_file)
  {
    $document = $this->loadDocDatAdlefm($user_file);
    $document->setField6('');
    return $document;
  }
  
  // Restoration of Licence - Standard Questions
  public function loadDocDatRelisq($user_file)
  {
    // THIS DOCUMENT TYPE DOES NOT REQUIRE ENTRY DATA FORM, PLAIN TEXT ONLY
  }
  
  // Statutory Declaration - Misc
  public function loadDocDatStdemi($user_file)
  {
    $document = $this->loadDocDatClkacl($user_file);
    $document->setField2('');
    return $document;
  }
  
  // Statutory Declaration - Misc (Solicitor Attesting)
  public function loadDocDatStdesa($user_file)
  {
    return $this->loadDocDatStdemi($user_file);
  }
  
  // Statutory Declaration - No Income
  public function loadDocDatStdeni($user_file)
  {
    return $this->loadDocDatStdemi($user_file);
  }
  
  // Statutory Declaration - No Income (Solicitor Attesting)
  public function loadDocDatStdens($user_file)
  {
    return $this->loadDocDatStdemi($user_file);
  }
  
  
  /***************************************** INSTRUCTIONS *****************************************/
  // Country Plea Outline
  public function loadDocDatCoplou($user_file)
  {
    $document = $this->loadDocDatGenins($user_file);
    
    // load default content into the text area if there is something to load for a certain document
    $document->setField17($this->getPartial('default_values', array('obj' => $this, 'field' => 'document_field17')));
   
    return $document;
  }
  
  // General Instructions
  public function loadDocDatGenins($user_file)
  {
    $document = new Document();
    $this->helper->dob_detail = '';
    
    if ($user_file) {
      $document->setUserFileId($user_file->getId());
      $document->setField1($user_file->getNumber());
      $document->setField2($user_file->getClient()->getUserProfiles()->getDobFormatted('d/m/Y'));
      $this->helper->dob_detail = $user_file->getClient()->getUserProfiles()->getDobDetail();
      $document->setField4(strtoupper($user_file->getFullName()));
      $document->setField5($user_file->getFullAddress());
      $document->setField17($user_file->getInstruction());
    }
    
    return $document;
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /*************************************** INFORMANT section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /**************************************** CORRESPONDENCE ****************************************/
  // Alibi Notice
  public function loadDocDatAlinot($user_file)
  {
    $document = $this->loadDocDatF32adj($user_file);
    if ($user_file) {
      $document->setField2('');
      $document->setField11('');
      $document->setField3(substr($document->getField7(),3));
      $document->setField5($user_file->buildChargeList());
    }
    return $document;
  }
  
  // Appeal Notice - Fax
  public function loadDocDatApnofx($user_file)
  {
    $document = $this->loadCommonDocDat($user_file, 'document', 'fax');
    if ($user_file) {
      $document->setField5($user_file->getInformant()->obtainFullName('w_honorific'));
      $document->setField6($user_file->getInformant()->getUserProfiles()->getFax());
    }
    
    return $document;
  }
  
  // Chief Commissioner - Costs letter
  public function loadDocDatCccole($user_file, $return_type='document')
  {
    // this type does not load some fields that we need to cutomized
    $data_arr = $this->loadCommonDocDat($user_file, $return_type);
    if ($return_type=='document') $document = &$data_arr; else $document = &$data_arr['document'];
    
    if ($user_file) {
      $document->setField10($document->getField4());
      $document->setField4($user_file->getInformant()->obtainFullName('w_honorific'));
      $police_station = $user_file->getInformant()->getAgencies();
      if ($police_station) $document->setField5($police_station[0]->getFullAddress('w_name'));
      $document->setField6($document->getField4());
    }
    
    return $data_arr;
  }
  
  // Contest Mention - Fax
  public function loadDocDatComefx($user_file)
  {
    return $this->loadDocDatApnofx($user_file);
  }
  
  // Damages/Restitution - Details Sought
  public function loadDocDatDrdeso($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Diversion Letter
  public function loadDocDatDivlet($user_file)
  {
    if ($user_file) {
      $this->helper->pre_text = "We act for the abovenamed defendant, who has been charged with the following:
        <br/>".$user_file->buildChargeList('static')."
        <br/>".$user_file->getFullName()." is ".$user_file->getClient()->getUserProfiles()->getDobDetail()."<br/>";
    }
    return $this->loadDocDatCccole($user_file);
  }
  
  // Documents - Request Further
  public function loadDocDatDorefu($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Fax - Informant
  public function loadDocDatFaxinf($user_file)
  {
    return $this->loadDocDatApnofx($user_file);
  }
  
  // Fail to Appear - Summons Single Informant
  public function loadDocDatFtassi($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Fail to Appear - Summons Multiple Informants
  public function loadDocDatFtasmi($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Infringement Notice - Objection Letter
  public function loadDocDatInoble($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Interview Recording Request
  public function loadDocDatInrere($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Letter - Informant
  public function loadDocDatLetinf($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Rebail - Multiple Informants
  public function loadDocDatRemuin($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Rebail - Single Informant
  public function loadDocDatResiin($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  // Section 32C - Confidential Comms. Application to Issue Subpoena
  public function loadDocDatS32cas($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Section 32C - Confidential Comms. (Magistrates)
  public function loadDocDatS32cma($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    $document->setField5($user_file->getProsecution()->getName());
    return $document;
  }
  
  // Section 32C - Confidential Comms. (Other Courts)
  public function loadDocDatS32coc($user_file)
  {
    return $this->loadDocDatS32cma($user_file);
  }
  
  // Section 342 - Prior Sex (Magistrates)
  public function loadDocDatS34psm($user_file)
  {
    return $this->loadDocDatS32cma($user_file);
  }
  
  // Section 342 - Prior Sex (Other Courts)
  public function loadDocDatS34pso($user_file)
  {
    return $this->loadDocDatS32cma($user_file);
  }
  
  // Witness Priors - Request
  public function loadDocDatWiprre($user_file)
  {
    return $this->loadDocDatCccole($user_file);
  }
  
  
  /******************************************* BRIEFS *********************************************/
  // Brief Request 1
  public function loadDocDatBrirq1($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all', 'fax');
    if ($user_file) {
      $data_arr['document']->setField5($user_file->getInformant()->obtainFullName('w_honorific'));
      $data_arr['document']->setField6($user_file->getInformant()->getUserProfiles()->getFax()); 
      /*if ($data_arr['last_court_date']) { // no need of this, field loaded in loadCommonDocDat
        $data_arr['document']->setField17($this->getPartial('default_values', array('obj' => $this, 'field' => 'document_field17')));
      }*/
    }
  
    return $data_arr['document'];
  }
  
  // Brief Request 2
  public function loadDocDatBrirq2($user_file)
  {
    return $this->loadDocDatBrirq1($user_file);
  }
  
  // Brief Request 3
  public function loadDocDatBrirq3($user_file)
  {
    return $this->loadDocDatBrirq1($user_file);
  }
  
  // Brief Request 4
  public function loadDocDatBrirq4($user_file)
  {
    return $this->loadDocDatBrirq1($user_file);
  }
  
  
  /***************************************** PROSECUTORS ******************************************/
  // Fax - Enclosing Adjournment
  public function loadDocDatFxenad($user_file)
  {
    $document = $this->loadCommonDocDat($user_file, 'document', 'fax');
    if ($user_file) {
      $document->setField5($user_file->getProsecutor()->obtainFullName('w_honorific'));
      $document->setField6($user_file->getProsecutor()->getUserProfiles()->getFax());
    }
    
    return $document;
  }
  
  // Fax - Enclosing Documents
  public function loadDocDatFxendc($user_file)
  {
    return $this->loadDocDatFxenad($user_file);
  }
  
  // Fax - Miscellaneous
  public function loadDocDatFxmisc($user_file)
  {
    return $this->loadDocDatFxenad($user_file);
  }
  
  // Letter to Prosecutors
  public function loadDocDatLttops($user_file, $return_type='document')
  {
    // this letter type does not load some fields that we need to cutomized
    $data_arr = $this->loadCommonDocDat($user_file, $return_type);
    if ($return_type=='document') $document = &$data_arr; else $document = &$data_arr['document'];

    if ($user_file) {
      $document->setField10($document->getField4());
      $document->setField4($user_file->getProsecutor()->obtainFullName('w_honorific'));
      $prosecution = $user_file->getProsecutor()->getAgencies();
      if ($prosecution) $document->setField5($prosecution[0]->getFullAddress('w_name'));
      $document->setField6($document->getField4());
    }
    
    return $data_arr;
  }
  
  // Summary Case Conference Letter
  public function loadDocDatSccolt($user_file)
  {
    return $this->loadDocDatLttops($user_file);
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /************************************** COURT DATE section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /******************************************* RESULTS ********************************************/
  // Case Study
  public function loadDocDatCasstu($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField5('');
      $data_arr['document']->setField6($data_arr['last_court_date']->getJudge()->obtainFullName('w_honorific'));
      $this->helper->charge_list = $user_file->buildChargeList('static');
      $data_arr['document']->setField17($data_arr['last_court_date']->getResult());
    }
    return $data_arr['document'];
  }
  
  // Email Result to Solicitor
  public function loadDocDatErtsol($user_file)
  {
    $document = $this->loadDocDatReflma($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    return $document;
  }
  
  // Filenote - of Result
  public function loadDocDatFilore($user_file)
  {
    return $this->loadDocDatCasstu($user_file);
  }
  
  // Result - Final Letter (Mags)
  public function loadDocDatReflma($user_file, $return_type='document')
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      //$data_arr['document']->setField17($data_arr['last_court_date']->getCustomResult('w_preface'));
      
      $solicitor = trim($user_file->getSolicitor()->obtainFullName());
      $judge = trim($data_arr['last_court_date']->getJudge()->obtainFullName('w_honorific'));
      $result = trim($data_arr['last_court_date']->getResult());
    }
    if (empty($solicitor))  $solicitor = "___________";
    if (empty($judge))      $judge = "___________";
    if (empty($result))     $result = "";
    
    $values = array($solicitor, $judge, $result);
    $vars = array("%%solicitor%%", "%%judge%%", "%%result%%");
    $data_arr['document']->setField17(str_replace($vars, $values, $data_arr['document']->getField17()));
  
    return ($return_type=='document') ? $data_arr['document'] : $data_arr;
  }
  
  // Result - Final Letter (Other)
  public function loadDocDatReflot($user_file)
  {
    return $this->loadDocDatReflma($user_file);
  }
  
  // Result - Interim Letter
  public function loadDocDatReinle($user_file)
  {
    return $this->loadDocDatReflma($user_file);
  }
  
  // Result Sheet - Final
  public function loadDocDatReshfi($user_file)
  {
    //$data_arr = $this->loadCommonDocDat($user_file, 'all');
    $data_arr = $this->loadDocDatReflma($user_file, 'all');
    
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField3($user_file->getContactData('phonesfixed'));
      $data_arr['document']->setField6($data_arr['last_court_date']->getJudge()->obtainFullName('w_honorific'));
      $data_arr['document']->setField10($user_file->getInformant()->obtainFullName('w_honorific'));
      $this->helper->charge_list = $user_file->buildChargeList('static');
      //$data_arr['document']->setField17($data_arr['last_court_date']->getCustomResult('w_preface'));
    }
    return $data_arr['document'];
  }
  
  // Result Sheet
  public function loadDocDatReshee($user_file)
  {
    // display document only to print
    $charge_module = sfContext::getInstance()->getRequest()->getParameter('modulex');
    
    if ($charge_module) {
      $this->helper->only_print = true;
      $this->helper->show_settings = false;
    }
    
    $document = new Document();
    if (!$user_file) return $document;
        
    $document->setUserFileId($user_file->getId());
    $document->setField1($user_file->getNumber());
    $document->setField2($user_file->getClient()->getUserProfiles()->getDobFormatted('d/m/Y'));
    $this->helper->dob_detail = $user_file->getClient()->getUserProfiles()->getDobDetail();
    
    $document->setField3($user_file->getContactData('phonesfixed'));
    $document->setField4(strtoupper($user_file->getFullName()));
    $document->setField5($user_file->getFullAddress());
    $document->setField6(strtoupper($user_file->getInformant()->obtainFullName('w_honorific')));
    $document->setField8(strtoupper($user_file->getProsecutor()->obtainFullName('w_honorific')));
    $document->setField9($user_file->getSolicitorId());
    $document->setField11($user_file->getCaseNumber());
    $document->setField13($user_file->getbailOnThis());
    $document->setField16($user_file->getEmail());
    $document->setField17($user_file->buildChargeList());
    $document->setField18($user_file->buildResultList());
       
    $court_date = $user_file->getFileCourtDates();
    $last_court_date = null;
    if (count($court_date)) {
      $last_court_date = $court_date[count($court_date)-1];
      $court_date = $last_court_date->getDate();
      $court_name = $last_court_date->getCourt()->getName();
      $listing = $last_court_date->getListing()->getName();
      $court_result = $last_court_date->getResult();
      $document->setField7(strtoupper($court_name));
      $document->setField12($listing);
      
      $this->helper->court_date = date("D j F Y", strtotime($court_date));
      $this->helper->court_line = "<tr>
        <td>".date('d F Y', strtotime($court_date))."</td>
        <td>".$court_name."</td>
        <td>".$listing."</td>
        <td>".$user_file->getSolicitor()->obtainFullName()."</td>
        <td>".$last_court_date->getJudge()->obtainFullName('w_honorific')."</td>
      </tr>";
      
      if (!empty($court_result)) $this->helper->court_line.= "<tr><td colspan='5'>".$court_result."</td></tr>";
    }
    
    return $document;
  }
  
  
  /********************************* RESULTS : DRINK DRIVE LETTERS ********************************/
  // Drink Driving Result
  public function loadDocDatDrdrre($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Interlock Removal
  public function loadDocDatInlrev($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // License Restoration Pending Letter
  public function loadDocDatLrpelt($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  // Result of License Restoration
  public function loadDocDatRelirs($user_file)
  {
    return $this->loadDocDatAdlefm($user_file);
  }
  
  
  // CONSIDER MOVE THIS SECTION TO AGENCIES: PRISON
  /************************************* RESULTS : CUSTODY STATUS *********************************/
  // Request CRN Number (ALREADY DEFINED IN PRISONS) 
  public function loadDocDatRcrnn1($user_file) 
  {
    return $this->loadDocDatRcrnnb($user_file);
  }
  
  // Request CRN Number and Location (ALREADY DEFINED IN PRISONS) 
  public function loadDocDatRcrna1($user_file) 
  {
    return $this->loadDocDatRcrnal($user_file);
  }
  
  // Request Gaol (SIMILAR TO "Request Prison Location") 
  public function loadDocDatRqsgao($user_file) 
  {
    return $this->loadDocDatRcrnal($user_file, 'document', 'fax');
  }
  
  // YTC Location (ALREADY DEFINED IN PRISONS) 
  public function loadDocDatYtclo2($user_file) 
  {
    return $this->loadDocDatYtcloc($user_file);
  } 
 
  
  /************************************** SUMMARY ADJOURNMENTS ************************************/
  // Adjourn to Contest Mention
  public function loadDocDatAdcome($user_file)
  {
    $document = $this->loadDocDatFxcorc($user_file, 'CRC');
    $document->setField5('Criminal Co-ordinator');
    $informant = ($user_file) ? $user_file->getInformant()->obtainFullName('w_honorific') : '';
    $document->setField17(str_replace('%%informant%%', $informant, $document->getField17()));
    return $document;
  }
  
  // Adjourn to Contest Mention -  No response to SCC Request
  public function loadDocDatAdcmnr($user_file)
  {
    return $this->loadDocDatAdcome($user_file);
  }
  
  // Adjourn to Consolidation Plea
  public function loadDocDatAdcopl($user_file)
  {
    $document = $this->loadDocDatFxcorc($user_file, 'CRC');
    $document->setField5('Criminal Co-ordinator');
    return $document;
  }
  
  // Adjourn to Guilty Plea
  public function loadDocDatAdgupl($user_file)
  {
    return $this->loadDocDatAdcopl($user_file);
  }
  
  // Adjourn to Summary case Conference
  public function loadDocDatAdsucc($user_file)
  {
    return $this->loadDocDatAdcome($user_file);
  }
  
  // First Mention on Summons - Adjourn to Further Mention
  public function loadDocDatFmsafm($user_file)
  {
    return $this->loadDocDatAdcome($user_file);
  }
  
  // Miscellaneous - Adjourn to Further Mention
  public function loadDocDatMisafm($user_file)
  {
    return $this->loadDocDatAdcopl($user_file);
  }
  
  // No Brief - Adjourn to Further Mention
  public function loadDocDatNobafm($user_file)
  {
    return $this->loadDocDatAdcopl($user_file);
  }
  
  // No Instructions - Adjourn to Further Mention
  public function loadDocDatNiatfm($user_file)
  {
    return $this->loadDocDatAdcome($user_file);
  }
  
  // Time Certainty
  public function loadDocDatTimcer($user_file)
  {
    return $this->loadDocDatAdcopl($user_file);
  }
  
  
  /******************************************** CHILDREN ******************************************/
  // Affidavit of Service public (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatAfofs1($user_file) 
  {
    return $this->loadDocDatAfofse($user_file);
  }
  
  // Bail Application - First Time (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatBafit1($user_file)
  {
    return $this->loadDocDatBafiti($user_file);
  }
  
  // Bail Application - Previous Refusal (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatBaprr1($user_file)
  {
    return $this->loadDocDatBaprre($user_file);
  }
  
  // Bail Application - Variation of Conditions (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatBavoc1($user_file)
  {
    return $this->loadDocDatBavoco($user_file);
  }
  
  // Cease to Act (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatCetoa1($user_file)
  {
    return $this->loadDocDatCetoac($user_file);
  }
  
  // Certified Extract - Request (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatCeexr1($user_file) 
  {
    return $this->loadDocDatCeexre($user_file);
  }
  
  // Digital Recording - Request (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatDirer1($user_file)
  {
    return $this->loadDocDatDirere($user_file);
  }
  
  // Fax to Children`s Court
  public function loadDocDatFxchco($user_file)
  {
    return $this->loadDocDatFxcorc($user_file, 'CRC');
  }
  
  // Gaol Order (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatGaoor1($user_file) 
  {
    return $this->loadDocDatGaoord($user_file);
  }
  
  // Gaol Order - fax to YTC Enclosing (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatGofty1($user_file) 
  {
    return $this->loadDocDatGoftye($user_file);
  }
  
  // Gaol Order - fax to Magistrate to Sign (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatGoftm1($user_file) 
  {
    return $this->loadDocDatGoftms($user_file);
  }
  
  // General Application (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatGenap1($user_file) 
  {
    return $this->loadDocDatGenapp($user_file);
  }
  
  // Letter to Children`s Court
  public function loadDocDatLechco($user_file, $return_type='document')
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    
    if ($user_file) {
      $data_arr['document']->setField10($data_arr['document']->getField4());  
    }
    if ($data_arr['last_court_date']) {  // get the value from the current court date
      $data_arr['document']->setField4($data_arr['last_court_date']->getCourt()->getName());
      $data_arr['document']->setField5($data_arr['last_court_date']->getCourt()->getFullAddress());    
    }
    $data_arr['document']->setField6('');
    
    return ($return_type=='document') ? $data_arr['document'] : $data_arr;
  }
  
  // Ropes Program
  public function loadDocDatRoppro($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      //$this->helper->court_title = "IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName());
    }
    
    if ($user_file) {
      $data_arr['document']->setField2('');
      $data_arr['document']->setField3($user_file->getClient()->getUserProfiles()->getDobFormatted('d/m/Y'));
      
      $data_arr['document']->setField6($user_file->getInformant()->obtainFullName('w_honorific'));
      $police_station = $user_file->getInformant()->getAgencies();
      if ($police_station) $data_arr['document']->setField7($police_station[0]->getFullAddress('w_name'));

      $data_arr['document']->setField8($user_file->buildChargeList());
      $data_arr['document']->setField9($user_file->getChargesDate('d/m/Y'));
      
      $data_arr['document']->setField10("Informant (caution referral)");
    }
    return $data_arr['document'];
  }
  
  // Time Certainty (ALREADY DEFINED IN SUMMARY ADJOURNMENTS) 
  public function loadDocDatTimce1($user_file) 
  {
    return $this->loadDocDatTimcer($user_file);
  }
  
  // Witness Summons (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatWitsu1($user_file) 
  {
    return $this->loadDocDatWitsum($user_file);
  }
  
  
  /****************************************** MAGISTRATES *****************************************/
  // Affidavit of Service
  public function loadDocDatAfofse($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Bail Application - First Time
  public function loadDocDatBafiti($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $this->helper->court_title = "IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName());
      $data_arr['document']->setField13($this->helper->court_title);
    }
    
    if ($user_file) {
      $data_arr['document']->setField3($user_file->getClient()->getUserProfiles()->getDobFormatted('d/m/Y'));
      $data_arr['document']->setField6($user_file->getCaseNumber());
      $data_arr['document']->setField10(strtoupper($user_file->getInformant()->obtainFullName('w_honorific')));
      $data_arr['document']->setField17($user_file->buildChargeList());
      $data_arr['document']->setField15($user_file->getInformant()->getUserProfiles()->getBadgeNumber());
    }
    $data_arr['document']->setField11(sfConfig::get("app_appowner_phone"));
    $data_arr['document']->setField12(sfConfig::get("app_appowner_fax"));
    $data_arr['document']->setField18($this->getPartial('default_values', array('obj' => $this, 'field' => 'document_field18')));
    
    return $data_arr['document'];
  }
  
  // Bail Application - Previous Refusal
  public function loadDocDatBaprre($user_file)
  {
    $document = $this->loadDocDatBafiti($user_file);
    $document->setField19($this->getPartial('default_values', array('obj' => $this, 'field' => 'document_field19')));
    return $document;
  }
  
  // Bail Application - Variation of Conditions
  public function loadDocDatBavoco($user_file)
  {
    $document = $this->loadDocDatBafiti($user_file);
    $document->setField11("");
    $document->setField17($this->getPartial('default_values', array('obj' => $this, 'field' => 'document_field17')));
    return $document;
  }
  
  // Cease to Act
  public function loadDocDatCetoac($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField7("IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName()));
    }
    if ($user_file) {
      $data_arr['document']->setField10(strtoupper($user_file->getInformant()->obtainFullName('w_honorific')));
    }
    $data_arr['document']->setField3($this->helper->address);
    
    return $data_arr['document'];
  }
  
  // Certified Extract - Request
  public function loadDocDatCeexre($user_file)
  {
    $document = $this->loadDocDatLechco($user_file);
    $document->setField5($document->getField5()."\n"."Attn: Criminal Registry");
    
    return $document;
  }
  
  // Digital Recording - Request
  public function loadDocDatDirere($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField11($data_arr['last_court_date']->getJudge()->obtainFullName('w_honorific'));
    }
    if ($user_file) {
      $data_arr['document']->setField3($user_file->getCaseNumber());
    }
    $data_arr['document']->setField14(sfConfig::get("app_appowner_phone"));
    $data_arr['document']->setField15($this->helper->address);
    
    return $data_arr['document'];
  }
  
  // Case Abridgement - Application
  public function loadDocDatCaabap($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField7("IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName()));
    }
    if ($user_file) {
      $data_arr['document']->setField3($user_file->getCaseNumber());  // case number = court reference?
      //$data_arr['document']->setField6($data_arr['document']->getField4());
      $data_arr['document']->setField11($user_file->getClient()->getUserProfiles()->getDobFormatted('d/m/Y'));
    }
    
    return $data_arr['document'];
  }
  
  // Fax to Court Registry/Coordinator
  public function loadDocDatFxcorc($user_file, $coo_type='REG', $return_type='document')
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all', 'fax');
    if ($data_arr['last_court_date']) {
      $fax_number = '';
      $user_id = $data_arr['last_court_date']->getCourt()->retrieveUserByGroup('code', $coo_type);
      if (!empty($user_id)) {
        $user = Doctrine::getTable('sfGuardUser')->findOneBy('id', $user_id);
        $fax_number = $user->getUserProfiles()->getFax();
      }
      $data_arr['document']->setField6($fax_number);
    }
    
    return ($return_type=='document') ? $data_arr['document'] : $data_arr;
    //return $data_arr['document'];
  }
  
  // Gaol Order
  public function loadDocDatGaoord($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($user_file->getPrison()->getName());
      $document->setField17($user_file->buildChargeList());
    }
    $document->setField3("The Officer in Charge");
    
    // could be the solicitor data
    $document->setField1("");
    $document->setField2("");
    $document->setField5("");
    $document->setField6("");
    $document->setField9("");
    
    return $document;
  }
  
  // Gaol Order - fax to YTC Enclosing
  public function loadDocDatGoftye($user_file)
  {
    return $this->loadDocDatFxcorc($user_file);
  }
  
  // Gaol Order - fax to Magistrate to Sign
  public function loadDocDatGoftms($user_file)
  {
    return $this->loadDocDatFxcorc($user_file);
  }
  
  // General Application
  public function loadDocDatGenapp($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField7("IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName()));
    }
    if ($user_file) {
      $data_arr['document']->setField3($user_file->getCaseNumber());
    }
    
    return $data_arr['document'];
  }
  
  // Letter to Magistrate`s Court
  public function loadDocDatLemaco($user_file)
  {
    return $this->loadDocDatLechco($user_file);
  }
  
  // Video Link Request
  public function loadDocDatVilkre($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField18($user_file->buildChargeList());
      $document->setField11($user_file->getClient()->getUserProfiles()->getCriminalCrn());
      $document->setField12($user_file->getPrison()->getName());
    }
    $document->setField3(sfConfig::get("app_appowner_firmname"));
    $document->setField10(sfConfig::get("app_appowner_phone"));
    
    return $document;
  }
  
  // Witness Summons
  public function loadDocDatWitsum($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');

    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField2("IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName()));
      $data_arr['document']->setField5($data_arr['last_court_date']->getCourt()->getFullAddress());
      $data_arr['document']->setField6($data_arr['last_court_date']->getCourt()->getPhone());
      $data_arr['document']->setField16($data_arr['last_court_date']->getTimeFormatted());
    }
    if ($user_file) {
      $data_arr['document']->setField3($user_file->getCaseNumber());  // court reference = case number?
      $data_arr['document']->setField18($user_file->buildChargeList());
      $data_arr['document']->setField10($user_file->getInformant()->obtainFullName('w_honorific'));
      $data_arr['document']->setField11($user_file->getProsecution()->getName());
      $data_arr['document']->setField12($user_file->getProsecution()->getEmail());
      $data_arr['document']->setField13($user_file->getProsecution()->getPhone());
    }
    
    $solicitor_info = $this->helper->address ."\nPhone:".sfConfig::get("app_appowner_phone");
    $data_arr['document']->setField14($solicitor_info);
    //$data_arr['document']->setField15(sfConfig::get("app_appowner_phone"));
    
    // witness fields
    $data_arr['document']->setField1("");
    $data_arr['document']->setField15("");
    
    return $data_arr['document'];
  }
  
  // Application to Vary Bail
  public function loadDocDatApvaba($user_file)
  {
    $document = new Document();
    
    if ($user_file) {
      $document->setField4($user_file->getFullName());
      $court_date = $user_file->getFileCourtDates();
      if (count($court_date)) { // get the last court date,
        $last_court_date = $court_date[count($court_date)-1];
        $document->setField2("IN THE ".strtoupper($last_court_date->getCourt()->getName()));
      }
    }
    
    return $document;
  }
  
  // Notice of Appeal s51
  public function loadDocDatNoap51($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField2("IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName()));
    }
    
    if ($user_file) {  
      $data_arr['document']->setField6($user_file->getInformant()->obtainFullName('w_honorific'));
      /*$police_station = $user_file->getInformant()->getAgencies();
      if ($police_station) $data_arr['document']->setField7($police_station[0]->getFullAddress('w_name'));*/
      $data_arr['document']->setField10($user_file->getChargesDate('d/m/Y'));
      $data_arr['document']->setField5(str_replace("\n", ' ', $data_arr['document']->getField5()));
    }
    return $data_arr['document'];
  }
  
  // Request for contested form12
  public function loadDocDatRecofr($user_file)
  {
    $document = new Document();
    
    if ($user_file) {
      $document->setField4($user_file->getFullName());
      $document->setField6($user_file->getInformant()->obtainFullName('w_honorific'));
      $document->setField9($user_file->getSolicitorId());
      $court_date = $user_file->getFileCourtDates();
      if (count($court_date)) { // get the last court date,
        $last_court_date = $court_date[count($court_date)-1];
        $document->setField2("IN THE ".strtoupper($last_court_date->getCourt()->getName()));
      }
    }
    
    return $document;
  }
  
  // Audio Visual Link Form44 (ALREADY DEFINED IN COMMITTAL STREAM) 
  public function loadDocDatVlntc1($user_file) 
  {
    return $this->loadDocDatVlntcr($user_file);
  }
  
  // Sexual Offences List FormA
  public function loadDocDatSeolfa($user_file)
  {
    $document = new Document();
    return $document;;
  }
  
  // Sexual Offences List FormB
  public function loadDocDatSeolfb($user_file)
  {
    return $this->loadDocDatSeolfa($user_file);
  }
  
  
  /**************************************** COMMITTAL STREAM **************************************/
  // Application - Form 31
  public function loadDocDatApfr31($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField15("IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName()));
    }
    if ($user_file) {
      $data_arr['document']->setField3($user_file->getCaseNumber());
      $data_arr['document']->setField10("Police Prosecutors");
      
      // no neccesary to have a committal to have committal mention date
      //if ($this->committal_stream) $data_arr['document']->setField11($this->committal_stream->getMentionDate());
      $data_arr['document']->setField11($data_arr['document']->getCommittalMentionDate($user_file));
    }
    $data_arr['document']->setField12($this->helper->address);
    $data_arr['document']->setField13(sfConfig::get("app_appowner_phone"));
    $data_arr['document']->setField14(sfConfig::get("app_appowner_fax"));
    
    return $data_arr['document'];
  }
  
  // Cease Abridgement - Notice
  public function loadDocDatCeabno($user_file)
  {
    return $this->loadDocDatCaabap($user_file);
  }
  
  // Cease to Act - Committal
  public function loadDocDatCetacm($user_file)
  {
    return $this->loadDocDatCetoac($user_file);
  }
  
  // Form 32 - Cross-examine Witnesses
  public function loadDocDatF32cew($user_file)
  {
    return $this->loadDocDatF32adj($user_file);
  }
  
  // Form 32 - Straight Hand-up
  public function loadDocDatF32shu($user_file)
  {
    return $this->loadDocDatF32adj($user_file);
  }
  
  // Form 32 - Adjournment
  public function loadDocDatF32adj($user_file, $return_type='document')
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    $this->helper->address_text = str_replace("\n", "<br/>", $this->helper->address);
    
    if ($data_arr['last_court_date']) {
      $this->helper->court_title = "IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName());
    }
    if ($user_file) {
      $data_arr['document']->setField6($user_file->getCaseNumber());
      $data_arr['document']->setField7($this->helper->court_title);
      $data_arr['document']->setField10(strtoupper($user_file->getInformant()->obtainFullName('w_honorific')));
      $data_arr['document']->setField11($data_arr['document']->getCommittalMentionDate($user_file));
      
      if ($this->committal_stream) $data_arr['document']->setField11($this->committal_stream->getMentionDate());
    }
    
    return ($return_type=='document') ? $data_arr['document'] : $data_arr;
  }
  
  // Fax to Committals Co-ordinator
  public function loadDocDatFxcoco($user_file)
  {
    $document = $this->loadCommonDocDat($user_file, 'document', 'fax');
    if ($user_file) {
      $document->setField5("Committals Co-ordinator");
      $document->setField6(""); // fax from who or what (court)?
    }
    
    return $document;
  }
  
  // Fax - Filing Hearing Without Solicitor & Form 25
  public function loadDocDatFxff25($user_file)
  {
    return $this->loadDocDatFxcoco($user_file);
  }
  
  // Form 25 - Appearance
  public function loadDocDatF25apa($user_file)
  {
    return $this->loadDocDatF32adj($user_file);
  }
  
  // Letter to Committal Co-ordinator
  public function loadDocDatLecoco($user_file)
  {
    $document = $this->loadDocDatLechco($user_file);
    $document->setField5($document->getField5()."\n\n"."Attn: Committals Co-ordinator");
    return $document;
  }
  
  // Special Mention - Consent
  public function loadDocDatSpmeco($user_file)
  {
    return $this->loadDocDatFxcoco($user_file);
  }
  
  // Special Mention - No Consent
  public function loadDocDatSpmenc($user_file)
  {
    return $this->loadDocDatFxcoco($user_file);
  }
  
  // Video Link - Notification to Central Records
  public function loadDocDatVlntcr($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField7("IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName()));
    }
    if ($user_file) {
      $data_arr['document']->setField3($user_file->getCaseNumber());
      $data_arr['document']->setField10($user_file->getClient()->getUserProfiles()->getCriminalCrn());
      $data_arr['document']->setField11($user_file->getPrison()->getName());
    }
    
    return $data_arr['document'];
  }
  
  // Video Link - Booking Request
  public function loadDocDatVlbore($user_file)
  {
    return $this->loadDocDatVilkre($user_file);
  }
  
  
  /******************************************** COUNTY ********************************************/
  // Affidavit of Service (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatAfofs2($user_file) 
  {
    return $this->loadDocDatAfofse($user_file);
  }
  
  // Bail Application - Affidavit in Support
  public function loadDocDatBaafsu($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Bail Application - Notice
  public function loadDocDatBanoti($user_file)
  {
    $data_arr = $this->loadDocDatAffswo($user_file, 'all');
    $court_name = $court_address = $court_date = '____________';
    
    if ($data_arr['last_court_date']) {
      $court_name = $data_arr['last_court_date']->getCourt()->getName();
      $court_address = $data_arr['last_court_date']->getCourt()->getFullAddress();
      $court_date = $data_arr['last_court_date']->getDate();
    }
    $values = array($court_name, $court_address, $court_date);
    $vars = array("%%court_name%%", "%%court_address%%", "%%court_date%%");
    $data_arr['document']->setField17(str_replace($vars, $values, $data_arr['document']->getField17()));
     
    return $data_arr['document'];
  }
  
  // Bail Application - variation of Conditions (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatBavoc2($user_file) 
  {
    return $this->loadDocDatBavoco($user_file);
  }
  
  // Defence Response for Initial Directions Hearing
  public function loadDocDatDrfidh($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    if ($user_file) {
      $document->setField18($user_file->buildChargeList());
    }
    return $document;
  }
  
  // Crown Opening - Reply Only
  public function loadDocDatCoreon($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Crown Opening - Admissions Sought
  public function loadDocDatCoadso($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Fax - To County Court
  public function loadDocDatFxtocc($user_file)
  {
    return $this->loadDocDatFxcorc($user_file, 'CRC');
  }
  
  // Fax - To Judge`s Associate (ALREADY DEFINED IN HIGH COURT) 
  public function loadDocDatFxtoj1($user_file) 
  {
    return $this->loadDocDatFxtoja($user_file);
  }
  
  // Gaol Order (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatGaoor2($user_file) 
  {
    return $this->loadDocDatGaoord($user_file);
  }
  
  // General Application (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatGenap2($user_file) 
  {
    return $this->loadDocDatGenapp($user_file);
  }
  
  // Legal Aid - Application For Funding
  public function loadDocDatLaapfu($user_file)
  {
    $document = $this->loadDocDatBanoti($user_file);
    $document->setField17(str_replace(array('%%client_name%%'), array($user_file->getFullName()), $document->getField17()));
    return $document;
  }
  
  // Letter - To County Court
  public function loadDocDatLecocr($user_file)
  {
    $document = $this->loadDocDatLechco($user_file);
    $document->setField5($document->getField5()."\n\n"."Attn: ");
    return $document;
  }
  
  // Solicitor Acting - Notice
  public function loadDocDatSoacno($user_file)
  {
    $data_arr = $this->loadDocDatAffswo($user_file, 'all');
    
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField14($data_arr['last_court_date']->getCourt()->getName());
      $data_arr['document']->setField15(date("d F Y", strtotime($data_arr['last_court_date']->getDate())));
    }
    $data_arr['document']->setField13(sfConfig::get("app_appowner_phone"));
    if ($user_file) {
      $data_arr['document']->setField13($user_file->getCaseNumber());
    }
    return $data_arr['document'];
  }
  
  // Solicitor Ceased to Act - Notice
  public function loadDocDatSocano($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    $document->setField13(sfConfig::get("app_appowner_phone"));
    if ($user_file) {
      $document->setField13($user_file->getCaseNumber());
    }
    return $document;
  }
  
  // Subpoena - Attend
  public function loadDocDatSpatte($user_file)
  {
    $data_arr = $this->loadDocDatAffswo($user_file, 'all');
    
    if ($data_arr['last_court_date']) {
      $court_data = $data_arr['last_court_date']->getCourt()->getName()."\n".$data_arr['last_court_date']->getCourt()->getFullAddress();
      $data_arr['document']->setField5($court_data);
    }
    return $data_arr['document'];
  }
  
  // Subpoena - Produce
  public function loadDocDatSpprod($user_file)
  {
    return $this->loadDocDatSpatte($user_file);
  }
  
  // Subpoena - Produce and Attend
  public function loadDocDatSpprat($user_file)
  {
    return $this->loadDocDatSpatte($user_file);
  }
  

  /**************************************** COUNTY - APPEAL ***************************************/
  // Letter - To County Court (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatLecoc1($user_file) 
  {
    return $this->loadDocDatLecocr($user_file);
  }
  
  // Fax to County Court -  General (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatFxtoc1($user_file) 
  {
    return $this->loadDocDatFxtocc($user_file);
  }
  
  // Fax - To Judge`s Associate (ALREADY DEFINED IN HIGH COURT) 
  public function loadDocDatFxtoj2($user_file) 
  {
    return $this->loadDocDatFxtoja($user_file);
  }
  
  // Notice of Appeal Fax to Informant
  public function loadDocDatNoafti($user_file)
  {
    return $this->loadDocDatApnofx($user_file);
  }
  
  // Subpoena - Attend (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatSpatt1($user_file) 
  {
    return $this->loadDocDatSpatte($user_file);
  }
  
  // Subpoena - Produce (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatSppro1($user_file) 
  {
    return $this->loadDocDatSpprod($user_file);
  }
  
  // Subpoena - Produce and Attend (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatSppra1($user_file) 
  {
    return $this->loadDocDatSpprat($user_file);
  }
  
  
  /******************************************* SUPREME ********************************************/
  // Affidavit - Exhibit Cover Sheet (ALREADY DEFINED IN FORMS [CLIENT]) 
  public function loadDocDatAffec1($user_file) 
  {
    return $this->loadDocDatAffecs($user_file);
  }
  
  // Affidavit of Service (ALREADY DEFINED IN MAGISTRATES) 
  public function loadDocDatAfofs3($user_file) 
  {
    return $this->loadDocDatAfofse($user_file);
  }
  
  // Bail Application - Affidavit in Support (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatBaafs1($user_file) 
  {
    return $this->loadDocDatBaafsu($user_file);
  }
  
  // Bail Application - Notice (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatBanot1($user_file) 
  {
    return $this->loadDocDatBanoti($user_file);
  }
  
  // Bail Variation - Notice
  public function loadDocDatBavano($user_file)
  {
    return $this->loadDocDatBanoti($user_file);
  }
  
  // Fax - To Judge`s Associate (ALREADY DEFINED IN HIGH COURT) 
  public function loadDocDatFxtoj3($user_file) 
  {
    return $this->loadDocDatFxtoja($user_file);
  }
  
  // Fax - To Supreme Court
  public function loadDocDatFxtosc($user_file)
  {
    return $this->loadDocDatFxcorc($user_file);
  }
  
  // Letter - To Supreme Court
  public function loadDocDatLetosc($user_file)
  {
    $document = $this->loadDocDatLechco($user_file);
    $document->setField5($document->getField5()."\n\n"."Attn:");
    return $document;
  }
  
  // Notice to Addressee and Application
  public function loadDocDatNoadap($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Solicitor Ceased to Act - Notice (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatSocan1($user_file) 
  {
    return $this->loadDocDatSocano($user_file);
  }
  
  // Subpoena - Attend (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatSpatt2($user_file) 
  {
    return $this->loadDocDatSpatte($user_file);
  }
  
  // Subpoena - Produce (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatSppro2($user_file) 
  {
    return $this->loadDocDatSpprod($user_file);
  }
  
  // Subpoena - Produce and Attend (ALREADY DEFINED IN COUNTY) 
  public function loadDocDatSppra2($user_file) 
  {
    return $this->loadDocDatSpprat($user_file);
  }
  
  
  /**************************************** COURT OF APPEAL ***************************************/
  // Appeal Against Conviction - Notice
  public function loadDocDatApacno($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    $client_name = $prison_name = $charges_list = '____________';
    
    if ($user_file) {
      $client_name = $user_file->getFullName();
      $prison_name = $user_file->getPrison()->getName();
      $charges_list = $user_file->buildChargeList();
    }
    $values = array($client_name, $prison_name, $charges_list);
    $vars = array("%%client_name%%", "%%prison_name%%", "%%charges_list%%");
    $document->setField17(str_replace($vars, $values, $document->getField17()));
     
    return $document;
  }
  
  // Appeal Against Sentence - Notice
  public function loadDocDatApasno($user_file)
  {
    return $this->loadDocDatApacno($user_file);
  }
  
  // Fax - Abandoning Appeal
  public function loadDocDatFxabap($user_file)
  {
    $document = $this->loadDocDatFxcorc($user_file);
    $document->setField5('Court of Appeal Registry');  // this value must be get from database
    return $document;
  }
  
  // Fax - To Court of Appeal Judge
  public function loadDocDatFxcaju($user_file)
  {
    return $this->loadDocDatFxcorc($user_file);
  }
  
  // Folder Coversheet
  public function loadDocDatFolcsh($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    $document->setField10("DIRECTOR OF PUBLIC PROSECUTIONS");   // override the name of officer
     
    if ($user_file) {
      $document->setField11($user_file->getProsecutor()->obtainFullName('w_honorific'));      
      $document->setField12($user_file->getProsecution()->getFullAddress('w_name', 'w_contact'));
    }
    
    return $document;
  }
  
  // Folder - Spine v OPP
  public function loadDocDatFospvo($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    $document->setField10("DIRECTOR OF PUBLIC PROSECUTIONS");   // override the name of officer
    return $document;
  }
  
  // Fax to Court of Appeal
  public function loadDocDatFxtoca($user_file)
  {
    return $this->loadDocDatFxabap($user_file);
  }
  
  // Letter to Court of Appeal
  public function loadDocDatLttoca($user_file)
  {
    return $this->loadDocDatLechco($user_file);
  }
  
  // Notice that Solicitor Acts
  public function loadDocDatNosoac($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    $document->setField10("The Queen");   // override the name of officer
    $document->setField11(sfConfig::get("app_appowner_firmname"));
    return $document;
  }
  
  // Particulars (Must go with Each Appeal)
  public function loadDocDatPmgwea($user_file)
  {
    $data_arr = $this->loadDocDatAffswo($user_file, 'all');
    
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField7(str_replace("IN THE ", "", $data_arr['document']->getField7()));
      $data_arr['document']->setField6($data_arr['last_court_date']->getJudge()->obtainFullName('w_honorific'));
    }
    if ($user_file) {
      $data_arr['document']->setField17($user_file->buildChargeList());
    }
    $data_arr['document']->setField11('');
    
    return $data_arr['document'];
  }
  
  // VGRS  Request For Recording
  public function loadDocDatVgrsrr($user_file)
  {
    $document = $this->loadDocDatPmgwea($user_file);
    $document->setField3($user_file->getSolicitor()->getEmailAddress());
    return $document;
  }
  
  // Extension of Time Application
  public function loadDocDatExtiap($user_file)
  {
    $document = new Document();
    
    if ($user_file) {
    }
    $document->setField2('coarefistmasupremecoun.vic.2ov.au');
    $document->setField3("Robyn Lansdowne\nActing Registrar");
    
    return $document;
  }
  
  
  /******************************************* HIGH COURT *****************************************/
  // Letter to High Court
  public function loadDocDatLetohc($user_file)
  {
    $document = $this->loadDocDatLechco($user_file);
    $document->setField5($document->getField5()."\n\n"."Attn:");
    return $document;
  }
  
  // Fax to High Court
  public function loadDocDatFxtohc($user_file)
  {
    return $this->loadDocDatFxcorc($user_file);
  }
  
  // Fax to Judge`s Associate
  public function loadDocDatFxtoja($user_file)
  {
    $data_arr = $this->loadDocDatFxcorc($user_file, 'ASS', 'all');
    
    if ($data_arr['last_court_date']) {
      // the judge to whom the associate is linked
      $data_arr['document']->setField12($data_arr['last_court_date']->getJudge()->obtainFullName('w_honorific'));
    }
    return $data_arr['document'];
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /*************************************** BARRISTER section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /*************************************** BARRISTER DETAILS **************************************/
  // Basics to Include in Trial Brief
  public function loadDocDatBaintb($user_file)
  {
    // THIS DOCUMENT TYPE DOES NOT REQUIRE ENTRY DATA FORM, PLAIN TEXT ONLY
  }
  
  
  /******************************************* BACK SHEETS ****************************************/
  // Appeal Police (Informant)
  public function loadDocDatAppoin($user_file)
  {
    $data_arr = $this->loadDocDatF32adj($user_file, 'all');
    
    $data_arr['document']->setField3($this->helper->address);
    $data_arr['document']->setField11('');
    if ($user_file) {
      // loading barrister info
      $data_arr['document']->setField6($data_arr['last_court_date']->getListing()->getName());

      $barrister = $user_file->getBarrister();
      $clerk = $barrister->getUserProfiles()->getRelatedUser();
      $data_arr['document']->setField11($barrister->ObtainFullName());
      $data_arr['document']->setField12($clerk->ObtainFullName());
      $data_arr['document']->setField13($clerk->getUserProfiles()->getWorkPhone());
      $data_arr['document']->setField14($clerk->getUserProfiles()->getFax());
      $data_arr['document']->setField15($user_file->getBarristerFee());
    }
    
    return $data_arr['document'];
  }
  
  // Appeal O.P.P.
  public function loadDocDatAppopp($user_file)
  {
    $document = $this->loadDocDatAppoin($user_file);
    $document->setField10('OFFICE OF PUBLIC PROSECUTIONS');
    return $document;
  }
  
  // Appeal C.D.P.P.
  public function loadDocDatApcdpp($user_file)
  {
    $document = $this->loadDocDatAppoin($user_file);
    $document->setField10('COMMONWEALTH D.P.P.');
    return $document;
  }
  
  // Appeal Other Prosecuting Agency
  public function loadDocDatApopra($user_file)
  {
    $document = $this->loadDocDatAppoin($user_file);
    $document->setField10('POLICE PROSECUTORS');
    return $document;
  }
  
  // Appeal Other Individual Named as Informant
  public function loadDocDatAoinai($user_file)
  {
    return $this->loadDocDatAppoin($user_file);
  }
  
  // Commonwealth Director of Public Prosecutions (C.D.P.P.)
  public function loadDocDatCdppro($user_file)
  {
    return $this->loadDocDatApcdpp($user_file);
  }
  
  // Director`s Appeal C.D.P.P.
  public function loadDocDatDacdpp($user_file)
  {
    $document = $this->loadDocDatAppoin($user_file);
    $document->setField10('DIRECTOR OF PUBLIC PROSECUTIONS (Commonwealth)');
    return $document;
  }
  
  // Director`s Appeal O.P.P.
  public function loadDocDatDapopp($user_file)
  {
    $document = $this->loadDocDatAppoin($user_file);
    $document->setField10('DIRECTOR OF PUBLIC PROSECUTIONS (Victoria)');
    return $document;
  }
  
  // Officer of Public Prosecutions (O.P.P.)
  public function loadDocDatOfoppr($user_file)
  {
    return $this->loadDocDatAppopp($user_file);
  }
  
  // Other Individual Named as Informant
  public function loadDocDatOinain($user_file)
  {
    return $this->loadDocDatAppoin($user_file);
  }
  
  // Other Prosecuting Agency
  public function loadDocDatOtprag($user_file)
  {
    return $this->loadDocDatApopra($user_file);
  }
  
  // Police (Informant)
  public function loadDocDatPolinf($user_file)
  {
    return $this->loadDocDatAppoin($user_file);
  }
  
  
  /***************************************** CORRESPONDENCE ***************************************/
  // Fax to Barrister
  public function loadDocDatFxtoba($user_file)
  {
    $document = $this->loadCommonDocDat($user_file, 'document', 'fax');
    if ($user_file) {
      $document->setField5($user_file->getBarrister()->obtainFullName('w_honorific'));
      $document->setField6($user_file->getBarrister()->getUserProfiles()->getFax());
    }
    
    return $document;
  }
  
  // Letter to Barrister
  public function loadDocDatLttoba($user_file, $return_type='document')
  { 
    // this letter type does not load some fields that we need to cutomized
    $data_arr = $this->loadCommonDocDat($user_file, $return_type);
    if ($return_type=='document') $document = &$data_arr; else $document = &$data_arr['document'];
    
    $document->setField5('');
    if ($user_file) {
      $document->setField10($document->getField4());
      $document->setField4($user_file->getBarrister()->obtainFullName('w_honorific'));
      $document->setField5($user_file->getBarrister()->getUserProfiles()->getFullAddress('w_name'));
      $document->setField6($document->getField4());
    }
    
    // default values
    if (trim($document->getField4()) == '')  $document->setField6('Counsel');
    
    return $data_arr;
  }
  
  // Memorandum to Counsel
  public function loadDocDatMetocn($user_file)
  {
    $document = new Document();
    if ($user_file) {
      $document->setUserFileId($user_file->getId());
      $document->setField9($user_file->getSolicitorId());
    }
    return $document;
  }
  
  // Print Spine (Wide Folder)
  public function loadDocDatPspnwf($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    if ($user_file) {
      $document->setField5($user_file->getBarrister()->obtainFullName());
    }
    return $document;
  }
  
  // Print Spine (Narrow Folder)
  public function loadDocDatPspnnf($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /****************************************** FEE section *****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////

  /******************************************* AGREEMENTS *****************************************/
  // Lump sum one day
  public function loadDocDatFalsod($user_file, $agreement_type=1)
  {
    $document = $this->loadDocDatAdlefm($user_file);
    $this->helper->section = 'fee';   // overwrite the section of previous function
    $this->helper->field1_text = $document->getField1();

    // default values
    $document->setField11(CommonTable::getBankAccountDetails(1));
    $document->setField10('');
    $document->setField16('');
    $total_text = "__________";
    $date_text = "__________";
    if ($user_file) {
      //it is supposed that only one type of agreement can be valid => get the first one
      if ($agreement_type == 0) {
        foreach ($user_file->getFileFeeAgreements() as $agreement) {
          $ttotal = $agreement->getTotal();
          $etotal = $agreement->getEstimateTotal();
          if ( !empty($ttotal) || !empty($etotal) ) {
            $total_text = !empty($ttotal) ? $ttotal : $etotal;
            $date_text = $agreement->getByWhatDate();
            break;
          }
        }
        $document->setField17(str_replace(array("%%total%%", "%%date%%"), array($total_text, $date_text), $document->getField17()));
      }
      
      $this_agreement = null;
      foreach ($user_file->getFileFeeAgreements() as $agreement) {
        if ($agreement->getFeeAgreementTypeId() == $agreement_type) {
          $this_agreement = $agreement;
          break;
        }
      }
      if ($this_agreement) {
        $amount1 = $this_agreement->getLumpSum();
        $total = $this_agreement->getTotal();
        if ($agreement_type == 1) {
          $amount2 = $this_agreement->calculateAmountGst($amount1);
        }
        else {
          $total = $this_agreement->getEstimateTotal();
          $rate_per_hour = sfConfig::get("app_rate_per_hour");
          if ($agreement_type == 2) {
            $amount1+= $this_agreement->getHourlyFee();
            $amount2 = $this_agreement->calculateAmountGst($amount1);
            $rate_per_day = $rate_per_hour*8;
            $document->setField10($rate_per_day);
            $document->setField16($this_agreement->calculateAmountGst($rate_per_day));
          }
          else {
            $amount1 = $this_agreement->getCounselDailyFee();
            $amount2 = $this_agreement->getInstructorDailyFee();
            $document->setField10($rate_per_hour);
            $document->setField16($this_agreement->calculateAmountGst($rate_per_hour, 'inverse'));
          }
        }
        
        // set account details according to type
        $account_type = $this_agreement->getAccountTypeId();
        if (!empty($account_type)) $document->setField11(CommonTable::getBankAccountDetails($account_type));
        
        $document->setField12($amount1);
        $document->setField13($amount2);
        $document->setField14($total);
        $document->setField15(date('d/m/Y', strtotime($this_agreement->getByWhatDate())));
      }
    }
    
    return $document;
  }
  
  // Lump sum more than one day
  public function loadDocDatFalsmd($user_file)
  {
    $document = $this->loadDocDatFalsod($user_file, 2);
    $per_day_amount = $document->getField10();
    //$agreement = new FeeAgreement();
    //$per_day_gst = $agreement->calculateAmountGst($per_day_amount);
    $per_day_gst = $document->getField16();
    $document->setField17(str_replace(array("%%per_day_amount%%", "%%per_day_gst%%"), array($per_day_amount, $per_day_gst), $document->getField17()));
    
    return $document;
  }
  
  // Schedule fees
  public function loadDocDatFascfe($user_file)
  {
    return $this->loadDocDatFalsod($user_file, 3);
  }
  
  // General Cover Letter
  public function loadDocDatFagecl($user_file)
  {
    $document = $this->loadDocDatAdlefm($user_file);
    $this->helper->section = 'fee';   // overwrite the section of previous function
    return $document;
  }
  
  // Lump sum Cover Letter
  public function loadDocDatFalscl($user_file)
  {
    return $this->loadDocDatFalsod($user_file, 0);
  }
  
  
  /******************************************** INVOICES ******************************************/
  // New Trust Inv - Monies Owing
  public function loadDocDatTrmoin($user_file)
  {
    $document = $this->loadCommonDocDat($user_file, 'document', 'invoice');
    
    $document->setField6('');
    $document->setField9('');
    if (!empty($this->helper->invoice_id)) {
      $invoice = Doctrine::getTable('Invoice')->find($this->helper->invoice_id);
      if ($invoice) {
        $amount_due = $invoice->getAmountDue(); 
        if (empty($amount_due)) $amount_due = $invoice->calculateAmountDue();
        $amount_remained_in_trust = '';

        $document->setField2($invoice->getNumber());
        $document->setField9($invoice->getAmount());
        $document->setField10($invoice->getAmountPaid());
        $document->setField11($amount_due);
        $document->setField12($amount_remained_in_trust);
      }
    }
    
    return $document;
  }
  
  // New Trust Inv - No Monies Owing
  public function loadDocDatTrnmin($user_file)
  {
    return $this->loadDocDatTrmoin($user_file);
  }
  
  // New Standard Inv
  public function loadDocDatStdinv($user_file)
  {
    $document = $this->loadDocDatTrmoin($user_file);
    if (!empty($this->helper->invoice_id)) {
      $invoice = Doctrine::getTable('Invoice')->find($this->helper->invoice_id);
      if ($invoice) {
        $gst = $invoice->calculateAmountGst();
        $document->setField6(number_format(($invoice->getAmount() - $gst), sfConfig::get("app_precision")));
        $document->setField12($gst);
      }
    }
    return $document;
  }
  
  // New Non - Standard Inv
  public function loadDocDatNstinv($user_file)
  {
    return $this->loadDocDatStdinv($user_file);
  }
  
  /******************************************** RECEIPTS ******************************************/
  // Paid Receipt
  public function loadDocDatPaircp($user_file)
  {
    $this->helper->show_settings = false;
    $document = $this->loadCommonDocDat($user_file);
    
    $amount = "______";
    if (!empty($this->helper->receipt_id)) {
      $receipt = Doctrine::getTable('Receipt')->find($this->helper->receipt_id);
      if ($receipt) {
        $amount = $receipt->getAmountPaid();
        $this->helper->receipt_number = " #".$receipt->getNumber();
      }
    }
    
    $document->setField17(str_replace("%%amount%%", $amount, $document->getField17()));
    return $document;
  }
  
  // Interim Receipt
  public function loadDocDatIntrcp($user_file)
  {
    return $this->loadDocDatPaircp($user_file);
  }
 
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** LEGAL section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /******************************************* VLA DETAILS ****************************************/
  // Fax to VLA
  public function loadDocDatFxtvla($user_file)
  {
    $document = $this->loadCommonDocDat($user_file, 'document', 'fax');
    
    // clear these fields too for this document only
    $document->setField7(''); // Court name
    $document->setField8(''); // Court date
    
    return $document;
  }
  
  // Miscellaneous Letter to VLA
  public function loadDocDatMltvla($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    $document->setField4(''); // VLA office name
    $document->setField5(''); // address of VLA Office
    $document->setField6(''); // VLA ooficer
    
    // clear these fields too for this document only
    $document->setField7(''); // Court name
    $document->setField8(''); // Court date
    
    return $document;
  }
  
  
  /******************************************* COMPLIANCE *****************************************/
  // legal Aid Compliance Filenote
  public function loadDocDatLacofn($user_file)
  {
    $document = new Document();
    
    if ($user_file) {
      $document->setField1($user_file->getNumber());
      $document->setField2($user_file->getClient()->getUserProfiles()->getCentrelinkCrn());
      $document->setField3($user_file->getClient()->getUserProfiles()->getHccExpirationDate());
      $document->setField4($user_file->getFullName());
      $document->setField9($user_file->getSolicitorId());
      $document->setField17($user_file->buildChargeList());
    }
    
    return $document;
  }
  
  
  /************************************* COMPLIANCE: WORKSHEETS ************************************/
  // Appeal
  public function loadDocDatAppeal($user_file)
  {
    $document = new Document();
    if ($user_file) {
      $document->setField1($user_file->getNumber());
      $document->setField2($user_file->getFullName());
      $document->setField3($user_file->getSolicitorId());
    }
    
    return $document;
  }
  
  // Bail Application
  public function loadDocDatBaialc($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Committals
  public function loadDocDatComtal($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Consolidation
  public function loadDocDatConsod($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Guilty - Commonwealth
  public function loadDocDatGuicom($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Guilty - State
  public function loadDocDatGuista($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Medical Report
  public function loadDocDatMedrep($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Not Guilty -Commonwealth
  public function loadDocDatNoguco($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Not Guilty - State
  public function loadDocDatNogust($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Traffic Prosecution
  public function loadDocDatTrapro($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  // Trial
  public function loadDocDatTrialx($user_file)
  {
    return $this->loadDocDatAppeal($user_file);
  }
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** AGENCY section ***************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /********************************************** CTLD ********************************************/
  // CTLD Fax
  public function loadDocDatCtldfx($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // CTLD Letter
  public function loadDocDatCtldlt($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    $document->setField4('');
    $document->setField5('');
    $document->setField6('');
    return $document;
  }
  
  // Confirm Barrister
  public function loadDocDatCombar($user_file)
  {
    return $this->loadDocDatCtldlt($user_file);
  }
  
  // Confirm Barrister Fax
  public function loadDocDatCobafx($user_file)
  {
    return $this->loadDocDatCtldfx($user_file);
  }
  
  // Confirm that Plea
  public function loadDocDatComple($user_file)
  {
    return $this->loadDocDatCtldlt($user_file);
  }
  
  // Confirm that Plea Fax
  public function loadDocDatCoplfx($user_file)
  {
    return $this->loadDocDatCtldfx($user_file);
  }
  
  // Form 2 11-E
  public function loadDocDatFm211e($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    $document->setField17(str_replace('%%client%%', $document->getField4(), $document->getField17()));
    return $document;
  }
  
  // Enclosing 2 11-E
  public function loadDocDatEn211e($user_file)
  {
    return $this->loadDocDatCtldlt($user_file);
  }
  
  // Enclosing 2 11-E Fax
  public function loadDocDatE211fx($user_file)
  {
    return $this->loadDocDatCtldfx($user_file);
  }
  
  
  /************************************* OFFICE OF CORRECTIONS ************************************/
  // Fax to Corrections
  public function loadDocDatFxtoct($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Letter to Correction
  public function loadDocDatLttoct($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    $document->setField4('');
    $document->setField5('');
    $document->setField6('');
    
    return $document;
  }
  
  
  /**************************************** JUVENILE JUSTICE **************************************/
  // Fax to Juvenile Justice
  public function loadDocDatFxtojj($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Letter to Juvenile Justice
  public function loadDocDatLttojj($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    $document->setField4('');
    $document->setField5('');
    $document->setField6('');
    
    return $document;
  }
  
  // YTC Location (ALREADY DEFINED IN PRISONS) 
  public function loadDocDatYtclo1($user_file) 
  {
    return $this->loadDocDatYtcloc($user_file);
  }
  
  
  /********************************************* PRISONS ******************************************/
  /*// Change Gaol Location
  public function loadDocDatChgalo($user_file)
  {
    // THIS IS NOT A DOCUMENT, MUST BE REMOVED FROM HERE
  }*/
  
  // Fax to Prison
  public function loadDocDatFxtopr($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Letter to Prison
  public function loadDocDatLttopr($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
      $prison = $user_file->getPrison();
      $document->setField4($prison->getName());
      $document->setField5($prison->getFullAddress());
    }
    $document->setField6('');
    
    return $document;
  }
  
  // Phone Conference
  public function loadDocDatPhocof($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Request CRN Number
  public function loadDocDatRcrnnb($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Request CRN Number & Location
  public function loadDocDatRcrnal($user_file)
  {
    $document = $this->loadCommonDocDat($user_file, 'document', 'fax');
    $document->setField17(str_replace('%%date_of_birth%%', $user_file->getClient()->getUserProfiles()->getDobFormatted('d/m/Y'), $document->getField17()));
    return $document;
  }
  
  // Request Prison Location
  public function loadDocDatReprlo($user_file)
  {
    return $this->loadDocDatRcrnal($user_file, 'document', 'fax');
  }
  
  // Video Conference
  public function loadDocDatVidcof($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Video/Phone at Dame Phyllis Frost
  public function loadDocDatVpadpf($user_file)
  {
    // THIS TEMPLATE IS MISSED
  }
  
  // YTC Location
  public function loadDocDatYtcloc($user_file)
  {
    return $this->loadDocDatRcrnal($user_file, 'document', 'fax');
  }
  
  
  /************************************** APPEALS COSTS BOARD *************************************/
  // Appeals Cost Certificate
  public function loadDocDatApcoce($user_file)
  {
    $data_arr = $this->loadCommonDocDat($user_file, 'all');
    
    $data_arr['document']->setField3('');
    if ($data_arr['last_court_date']) {
      $data_arr['document']->setField3($data_arr['last_court_date']->getJudge()->obtainFullName('w_honorific'));
      //$court_title = "IN THE ".strtoupper($data_arr['last_court_date']->getCourt()->getName());
    }
    
    if ($user_file) {
      $court_title = "IN THE COURT OF APPEAL\nOF VICTORIA\nAT MELBOURNE";
      $data_arr['document']->setField6($user_file->getSolicitor()->obtainFullName()."\n".$this->helper->address);
      $data_arr['document']->setField7($court_title);
      $data_arr['document']->setField5(strtoupper($user_file->getInformant()->obtainFullName('w_honorific')));
    }
    
    return $data_arr['document'];
  }
  
  // Appeals Costs Board Letter
  public function loadDocDatApcobl($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    $document->setField4('');
    $document->setField5('');
    $document->setField6('');
    
    return $document;
  }
  
  // Appeals Costs Board Fax
  public function loadDocDatApcobf($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  
  /*********************************** ABORIGINAL LEGAL SERVICES **********************************/
  // Fax to Aboriginal Legal Services
  public function loadDocDatFxtals($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Letter to Aboriginal Legal Services
  public function loadDocDatLttals($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    $document->setField4('');
    $document->setField5('');
    $document->setField6('');
    
    return $document;
  }
  
  
  /************************************ COMMUNITY LEGAL SERVICES **********************************/
  // Fax to Community Legal Services
  public function loadDocDatFxtcls($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Letter to Community Legal Services
  public function loadDocDatLttcls($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    $document->setField4('');
    $document->setField5('');
    $document->setField6('');
    
    return $document;
  }
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** ADMIN section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  
  /************************************** MISC CORRESPONDENCE *************************************/
  // Affidavit 3rd Party
  public function loadDocDatAfthpa($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Affidavit 3rd Party (Solicitor Attesting)
  public function loadDocDatA3psat($user_file)
  {
    $this->helper->sign_text = "<br/>".str_replace("\n", ", " ,$this->helper->address).
            "<br/>An Australian Legal Practitioner within the meaning of the Legal Profession Act 2004";
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Affidavit 3rd Party - Exhibit Cover Sheet
  public function loadDocDatA3pecs($user_file)
  {
    return $this->loadDocDatF32adj($user_file);
  }
  
  // Fax Cover - This File
  public function loadDocDatFxcvtf($user_file)
  {
    return $this->loadCommonDocDat($user_file, 'document', 'fax');
  }
  
  // Fax Cover - Any File
  public function loadDocDatFxcvaf($user_file)
  {
    $document = $this->loadCommonDocDat($user_file, 'document', 'fax');
    $document->setField1("");
    $document->setField4("");
    $document->setField7("");
    $document->setField8("");
    return $document;
  }
  
  // File Note - Add to This File
  public function loadDocDatFnattf($user_file)
  {
    return $this->loadCommonDocDat($user_file);
  }
  
  // File Note - Not Added to This File
  public function loadDocDatFnnatf($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    $document->setField1("");
    $document->setField4("");
    $document->setField7("");
    $document->setField8("");
    return $document;
  }
  
  // Folder Spine - Wide
  public function loadDocDatFlspwd($user_file)
  {
    $document = $this->loadDocDatAffswo($user_file);
    if ($user_file) {
      $document->setField5($user_file->getBarrister()->obtainFullName());
    }
    return $document;
  }
  
  // Folder Spine - Narrow
  public function loadDocDatFlspna($user_file)
  {
    return $this->loadDocDatAffswo($user_file);
  }
  
  // Miscellaneous Letter - This File
  public function loadDocDatMlttfi($user_file)
  {
    $document = $this->loadCommonDocDat($user_file);
    
    if ($user_file) {
      $document->setField10($document->getField4());
    }
    $document->setField4('');
    $document->setField5('');
    $document->setField6('');

    return $document;
  }
  
  // Miscellaneous Letter - Any File
  public function loadDocDatMltafi($user_file)
  {
    $document = $this->loadDocDatMlttfi($user_file);
    $document->setField1('');
    $document->setField7('');
    $document->setField8('');
    $document->setField10('');
    
    return $document;
  }
  
  // Phone Message - Add to This File
  public function loadDocDatPmattf($user_file)
  {
    return $this->loadCommonDocDat($user_file);
  }
  
  // Phone Message - Any File
  public function loadDocDatPmanfi($user_file)
  {
    return $this->loadDocDatFnnatf($user_file);
  }
  
  // Statutory Declaration 3rd Party
  public function loadDocDatSde3pa($user_file)
  {
    $document = $this->loadDocDatStdemi($user_file);
    $document->setField2('');
    $document->setField4('');
    $document->setField5('');
    return $document;
  }
  
  // Statutory Declaration 3rd Party (Solicitor Attesting)
  public function loadDocDatSd3psa($user_file)
  {
    $this->helper->sign_text = "<br/>".str_replace("\n", ", " ,$this->helper->address).
            "<br/>An Australian Legal Practitioner within the meaning of the Legal Profession Act 2004";
    return $this->loadDocDatSde3pa($user_file);
  }
  
  // reformat date for date change in the documents
  public function executeReFormatDate(sfWebRequest $request)
  {    
    $date = $request->getParameter('date');
    $format = $request->getParameter('format');
    if ($date && $format) {
      $current_time = date("H:i:s");
      $date.= " ".$current_time;
      $adate = strtotime($date);
      $sdate = date("Y-m-d H:i:s", $adate);  // for saving into database
      
      //echo date($format, strtotime($absolute_time));
      die(json_encode(array("fdate" => date($format, $adate), "adate" => $adate, "sdate" => $sdate)));
    }
    return sfView::NONE;
  }
  
  
  public function executeClearbuffer(sfWebRequest $request)
  {
    Document::clearDocBuffer();
    return sfView::NONE;
  }
   
  
  /**************************************************************************************************/
  /************************************* NOT USEFUL FUNCTIONS ***************************************/
  /**************************************************************************************************/
  
  // not useful by now
  public function executePrintPreview(sfWebRequest $request)
  {
    $document = $request->getParameter('document');
    if ($document) {}
    else {
      $document = new Document();
    }
    $this->form = new DocumentForm();
    $this->form->bind($request->getParameter('document'), $request->getFiles('document'));
    $this->document = $document;
    
    $this->setLayout('print_layout');
    //$this->setTemplate('new');
  }
  
  
  // with sfTCPDFPlugin class: very limited and complex, useless by now
  public function covertToPDF($html, $pre_process=false)
  {
    // get configuration parameters
    $config = sfTCPDFPluginConfigHandler::loadConfig();
    
    // pdf object
    $pdf = new sfTCPDF();
 
    // set document information
    //$pdf->SetCreator(PDF_CREATOR);
    //$pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Document Preview');
    //$pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 
    // set default header data
    //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING);
 
    // set header and footer fonts
    //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
    // set default monospaced font
    //$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
    //set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
    // ---------------------------------------------------------
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);
 
    // Set font: dejavusans is a UTF-8 Unicode font, if you only need to print standard ASCII chars, you can use core fonts like times to reduce file size.
    //$pdf->SetFont('helvetica', '', 12, '', true);
 
    // Add a page: This method has several options, check the source code documentation for more information.
    $pdf->AddPage();
    
    // Set some content to print
    //$html = $this->getPartial('document/email_form', array('document' => $document, 'form' => $this->form, 'configuration' => $this->configuration, 'helper' => $this->helper));
    //if ($pre_process) $html = $this->preProcess($html);   // pre process content if necessary
      
    // output the HTML content
    $pdf->writeHTML($html, true, false, true, false, '');
    
    // reset pointer to the last page
    $pdf->lastPage();
 
    // ---------------------------------------------------------
    // Close and output PDF document: This method has several options, check the source code documentation for more information.
    $pdf->Output('document_001.pdf', 'I');
 
    // Stop symfony process
    throw new sfStopException();
  }
  
}
