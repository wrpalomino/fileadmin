<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CommonTable extends Doctrine_Table
{  
  private static $full_part_options = array(
    '' => '',
    'Full' => 'Full',
    'Part' => 'Part',
  );
  
  private static $hearing_type_options = array(
    'pg_up_to_8_summary_charges' => "PG - Up to 8 summary charges",
    'committal_mention' => "Committal mention",
    'sex_offence' => 'Sex Offence',
    'adjournment_application' => 'Adjournment Application'
  );
  
  private static $addressee_declaration_options = array(
    'all_material' => 'All of the material I am providing to the Court in compliance with the 
      attached subpoena is copies of documents. I acknowledge that the Court will destroy the 
      copies once they are no longer required, without further notice to me.',
    'some_material' => 'Some or all of the material I am providing to the Court in compliance 
      with the attached subpoena is an original document. Once the material is no longer required, 
      all of the material should be returned to me at the following address â [insert address 
      for return of material].'
  );
  
  private static $subpoena_ordered_options = array(
    'attend' => '*to attend to give evidence- see section A of this form;',
    'produce' => '*to produce this subpoena or a copy of it and the documents or things specified in 
      the Schedule- see section B of this form; or',
    'attend_produce' => '*to attend to give evidence and to produce this subpoena or a copy of it 
      and the documents or things specified in the Schedule- see section C of this form.'
  );
  
  private static $worksheet_appeal_options = array(
    'conviction_sentence' => array(
      'conviction' => 'Against Conviction',
      'sentence' => 'Against Sentence'
    ),
    'advice_grounds' => array(
      'advice' => 'Advice of Counsel AND/OR',
      'grounds' => 'The grounds to be relied upon in support of the application'
    )
  );
  
  private static $worksheet_bail_application_options = array(
    'grounds_strengths' => array(
      'No fail to appear priors' => 'No fail to appear priors',
      'Rehab Drug Alcohol Detox' => 'Rehab/Drug/Alcohol/Detox',
      'Stable Accomodation' => 'Stable Accomodation',
      'Supported Accomodation' => 'Supported Accomodation',
      'Support Workers References' => 'Support Workers/References',
      'Other References' => 'Other References'
    ),
    'practitioner_assessment' => array(
      'Fail to Appear Priors Breach Bails' => 'Fail to Appear Priors/Breach Bails',
      'Offended whilst on Bail' => 'Offended whilst on Bail',
      'Nature of Offence' => 'Nature of Offence(s)',
      'Unacceptable Risk offending witnesses' => 'Unacceptable Risk (offending/witnesses)',
      'No stable Accomodation' => 'No stable Accomodation'
    )
  );
  
  private static $worksheet_committal_options = array(
    'sexual_committal' => array(
      "sexual assault" => "A sexual assault case where aid is sought for limited representation. 
        (limited assistance of one day to cross-examine victim only",
      "committal mention" => "A committal mention and Negotiations: And/OR A Defended Committal for:"
    ),
    'one_two_days' => array(
      "onw day" => "ONE day",
      "two day" => "TWO days"
    ),
    "eligilibity_criteria" => array(
      "Homicide" => "Homicide (including manslaughter and culpable driving)",
      "where identification" => "A case where identification, or consent, is a real issue ** (provide 
        outline of reasons); OR",
      "strong likelihood" => "A case where there is a strong likelihood that a benefit will result 
        from representation."
    ),
    "change_deal" => array(
      "principal charge" => "The principal charge(s) capable of being heard and determined Summarily",
      "lesser charge" => "A lesser charge is likely to be offered by the prosecution"
    ),
    "cross_examination" => array(
      "leads_agreed" => "leads to an agreed amended summary of facts",
      "clarifies issues" => "clarifies issues to be faced at trial",
      "results in evidence" => "results in evidence being admitted at a subsequent trial",
      "discredits witness testimony" => "discredits witness testimony which may lead to that evidence 
        being excluded"
    )
  );

  private static $worksheet_guilty_state_options = array(
    "seriousness of the offence" => "The seriousness of the offence relative to other examples of the 
      same offence (eg. Quantum of theft nature of injuries, amount of drugs)",
    "Extent to which the law was breached" => "Extent to which the law was breached",
    "Extent of mitigating circumstances" => "Extent of mitigating circumstances",
    "Extent of any aggravating circumstances" => "Extent of any aggravating circumstances",
    "Eligible person under Intelectually" => "Eligible person under Intelectually Disabled Persons Act, or",
    "Receiving services from Mental" => "Receiving services from Approved Mental Health Servie Documentary 
      proof on file"
  );
   
  private static $worksheet_not_guilty_state_options = array(
    "crown_case" => array(
      "Likelihood that evidence was obtained illegally" => "Likelihood that evidence was obtained illegally",
      "Admission not voluntary" => "Admission not voluntary",
      "Accused not informed of right to silence" => "Accused not informed of right to silence",
      "Police engaged illegal behaviour" => "Police engaged in illegal behaviour without authorisation",
      "Likelihood of propensity for the evidence" => "Likelihood of propensity for the evidence to be 
        unduly prejudicial to the accused"
    ),
    "likely_penalty" => array(
      "Primary charge or main group of charges" => "Primary charge or main group of charges",
      "The extent to which the law was breached" => "The extent to which the law was breached",
      "Existence of aggravating or mitigating" => "Existence of aggravating or mitigating circumstances"
    )
  );
  
  private static $worksheet_trial_options = array(
    "category" => array(
      "County Court Trial" => "County Court Trial",
      "County Court Plea" => "County Court Plea",
      "Supreme Court Trial" => "Supreme Court Trial",
      "Supreme Court Plea" => "Supreme Court Plea"
    ),
    "recommendations" => array( 
      "Specific defence argument or arguments;" => "Specific defence argument or arguments;", 
      "Voir dire only; or" => "Voir dire only; or",
      "(specify limited purpose)" => "(specify limited purpose)"
    )
  );
  
  private static $bail_application_options = array(
    "summary_indictable" => array(
      "summary_stream" => "Summary stream (please tick)",
      "indictable_stream" => "Indictable stream (please tick)"
    ),
    "to" =>  array(
      "registrar_magistrates_court" => "Registrar, Magistratesâ Court",
      "the_respondent" => "The Respondent",
      "the_office_of_public_prosecutions" => "The Office of Public Prosecutions",
      "vicpol_prosecutions" => "VicPol prosecutions"
    ),
    "time" => array(
      "9:30 AM" => "9:30 AM",
      "10:30 AM" => "10:30 AM",
      "Other" => "Other"
    ),
    "hearing_details" => array(
      "CISP CREDIT Assessment required" => "CISP / CREDIT Assessment required? (please tick)",
      "Will evidence be called" => "Will evidence be called? (please tick)"
    )
  );
 
  private static $vary_bail_application_options = array(
    "amount_conditions" => array(
      "amount_bail" => "* AMOUNT OF BAIL",
      "conditions_bail" => "* CONDITION(S) OF BAIL"
    ),  
    "admitted_conditions" => array(
      "a" => "* (a)",
      "b" => "* (b)"  
    ),
    "surety" => array(
      "surety" => "* surety/",
      "sureties" => "sureties"
    ),
    "vary_conditions" => array(
      "vary" => "* varying ",
      "condition" =>  " a condition / ",
      "conditions as follows" => " the conditions of bail as follows:"
    )
  );
    
  private static $request_contested_options = array(
    "represented" => "The accused is represented by:",
    "no_represented" => "The accused is not legally represented"
  );
  
  private static $witness_summon_options = array(
    "give" => "&nbsp;come to court to give evidence in the proceeding",
    "give_produce" => "&nbsp;come to court to give evidence and also produce at the hearing the following documents or 
      things that are in your possession or control.%%field17%%",
    "produce" => "&nbsp;produce at the hearing the following documents or things that are in your possession or control.
      %%field19%%"
  );
  
  
  static public function getBankAccountOptions()
  {
    $arr = sfconfig::get('app_appowner_bankaccounts');
    return array_combine($arr, $arr);
  }
  
  static public function getBankAccountDetails($bank_account_type_id)
  {
    $account = ($bank_account_type_id == 1) ? 'trustaccount' : 'businessaccount';
    $arr = sfConfig::get('app_appowner_'.$account);
    $account_text = "";
    foreach ($arr as $k => $v) {
      if (!empty($account_text)) $account_text.= "\n";
      $account_text.= " * ".$k.": ".$v;
    }
    return $account_text;
  }
  
  static public function getFullPartOptions()
  {
    return self::$full_part_options;
  }
  
  static public function getHearingTypeOptions()
  {
    return self::$hearing_type_options;
  }
  
  static public function getAddresseeDeclarationOptions()
  {
    return self::$addressee_declaration_options;
  }
  
  static public function getSubpoenaOrderedOptions() 
  {
    return self::$subpoena_ordered_options;
  }
  
  static public function getWorksheetAppealOptions($qt='')
  {
    return (isset(self::$worksheet_appeal_options[$qt])) ? self::$worksheet_appeal_options[$qt] : array();
  }
  
  static public function getWorksheetBailApplicationOptions($qt='')
  {
    return (isset(self::$worksheet_bail_application_options[$qt])) ? self::$worksheet_bail_application_options[$qt] : array();
  }
  
  static public function getWorksheetCommittalOptions($qt='')
  {
    return (isset(self::$worksheet_committal_options[$qt])) ? self::$worksheet_committal_options[$qt] : array();
  }
  
  static public function getWorksheetGuiltyStateOptions()
  {
    return self::$worksheet_guilty_state_options;
  }
  
  static public function getWorksheetNotGuiltyStateOptions($qt='')
  {
    return (isset(self::$worksheet_not_guilty_state_options[$qt])) ? self::$worksheet_not_guilty_state_options[$qt] : array();
  }
  
  static public function getWorksheetTrialOptions($qt='')
  {
    return (isset(self::$worksheet_trial_options[$qt])) ? self::$worksheet_trial_options[$qt] : array();
  }
  
  static public function getBailApplicationOptions($qt='')
  {
    return (isset(self::$bail_application_options[$qt])) ? self::$bail_application_options[$qt] : array();
  }  
  
  static public function getVaryBailApplicationOptions($qt='')
  {
    return (isset(self::$vary_bail_application_options[$qt])) ? self::$vary_bail_application_options[$qt] : array();
  }
  
  static public function getRequestContestedOptions()
  {
    return (isset(self::$request_contested_options)) ? self::$request_contested_options : array();
  }
  
  static public function getWitnessSummonOptions()
  {
    return (isset(self::$witness_summon_options)) ? self::$witness_summon_options : array();
  }
  
  static public function getCorrespondenceSentOptions()
  {
    $arr = array();
    foreach (Link::$client_send_to as $option) $arr[] = $option['text'];
    return $arr;
  }
  
  
  
  
  // added by William, 28/01/2013: this is to change the session variable for the main filter search criteria
  static public function fixMainFilterValues($main_filter)
  {
    if ($main_filter['date']['text'] != "") {  // change date from AUS format to US format before searching in DB
      $myDateTime = DateTime::createFromFormat('d-m-Y', $main_filter['date']['text']);
      /*if ($myDateTime) */ $main_filter['date']['text'] = $myDateTime->format('Y-m-d');
      //echo "0000".$main_filter['date']['text']."0000";
    }
    return $main_filter;
  }
  
  
  static public function mainFilter(Doctrine_Query $q, $object='', $user_rel='UserFile')
  {
    $rootAlias = $q->getRootAlias();
    $aux_user_obj = sfContext::getInstance()->getUser();
            
    $main_filter = self::fixMainFilterValues(sfContext::getInstance()->getUser()->getAttribute('main_filter', null));
    
    if ( ($main_filter !== null) && ($user_rel != '') ) {
      $file_rel_add = false;
      $court_rel_add = false; 
      
      // this objects are related only to court date as maximum level, then need a link to user file
      if ( ($object == 'Invoice') || ($object == 'Receipt') /*|| ($object == 'CommittalStream')*/ ) {
        $q->leftJoin($rootAlias . '.CourtDate cd');
        $rootAlias = 'cd';
      }
      
      // for judges who are not linked directly to the user file object but through the court date object
      if ($user_rel == 'JudgeCourtDates') {
        $q->leftJoin($rootAlias . '.JudgeCourtDates cd');
        $rootAlias = 'cd';
        $user_rel='UserFile';   // back to default to process the other criteria
      }
      
      if ( ($object == 'sfGuardUser')&&($user_rel == 'ClientUserFiles') ) {
        if ($main_filter['first_name']['text'] != '') {
          $q->andWhere($rootAlias .'.first_name LIKE ?', '%'.$main_filter['first_name']['text'].'%');
        }

        if ($main_filter['last_name']['text'] != '') {
          $q->andWhere($rootAlias .'.last_name LIKE ?', '%'.$main_filter['last_name']['text'].'%');
        }
      }
      else {
        if ($main_filter['first_name']['text'] != '') {
          if (!$file_rel_add) {
            $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
            $q->leftJoin('uf.Client cl');
            $file_rel_add = true;
          }
          $q->andWhere('cl.first_name LIKE ?', '%'.$main_filter['first_name']['text'].'%');
        }

        if ($main_filter['last_name']['text'] != '') {
          if (!$file_rel_add) {
            $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
            $q->leftJoin('uf.Client cl');
            $file_rel_add = true;
          }
          $q->andWhere('cl.last_name LIKE ?', '%'.$main_filter['last_name']['text'].'%');       
        }
      }
      
      if ($main_filter['number']['text'] != '') {
        if (!$file_rel_add) {
          $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
          $file_rel_add = true;
        }
        $number = (int)$main_filter['number']['text'];
        $number = str_pad((int)$number, 6, "0", STR_PAD_LEFT);
        $q->andWhere('uf.number=?', $number);
      }
      
      if ( ($object == 'CourtDate') || ($rootAlias == 'cd') ) {
        
        // added 03/03/2013: it was added
        if ($rootAlias == 'cd')  $court_rel_add = true;
        
        if ($main_filter['court']['text'] != '') {
          $q->leftJoin($rootAlias.'.Court ag')
          ->andWhere('ag.name LIKE ?', '%'.$main_filter['court']['text'].'%');
        }

        if ($main_filter['date']['text'] != '') {
          $q->andWhere($rootAlias.'.date LIKE ?', '%'.$main_filter['date']['text'].'%');
        }

        if ($main_filter['listing']['text'] != '') {
          $q->leftJoin($rootAlias.'.Listing li')
          ->andWhere('li.name LIKE ?', '%'.$main_filter['listing']['text'].'%');
        }
      }
      else {
        if ($main_filter['court']['text'] != '') {
          if (!$file_rel_add) {
            $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
            $file_rel_add = true;
          }
          if (!$court_rel_add) {
            $q->leftJoin('uf.FileCourtDates cd')
            ->leftJoin('cd.Court ag');
            $court_rel_add = true;
          }
          $q->andWhere('ag.name LIKE ?', '%'.$main_filter['court']['text'].'%');
        }

        if ($main_filter['date']['text'] != '') {
          if (!$file_rel_add) {
            $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
            $file_rel_add = true;
          }
          if (!$court_rel_add) {
            $q->leftJoin('uf.FileCourtDates cd');
            $court_rel_add = true;
          }
          $q->andWhere('cd.date LIKE ?', '%'.$main_filter['date']['text'].'%');
        }

        if ($main_filter['listing']['text'] != '') {
          if (!$file_rel_add) {
            $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
            $file_rel_add = true;
          }
          if (!$court_rel_add) {
            $q->leftJoin('uf.FileCourtDates cd');
            $court_rel_add = true;
          }
          $q->leftJoin('cd.Listing li')
          ->andWhere('li.name LIKE ?', '%'.$main_filter['listing']['text'].'%');
        }
        
      }
      
      if ($object == 'Charge') {
        if ($main_filter['charge']['text'] != '') {
          $q->andWhere($rootAlias.'.charge LIKE ?', '%'.$main_filter['charge']['text'].'%');
        }
      }
      else {
        if ($main_filter['charge']['text'] != '') {
          if (!$file_rel_add) {
            $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
            $file_rel_add = true;
          }
          $q->leftJoin('uf.FileCharges ch')
          ->andWhere('ch.charge LIKE ?', '%'.$main_filter['charge']['text'].'%');
        }
      }
      
      if ($main_filter['informant']['text'] != '') {
        if (!$file_rel_add) {
          $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
          $file_rel_add = true;
        }
        $q->leftJoin('uf.Informant in')
        ->andWhere($aux_user_obj->buildComplexQuery($main_filter['informant']['text'], 'in'));
      }
      
      if ($main_filter['solicitor']['text'] != '') {
        /*if ($object == "CourtDate") {
          $q->leftJoin($rootAlias.'.Appearing ap')
          ->andWhere($aux_user_obj->buildComplexQuery($main_filter['solicitor']['text'], 'ap'));          
        }
        else  {*/
          if (!$file_rel_add) {
            $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
            $file_rel_add = true;
          }
          $q->leftJoin('uf.Solicitor so')
          ->andWhere($aux_user_obj->buildComplexQuery($main_filter['solicitor']['text'], 'so'));
        //}
      }
      $q = self::setExtraSQL($q, $court_rel_add, $file_rel_add, $user_rel);
    }
    
    //echo $q;
    return $q;
  }
  
  
  static public function setExtraSQL(Doctrine_Query $q, $court_rel_add, $file_rel_add, $user_rel='UserFile', $mobject='uf', $extra_sql=null)
  {
    // added on 02/03/2013: always show the most recent court date
    $rootAlias = $q->getRootAlias();
 
    if (!$file_rel_add) {
      $q->leftJoin($rootAlias . '.'.$user_rel.' uf');
    }
    if (!$court_rel_add) {
      $q->leftJoin($mobject.'.FileCourtDates cd');
    }
    $q->orderBy('cd.date ASC'); // always ordered DESC

    
    if ($extra_sql != null)  {
      foreach ($extra_sql as $k => $v) {
        switch ($k) {
          case 'LIMIT': $q->limit($v);    break;
        }
      }
    }
    
    return $q;
  }
  
}
?>