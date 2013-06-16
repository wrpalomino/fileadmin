<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Link 
{
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /**************************************** CLIENT section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $client_page_links = array(
      'cli_p1' => array('text' => 'Client Details', 'href' => 'client/index?edit_pager=1', 'action' => 'index'),
      'cli_p2' => array('text' => 'Correspondence', 'href' => 'client/correspondence', 'action' => 'correspondence'),
      'cli_p3' => array('text' => 'Authorities', 'href' => 'client/authorities', 'action' => 'authorities'),
      'cli_p4' => array('text' => 'Forms', 'href' => 'client/forms', 'action' => 'forms'),
      'cli_p5' => array('text' => 'Instructions', 'href' => 'client/instructions', 'action' => 'instructions'),
      'cli_p6' => array('text' => 'Scanned Documents', 'href' => 'client/scannedDocuments', 'action' => 'scannedDocuments'),
      'cli_p7' => array('text' => 'Send SMS', 'href' => 'client/sms', 'action' => 'sms'),
    );
  
  static public $client_send_to = array(
      'cli_s1' => array('text' => 'Send Correspondence to Main Address', 'value' => 'main'),
      'cli_s2' => array('text' => 'Send Correspondence to Other Address', 'value' => 'other'),
      'cli_s3' => array('text' => 'Send Correspondence to Prison', 'value' => 'prison'),
      'cli_s4' => array('text' => 'Send Correspondence to Prison dx', 'value' => 'prisondx'),
    );
  
  static public $client_default_links = array(
      'cli_d1' => array('text' => 'Prison Visits & Contacts', 'href' => '#'),
    );
  
  static public $client_correspondence_links = array(
      'adlefm' => array('text' => 'Adjournment Letter - First Mention', 'href' => "#", 'js' => "onclick=openBox('document/new?doc=adlefm');"),
      'adlege' => array('text' => 'Adjournment Letter - General', 'href' => "#", 'js' => "onclick=openBox('document/new?doc=adlege');"),
      'apmabd' => array('text' => 'Appointment - Make & Bring Docs', 'href' => "#", 'js' => "onclick=openBox('document/new?doc=apmabd');"),
      'aplema' => array('text' => 'Appointment - Make', 'href' => "#", 'js' => "onclick=openBox('document/new?doc=aplema');"),
      'apcomf' => array('text' => 'Appointment - Confirm', 'href' => "#", 'js' => "onclick=openBox('document/new?doc=apcomf');"),
      'brfwcp' => array('text' => 'Brief - Forward Copy', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=brfwcp');"),
      'brrmat' => array('text' => 'Brief - Received Make Appt (Through Staff)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=brrmat');"),
      'brrmap' => array('text' => 'Brief - Received Make Appt', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=brrmap');"),
      'brwwfc' => array('text' => 'Brief - Waiting & Will Forward Copy', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=brwwfc');"),
      'brwwrr' => array('text' => 'Brief - Waiting & Will Ring on Reciept', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=brwwrr');"),
      'clovle' => array('text' => 'Callover Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=clovle');"),
      'canoco' => array('text' => 'Cease to Act - No Contact', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=canoco');"),
      'canofu' => array('text' => 'Cease to Act - No Funding', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=canofu');"),
      'cansla' => array('text' => 'Cease to Act - Not Sent Legal Aid Docs', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=cansla');"),
      'docpro' => array('text' => 'Document - Provide', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=docpro');"),
      'ftasum' => array('text' => 'Fail to Answer Summons', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ftasum');"),
      'ftabai' => array('text' => 'Fail to Answer Bail', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ftabai');"),
      'lapsfo' => array('text' => 'Legal Aid - Provide Signed Form', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lapsfo');"),
      'laffop' => array('text' => 'Legal Aid - Form Filled Out Over Phone', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=laffop');"),
      'lapfof' => array('text' => 'Legal Aid - Provide Filled Out Form', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lapfof');"),
      'lanmam' => array('text' => 'Legal Aid - New Means After 12 Months', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lanmam');"),
      'larefu' => array('text' => 'Legal Aid Refused', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=larefu');"),
      'lemisc' => array('text' => 'Letter - Miscellaneous', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lemisc');"),
      'pocafe' => array('text' => 'Psychologist - Confirm Appt & Fees', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=pocafe');"),
      'pocoac' => array('text' => 'Psychologist - Confirm Appt (Legal Aid)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=pocoac');"),
      'picafe' => array('text' => 'Psychiatrist - Confirm Appt & Fees', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=picafe');"),
      'picoac' => array('text' => 'Psychiatrist - Confirm Appt (Legal Aid)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=picoac');"),
      'relein' => array('text' => 'Result Letter - Interim', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=relein');"),
      'relefm' => array('text' => 'Result Letter - Final Magistrates', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=relefm');"),
      'relefc' => array('text' => 'Result Letter - Final Count/Supreme', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=relefc');"),
    );
  
  static public $client_authorities_links = array(
      'banaut' => array('text' => 'Bank Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=banaut');"),
      'cavaut' => array('text' => 'Caveat Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=cavaut');"),
      'clkacl' => array('text' => 'Centrelink Authority (Client)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=clkacl');"),
      'clkanc' => array('text' => 'Centrelink Authority (non-Client)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=clkanc');"),
      'crcdau' => array('text' => 'Credit Card Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=crcdau');"),
      'ccaunc' => array('text' => 'Credit Card Authority (non-Client)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ccaunc');"),
      'faxefa' => array('text' => 'Fax - Enclosing File Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=faxefa');"),
      'ficoau' => array('text' => 'File Collection Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ficoau');"),
      'gefiau' => array('text' => 'General - File Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=gefiau');"),
      'leefau' => array('text' => 'Letter - Enclosing File Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=leefau');"),
      'mefage' => array('text' => 'Medical - File Authority (General)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=mefage');"),
      'mefajh' => array('text' => 'Medical - File Authority (Justice health)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=mefajh');"),
      'sofiau' => array('text' => 'Solicitor - File Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sofiau');"),
      'sohtmo' => array('text' => 'Solicitor Holding Trust Monies - File Authority', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sohtmo');"),
    );
  
  static public $client_forms_links = array(
      'affswo'  => array('text' => 'Affidavit - Sworn', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=affswo');"),
      'affaff'  => array('text' => 'Affidavit - Affirmed', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=affaff');"),
      'affsas'  => array('text' => 'Affidavit (Solicitor Attesting) - Sworn', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=affsas');"),
      'affsaa'  => array('text' => 'Affidavit (Solicitor Attesting) - Affirmed', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=affsaa');"),
      'affecs'  => array('text' => 'Affidavit - Exhibit Cover Sheet', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=affecs');"),
      'cli_f1'  => array('text' => 'Affidavits Created', 'href' => '#'),
      'crfxco'  => array('text' => 'Character Reference - Fax Cover', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=crfxco');"),
      'crgunc'  => array('text' => 'Character Reference Guide - New Client', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=crgunc');"),
      'crgutp'  => array('text' => 'Character Reference Guide - 3rd party', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=crgutp');"),
      'crmaco'  => array('text' => 'Character Reference - Magistrates` Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=crmaco');"),
      'crotco'  => array('text' => 'Character Reference - Other Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=crotco');"),
      'foirqf'  => array('text' => 'FOI Request Form', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=foirqf');"),
      'foirps'  => array('text' => 'FOI Request - Provide Signed Form', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=foirps');"),
      'foircl'  => array('text' => 'FOI Request - Cover Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=foircl');"),
      'relisq'  => array('text' => 'Restoration of Licence - Standard Questions', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=relisq');"),
      'stdemi'  => array('text' => 'Statutory Declaration - Misc', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=stdemi');"),
      'stdesa'  => array('text' => 'Statutory Declaration - Misc (Solicitor Attesting)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=stdesa');"),
      'stdeni'  => array('text' => 'Statutory Declaration - No Income', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=stdeni');"),
      'stdens'  => array('text' => 'Statutory Declaration - No Income (Solicitor Attesting)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=stdens');"),
    );
  
  static public $client_instructions_links = array(
      'coplou'  => array('text' => 'Country Plea Outline', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=coplou');"),
      'genins'  => array('text' => 'General Instructions', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=genins');"),
      'cli_i1'  => array('text' => 'Instructions Sheet to Email (Word Doc)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=genins&fmt=doc');"),
      'cli_i2'  => array('text' => 'Instructions Sheet to Email (PDF)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=genins&fmt=pdf');"),
      'cli_i3'  => array('text' => 'Judicial College Charge Book', 'href' => 'http://www.justice.vic.gov.au/emanuals/CrimChargeBook/default.htm', 'target' => '_blank'),
      'cli_i4'  => array('text' => 'Judicial College Sentencing Manual', 'href' => 'http://www.justice.vic.gov.au/emanuals/VSM/default.htm', 'target' => '_blank'),
      'cli_i5'  => array('text' => 'NSW Charge Book', 'href' => 'http://www.judcom.nsw.gov.au/publications/benchbks/criminal/index.html', 'target' => '_blank'),
    );
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /*************************************** INFORMANT section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $informant_page_links = array(
      'inf_p1'  => array('text' => 'Informant Details', 'href' => 'informant/index?edit_pager=1', 'action' => 'index'),
      'inf_p2'  => array('text' => 'Charges', 'href' => 'charge/index?edit_pager=0', 'action' => 'index'),
      'inf_p3'  => array('text' => 'Correspondence', 'href' => 'informant/correspondence', 'action' => 'correspondence'),
      'inf_p4'  => array('text' => 'Brief', 'href' => 'brief/index?edit_pager=1', 'action' => 'index'),
      'inf_p5'  => array('text' => 'Prosecutors', 'href' => 'prosecutor/index?edit_pager=1', 'action' => 'index'),
    );
  
  static public $informant_default_links = array(
      'inf_d1'  => array('text' => 'Add/Update Station Details', 'href' => '#'),
    );
  
  static public $informant_charges_links = array(
      'inf_c1'  => array('text' => 'Case Citator', 'href' => 'http://www.austlii.edu.au/LawCite/', 'target' => '_blank'),
      'inf_c2'  => array('text' => 'Print Result Sheet', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=reshee&modulex=charge');"),
    );
  
  static public $informant_correspondence_links = array(
      'alinot'  => array('text' => 'Alibi Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=alinot');"),
      'apnofx'  => array('text' => 'Appeal Notice - Fax', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apnofx');"),
      'cccole'  => array('text' => 'Chief Commissioner - Costs letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=cccole');"),
      'comefx'  => array('text' => 'Contest Mention - Fax', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=comefx');"),
      'drdeso'  => array('text' => 'Damages/Restitution - Details Sought', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=drdeso');"),
      'divlet'  => array('text' => 'Diversion Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=divlet');"),
      'dorefu'  => array('text' => 'Documents - Request Further', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=dorefu');"),
      'faxinf'  => array('text' => 'Fax - Informant', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=faxinf');"),
      'ftassi'  => array('text' => 'Fail to Appear - Summons Single Informant', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ftassi');"),
      'ftasmi'  => array('text' => 'Fail to Appear - Summons Multiple Informants', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ftasmi');"),
      'inoble'  => array('text' => 'Infringement Notice - Objection Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=inoble');"),
      'inrere'  => array('text' => 'Interview Recording Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=inrere');"),
      'letinf'  => array('text' => 'Letter - Informant', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=letinf');"),
      'remuin'  => array('text' => 'Rebail - Multiple Informants', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=remuin');"),
      'resiin'  => array('text' => 'Rebail - Single Informant', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=resiin');"),
      's32cas'  => array('text' => 'Section 32C - Confidential Comms. Application to Issue Subpoena', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=s32cas');"),
      's32cma'  => array('text' => 'Section 32C - Confidential Comms. (Magistrates)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=s32cma');"),
      's32coc'  => array('text' => 'Section 32C - Confidential Comms. (Other Courts)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=s32coc');"),
      's34psm'  => array('text' => 'Section 342 - Prior Sex (Magistrates)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=s34psm');"),
      's34pso'  => array('text' => 'Section 342 - Prior Sex (Other Courts)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=s34pso');"),
      'wiprre'  => array('text' => 'Witness Priors - Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=wiprre');"),
    );
  
  static public $informant_briefs_links = array(
      'inf_b1'  => array('text' => 'S 39 Criminal Procedure Act - Brief Service', 'href' => 'http://www.austlii.edu.au/au/legis/vic/consol_act/cpa2009188/s39.html', 'target' => '_blank'),
      'inf_b2'  => array('text' => 'Find Unreceived Police Briefs', 'href' => 'brief/index?edit_pager=0&filter=Unreceived', 'action' => 'index')
    );
  
  //static public $informant_prosecutors_links = array(
  static public $prosecutor_default_links = array(
      'fxenad'  => array('text' => 'Fax - Enclosing Adjournment', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxenad');"),
      'fxendc'  => array('text' => 'Fax - Enclosing Documents', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxendc');"),
      'fxmisc'  => array('text' => 'Fax - Miscellaneous', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxmisc');"),
      'lttops'  => array('text' => 'Letter to Prosecutors', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lttops');"),
      'sccolt'  => array('text' => 'Summary Case Conference Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sccolt');"),
      //'inf_r1'  => array('text' => 'Change Prosecutor Details', 'href' => '#'),
      //'inf_r2'  => array('text' => 'Input New Prosecutor', 'href' => '#'),
      //'inf_r3'  => array('text' => 'Input New Agency', 'href' => '#'),
      'inf_r4'  => array('text' => 'Summary Case Conference Charter', 'href' => 'http://www.austlii.edu.au/au/legis/vic/consol_act/cpa2009188/s39.html', 'target' => '_blank'),
    );
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /************************************** COURT DATE section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $court_page_links = array(
      'cou_p1' => array('text' => 'Court Details', 'href' => 'court/index?edit_pager=1&rf=1', 'action' => 'index'),
      'cou_p2' => array('text' => 'Result', 'href' => 'court/results', 'action' => 'results'),
      'cou_p3' => array('text' => 'Summary Adjournments', 'href' => 'court/summaryAdjournments', 'action' => 'summaryAdjournments'),
      'cou_p4' => array('text' => 'Children', 'href' => 'court/children', 'action' => 'children'),
      'cou_p5' => array('text' => 'Magistrates', 'href' => 'court/magistrates', 'action' => 'magistrates'),
      //'cou_p6' => array('text' => 'Committal Stream', 'href' => 'court/committalStream', 'action' => 'committalStream'),
      'cou_p6' => array('text' => 'Committal Stream', 'href' => 'committalStream/index?edit_pager=1', 'action' => 'index'),
      'cou_p7' => array('text' => 'County', 'href' => 'court/county', 'action' => 'county'),
      'cou_p8' => array('text' => '  - Appeal', 'href' => 'court/appeal', 'action' => 'appeal'),
      'cou_p9' => array('text' => 'Supreme', 'href' => 'court/supreme', 'action' => 'supreme'),
      'cou_pA' => array('text' => 'Court of Appeal', 'href' => 'court/courtAppeal', 'action' => 'courtAppeal'),
      'cou_pB' => array('text' => 'High Court', 'href' => 'court/highCourt', 'action' => 'highCourt'),
    );
  
  static public function getCourtDefaultLinks()
  {
    self::$court_default_links['cou_d1'] = array('text' => 'Court Listing', 'href' => 'court/index?edit_pager=0&filter=Current', 'action' => 'index');
    self::$court_default_links['cou_d2'] = array('text' => 'Previous Results', 'href' => 'court/index?edit_pager=0&filter=Past', 'action' => 'index');
    return self::$court_default_links;
  }
  
  static public $court_default_links = array(
      //'cou_d1' => array('text' => 'Court Listing', 'href' => 'court/index?edit_pager=0&filter=filter&filters[date][from]='.$this->getDate().'&filters[date][to]=2020-12-31', 'action' => 'index'),
      //'cou_d2' => array('text' => 'Previous Results', 'href' => 'court/index?edit_pager=0&filter=pdate', 'action' => 'index'),
      'cou_d3' => array('text' => 'New Court Date', 'href' => 'court/new', 'action' => 'new'),
    );
  
  static public $court_results_links = array(
      'casstu'  => array('text' => 'Case Study', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=casstu');"),
      //'cou_r1'  => array('text' => 'Custody Status - Update', 'href' => '#'),
      'ertsol'  => array('text' => 'Email Result to Solicitor', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ertsol');"),
      'filore'  => array('text' => 'Filenote - of Result', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=filore');"),
      //'cou_r2'  => array('text' => 'New Court Date', 'href' => '#'),
      //'cou_r3'  => array('text' => 'Previous Results', 'href' => '#'),
      'reflma'  => array('text' => 'Result - Final Letter (Mags)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=reflma');"),
      'reflot'  => array('text' => 'Result - Final Letter (Other)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=reflot');"),
      'reinle'  => array('text' => 'Result - Interim Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=reinle');"),
      'reshfi'  => array('text' => 'Result Sheet - Final', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=reshfi');"),
      'reshee'  => array('text' => 'Result Sheet', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=reshee');"),
      //'cou_r4'  => array('text' => 'Drink Drive Letters', 'href' => '#'),
      //'cou_r5'  => array('text' => 'Custody Status', 'href' => '#'),      
    );
  
  static public $court_results_drink_drive_letters_links = array(
      'drdrre'  => array('text' => 'Drink Driving Result', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=drdrre');"),
      'inlrev'  => array('text' => 'Interlock Removal', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=inlrev');"),
      'lrpelt'  => array('text' => 'License Restoration Pending Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lrpelt');"),
      'relirs'  => array('text' => 'Result of License Restoration', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=relirs');"),
      );
  
  static public $court_results_custody_status_links = array(
      'rcrnn1'  => array('text' => 'Request CRN Number', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=rcrnn1');", 'from' => 'agency'),
      'rcrna1'  => array('text' => 'Request CRN Number and Location', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=rcrna1');", 'from' => 'agency'),
      'rqsgao'  => array('text' => 'Request Gaol', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=rqsgao');"),
      'ytclo2'  => array('text' => 'YTC Location', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ytclo2');", 'from' => 'agency'),
      );
  
  static public function getCourtResultsLinks($mode=0)
  {
    // $mode:  0: copy link and text    1: map link to load template
    foreach (self::$court_results_drink_drive_letters_links as $k => $v) {
      if ( ($mode == 0) || ($mode == 1 && !isset($v['from'])) ) {
        $v['text'] = 'Drink Drive Letters >> '.$v['text'];
        self::$court_results_links[$k] = $v;
      }
    }
    foreach (self::$court_results_custody_status_links as $k => $v) {
      if ( ($mode == 0) || ($mode == 1 && !isset($v['from'])) ) {
        $v['text'] = 'Custody Status >> '.$v['text'];
        self::$court_results_links[$k] = $v;
      }
    }
    return self::$court_results_links;
  }
  
  static public $court_summary_adjournments_links = array(
      'adcome'  => array('text' => 'Adjourn to Contest Mention', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=adcome');"),
      'adcmnr'  => array('text' => 'Adjourn to Contest Mention -  No response to SCC Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=adcmnr');"),
      'adcopl'  => array('text' => 'Adjourn to Consolidation Plea', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=adcopl');"),
      'adgupl'  => array('text' => 'Adjourn to Guilty Plea', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=adgupl');"),
      'adsucc'  => array('text' => 'Adjourn to Summary case Conference', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=adsucc');"),
      'fmsafm'  => array('text' => 'First Mention on Summons - Adjourn to Further Mention', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fmsafm');"),
      'misafm'  => array('text' => 'Miscellaneous - Adjourn to Further Mention', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=misafm');"),
      'nobafm'  => array('text' => 'No Brief - Adjourn to Further Mention', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=nobafm');"),
      'niatfm'  => array('text' => 'No Instructions - Adjourn to Further Mention', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=niatfm');"),
      'timcer'  => array('text' => 'Time Certainty', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=timcer');"),
    );

  static public $court_children_links = array(
      'afofs1'  => array('text' => 'Affidavit of Service', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=afofs1');"),
      'bafit1'  => array('text' => 'Bail Application - First Time', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=bafit1');"),
      'baprr1'  => array('text' => 'Bail Application - Previous Refusal', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=baprr1');"),
      'bavoc1'  => array('text' => 'Bail Application - Variation of Conditions', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=bavoc1');"),
      'cetoa1'  => array('text' => 'Cease to Act', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=cetoa1');"),
      'ceexr1'  => array('text' => 'Certified Extract - Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ceexr1');"),
      'direr1'  => array('text' => 'Digital Recording - Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=direr1');"),
      'fxchco'  => array('text' => 'Fax to Children`s Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxchco');"),
      'gaoor1'  => array('text' => 'Gaol Order', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=gaoor1');"),
      'gofty1'  => array('text' => 'Gaol Order - fax to YTC Enclosing', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=gofty1');"),
      'goftm1'  => array('text' => 'Gaol Order - fax to Magistrate to Sign', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=goftm1');"),
      'genap1'  => array('text' => 'General Application', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=genap1');"),
      'lechco'  => array('text' => 'Letter to Children`s Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lechco');"),
      'roppro'  => array('text' => 'Ropes Program', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=roppro');"),
      'timce1'  => array('text' => 'Time Certainty', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=timce1');"),
      'witsu1'  => array('text' => 'Witness Summons', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=witsu1');"),
      'cou_c1'  => array('text' => 'Children Court Website', 'href' => 'http://www.childrenscourt.vic.gov.au/CA256CA800011129/HomePage?ReadForm&1=Home~&2=~&3=~', 'target' => '_blank'),
    );
  
  static public $court_magistrates_links = array(
      'afofse'  => array('text' => 'Affidavit of Service', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=afofse');"),
      'bafiti'  => array('text' => 'Bail Application - First Time', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=bafiti');"),
      'baprre'  => array('text' => 'Bail Application - Previous Refusal', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=baprre');"),
      'bavoco'  => array('text' => 'Bail Application - Variation of Conditions', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=bavoco');"),
      'cetoac'  => array('text' => 'Cease to Act', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=cetoac');"),
      'ceexre'  => array('text' => 'Certified Extract - Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ceexre');"),
      'direre'  => array('text' => 'Digital Recording - Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=direre');"),
      'caabap'  => array('text' => 'Case Abridgement - Application', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=caabap');"),
      'fxcorc'  => array('text' => 'Fax to Court Registry/Coordinator', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxcorc');"),
      'gaoord'  => array('text' => 'Gaol Order', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=gaoord');"),
      'goftye'  => array('text' => 'Gaol Order - fax to YTC Enclosing', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=goftye');"),
      'goftms'  => array('text' => 'Gaol Order - fax to Magistrate to Sign', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=goftms');"),
      'genapp'  => array('text' => 'General Application', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=genapp');"),
      'lemaco'  => array('text' => 'Letter to Magistrate`s Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lemaco');"),
      'vilkre'  => array('text' => 'Video Link Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=vilkre');"),
      'witsum'  => array('text' => 'Witness Summons', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=witsum');"),
      'cou_m1'  => array('text' => 'Request for Contested Summary hearing - Form 12', 'href' => 'http://www.magistratescourt.vic.gov.au/home/criminal+proceedings/magistrates+-+criminal+-+form+12+-+request+for+contested+summary+hearing', 'target' => '_blank'),
      'cou_m2'  => array('text' => 'Sexual Offences List - Contest Mention Info - Form A', 'href' => 'http://www.magistratescourt.vic.gov.au/home/specialist+jurisdictions/sexual+assault/magistrates+-+sexual+offences+list+-+contest+mention+information+form', 'target' => '_blank'),
      'cou_m3'  => array('text' => 'Sexual Offences List - Notice of Readiness for Summary Con. Hearing - Form B', 'href' => 'http://www.magistratescourt.vic.gov.au/home/specialist+jurisdictions/sexual+assault/magistrates+-+sexual+offences+list+-+notice+of+readiness+for+hearing', 'target' => '_blank'),
      //'cou_m4'  => array('text' => 'hearing - Form B', 'href' => '#'),
      
      // added by William, 07/11/2012: extra documents requested
      'apvaba' => array('text' => 'Application to Vary Bail', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apvaba');"),
      'noap51' => array('text' => 'Notice of Appeal s51', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=noap51');"),
      'recofr' => array('text' => 'Request for contested form12', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=recofr');"),
      'vlntc1' => array('text' => 'Audio Visual Link Form44', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=vlntc1');"),
      'seolfa' => array('text' => 'Sexual Offences List FormA', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=seolfa');"),
      'seolfb' => array('text' => 'Sexual Offences List FormB', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=seolfb');"),
      
      'cou_m5'  => array('text' => 'Practice Directions', 'href' => "http://www.magistratescourt.vic.gov.au/ca256cd30010d864/page/practice+&+procedure-chief+magistrate's+practice+directions?OpenDocument&1=15-Practice+%2526+Procedure~&2=10-Chief+Magistrate%2527s+Practice+Directions~&3=~", 'target' => '_blank'),
      'cou_m6'  => array('text' => 'Magistrates` Court Website', 'href' => 'http://www.magistratescourt.vic.gov.au/ca256cd30010d864/homepage?ReadForm&1=Home~&2=~&3=~', 'target' => '_blank'),
    );
  
  static public $court_committal_stream_links = array(
      'apfr31'  => array('text' => 'Application - Form 31', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apfr31');"),
      'ceabno'  => array('text' => 'Case Abridgement - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ceabno');"),
      'cetacm'  => array('text' => 'Cease to Act - Committal', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=cetacm');"),
      'f32cew'  => array('text' => 'Form 32 - Cross-examine Witnesses', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=f32cew');"),
      'f32shu'  => array('text' => 'Form 32 - Straight Hand-up', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=f32shu');"),
      'f32adj'  => array('text' => 'Form 32 - Adjournment', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=f32adj');"),
      'fxcoco'  => array('text' => 'Fax to Committals Co-ordinator', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxcoco');"),
      'fxff25'  => array('text' => 'Fax - Filing Hearing Without Solicitor & Form 25', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxff25');"),
      'f25apa'  => array('text' => 'Form 25 - Appearance', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=f25apa');"),
      'lecoco'  => array('text' => 'Letter to Committal Co-ordinator', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lecoco');"),
      'spmeco'  => array('text' => 'Special Mention - Consent', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=spmeco');"),
      'spmenc'  => array('text' => 'Special Mention - No Consent', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=spmenc');"),
      'vlntcr'  => array('text' => 'Video Link - Notifocation to Central Records', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=vlntcr');"),
      'vlbore'  => array('text' => 'Video Link - Booking Request', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=vlbore');"),
      'cou_s1'  => array('text' => 'Case Direction Notice - Form 32', 'href' => '#'),
      'cou_s2'  => array('text' => 'Practice Directions', 'href' => "http://www.magistratescourt.vic.gov.au/ca256cd30010d864/page/practice+&+procedure-chief+magistrate's+practice+directions?OpenDocument&1=15-Practice+%2526+Procedure~&2=10-Chief+Magistrate%2527s+Practice+Directions~&3=~", 'target' => '_blank'),
      'cou_s3'  => array('text' => 'Magistrates` Court Website', 'href' => 'http://www.magistratescourt.vic.gov.au/ca256cd30010d864/homepage?ReadForm&1=Home~&2=~&3=~', 'target' => '_blank'),
    );

  static public $court_county_links = array(
      'afofs2'  => array('text' => 'Affidavit of Service', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=afofs2');"),
      'baafsu'  => array('text' => 'Bail Application - Affidavit in Support', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=baafsu');"),
      'cou_o1'  => array('text' => 'Affidavits Created', 'href' => '#'),
      'banoti'  => array('text' => 'Bail Application - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=banoti');"),
      'bavoc2'  => array('text' => 'Bail Application - variation of Conditions', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=bavoc2');"),
      'drfidh'  => array('text' => 'Defence Response for Initial Directions Hearing', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=drfidh');"),
      'coreon'  => array('text' => 'Crown Opening - Reply Only', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=coreon');"),
      'coadso'  => array('text' => 'Crown Opening - Admissions Sought', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=coadso');"),
      'fxtocc'  => array('text' => 'Fax - To County Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtocc');"),
      'fxtoj1'  => array('text' => 'Fax - To Judge`s Associate', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtoj1');"),
      'gaoor2'  => array('text' => 'Gaol Order', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=gaoor2');"),
      'genap2'  => array('text' => 'General Application', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=genap2');"),
      'laapfu'  => array('text' => 'Legal Aid - Application For Funding', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=laapfu');"),
      'lecocr'  => array('text' => 'Letter - To County Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lecocr');"),
      'soacno'  => array('text' => 'Solicitor Acting - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=soacno');"),
      'socano'  => array('text' => 'Solicitor Ceased to Act - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=socano');"),
      'spatte'  => array('text' => 'Subpoena - Attend', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=spatte');"),
      'spprod'  => array('text' => 'Subpoena - Produce', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=spprod');"),
      'spprat'  => array('text' => 'Subpoena - Produce and Attend', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=spprat');"),
      'cou_o2'  => array('text' => 'General Crime Court Contact Details', 'href' => '#'),
      'cou_o3'  => array('text' => 'Sex List Practice Directions', 'href' => '#'),
      'cou_o4'  => array('text' => 'General Practice Directions', 'href' => '#'),
      'cou_o5'  => array('text' => 'County Court Website', 'href' => '#'),
      'cou_o6'  => array('text' => 'Search County Court Listings', 'href' => '#'),
    );
  
  static public $court_appeal_links = array(
      'lecoc1' => array('text' => 'Letter - To County Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lecoc1');"),
      'fxtoc1' => array('text' => 'Fax to County Court -  General', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtoc1');"),
      'fxtoj2' => array('text' => 'Fax - To Judge`s Associate', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtoj2');"),
      'noafti' => array('text' => 'Notice of Appeal Fax to Informant', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=noafti');"),
      'spatt1' => array('text' => 'Subpoena - Attend', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=spatt1');"),
      'sppro1' => array('text' => 'Subpoena - Produce', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sppro1');"),
      'sppra1' => array('text' => 'Subpoena - Produce and Attend', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sppra1');"),
      'cou_a1' => array('text' => 'Search County Court Listings', 'href' => '#'),
      'cou_a2' => array('text' => 'Practice Directions', 'href' => '#'),
      'cou_a3' => array('text' => 'County Court Website', 'href' => '#'),
    );
  
  static public $court_supreme_links = array(
      'affec1' => array('text' => 'Affidavit - Exhibit Cover Sheet', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=affec1');"),
      'afofs3' => array('text' => 'Affidavit of Service', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=afofs3');"),
      'baafs1' => array('text' => 'Bail Application - Affidavit in Support', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=baafs1');"),
      'cou_u1' => array('text' => 'Affidavits Created', 'href' => '#'),
      'banot1' => array('text' => 'Bail Application - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=banot1');"),
      'bavano' => array('text' => 'Bail Variation - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=bavano');"),
      'fxtoj3' => array('text' => 'Fax - To Judge`s Associate', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtoj3');"),
      'fxtosc' => array('text' => 'Fax - To Supreme Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtosc');"),
      'letosc' => array('text' => 'Letter - To Supreme Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=letosc');"),
      'noadap' => array('text' => 'Notice to Addressee and Application', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=noadap');"),
      'socan1' => array('text' => 'Solicitor Ceased to Act - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=socan1');"),
      'spatt2' => array('text' => 'Subpoena - Attend', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=spatt2');"),
      'sppro2' => array('text' => 'Subpoena - Produce', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sppro2');"),
      'sppra2' => array('text' => 'Subpoena - Produce and Attend', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sppra2');"),
      'cou_u2' => array('text' => 'Practice Directions', 'href' => '#'),
      'cou_u3' => array('text' => 'Supreme Court Website', 'href' => '#'),
    );

  static public $court_court_appeal_links = array(
      'apacno' => array('text' => 'Appeal Against Conviction - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apacno');"),
      'apasno' => array('text' => 'Appeal Against Sentence - Notice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apasno');"),
      'fxabap' => array('text' => 'Fax - Abandoning Appeal', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxabap');"),
      'fxcaju' => array('text' => 'Fax - To Court of Appeal Judge', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxcaju');"),
      'folcsh' => array('text' => 'Folder Coversheet', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=folcsh');"),
      'fospvo' => array('text' => 'Folder - Spine v OPP', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fospvo');"),
      'fxtoca' => array('text' => 'Fax to Court of Appeal', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtoca');"),
      'lttoca' => array('text' => 'Letter to Court of Appeal', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lttoca');"),
      'nosoac' => array('text' => 'Notice that Solicitor Acts', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=nosoac');"),
      'pmgwea' => array('text' => 'Particulars (Must go with Each Appeal)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=pmgwea');"),
      'vgrsrr' => array('text' => 'VGRS  Request For Recording', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=vgrsrr');"),
      'extiap' => array('text' => 'Extension of Time Application', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=extiap');"),
      'cou_e1' => array('text' => 'Practice Directions', 'href' => '#'),
      'cou_e2' => array('text' => 'Supreme Court Website', 'href' => '#'),
    );

  static public $court_high_court_links = array(
      'letohc' => array('text' => 'Letter to High Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=letohc');"),
      'fxtohc' => array('text' => 'Fax to High Court', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtohc');"),
      'fxtoja' => array('text' => 'Fax to Judge`s Associate', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtoja');"),
      'cou_h1' => array('text' => 'High Court Website', 'href' => '#'),
    );
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /*************************************** BARRISTER section **************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $barrister_page_links = array(
      'bar_p1' => array('text' => 'Barrister Details', 'href' => 'barrister/index?edit_pager=1', 'action' => 'index'),
      'bar_p2' => array('text' => 'Backsheets', 'href' => 'barrister/backsheets', 'action' => 'backsheets'),
      'bar_p3' => array('text' => 'Correspondence', 'href' => 'barrister/correspondence', 'action' => 'correspondence'),
    );
  
  static public $barrister_default_links = array(
      //'bar_d1' => array('text' => 'Add/Update Barrister', 'href' => '#'),
      'baintb' => array('text' => 'Basics to Include in Trial Brief', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=baintb');"),
    );
  
  static public $barrister_extra_options = array(
      'bar_e1' => array('text' => '"Whole of Job" Text', 'value' => 'main'),
      'bar_e2' => array('text' => 'VLA No Payment For Adjournment', 'value' => 'other'),
      'bar_e3' => array('text' => 'Count/Supreme Text', 'value' => 'prison'),
    );
  
  static public $barrister_backsheets_links = array(
      'appoin' => array('text' => 'Appeal Police (Informant)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=appoin');"),
      'appopp' => array('text' => 'Appeal O.P.P.', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=appopp');"),
      'apcdpp' => array('text' => 'Appeal C.D.P.P.', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apcdpp');"),
      'apopra' => array('text' => 'Appeal Other Prosecuting Agency', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apopra');"),
      'aoinai' => array('text' => 'Appeal Other Individual Named as Informant', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=aoinai');"),
      'cdppro' => array('text' => 'Commonwealth Director of Public Prosecutions (C.D.P.P.)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=cdppro');"),
      'dacdpp' => array('text' => 'Director`s Appeal C.D.P.P.', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=dacdpp');"),
      'dapopp' => array('text' => 'Director`s Appeal O.P.P.', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=dapopp');"),
      'ofoppr' => array('text' => 'Officer of Public Prosecutions (O.P.P.)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ofoppr');"),
      'oinain' => array('text' => 'Other Individual Named as Informant', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=oinain');"),
      'otprag' => array('text' => 'Other Prosecuting Agency', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=otprag');"),
      'polinf' => array('text' => 'Police (Informant)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=polinf');"),
    );
  
  static public $barrister_correspondence_links = array(
      'fxtoba' => array('text' => 'Fax to Barrister', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtoba');"),
      'lttoba' => array('text' => 'Letter to Barrister', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lttoba');"),
      'metocn' => array('text' => 'Memorandum to Counsel', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=metocn');"),
      'pspnwf' => array('text' => 'Print Spine (Wide Folder)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=pspnwf');"),
      'pspnnf' => array('text' => 'Print Spine (Narrow Folder)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=pspnnf');"),
      'bar_c1' => array('text' => 'Email Barrister`s Clerk', 'href' => '#'),
      'bar_c2' => array('text' => 'Victorian Bar Website', 'href' => 'http://www.vicbar.com.au', 'target' => '_blank'),
    );
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /****************************************** FEE section *****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $fee_page_links = array(
      'fee_p1' => array('text' => 'Fee Details', 'href' => 'fileFee/index?edit_pager=1&code=FEE', 'action' => 'index'),
      'fee_p2' => array('text' => 'Agreement', 'href' => 'fileFee/index?edit_pager=1&code=FAG', 'action' => 'index'),
      'fee_p3' => array('text' => 'Invoices', 'href' => 'fileFee/invoices', 'action' => 'invoices'),
      'fee_p4' => array('text' => 'Receipts', 'href' => 'fileFee/receipts', 'action' => 'receipts'),
    );
  
  static public $fee_agreements_links = array(
      'falsod' => array('text' => 'Lump sum one day', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=falsod');"),
      'falsmd' => array('text' => 'Lump sum more than one day', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=falsmd');"),
      'fascfe' => array('text' => 'Schedule fees', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fascfe');"),
      'fagecl' => array('text' => 'General Cover Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fagecl');"),
      'falscl' => array('text' => 'Lump sum Cover Letter', 'href'=> '#', 'js' => "onclick=openBox('document/new?doc=falscl');"),
    );
  
  static public $fee_invoices_links = array(
      'stdinv' => array('text' => 'New Standard Inv', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=stdinv');"),
      'nstinv' => array('text' => 'New Non - Standard Inv', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=nstinv');"),
      'trnmin' => array('text' => 'New Trust Inv - No Monies Owing', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=trnmin');"),      
      'trmoin' => array('text' => 'New Trust Inv - Monies Owing', 'href' => "#", 'js' => "onclick=openBox('document/new?doc=trmoin');"),
    );
  
  static public $fee_receipts_links = array(
      'paircp' => array('text' => 'Paid Receipt', 'href' => "#", 'js' => "onclick=openBox('document/new?doc=paircp');"),
      'intrcp' => array('text' => 'Interim Receipt', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=intrcp');"),
    );
      
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** LEGAL section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $legal_page_links = array(
      'lga_p1' => array('text' => 'VLA Details', 'href' => 'legal/index?edit_pager=1', 'action' => 'index'),
      'lga_p2' => array('text' => 'Simplified Grants Unit', 'href' => 'grant/index?edit_pager=0', 'action' => 'index'),
      'lga_p3' => array('text' => '  - Elodge', 'href' => 'legal/elodge', 'action' => 'elodge'),
      'lga_p4' => array('text' => '  - Indictable', 'href' => 'legal/indictable', 'action' => 'indictable'),
      'lga_p5' => array('text' => '  - Forms', 'href' => 'legal/forms', 'action' => 'forms'),
      'lga_p6' => array('text' => 'Manuals & Guidelines', 'href' => 'legal/manuals', 'action' => 'manuals'),
      'lga_p7' => array('text' => 'Compliance', 'href' => 'compliance/index?edit_pager=1', 'action' => 'index'),
      'lga_p8' => array('text' => '  - Worksheets', 'href' => 'legal/worksheets', 'action' => 'worksheets'),
    );
  
  static public $legal_vla_details_links = array(
      'lga_v1' => array('text' => 'Email VLA App', 'href' => '#'),
      'fxtvla' => array('text' => 'Fax to VLA', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtvla');"),
      'mltvla' => array('text' => 'Miscellaneous Letter to VLA', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=mltvla');"),
      'lga_v2' => array('text' => 'Victoria Legal Aid Website', 'href' => 'http://www.legalaid.vic.gov.au', 'target' => '_blank'),
    );

  static public $legal_elodge_links = array(
      'lga_e1' => array('text' => 'Log In to Elodge', 'href' => '#'),
      'lga_e2' => array('text' => 'Email Elodge Team', 'href' => '#'),
    );
      
  // FIND OUT IF THESE ARE LINKS OR DOCUMENTS
  static public $legal_indictable_links = array(
      'aptl1i' => array('text' => 'Appeal Table L1 Invoice', 'href' => '#'),
      'cotbin' => array('text' => 'Committals - Table B Invoice', 'href' => '#'),
      'cotb1i' => array('text' => 'Committals - Table B1 Invoice', 'href' => '#'),
      'catl1i' => array('text' => 'Crown Appeal Table L1 Invoice', 'href' => '#'),
      'coplin' => array('text' => 'County Plea Invoice', 'href' => '#'),
      'cotrin' => array('text' => 'County Trial Invoice', 'href' => '#'),
      'hcotbm' => array('text' => 'High Court Table M', 'href' => '#'),
      'mtcdfi' => array('text' => 'Misc. - Table C, D & F Invoice', 'href' => '#'),
      'suplin' => array('text' => 'Supreme Plea Invoice', 'href' => '#'),
      'sutrin' => array('text' => 'Supreme Trial Invoice', 'href' => '#'),
    );

  // FIND OUT IF THESE ARE LINKS OR DOCUMENTS
  static public $legal_forms_links = array(
      'chckli' => array('text' => 'Checklist', 'href' => '#'),
      'ccapbr' => array('text' => 'County Court Appeal/Breach', 'href' => '#'),
      'exprwr' => array('text' => 'Extra Prep Worksheet', 'href' => '#'),
      'finrpt' => array('text' => 'Final Report', 'href' => '#'),
      'vlaapf' => array('text' => 'VLA Application Form', 'href' => '#'),
      'txinmk' => array('text' => 'Tax Invoice Mags/Kids', 'href' => '#'),
      'ctximk' => array('text' => 'Consol Tax Invoice Mags/Kids', 'href' => '#'),
    );

  static public $legal_manuals_links = array(
      'lga_m1' => array('text' => 'Grants Handbook', 'href' => '#'),
      'lga_m2' => array('text' => 'Notes on Guidelines', 'href' => '#'),
      'lga_m3' => array('text' => 'Section 29A Practitioner Manual', 'href' => '#'),
    );

  static public $legal_compliance_links = array(
      'lacofn' => array('text' => 'legal Aid Compliance Filenote', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lacofn');"),
    );

  static public $legal_worksheets_links = array(
      'appeal' => array('text' => 'Appeal', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=appeal');"),
      'baialc' => array('text' => 'Bail Application', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=baialc');"),
      'comtal' => array('text' => 'Committals', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=comtal');"),
      'consod' => array('text' => 'Consolidation', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=consod');"),
      'guicom' => array('text' => 'Guilty - Commonwealth', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=guicom');"),
      'guista' => array('text' => 'Guilty - State', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=guista');"),
      'medrep' => array('text' => 'Medical Report', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=medrep');"),
      'noguco' => array('text' => 'Not Guilty -Commonwealth', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=noguco');"),
      'nogust' => array('text' => 'Not Guilty - State', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=nogust');"),
      'trapro' => array('text' => 'Traffic Prosecution', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=trapro');"),
      'trialx' => array('text' => 'Trial', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=trialx');"),
      'lga_w1' => array('text' => 'worksheets On-line', 'href' => '#'),
    );
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** AGENCY section ***************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $agency_page_links = array(
      'agn_p1' => array('text' => 'Criminal Trial Listing Dir', 'href' => "agency/index?edit_pager=1&code=CLD", 'action' => 'index'),
      'agn_p2' => array('text' => 'Office of Corrections', 'href' => 'agency/index?edit_pager=1&code=OOC', 'action' => 'index'),
      'agn_p3' => array('text' => 'Juvenile Justice', 'href' => 'agency/index?edit_pager=1&code=JJS', 'action' => 'index'),
      'agn_p4' => array('text' => 'Prisons', 'href' => 'agency/index?edit_pager=1&code=PRI', 'action' => 'index'),
      'agn_p5' => array('text' => 'Appeals Costs Board', 'href' => 'agency/index?edit_pager=1&code=ACB', 'action' => 'index'),
      'agn_p6' => array('text' => 'Aboriginal Legal Services', 'href' => 'agency/index?edit_pager=1&code=ALS', 'action' => 'index'),
      'agn_p7' => array('text' => 'Community Legal Services', 'href' => 'agency/index?edit_pager=1&code=CLS', 'action' => 'index'),
    );
  
  static public $agency_criminal_trial_listing_dir_links = array(
      'ctldfx' => array('text' => 'CTLD Fax', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ctldfx');"),
      'ctldlt' => array('text' => 'CTLD Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ctldlt');"),
      'combar' => array('text' => 'Confirm Barrister', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=combar');"),
      'cobafx' => array('text' => 'Confirm Barrister Fax', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=cobafx');"),
      'comple' => array('text' => 'Confirm that Plea', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=comple');"),
      'coplfx' => array('text' => 'Confirm that Plea Fax', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=coplfx');"),
      'fm211e' => array('text' => 'Form 2 11-E', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fm211e');"),
      'en211e' => array('text' => 'Enclosing 2 11-E', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=en211e');"),
      'e211fx' => array('text' => 'Enclosing 2 11-E Fax', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=e211fx');"),
    );
  
  static public $agency_office_of_corrections_links = array(
      'fxtoct' => array('text' => 'Fax to Corrections', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtoct');"),
      'lttoct' => array('text' => 'Letter to Corrections', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lttoct');"),
    );
  
  static public $agency_juvenile_justice_links = array(
      'fxtojj' => array('text' => 'Fax to Juvenile Justice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtojj');"),
      'lttojj' => array('text' => 'Letter to Juvenile Justice', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lttojj');"),
      'ytcloc' => array('text' => 'YTC Location', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ytcloc');"),
    );
  
  static public $agency_prisons_links = array(
      //'chgalo' => array('text' => 'Change Gaol Location', 'href' => '#'),
      'fxtopr' => array('text' => 'Fax to Prison', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtopr');"),
      'lttopr' => array('text' => 'Letter to Prison', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lttopr');"),
      'agn_r1' => array('text' => 'List of Remandees', 'href' => '#'),
      'phocof' => array('text' => 'Phone Conference', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=phocof');"),
      'agn_r2' => array('text' => 'Prison Visits', 'href' => '#'),
      'rcrnnb' => array('text' => 'Request CRN Number', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=rcrnnb');"),
      'rcrnal' => array('text' => 'Request CRN Number & Location', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=rcrnal');"),
      'reprlo' => array('text' => 'Request Prison Location', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=reprlo');"),
      'vidcof' => array('text' => 'Video Conference', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=vidcof');"),
      'vpadpf' => array('text' => 'Video/Phone at Dame Phyllis Frost', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=vpadpf');"),
      'ytclo1' => array('text' => 'YTC Location', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=ytclo1');"),
    );
  
  static public $agency_appeals_costs_board_links = array(
      'apcoce' => array('text' => 'Appeals Cost Certificate', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apcoce');"),
      'apcobl' => array('text' => 'Appeals Costs Board Letter', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apcobl');"),
      'apcobf' => array('text' => 'Appeals Costs Board Fax', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=apcobf');"),
    );
  
  static public $agency_aboriginal_legal_services_links = array(
      'fxtals' => array('text' => 'Fax to Aboriginal Legal Services', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtals');"),
      'lttals' => array('text' => 'Letter to Aboriginal Legal Services', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lttals');"),
    );
  
  static public $agency_community_legal_services_links = array(
      'fxtcls' => array('text' => 'Fax to Community Legal Services', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxtcls');"),
      'lttcls' => array('text' => 'Letter to Community Legal Services', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=lttcls');"),
    );
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** TO DO section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $todo_page_links = array(
      'tdo_p1' => array('text' => "Client's List", 'href' => 'todo/index?rf=1&code=ALL', 'action' => 'index'),
      'tdo_p2' => array('text' => "MB's List - By", 'href' => 'todo/index?code=MBLB&filter=filter&filters[task_by_id]=2', 'action' => 'index'),
      'tdo_p3' => array('text' => "MB's List - For", 'href' => 'todo/index?code=MBLF&filter=filter&filters[task_for_id]=2', 'action' => 'index'),
      'tdo_p4' => array('text' => "Other's List - By", 'href' => 'todo/index?code=OTLB&rf=1', 'action' => 'index'),
      'tdo_p5' => array('text' => "Other's List - For", 'href' => 'todo/index?code=OTLF&rf=1', 'action' => 'index'),
    );
  
  
  
  //////////////////////////////////////////////////////////////////////////////////////////////////
  /***************************************** ADMIN section ****************************************/
  //////////////////////////////////////////////////////////////////////////////////////////////////
  static public $admin_page_links = array(
      'adm_p1' => array('text' => 'File', 'href' => 'file/index?edit_pager=1', 'action' => 'index'),
      'adm_p2' => array('text' => 'File Management', 'href' => 'admin/fileManagement', 'action' => 'fileManagement'),      
      'adm_p3' => array('text' => 'Misc. Correspondence', 'href' => 'admin/correspondence', 'action' => 'correspondence'),
      'adm_p4' => array('text' => 'Phone Book', 'href' => 'admin/phoneBook', 'action' => 'phoneBook'),
      'adm_p5' => array('text' => 'Users & Customers', 'href' => 'user/index?edit_pager=0', 'action' => 'index'),
      'adm_p6' => array('text' => 'Entities & Agencies', 'href' => 'institution/index?edit_pager=0', 'action' => 'index'),
      'adm_p7' => array('text' => 'Referral', 'href' => 'admin/referral', 'action' => 'referral'),
      'adm_p8' => array('text' => 'Settings', 'href' => 'admin/settings', 'action' => 'settings'),
      'adm_p9' => array('text' => 'Court Dates List', 'href' => 'admin/courtList?filter=Current', 'action' => 'courtList'),
      'adm_p10' => array('text' => 'Saved Documents List', 'href' => 'document/index?edit_pager=0', 'action' => 'index'),
      'adm_p11' => array('text' => 'Sent Documents List', 'href' => 'correspondence/index?edit_pager=0', 'action' => 'index'),
      'adm_p12' => array('text' => 'SMS Templates', 'href' => 'smsTemplate/index?edit_pager=0', 'action' => 'index'),
    );

  static public $admin_file_management_links = array(
      'adm_f1' => array('text' => 'Change File Number', 'href' => '#', 'js' => 'onclick="openBox(\'admin/process?doc=chfinu\', 500, 200)"'),
      'adm_f2' => array('text' => 'Change File Status', 'href' => '#', 'js' => 'onclick="openBox(\'admin/process?doc=stficl\', 500, 200)"'),
      'adm_f3' => array('text' => 'Files - Current List', 'href' => 'file/index?edit_pager=0&filter=Current', 'action' => 'fileManagement'),
      'adm_f4' => array('text' => 'Files - Closed List', 'href' => 'file/index?edit_pager=0&filter=Closed', 'action' => 'fileManagement'),
      'adm_f5' => array('text' => 'Files - Re-open List', 'href' => 'file/index?edit_pager=0&filter=Re-open', 'action' => 'fileManagement'),
      'adm_f6' => array('text' => 'Files - Complete List', 'href' => 'file/index?edit_pager=0&filter=Complete', 'action' => 'fileManagement'),
      //'adm_fS' => array('text' => 'Files - Out-dated List', 'href' => 'file/index?edit_pager=0&filter=Out-dated', 'action' => 'fileManagement'),
      'adm_fC' => array('text' => 'Results - Check Past dates', 'href' => 'file/index?edit_pager=0&filter=Out-dated', 'action' => 'fileManagement'),
      'adm_f7' => array('text' => 'Form 25 - Outstanding List', 'href' => '#'),
      'adm_f8' => array('text' => 'Form 32 - Outstanding List', 'href' => '#'),
      'adm_f9' => array('text' => 'Hand Up Briefs - Outstanding List', 'href' => '#'),
      //'adm_fA' => array('text' => 'List of Found Files', 'href' => '#'),
      'adm_fB' => array('text' => 'Police Briefs - Unreceived', 'href' => '#'),
      'adm_fD' => array('text' => 'Solicitor - List Current Files', 'href' => 'file/index?edit_pager=0&filter=Complete', 'action' => 'fileManagement'),
      //'adm_fE' => array('text' => 'VLA Contest Mention Letters', 'href' => '#'),
      'adm_fF' => array('text' => 'View File Notes or Phone Messages where chose "add to this file"', 'href' => '#'),
      'adm_fG' => array('text' => 'View Following Types of Letters or Drafts Printed for This File; Misc. letter to Client/Informant/Prosecutor : Misc. Letter - This File', 'href' => '#'),
      'adm_fH' => array('text' => 'View Misc. Letter - Any File', 'href' => '#'),
      'adm_fI' => array('text' => 'View Letters or Forms Sent as Email Attachements on This File', 'href' => '#'),
      'adm_fJ' => array('text' => 'SMS Staff', 'href' => '#'),
      'adm_fK' => array('text' => 'View SMS Log', 'href' => '#'),
      'adm_fL' => array('text' => 'Word Templates', 'href' => '#'),
      'adm_fM' => array('text' => 'Create New File', 'href' => 'file/new?edit_pager=1', 'action' => 'new'),
      //'adm_fN' => array('text' => 'Create Duplicate File', 'href' => '#'),
      'adm_fO' => array('text' => 'File - Change Details', 'href' => 'file/index?edit_pager=1', 'action' => 'index'),
      'adm_fP' => array('text' => 'Solicitor - Change Details', 'href' => '#'),
      'adm_fQ' => array('text' => 'Client Photo', 'href' => '#'),
      'adm_fR' => array('text' => 'Delete File', 'href' => '#'),
    );

  static public $admin_phone_book_links = array(
      'adm_b1' => array('text' => 'Aboriginal Legal Services', 'href' => '#'),
      'adm_b2' => array('text' => 'Barristers', 'href' => '#'),
      'adm_b3' => array('text' => 'Barristers` Clerks', 'href' => '#'),
      'adm_b4' => array('text' => 'Courts', 'href' => '#'),
      'adm_b5' => array('text' => 'Community Legal Centres', 'href' => '#'),
      'adm_b6' => array('text' => 'Firm General Phone Book', 'href' => '#'),
      'adm_b7' => array('text' => 'Juvenile Justice', 'href' => '#'),
      'adm_b8' => array('text' => 'Postcodes', 'href' => '#'),
      'adm_b9' => array('text' => 'Police Stations', 'href' => '#'),
      'adm_bA' => array('text' => 'Prisons', 'href' => '#'),
      'adm_bB' => array('text' => 'Prosecutors', 'href' => '#'),
      'adm_bC' => array('text' => 'Victoria Legal Aid', 'href' => '#'),
    );
  
  static public $admin_referral_links = array(
      'adm_r1' => array('text' => 'Email Asking to Fill In', 'href' => '#'),
      'adm_r2' => array('text' => 'Find Files Opened By Date', 'href' => '#'),
      'adm_r3' => array('text' => 'Find Referrals By Date', 'href' => '#'),
    );
  
  static public $admin_correspondence_links = array(
      'afthpa' => array('text' => 'Affidavit 3rd Party', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=afthpa');"),
      'a3psat' => array('text' => 'Affidavit 3rd Party (Solicitor Attesting)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=a3psat');"),
      'a3pecs' => array('text' => 'Affidavit 3rd Party - Exhibit Cover Sheet', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=a3pecs');"),
      'adm_o1' => array('text' => 'Blank Pages', 'href' => '#'),
      'adm_o2' => array('text' => 'Email Solicitor - Please Ring Client', 'href' => '#'),
      'adm_o3' => array('text' => 'Email Solicitor - Outstanding Fees', 'href' => '#'),
      'fxcvtf' => array('text' => 'Fax Cover - This File', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxcvtf');"),
      'fxcvaf' => array('text' => 'Fax Cover - Any File', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fxcvaf');"),
      'fnattf' => array('text' => 'File Note - Add to This File', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fnattf');"),
      'fnnatf' => array('text' => 'File Note - Not Added to This File', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=fnnatf');"),
      'flspwd' => array('text' => 'Folder Spine - Wide', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=flspwd');"),
      'flspna' => array('text' => 'Folder Spine - Narrow', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=flspna');"),
      'mlttfi' => array('text' => 'Miscellaneous Letter - This File', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=mlttfi');"),
      'mltafi' => array('text' => 'Miscellaneous Letter - Any File', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=mltafi');"),
      'pmattf' => array('text' => 'Phone Message - Add to This File', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=pmattf');"),
      'pmanfi' => array('text' => 'Phone Message - Any File', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=pmanfi');"),
      'sde3pa' => array('text' => 'Statutory Declaration 3rd Party', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sde3pa');"),
      'sd3psa' => array('text' => 'Statutory Declaration 3rd Party (Solicitor Attesting)', 'href' => '#', 'js' => "onclick=openBox('document/new?doc=sd3psa');"),
      'adm_o4' => array('text' => 'Affidavits Created', 'href' => '#'),
      'adm_o5' => array('text' => 'View File Notes or Phone Messages where chose "add to this file"', 'href' => '#'),
      'adm_o6' => array('text' => 'View Following Types of Letters or Drafts Printed for This File; Misc. letter to Client/Informant/Prosecutor : Misc. Letter - This File', 'href' => '#'),
      'adm_o7' => array('text' => 'View Letters or Forms Sent as Email Attachements on This File', 'href' => '#'),
      'adm_o8' => array('text' => 'Word Templates', 'href' => '#'),
      'adm_o9' => array('text' => 'View List of Misc. Letters - Any File', 'href' => '#'),
    );
  
   static public $admin_court_list_links = array( 
      //'adm_c1' => array('text' => 'All Dates', 'href' => '#'),
      //'adm_c2' => array('text' => 'Today`s List', 'href' => '#'),
      //'adm_c3' => array('text' => 'Tomorrow`s List', 'href' => '#'),
      //'adm_c4' => array('text' => 'This Week`s List', 'href' => '#'),
      //'adm_c5' => array('text' => 'Choose Dates', 'href' => '#'),
      //'adm_c6' => array('text' => 'Solicitor', 'href' => '#'),
      //'adm_c7' => array('text' => 'Clear Solicitor', 'href' => '#'),
      //'adm_c8' => array('text' => 'Check Magistrates` Court Listing', 'href' => '#'),
      //'adm_c9' => array('text' => 'Check County Court Listing', 'href' => '#'),
  );
   
  static public function getAdminCourtListLinks()
  {
    /*self::$admin_court_list_links['adm_c1'] = array('text' => 'All Dates', 'href' => 'admin/courtList?edit_pager=0&rf=1', 'action' => 'index');
    self::$admin_court_list_links['adm_c2'] = array('text' => 'Today`s List', 'href' => 'admin/courtList?edit_pager=0&filter=filter&filters[date][from]='.date('Y-m-d').'&filters[date][to]='.date('Y-m-d'), 'action' => 'index');
    self::$admin_court_list_links['adm_c3'] = array('text' => 'Tomorrow`s List', 'href' => 'admin/courtList?edit_pager=0&filter=filter&filters[date][from]='.date('Y-m-d',time() + (24 * 60 * 60)).'&filters[date][to]='.date('Y-m-d',time() + (24 * 60 * 60)), 'action' => 'index');
    self::$admin_court_list_links['adm_c4'] = array('text' => 'This Week`s List', 'href' => 'admin/courtList?edit_pager=0&filter=filter&filters[date][from]='.strtotime("previous monday").'&filters[date][to]='.strtotime("next sunday" ), 'action' => 'index');
    self::$admin_court_list_links['adm_c5'] = array('text' => 'Choose Dates', 'href' => 'admin/courtList?edit_pager=0&rf=1', 'action' => 'index');*/
    
    self::$admin_court_list_links['adm_c1'] = array('text' => "Tomorrow's List", 'href' => 'admin/courtList?edit_pager=0&filter=Tomorrow', 'action' => 'index');
    self::$admin_court_list_links['adm_c1'] = array('text' => "Next 7 days List", 'href' => 'admin/courtList?edit_pager=0&filter=Next 7 days', 'action' => 'index');
    self::$admin_court_list_links['adm_c2'] = array('text' => "Next 2 weeks List", 'href' => 'admin/courtList?edit_pager=0&filter=Next 2 weeks', 'action' => 'index');
    self::$admin_court_list_links['adm_c3'] = array('text' => "Past 2 weeks List", 'href' => 'admin/courtList?edit_pager=0&filter=Past 2 weeks', 'action' => 'index');
    self::$admin_court_list_links['adm_c4'] = array('text' => "All Dates List", 'href' => 'admin/courtList?edit_pager=0&filter=Complete&rf=1', 'action' => 'index');
    self::$admin_court_list_links['adm_c5'] = array('text' => 'Choose Dates', 'href' => 'admin/courtList?edit_pager=0&filter=Complete&rf=1', 'action' => 'index');
    
    return self::$admin_court_list_links;
  }
  
  
  // function to replace the hardcode links by database info
  static public function getLinks($admin_section)
  {
    $links = Doctrine_Query::create()
          ->from('DocumentType dt')
          ->innerJoin('dt.AdminSection as WITH as.code = ?', $admin_section)
          ->execute();
    
    $client_correspondence_links = array();
    if ($links) {
      foreach ($links as $link)  {
        //echo $link->getShortName().' - '.$link->getName().'<br/>';   
        $client_correspondence_links[$link->getShortName()] = array(
            'text' => $link->getName(),
            'href' => '',
            'js' => "onclick=openBox('document/new?doc=".$link->getShortName()."');"
        );
      }
    }
    return $client_correspondence_links;
  }
  
}
?>
