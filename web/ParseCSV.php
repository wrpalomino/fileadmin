<?php

//to reset autoincrement...
//ALTER TABLE table_to_reset AUTO_INCREMENT=next_index_to_insert

function csv_to_array($input, $delimiter='|')
{
  $header = null;
  $data = array();
  $csvData = str_getcsv($input, "\n");
  
  foreach($csvData as $csvLine) {
    if(is_null($header)) {
      $header = explode($delimiter, $csvLine);
    }
    else {
      $items = explode($delimiter, $csvLine);
      for($n = 0, $m = count($header); $n < $m; $n++) {
        $prepareData[$header[$n]] = $items[$n];
      }
      $data[] = $prepareData;
    }
  }  
  return $data;
}


function parseCSV()
{
  $con = mysql_connect("localhost", "dbcrimla_admin", "fileadmin1234");
  if (!$con) {  
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("dbcrimla_fileadmin", $con);

  // inserting users and profiles
  $user_table = 'sf_guard_user';
  $profile_table = 'sf_guard_user_profile';
  $user_group_table = 'sf_guard_user_group';
  $user_agency_table = 'sf_guard_user_agency';


  /*$result = mysql_query("SELECT * FROM ".$user_table. " WHERE username LIKE '%barrister%'");
  $date_time = date('Y-m-d H:d:s');
  while($row = mysql_fetch_array($result)) {
    //echo $row['id'] . " " . $row['username']."<br />";
    $user_id = $row['id'];
    // for barrister
    $group_id = 4;
    $insert_query = "INSERT INTO ".$user_group_table." (user_id, group_id, created_at, updated_at) VALUES (".$user_id.", ".$group_id.", '".$date_time."', '".$date_time."')";
    echo $insert_query.'<br/>';
    //mysql_query($insert_query);
  }*/


  $result = mysql_query("SELECT * FROM agency WHERE sf_guard_group_id = 17");
  $date_time = date('Y-m-d H:d:s');
  while($row = mysql_fetch_array($result)) {
    //echo $row['id'] . " " . $row['username']."<br />";
    $agency_id = $row['id'];

    //echo $agency_id.' '.$row['name'].'<br/>';
    $name = ucwords(strtolower(str_replace("'", "\'",$row['name'])));
    $result1 = mysql_query("SELECT * FROM ".$user_table." WHERE first_name LIKE '%".$name."%'");
    $empty = true;
    while($row1 = mysql_fetch_array($result1)) {
      $empty = false;
      if ($agency_id > 3) {
        //echo "  ".$row1['id']. ' '.$row1['first_name']. ' '.$row1['last_name'].'<br/>';
        $user_id = $row1['id'];
        $insert_query = "INSERT INTO ".$user_agency_table." (user_id, agency_id, created_at, updated_at) VALUES (".$user_id.", ".$agency_id.", '".$date_time."', '".$date_time."')";
        //echo $insert_query.'<br/>';
        //mysql_query($insert_query);
      }
    } 

    if ($empty) echo $agency_id.' '.$row['name'].'<br/>';
    echo "<br/>";
  }


  /*$csvArr = csv_to_array(file_get_contents('Barristers.csv'));
  $cont = 0;
  foreach ($csvArr as $k => $v) {
    foreach ($v as $k1 => $v1) {
      //$v1 = str_replace('"', '', $v1);
      $v1 = str_replace("'", "\'", $v1);
      if ($v1 != ',,,,') {
        ++$cont;
        //echo $k1 .' => '. $v1.'<br/>';
        $fields = explode(',', $k1);
        $values = explode(',', $v1);
        $username = 'barrister'.$cont;
        $user_f = implode(',',array('username', $fields[0], $fields[1], $fields[2]));
        $user_v = implode(',',array("'".$username."'", "'".$values[0]."'", "'".$values[1]."'", "'".$values[2]."'"));
        $insert_query1 = "INSERT INTO ".$user_table." (".$user_f.") VALUES (".$user_v.")";
        echo $insert_query1.'<br/>';
        //mysql_query($insert_query1);

        $id = mysql_insert_id();
        $prof_f = implode(',',array('user_id', $fields[3], $fields[4]));
        $prof_v = implode(',',array($id, "'".$values[3]."'", "'".$values[4]."'"));
        $insert_query2 = "INSERT INTO ".$profile_table." (".$prof_f.") VALUES (".$prof_v.")";
        echo $insert_query2.'<br/><br/>';
        //mysql_query($insert_query2);
      }
    }
  }*/

  /*$date_time = date('Y-m-d H:d:s');
  //$csvArr = csv_to_array(file_get_contents('CriminalCoordinators.csv'));
  //$csvArr = csv_to_array(file_get_contents('SexualOffenceCoordinators.csv'));
  $csvArr = csv_to_array(file_get_contents('Registries.csv'));
  $cont = 0;
  foreach ($csvArr as $k => $v) {
    foreach ($v as $k1 => $v1) {
      //$v1 = str_replace('"', '', $v1);
      $v1 = str_replace("'", "\'", $v1);
      if ($v1 != ',,,,') {
        ++$cont;
        //echo $k1 .' => '. $v1.'<br/>';
        $fields = explode(',', $k1);
        $values = explode(',', $v1);
        $username = 'registry'.$cont;

        if (empty($values[2])) {
          $user_f = implode(',',array('username', $fields[0], $fields[1], 'created_at', 'updated_at'));
          $user_v = implode(',',array("'".$username."'", "'".$values[0]."'", "'".$values[1]."'", "'".$date_time."'", "'".$date_time."'"));
        }
        else {
          $user_f = implode(',',array('username', $fields[0], $fields[1], $fields[2], 'created_at', 'updated_at'));
          $user_v = implode(',',array("'".$username."'", "'".$values[0]."'", "'".$values[1]."'", "'".$values[2]."'", "'".$date_time."'", "'".$date_time."'"));
        }
        $insert_query1 = "INSERT INTO ".$user_table." (".$user_f.") VALUES (".$user_v.")";
        echo $insert_query1.'<br/>';
        //mysql_query($insert_query1);

        $id = mysql_insert_id();
        $prof_f = implode(',',array('user_id', $fields[3], $fields[4], 'created_at', 'updated_at'));
        $prof_v = implode(',',array($id, "'".$values[3]."'", "'".$values[4]."'", "'".$date_time."'", "'".$date_time."'"));
        $insert_query2 = "INSERT INTO ".$profile_table." (".$prof_f.") VALUES (".$prof_v.")";
        echo $insert_query2.'<br/>';
        //mysql_query($insert_query2);

        $user_id = $id;
        // for coordinator
        $group_id = 25;
        $insert_query3 = "INSERT INTO ".$user_group_table." (user_id, group_id, created_at, updated_at) VALUES (".$user_id.", ".$group_id.", '".$date_time."', '".$date_time."')";
        echo $insert_query3.'<br/><br/>';
        //mysql_query($insert_query3);
      }
    }
  }*/

  mysql_close($con);
}


function readPHPFile() 
{
  $documents_arr = array();
  $base_rooth = ($_SERVER['DOCUMENT_ROOT']).'fileadmin/';
  $filename = $base_rooth."lib/model/Link.class.php";
  $fp = fopen( $filename, "r" ) or die("Couldn't open $filename");
  
  $cont = 0;
  $section = '';
  while ( ! feof( $fp ) ) {
    $line = fgets( $fp, 1024 );
    //echo $line."<br/>";
    
    $section_pos = strpos($line, 'static public $');
    if ($section_pos !== false) {
      $init_posx = strpos($line, '$')+1;
      $section = substr($line, $init_posx, strpos($line, '_links')-$init_posx);
      //echo $section.'<br/>';
    }
    
    $pos = strpos($line, 'onclick=openBox(');
    if ($pos !== false) {
      //echo ++$cont.' -- ';
      //echo $line."<br/>";
      $code = substr($line, 7, 6);
      $name = '';
      $posname_ini = strpos($line, "text");
      if ($posname_ini !== false) {
        $posname_ini = $posname_ini+10;
        $posname_end = strpos($line, "'", $posname_ini);
        $name = substr($line, $posname_ini, $posname_end-$posname_ini);
      }
      //echo ++$cont .':'.$code .'  =>  '. $name .'<br/>';
      
      $document_arr = array('code' => $code,  'name' => $name);
      //$section = str_replace('_', ' ', $section);
      //$document_arr['section'] = isset($document_arr['section']) ? ';'.$section : $section;
      $document_arr['section'] = $section;
      $documents_arr[] = $document_arr;
    }
  }
  
  $codesx = array();
  $codes0 = array();
  $section_arr = array();
  foreach ($documents_arr as $k => $doc) {
    //echo ($k+1) .': '.$doc['code'] .'  =>  '. $doc['name'] .' |||||| '. $doc['section'] .'<br/>';
    $codes0[] = $doc['code'];
    if (isset($codesx[$doc['code']])) {
      $codesx[$doc['code']]['section'].= '|'.$doc['section'];
    }
    else {
      $codesx[$doc['code']] = $doc;
    }
    if (!isset($section_arr[$doc['section']])) {
      $section_arr[$doc['section']] = $doc['section'];
    }
  }
  
  /*echo '<pre>';
  print_r(array_count_values($codes0));
  echo '</pre>';*/  
  
  $con = mysql_connect("localhost", "dbcrimla_admin", "fileadmin1234");
  if (!$con) {  
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("dbcrimla_fileadmin", $con);

  // inserting document types
  $document_type_table = 'document_type';
  
  foreach ($codesx as $k => $doc) {
    
    //echo ++$cont .': '.$doc['code'] .'  =>  '. $doc['name'] .' |||||| '. $doc['section'] .'<br/>';
  
    $result = mysql_query("SELECT * FROM admin_section WHERE code='".$doc['section']."'");
    $date_time = date('Y-m-d H:d:s');
    while($row = mysql_fetch_array($result)) {
      $admin_section_id = $row['id'];

      $insert_query = "INSERT INTO ".$document_type_table." (name, short_name, admin_section_id, created_at, updated_at) VALUES ('".$doc['name']."', '".$doc['code']."', ".$admin_section_id.", '".$date_time."', '".$date_time."')";
      //echo ++$count.": ".$insert_query.'<br/>';
      //mysql_query($insert_query);  
    } 
  } 
  
  /*$codes = array();
  foreach ($codesx as $k => $doc) {
    $codes[] = $doc['code'];
  }
  
  echo '<pre>';
  print_r(array_count_values($codes));
  echo '</pre>';*/ 
}



function LoadAdminContentText()
{
  $default_values = array(
    'brirq1' => array(
'field17' => 'APPLICATION FOR BRIEF OF EVIDENCE<br/><br/>
We act for the above named and note that you are the Informant.<br/>
Pursuant to s 39(1) of the Criminal Procedure Act 2009 and to the common law in relation to pretrial 
disclosure we request that you provide our office with the following material:<br/>
(a) a copy of the charge-sheet relating to the alleged offence; and<br/>
(b) a copy of any prior convictions or ﬁndings of guilt against the accused and for any witness 
proposed to be called  by the Prosecution in this case; and<br/>
(c) any information, document or thing on which the prosecution intends to rely at the hearing of the 
charge including:<br/>
(i) a copy of any statement relevant to the charge signed by the accused, or a record of interview 
of the accused, that is in the possession of the informant; and<br/>
(ii) a copy, or a transcript, of any audio-recording or audiovisual recording required to be made 
under Subdivision (3 0A) of Division 1 of Part III of the Crimes Act 195 8; and<br/>
(iii) a copy or statement of any other evidentiary material that is in the possession of the informant 
relating to a confession or admission made by the accused relevant to the charge; and<br/>
(iv) a list of the persons the prosecution intends to call as witnesses at the hearing, together with 
a copy of each of the statements made by those persons;<br/>
(v) a legible copy of any document which the prosecution intends to produce as evidence; and<br/>
(vi) a list of any things the prosecution intends to tender as exhibits; and<br/>
(vii) a clear photograph, or a clear copy of such a photograph, of any proposed exhibit that cannot 
be described in detail in the list; and<br/>
(viii) a description of any forensic procedure, examination or test that has not yet been completed 
and on which the prosecution intends to rely as tending to establish the guilt of the accused; and<br/>
(ix) any evidentiary certiﬁcate issued under any Act that is likely to be relevant to the alleged 
offence;<br/>
And any other information, document or thing in the possession of the prosecution that is relevant 
to the alleged offence. We would be grateful to receive that material immediately.'
    ),
    
    'trmoin' => array(
'field17' => 'To our professional costs of and in connection with attending upon you and taking 
detailed instructions, all perusals, telephone attendances, preparation and lodging of documents and 
appearing on your behalf;'
    ),
    
    'aplema' => array(
'field17' => 'Please ring and make an appointment to see me.<br/><br/><br/>
Thank you for your assistance in relation to this matter.'
    ),
    
    'brfwcp' => array(
'field17' => 'Please find enclosed a copy of the Police brief.<br/><br/>
Please ring our office and make an appointment to see me once you have read it.'
    ),
    
    'brrmat' => array(
'field17' => 'We have received the copy of the Brief of Evidence in relation to your upcoming matter.<br/>
Please ring our office and make an appointment to see me to discuss the brief.<br/>
To make an appointment phone the office and ask for<br/><br/>
We look forward to hearing from you.'
    ),
    
    'brrmap' => array(
'field17' => 'We have received the copy of the Brief of Evidence in relation to your upcoming matter.<br/>
Please ring our office and make an appointment to see me to discuss the brief.<br/><br/>
We look forward to hearing from you.'
    ),
    
    'brwwfc' => array(
'field17' => 'We refer to the above and write to advise that we are still awaiting the police brief in your 
matter despite several requests to the Informant.<br/><br/>
Please be advised that we will forward a copy of the brief to you as soon as it is received by our office.<br/><br/>
In the meantime, please do not hesitate to contact me should you have any queries.'
    ),
    
    'brwwrr' => array(
'field17' => 'We refer to the above and write to advise that we are still awaiting the police brief in your 
matter despite several requests to the Informant.<br/><br/>
Please be advised that we will ring you as soon as it is received by our office.<br/><br/>
In the meantime, please do not hesitate to contact this office should you have any questions about your matter.'
    ),
    
    'clovle' => array(
'field17' => 'Please find attached letter from County Court in relation to your matter.<br/>
It is now listed for a Callover at the time on the letter.<br/>
You must attend the Callover.'
    ),
    
    
    'canoco' => array(
'field17' => 'We refer to the above and advise that we have made several attempts to contact you regarding 
your matter.<br/>
As we have not had any contact from you we can no longer represent you in your upcoming Court hearing.<br/>
We have notified the Court that we are no longer representing you in this matter.'
    ),
    
    
    'canofu' => array(
'field17' => 'We refer to the above matter and advise that we have ceased to act on your behalf.<br/>
Your legal fees were not paid by the due date and you failed to contact us to make alternative arrangements.<br/>
We have notified the Court that we are no longer representing you in this matter.'
    ),
    
    'cansla' => array(
'field17' => 'We refer to the above matter and advise that we have ceased to act on you behalf.<br/>
Despite several requests you have failed to send us the documentation required for us to apply for legal
aid on your behalf.<br/>
We have notified the Court that we are no longer representing you in this matter.'
    ),
    
    'docpro' => array(
'field17' => 'Please forward as soon as possible the following to our office:<br/><br/><br/>
Thank you for your assistance in this matter'
    ),

    'ftasum' => array(
'field17' => 'You were on a summons and your matter was to be heard on the above date.<br/>
Due to the fact that you did not attend Court a warrant has been issued for your arrest.<br/>
This means that the Informant will probably arrest you again. To arrange to be bailed you should ring 
the Informant and arrange to go into a Police Station.<br/><br/>
If you want some assistance in dealing with this problem please contact us as soon as possible.'
    ),
    
  'ftabai' => array(
'field17' => 'As you were on bail you were required to attend Court on the above date.<br/>
Due to the fact that you did not attend Court a warrant has been issued for your arrest.<br/>
This means that the Informant will probably arrest you again. To arrange to be re-bailed directly you 
should ring the Informant and explain to them why you did not answer your bail. They might then agree 
for you to go into a Police Station and be re-bailed.<br/>
They might not agree to re-bailing you and say that you have to go before a Magistrate to apply for 
bail. Please call us immediately if they are saying that you will have to go back before a Magistrate.<br/><br/>
If you want some assistance in dealing with this problem please contact us as soon as possible.'
    ),

    'lapsfo' => array(
'field17' => 'Please find enclosed a legal aid application form. Please complete and sign the form and 
send it back in the self-addressed envelope as soon as possible.<br/>
We will also require a copy of your current health care card if you are receiving a Centrelink benefit.<br/>
If you are working, we will require one recent payslip and the last three months of your bank statements.'),

    'laffop' => array(
'field17' => 'Please find enclosed a legal aid application form which has been completed on your behalf 
during the phone call.<br/>
Please complete and sign the back page of the application form after checking the information and then 
send it back as soon as possible.'
    ),

    'lapfof' => array(
'field17' => 'Please find enclosed a legal aid application form . Please just sign it on the back page 
(next to the cross) and send it back in the self-addressed envelope as soon as possible.<br/>
We will also require a copy of your current health care card if you are receiving a Centrelink benefit.<br/>
If you are working, we will require one recent payslip and the last three months of your bank statements.'
    ),

    'lanmam' => array(
'field17' => 'We refer to the above.<br/><br/>
As it has been over 12 months since you applied for legal aid funding, Victoria Legal Aid require updated 
financial information. This is so they can confirm your continuing eligibility for funding for lawyers.<br/>
Find enclosed Financial Statement for you to complete and return. When returning the Statement please also 
include a recent payslip and bank statements for last three month period.<br/>
Please attend to this matter without delay. We need to ensure that funding is in place for the next hearing.<br/>
A stamped, addressed envelope is enclosed for your use.<br/><br/>
Any queries, please contact this office.'
    ),

    'larefu' => array(
'field17' => 'Victoria Legal Aid have advised that your application for legal aid has been refused. The
amount that we would need to be paid to represent you at the next hearing of this matter is contained in 
the attached fees agreement.<br/>
Please contact us immediately to confirm you want us to act in relation to your matter.'
    ),

    'pocafe' => array(
'field17' => 'Your matter is next listed on the above date.<br/><br/>
As discussed, we have scheduled an appointment for you to see a psychologist so we can obtain a psychological 
report for your Court case.<br/>
Please be aware that the fee will need to be paid directly to the psychologist on the date of the assessment.<br/>
Name<br/>
Address<br/>
Time<br/>
Date<br/>
Fee<br/><br/>
Should you have any questions about this please contact me'
    ),

    'pocoac' => array(
'field17' => 'Your matter is next listed on the above date.<br/><br/>
As discussed, we have scheduled an appointment for you to see a psychologist so we can obtain a psychological 
report for your Court case.<br/>
It is very important that you attend the appointment so that the report is finished in time for Court.<br/>
Name<br/>
Address<br/>
Time<br/>
Date<br/><br/>
Should you have any questions about this please contact me'
    ),

    'picafe' => array(
'field17' => 'Your matter is next listed on the above date.<br/><br/>
As discussed, we have scheduled an appointment for you to see a psychiatrist so we can obtain a psychiatric 
report for your Court case.<br/>
Please be aware that the fee will need to be paid directly to the psychiatrist on the date of the assessment.<br/>
Name<br/>
Address<br/>
Time<br/>
Date<br/>
Fee<br/><br/>
Should you have any questions about this please contact me'
    ),

    'picoac' => array(
'field17' => 'Your matter is next listed on the above date.<br/><br/>
As discussed, we have scheduled an appointment for you to see a psychiatrist so we can obtain a psychiatric 
report for your Court case.<br/>
It is very important that you attend the appointment so that the report is finished in time for Court.<br/>
Name<br/>
Address<br/>
Time<br/>
Date<br/><br/>
Should you have any questions about this please contact me'
    ),

    'relein' => array(
'field17' => 'We confirm the result of your appearance at Court.<br/>
%%solicitor%% appeared before %%judge%% who made the following order:<br/>
%%result%%<br/>
We are obliged to tell all our clients that you have 28 days from the date of your appearance at 
Court to file an appeal if you believe the punishment you were given was excessive or that you were 
not, in fact, guilty.<br/>
Your appeal would then be heard in the County Court. It is very important that you note that the County 
Court can increase the sentence that you received if you appeal.<br/>
The responsibility of filing an appeal is yours and if it is outside the time limits you may not be 
allowed to continue with your appeal.'
    ),

    'relefm' => array(
'field17' => 'We confirm the result of your appearance at Court.<br/>
%%solicitor%% appeared before %%judge%% who made the following order:<br/>
%%result%%<br/><br/>
We enclose our final Trust Ledger report detailing receipts and payments and confirm our fees have 
been paid in full.<br/>
We are obliged to tell all our clients that you have 28 days from the date of your appearance at Court 
to file an appeal if you believe the punishment you were given was excessive or that you were not, in 
fact, guilty.<br/>
Your appeal would then be heard in the County Court. It is very important that you note that the County 
Court can increase the sentence that you received if you appeal.<br/>
The responsibility of filing an appeal is yours and if it is outside the time limits you may not be 
allowed to continue with your appeal.<br/><br/>
Please contact us if you want to discuss any of this information.'
    ),

    'relefc' => array(
'field17' => 'We confirm the result of your appearance at Court.<br/>
%%solicitor%% appeared before %%judge%% who made the following order:<br/>
%%result%%<br/><br/>
We enclose our final Trust Ledger report detailing receipts and payments and confirm our fees have been 
paid in full<br/>
We are obliged to tell all our clients that you have 28 days from the date of your appearance at Court 
to file an appeal if you believe the punishment you were given was excessive or that you were not, in 
fact, guilty.<br/>
Your appeal would then be heard in the Court of Appeal. It is very important that you note that the Court 
of Appeal can increase the sentence that you received if you appeal.<br/>
The responsibility of filing an appeal is yours and if it is outside the time limits you may not be allowed 
to continue with your appeal.<br/><br/>
Please contact us if you want to discuss any of this information'
    ),
    
    'faxefa' => array(
'field17' => 'Please find attached an authority signed by our client.'),
    
    'crfxco' => array(
'field17' => 'Please find enclosed a guide to writing a character reference.'),
    
    'foirps' => array(
'field17' => 'Please find enclosed a Freedom of Information request form in accordance with the Freedom 
of Information Act 1982.<br/>
Please sign the form and return it to this office as soon as possible.<br/><br/>
Please contact us if you have any questions about this request.'
    ),
    
    'apnofx' => array(
'field17' => 'Please find enclosed Notice of Appeal papers in relation to our client.<br/><br/>
Please contact us if you want to discuss this matter.'
    ),
    
    'comefx' => array(
'field17' => 'This matter has been adjourned for a contest mention.<br/><br/>
Obviously it saves Court time and is of advantage to all parties to see whether there are issues that can 
be resolved prior to the hearing.<br/><br/>
Please contact us to discuss this matter prior to the Court date.'
    ),
    
    'drdeso' => array(
'field17' => "You are the Informant in our client's matter that is listed on the above date.<br/><br/>
The brief contains details of a claim for damages/restitution.<br/><br/>
We would appreciate you forwarding to us, before the above date, a copy of any statements that are the 
basis for the above claim. If there are no statements we would appreciate being informed of the basis 
for the claim.<br/><br/>
Thank you for your assistance."
    ),
    
    'divlet' => array(
'field17' => "We respectfully submit that this is a matter suitable for recommendation fo the Diversion
program for the following reasons:<br/><br/>
1. The offence in these circumstances is, in some senses, minor;<br/>
2. The accused shows remorse and regret for the wrongdoing and was co-operative with the Police throughout 
their investigation;<br/>
3. The accused is unlikely to reoffend;<br/>
4. The accused will respond positively to the Diversion process and its requirements;<br/>
5. A conviction would have a serious effect on the accused's future;<br/>
6. The accused has no prior convictions or Court appearances;<br/><br/>
Please assess our client as to their suitability for Diversion and advise us accordingly.<br/><br/>
Thank you for your consideration. Do not hesitate to contact me should you want to discuss this matter further."
    ),
    
    'dorefu' => array(
'field17' => "We act for the above named.<br/><br/>
Please provide our office with the following documents which were not included in the brief;"
    ),
    
    'ftassi' => array(
'field17' => "You are the Informant in our client's matter that was listed on the above date. Our client 
failed to answer their summons on that date and a warrant for their arrest was issued.<br/><br/>
Our client is willing to present themselves to have the warrant executed (and hopefully to be bailed).<br/><br/>
Please contact us to arrange a suitable time for our client to attend the Police Station.<br/><br/>
Thank you for your assistance."
    ),
    
    'ftasmi' => array(
'field17' => "You are the Informant in our client's matter that was listed on the above date.<br/>
Our client failed to answer their summonses on that date and a warrant for their arrest was issued.<br/><br/>
Our client is willing to present themselves to have the warrant executed (and hopefully to be bailed).<br/><br/>
Please contact us to arrange a suitable time for our client to attend the Station.<br/><br/>
Thank you for your assistance."
    ),
    
    'inoble' => array(
'field17' => "We are instructed by the above-named to act on their behalf.<br/><br/>
Please find enclosed an Infringement Notice issued to them.<br/><br/>
Our client is objecting to the Infringement Notice and is requesting for the matter to be heard and 
determined by a Magistrate.<br/><br/>
Thank you for your assistance in relation to this matter."
    ),
    
    'inrere' => array(
'field17' => "We act for the abovenamed in a case where you are the Informant. They no longer have their 
copy of the record of interview and it is necessary for us to have a copy to prepare their matter.<br/><br/>
Please find enclosed a self-addressed envelope and a blank cd. It would be very helpful if you were to 
organise for a copy to be sent to us.<br/><br/>
Thank you for your assistance in relation to this matter."
    ),
    
    'remuin' => array(
'field17' => "You are the Informant in one of our client’s matters that was listed on the above date. Our 
client failed to answer their bail on that date and a warrant for their arrest was issued.<br/><br/>
Our client is willing to present themselves to have the warrant executed (and hopefully to be rebailed).<br/><br/>
We do not know which Informant was sent the warrant. If it was sent to you or you are able to execute 
the warrant please contact us."
    ),
    
    'resiin' => array(
'field17' => "You are the Informant in our client's matter that was listed on the above date. Our client 
failed to answer their bail on that date and a warrant for their arrest was issued.<br/><br/>
Our client is willing to present themselves to have the warrant executed (and hopefully to be rebailed).<br/><br/>
Please contact us to arrange a suitable time for our client to attend the Police Station.<br/><br/>
Thank you for your assistance."
    ),
    
    'wiprre' => array(
'field17' => "We act for the abovenamed in relation to the upcoming hearing where you are the Informant.<br/><br/>
Please provide us with a copy of the prior criminal history of any witnesses that you will be calling to 
give evidence at the hearing.<br/><br/>
Thank you for your assistance in relation to this matter."
    ),
    
    's32cas' => array(
'field17' => "Pursuant to section to s. 32(c)(1) of the Evidence (Miscellaneous Provisions) Act 1958 
(the Act) the accused intends to make an application on at am in the County Court at 250 William Street 
Melbourne to seek leave to issue a subpoena for protection of protected documents."
    ),
    
     's32cma' => array(
'field17' => "that the Defendant proposes to seek leave pursuant to s. 32(c)(1) of the Evidence Act 1958 
(Vic) in relation to evidence of confidential communications:"
    ),
    
    's34psm' => array(
'field17' => "that the Defendant proposes to seek leave pursuant to s. 342 of the Criminal Procedure Act 
(Vic) 2009 to cross-examine the complainant as follows:<br/>
A. The initial questions sought to be asked of the complainant are as follows;<br/><br/><br/>
B. The scope of the evidence sought to be elicited from the initial questioning is as follows:<br/><br/><br/>
C. How the evidence sought to be elicited from the questioning has substantial relevance to facts in issue 
or why it is a proper matter for cross-examination as to credit is as follows:"
    ),
    
    'alinot' => array(
'field17' => "*a. [State the name of each witness the accused proposes to call];<br/><br/>
b. [State the current address of each witness, if known to the accused];<br/><br/>
c. [Last known address of each witness. If the name and address of a witness is not known, the accused must 
state any information which might be of material assistance in finding the witness];<br/><br/>
d. [State the facts on which the accused relies].<br/><br/>
This notice may be given to the prosecutor or informant, by handing it to them at a hearing 
in relation to the charge, or by sending it by prepaid ordinary post to a nominated business address, by 
sending it to a nominated fax or email address, or by leaving the notice at the nominated business address 
with a person who appears to work there or in any other manner agreed with the informant or prosecutor.<br/>
If the accused is in a prison or a police gaol, the officer in charge of the prison or police gaol will 
arrange for this notice, when completed by the accused, to be given or sent to the prosecutor or infomant."
    ),
    
    'fxenad' => array(
'field17' => "Please find attached the request for an adjournment that we forwarded to the Court."),
    
    'fxendc' => array(
'field17' => "Please find attached documents in relation to our client’s matter."),
    
    'sccolt' => array(
'field17' => "We seek to have an out of court summary case conference with a Prosecutor about this case.
Our office is regularly advised that a case must be “booked in” for a summary case conference and that 
the conference must be held with a Prosecutor at Court.<br/>
As you will be aware, we are not funded by Victoria Legal Aid to attend such conferences and with private 
clients it is an extra cost that they should not have to pay.<br/>
We therefore respectfully request that a reply is made by email or by telephone to this letter by a 
prosecutor who has the ability to negotiate this case prior to the Court date.<br/>
As you are aware there is a protocol which establishes court procedures for the summary case conference 
system. The document is signed by the Chief Commissioner of Police as well as the Chief Magistrate and 
other significant parties.<br/>
The link to the document is http://www.legalaid.vic.gov.au/xfw/cl.summarycrim_sept09.pdf<br/>
We extract the following passage:<br/>
“Summary case conferences are out of court discussions between parties for the purpose of getting further 
material, negotiating about charges and summaries or progressing a case to hearing.<br/>
Senior experienced prosecutors will be appointed as Summary Case Conference Managers in each court and 
will be available at and out of court for negotiation be it by phone, email or in person”<br/>
We look forward to your response prior to the court date and note that if we do not receive a response we 
may refer to this letter on the issue of costs."
    ),
    
    'nstinv' => array(
'field17' => "To our professional costs;"
    ),
    
    'paircp' => array(
'field17' => "We have received the sum of $%%amount%%.<br/><br/>
This money is received as part payment of the amount owed. This amount includes GST.<br/><br/>
Thank you for your payment in relation to this matter."
    ),
    
    'intrcp' => array(
'field17' => "We have received the sum of $%%amount%% for our professional costs in relation to your matter 
pursuant to our fees agreement.<br/><br/>
Please note that this is an interim reciept. The actual Trust Account receipt will be
forwarded to you as soon as possible.<br/><br/>
Thank you for your payment in relation to this matter."
    ),
    
    'fagecl' => array(
'field17' => "Thank you for your instructions to act for you in this matter.<br/><br/>
Enclosed are two copies of the Fees Agreement. Please sign them, return a copy to our office and keep 
the second copy for your records."
    ),
    
    'falscl' => array(
'field17' => "Thank you for your instructions to act for you in this matter.<br/><br/>
Enclosed are two copies of the Fees Agreement. Please sign them, return a copy to our office and keep 
the second copy for your records.<br/><br/>
Please pay the fees of $ %%total%% by %%date%%"
    ),
    
    'falsmd' => array(
'field17' => "This amount includes your representation at Court and is calculated on the matter resolving 
and requiring only two appearances.<br/>
If there are any subsequent days of appearance the charge will be $ %%per_day_amount%% + GST of $ 
%%per_day_gst%% per day"
    ),
    
    'falsod' => array(
'field17' => "This amount includes your representation at Court and is calculated on the matter resolving 
and requiring only one appearance."
    ),
    
    'appoin' => array(
'field17' => 'Please note that as this is funded by VLA and thus the grant is subject to a ‘Whole of Job’ 
fee structure in relation to bail applications and appeals, it is a condition of counsel accepting this 
brief that counsel agree to appear at any part heard or return date in relation to this application, 
without any additional fee being available or otherwise payable. The reason for this is that there are 
no further fees that VLA will pay us in relation to the case.<br/>
Victoria Legal aid funding dictates that there is no payment for the adjournment of this case unless there 
is prior approval from Legal Aid.<br/>
This approval is not part of the grant of aid that we currently have and Counsel in accepting this brief 
accept the condition that they will not be paid for an adjournment. If there are sufficient reasons we can 
contact VLA and seek funding but this must be done and the approval given by VLA prior to any appearance 
taking place. If the reason for the adjournment falls outside VLA guidelines we will not make an application'
    ),
    
    'noafti' => array(
'field17' => "Please find enclosed Notice of Appeal papers in relation to our client.<br/><br/>
Please contact us if you want to discuss this matter"
    ),
    
    'adcome' => array(
'field17' => "ADJOURNMENT TO CONTEST MENTION<br/>
INFORMANT: %%informant%%<br/><br/>
We act for the abovenamed.<br/>
We request an adjournment of this matter to a contest mention.<br/>
For these matters, it is our understanding that our client is<br/>
Please contact our office if there are any difficulties with this request.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'adcmnr' => array(
'field17' => "ADJOURNMENT TO CONTEST MENTION<br/>
INFORMANT: %%informant%%<br/><br/>
We act for the abovenamed whose matter is listed for mention on the above date.<br/><br/>
This matter was last adjourned to enable a summary case conference to take place. To this end we have 
attempted to hold such a conference by emailing the Prosecutor. Unfortunately we have not received any 
response.<br/><br/>
Accordingly we request that the matter be adjourned for contest mention.<br/><br/>
As you are aware Victoria Legal Aid do not fund appearances for Summary Case Conferences. We therefore 
advice that whilst the client will attend Court no legal representative will be in attendance.<br/><br/>
For these matters, it is our understanding that our client is<br/>
Please contact our office if there are any difficulties with this request."
    ),
    
    'adcopl' => array(
'field17' => "ADJOURNMENT TO CONSOLIDATION<br/><br/>
We act for the abovenamed, and we request an adjournment for a consolidation plea.<br/><br/>
For these matters, it is our understanding that our client is<br/>
Please contact our office if there are any difficulties with this request.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'adgupl' => array(
'field17' => "ADJOURNMENT TO GUILTY PLEA<br/><br/>
We act for the abovenamed, and we request an adjournment for a plea of guilty.<br/><br/>
For these matters, it is our understanding that our client is<br/>
Please contact our office if there are any difficulties with this request.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'adsucc' => array(
'field17' => "ADJOURNMENT TO ENABLE SUMMARY CASE CONFERENCE TO BE HELD<br/>
INFORMANT: %%informant%%<br/><br/>
We act for the abovenamed.<br/><br/>
We request an adjournment of this matter to enable a case conference to be held.<br/><br/>
For these matters, it is our understanding that our client is<br/>
Please contact our office if there are any difficulties with this request.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'fmsafm' => array(
'field17' => "ADJOURNMENT TO FURTHER MENTION<br/>
INFORMANT: %%informant%%<br/><br/>
We act for the above-named, and we request an adjournment of this matter to a further mention so that 
we can prepare the matter.<br/><br/>
As this is the first mention of the matter and our client is on summons no-one will be appearing at 
Court in relation to this application.<br/><br/>
Please contact our office if there are any difficulties with this request.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'misafm' => array(
'field17' => "ADJOURNMENT TO FURTHER MENTION<br/><br/>
We act for the above-named, and we request an adjournment of this matter to a further mention.<br/><br/>
For these matters, it is our understanding that our client is<br/>
Please contact our office if there are any difficulties with this request.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'nobafm' => array(
'field17' => "ADJOURNMENT TO FURTHER MENTION<br/><br/>
We have sent a request to the Informant for the police brief so that we might advise our client on the 
matter. We request this adjournment to allow time for us to receive the brief and to discuss the matter 
further with our client.<br/><br/>
For these matters, it is our understanding that our client is<br/>
Please contact our office if there are any difficulties with this request.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'niatfm' => array(
'field17' => "ADJOURNMENT TO FURTHER MENTION<br/>
INFORMANT: %%informant%%<br/><br/>
We act for the above-named, and we request an adjournment of this matter to a further mention.<br/><br/>
We have just been instructed by our client, and we request this adjournment to allow us time to obtain 
documentation and receive fuller instructions.<br/><br/>
For these matters, it is our understanding that our client is<br/>
Please contact our office if there are any difficulties with this request.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'timcer' => array(
'field17' => "LISTING FOR TIME CERTAINTY<br/><br/>
We would appreciate this matter being listed for time certainty. The time that that we want the matter 
listed for is<br/><br/>
If this time is unavailable please list it for the next available time after the above.<br/><br/>
Thank you for your assistance in relation to this matter.<br/><br/><br/><br/>
Solicitor reference number for Court:__________"
    ),
    
    'mlttfi' => array(
'field17' => "<br/><br/><br/>
We apologise for the inconvenience.<br/><br/>
Please contact our office if you have any questions"
    ),
    
    'combar' => array(
'field17' => "Please note that in relation to this matter we have briefed.<br/><br/>
The date that the barrister was briefed was"
    ),
    
    'cobafx' => array(
'field17' => "Please note that in relation to this matter we have briefed counsel in relation to this matter:<br/><br/>
The date that the barrister was briefed was"
    ),
    
    'comple' => array(
'field17' => "Please note that this matter has resolved into a plea of guilty.<br/><br/>
Please contact us if you have any questions in relation to this matter."
    ),
    
    'coplfx' => array(
'field17' => "Please note that this matter has resolved into a plea of guilty.<br/><br/>
Please contact us if you have any questions in relation to this matter."
    ),
    
    'fm211e' => array(
'field17' => "1. Is our firm acting for %%client%%?<br/><br/><br/>
2. Have we (or our firm) made arrangements satisfactory to us (or our firm) for payment of legal costs in 
relation to this matter?<br/><br/><br/>
3. Will our firm represent %%client%% on the trial?<br/><br/><br/>
4. If NO to question 1:<br/>
   a) Do we understand that %%client%% has other legal representation? If YES please state the name and 
   address of that other practitioner (if known).<br/><br/><br/>
   b) When did our firm cease to act for %%client%%?<br/><br/><br/>
5. If NO to question 2:<br/>
   a) Has application been made by our firm or by %%client%% for legal assistance on behalf of %%client%%?<br/><br/>
   Date of Application:<br/><br/>
   b) If NO to a), has the defendant been advised by our firm to apply for legal assistance?<br/><br/>
   Date adviced:<br/><br/>
   If no application for legal aid has been made please attach a written explanation.<br/><br/>
6. WE NOTE WE MUST NOTIFY THE CTLD IN WRITING OF THE NAME OF COUNSEL AND WHEN BRIEFED<br/><br/>"
    ),
    
    'en211e' => array(
'field17' => "Please find enclosed Form 2-11E.<br/><br/>
Please contact us if you have any questions in relation to this matter."
    ),
    
    'rcrnnb' => array(
'field17' => "We act for the abovenamed.<br/><br/>
Please advise of their CRN number as we need it for Court correspondence"
    ),
    
    'rcrnal' => array(
'field17' => "We act for the abovenamed.<br/><br/>
Please advise of their current location and their CRN number (so we can use the CRN
on future correspondence).<br/><br/>
Their date of birth is %%date_of_birth%%"
    ),
    
    'reprlo' => array(
'field17' => "We act for the abovenamed.<br/><br/>Please advise of their current location.<br/>
Their date of birth is %%date_of_birth%%"
    ),
    
    'drdrre' => array(
'field17' => "We confirm the result of your appearance at Court.<br/>
_____________________ appeared before __________ who made the following order:<br/>
________________________________________________________<br/><br/>
We enclose our final Trust Ledger report detailing receipts and payments and confirm our fees 
have been paid in full.<br/>
We are obliged to tell all our clients that you have 30 days from the date of your appearance 
at Court to file an appeal if you believe the punishment you were given was excessive or that 
you were not, in fact, guilty.<br/>
Your appeal would then be heard in the County Court. It is very important that you note that 
the County Court can increase the sentence that you received if you appeal.<br/><br/>
The responsibility of filing an appeal is yours and if it is outside the time limits you may
not be allowed to continue with your appeal.<br/><br/>
Please contact us if you want to discuss any of this information."
    ),
    
    'relirs' => array(
'field17' => "____________________ appeared before ________ who made the following order:<br/>
____________________________________________________<br/><br/><br/>
Interlock Condition on your licence<br/><br/>
You've got your licence back, but the Magistrate has ordered you drive with an Interlock 
condition. What follows is a summary of issues relating to driving with an interlock condition, 
including some information about how you go about removing the your interlock after you have 
completed the mandatory minimum period ordered by the Magistate.<br/><br/>
How will having an interlock impact on me?<br/><br/>
You are on a BAC of 0.00% for the duration of the interlock period. You must only drive a motor 
vehicle fitted with an interlock device. No one except you is permitted to drive your motor 
vehicle so long as the interlock device is fitted. It is an offence to drive a motor vehicle in 
breach of your interlock condition.<br/><br/>
How much will the interlock device cost?<br/><br/>
There is an installation and removal fee, you are also responsible for the ongoing monthly service 
and maintenance of the interlock device. Expect to pay around $130 a month.<br/><br/>
How do I apply to remove the Interlock after the minimum period has expired?<br/><br/>
About 6 weeks before the end of the minimum interlock period, contact an accredited drink driver 
education agency for your final assessment and report. The assessment will take place after the 
interlock period has ended. You need to contact the company that installed and services your 
interlock, and provide that company with the name of the drink driver education agency and the 
date for your final assessment. You will need to consent to the release of information from your 
interlock supplier to the agency conducting your final assessment. After booking your final 
assessment and contacting your interlock supplier, you should attend Court and sign your 
application for removal of interlock condition. Your hearing will take place 28 days after lodging 
your application, and at least 7 days after you have completed your final assessment. The 
Magistrates Court will notify the police, and a police officer will interview you before your 
application is heard at Court.<br/><br/>
What happens at my court hearing?<br/><br/>
The Magistrate will consider your final assessment, and the data provided by your Interlock 
supplier. Your interlock supplier will have provided a report which lists the number of times the 
Interlock has been used to start your car. The report discloses occasions when the engine did not 
start due to a BAC over 0.00%. A Magistrate will be reluctant to grant the removal of an interlock 
condition where multiple failures are listed.<br/>
After a successful application for removal of Interlock Condition attend the nearest VicRoads 
office, bring your driver's licence, and bring the Interlock Removal Order.<br/><br/>
Do I need a lawyer?<br/><br/>
Having a lawyer there ensures that your case is put forward in the best possible light.<br/>
You have the comfort of knowing our firm has considerable experience in this technical field of 
licence restorations, and a well established history of helping our clients minimise their 
penalties and suspensions.<br/><br/>
Contact us closer to the end of your interlock period if you want us to represent you on the 
licence restoration hearing and we will guide you through the process."
    ),
    
    'ceexre' => array(
'field17' => "We appeared for our above-named client on _________________________.<br/>
We request a copy of the Certified extract for the above hearing and enclose a cheque for the amount of:<br/>
If there are any difficulties with this request please contact our office."
    ),
    
    'goftye' => array(
'field17' => "Please find enclosed a gaol order in relation to our client.<br/><br/>
Please contact us if there will be any difficulties in relation to their attendance at Court."
    ),
    
    'goftms' => array(
'field17' => "Please find enclosed a gaol order in relation to our client.<br/><br/>
Can you please organize for this gaol order to be signed by a Magistrate and then faxed back to this 
office.<br/><br/>
Thank you for your assistance in relation to this matter."
    ),
    
    'fxff25' => array(
'field17' => "Please find attached a Form 2 in relation to this matter which is listed for a filing
hearing.<br/><br/>
We have explained to our client what the procedure is at a filing hearing. Our client will be 
attending Court for the filing hearing and representing themselves.<br/><br/>
Please contact us if there is any difficulty with this request."
    ),
    
    'spmeco' => array(
'field17' => "We refer to the above and request a Special Mention to be listed on in accordance 
with Clause 3, Schedule 5 of the Magistrates’ Court Act 1989.<br/><br/>
Please be advised that the date of the Special mention has been consented to by the Prosecutor.<br/><br/>
We thank you for your assistance in this matter."
    ),
    
    'spmenc' => array(
'field17' => "We refer to the above and request a Special Mention be listed as soon as possible
in accordance with Clause 3, Schedule 5 of the Magistrates’ Court Act 1989.<br/><br/>
We have contacted the Prosecutor and have been unable to agree on a date and as such ask that a 
date be allocated at the earliest opportunity.<br/><br/>
We thank you for your assistance in relation to this matter."
    ),
    
    'banoti' => array(
'field17' => "that an Application for bail is sought to be made before a Judge in the %%court_name%% at 
%%court_address%%<br/>by the abovementioned Applicant"
    ),
    
    'laapfu' => array(
'field17' => "TAKE NOTICE the accused %%client_name%% will make application to the Court on %%court_date%% 
at %%court_name%% before the Chief Judge, for an order pursuant to Section 197 of the Criminal Procedure 
Act (2009) Victoria Legal Aid provide assistance to the accused and fund their matter."
    ),
    
    'apacno' => array(
'field17' => "I, %%client_name%% am convicted of the offence of<br/>
%%charges_list%%<br/>And I am a prisoner at %%prison_name%%<br/>
And I wish to appeal against my conviction (particulars of which are set out below).<br/><br/>
TAKE NOTICE that I apply to the Court of Appeal for leave to appeal against my conviction on the ground(s):<br/><br/>
(State briefly the grounds upon which you wish to appeal against the conviction)"
    ),
    
    'bafiti' => array(
'field18' => "Details of Co-Accused (list the name of ALL co-accused, date/s of any bail application and the 
name’s of the presiding magistrates<br/>
Name/Case# _______________________ Bail App ___/___/_____ Magistrate _________________<br/>
Name/Case# _______________________ Bail App ___/___/_____ Magistrate _________________"
    ),
    
    'baprre' => array(
'field19' => "(List all previous bail applications by date and the name of the magistrate/s before whom the 
application/s were made)<br/>
Date ___/___/_____ Magistrate __________________<br/>
Date ___/___/_____ Magistrate __________________<br/>"
    ),
    
    'bavoco' => array(
'field17' => "Application is made under section 25 of the Bail Act that the defendant be brought before the 
Court to be further dealt with"
    ),
 
    'coplou' => array(
'field17' => "1. FAMILY<br/>
Where BORN?<br/><br/><br/>
Parents names & occupations<br/><br/><br/>
Who lived with after born?<br/><br/><br/>
Where grew up?<br/><br/><br/>
Brothers and sisters?<br/><br/><br/>
1st name, age and occupation<br/><br/><br/>
Have siblings been in trouble?<br/><br/><br/>
Are parents still alive?<br/><br/><br/>
Any contact with them?<br/><br/><br/>
Good relationship with Parents?<br/><br/><br/>
How would you describe childhood?<br/><br/><br/>
Describe any significant events in your childhood?<br/><br/><br/>
Describe any significant events in family history<br/><br/><br/>
Any important extended family members grandparents aunts etc<br/><br/><br/>
If ward of state - for how long<br/><br/><br/>
Where lived as ward<br/><br/><br/>
Contact with family during wardship<br/><br/><br/><br/>
2. EDUCATION<br/>
Where go to primary school?<br/><br/><br/>
Where go to High School?<br/><br/><br/>
If more than one school set out schools and years of attendance<br/><br/><br/>
What was last year at school?<br/><br/><br/>
Why leave school -ie to go to job<br/><br/><br/>
Did you enjoy school?<br/><br/><br/>
Did you have a good social experience at school?<br/><br/><br/>
How was your academic performance?<br/><br/><br/>
Any educational problems?<br/><br/><br/>
Have you completed any other courses?<br/><br/><br/>
If yes include details and years of attendance<br/><br/><br/>
University?<br/><br/><br/>
Tafe?<br/><br/><br/>
Other?<br/><br/><br/><br/>
3. RELATIONSHIP & CHILDREN<br/>
In relationship?<br/><br/><br/>
Partner’s name<br/><br/><br/>
How long for<br/><br/><br/>
Where do they work?<br/><br/><br/>
Do you have Children?<br/><br/><br/>
names<br/><br/><br/>
ages<br/><br/><br/>
what is other parent’s name<br/><br/><br/>
Who live with?<br/><br/><br/>
How is relationship going?<br/><br/><br/>
Contact?<br/><br/><br/>
Kids health problems<br/><br/><br/>
Other issues with kids<br/><br/><br/>
Set out details of any significant past relationships<br/><br/><br/><br/>
4. EMPLOYMENT AND FINANCES<br/>
A. Current job<br/>
Employer<br/><br/><br/>
Hours of work<br/><br/><br/>
Can we get reference?<br/><br/><br/>
How long worked there?<br/><br/><br/>
Complete work history/chronology (attach CV if one available. Set out previous employers and the years that you worked for them, positions held and respobsibilities etc<br/><br/><br/>
include reasons for leaving jobs<br/><br/><br/>
How long out of work before getting next job?<br/><br/><br/>
How do you feel about your job?<br/><br/><br/>
What are your future work plans?<br/><br/><br/><br/>
B. Earnings<br/>
Net wage per week<br/><br/><br/>
Outgoings<br/><br/><br/>
Renting or Own house<br/><br/><br/>
How much pay to fine per week? (if appropriate)<br/><br/><br/>
Assets<br/><br/><br/>
Debts<br/><br/><br/><br/>
C. Benefit<br/>
Type of benefit<br/><br/><br/>
Amount per week<br/><br/><br/>
When commenced<br/><br/><br/>
Family Benefits?<br/><br/><br/><br/>
5. HEALTH AND SUBSTANCE ABUSE<br/>
A. Health<br/>
Any health problems as kid?<br/><br/><br/>
Health problems now?<br/><br/><br/>
And/or family member<br/><br/><br/>
Report from Doctor<br/><br/><br/><br/>
B. Psychiatric problems<br/>
Diagnosis/diagnoses<br/><br/><br/>
When first arose<br/><br/><br/>
Impact on life<br/><br/><br/>
Reports from GP and Psychiatrist?<br/><br/><br/><br/>
C. Substance abuse<br/>
What substances abused<br/><br/><br/>
Cost per day (eg 1 gram of amphetamine costing $ x)<br/><br/><br/>
How old when started?<br/><br/><br/>
What on/who with<br/><br/><br/>
How much using?<br/><br/><br/>
Attempts to get off<br/><br/><br/>
Rehab placements<br/><br/><br/>
How make them feel /why using?<br/><br/><br/><br/>
6. PRIOR CRIMINAL HISTORY<br/>
Have you been to Court before?<br/><br/><br/>
When and what for?<br/><br/><br/>
Include details of each time been to Court<br/><br/><br/>
What happened and why ?<br/><br/><br/>
Date or approx date of offending<br/><br/><br/>
Age when it occurred<br/><br/><br/>
Sentence received?<br/><br/><br/>
Impact of the sentence on your life?<br/><br/><br/><br/>
7. OFFENCES BEFORE THE COURT<br/>
Give your version of what happened<br/><br/><br/>
What was going on in your life that contributed to what happened?<br/><br/><br/>
How do you feel now about what happened<br/><br/><br/><br/>
A. Mitigatory factors<br/>
Have you made any apology?<br/><br/><br/>
Have you paid compensation or returned goods/money?<br/><br/><br/>
Has a compensation order been sought against you?<br/><br/><br/>
Early plea indicated<br/><br/><br/>
Date?<br/><br/><br/>
History of plea when plea entered<br/><br/><br/>
Admissions? (eg in interview)<br/><br/><br/>
Has there been much delay since the offence?<br/><br/><br/><br/>
8. POST OFFENCE CONDUCT<br/>
What has changed in your life since the offences?<br/><br/><br/>
Subsequent rehabilitation<br/><br/><br/>
How have you shown remorse<br/><br/><br/><br/>
9. REPORTS AND WRITTENCHARACTER REFERENCES<br/>
Who do you think could give you a strong written character reference?<br/><br/><br/>
Have they been prepared?<br/><br/><br/>
Do you want us to forward an outline of what they should contain?<br/><br/><br/>
Can anyone else provide a report that would be useful?<br/><br/><br/><br/>
10. CHARACTER EVIDENCE IN COURT<br/>
Who would you suggest we call as a witness in Court to give evidence about you?<br/><br/><br/><br/>
11.MISCELLANEOUS<br/>
Anything else you want to say about the circumstances of the offending?<br/><br/><br/>
Summarize in a paragraph everything that has happened in your life since the offences and how you now feel about what happened<br/><br/><br/>
What are your plans for the future?<br/><br/><br/><br/>
12. SENTENCING SUBMISSIONS<br/>
Appropriate disposition and why<br/><br/><br/>
List supporting propositions briefly eg early plea, rehabilitation<br/><br/><br/>
Was client on bail for other offences at this time<br/><br/><br/>
Were they breaching CBO or suspended sentence<br/><br/><br/><br/>
IF GAOL<br/>
Totality<br/><br/><br/>
Concurrency and cumulation<br/><br/><br/>
Length between minimum and head sentence.<br/><br/><br/>
What is time served already in custody.<br/><br/><br/>
Sentencing Act considerations; serious offender, continual offender, confiscation issues.<br/><br/><br/>
Instructions on forensic samples, sex offenders registry issues<br/><br/>"
        ),
    
    /*'' => array(
'field17' => ""),*/
);
  
  
  $con = mysql_connect("localhost", "dbcrimla_admin", "fileadmin1234");
  if (!$con) {  
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("dbcrimla_fileadmin", $con);

  // inserting to this table
  $table = 'admin_content';
  $type = 'VARIABLE';
  $count = 0;
  $date_time = date('Y-m-d H:d:s');
    
  foreach ($default_values as $dtsn => $arr) {
    $doc_type_id = null;
    $result = mysql_query("SELECT id FROM document_type WHERE short_name='".$dtsn."'");
    while($row = mysql_fetch_array($result)) {
      $doc_type_id = $row['id'];
      break;
    }
    
    foreach ($arr as $field => $value) {
      $raw_text = str_replace(array("\n", "\r"), "", $value);
      $value_todb =  mysql_real_escape_string(str_replace("<br/>", "\n", $raw_text));
      $elem_id = 'document_'.$field;
      
      if ($doc_type_id) {
        $insert_query = "INSERT INTO ".$table." (code, value, type, document_type_id, created_at, updated_at) VALUES ('".$elem_id."', '".$value_todb."', '".$type."', ".$doc_type_id.", '".$date_time."', '".$date_time."')";
        echo ++$count.": ".$insert_query.'<br/>';
        //mysql_query($insert_query);    
      }
    }
  }
  
}

function LoadAdminContentText2() 
{
  $default_values = array();
  
  $default_values['reflma'] = 'relein';
  $default_values['reshfi'] = 'relein';

  $default_values['baprre'] = 'bafiti';

  // appeal against coviction & sentence
  $default_values['apasno'] = 'apacno';

  // bail app & variation
  $default_values['bavano'] = 'banoti';

  // prison: YTC = gaol = Prison
  $default_values['ytcloc'] = 'reprlo';
  $default_values['rqsgao'] = 'reprlo';

  // barrister section backsheet
  $default_values['aoinai'] = 'appoin';
  $default_values['apopra'] = 'appoin';
  $default_values['appopp'] = 'appoin';
  $default_values['apcdpp'] = 'appoin';
  $default_values['dapopp'] = 'appoin';
  $default_values['cdppro'] = 'appoin';
  $default_values['dacdpp'] = 'appoin';
  $default_values['ofoppr'] = 'appoin';
  $default_values['oinain'] = 'appoin';
  $default_values['otprag'] = 'appoin';
  $default_values['polinf'] = 'appoin';

  // informant section forms
  $default_values['s32coc'] = 's32cma';
  $default_values['s34pso'] = 's34psm';

  // invoices default content
  $default_values['trnmin'] = 'trmoin';
  $default_values['stdinv'] = 'trmoin';

  // all the brief have the same default text
  $default_values['brirq2'] = 'brirq1';
  $default_values['brirq3'] = 'brirq1';
  $default_values['brirq4'] = 'brirq1';

  // agencies
  $default_values['e211fx'] = 'en211e';

  
  $con = mysql_connect("localhost", "dbcrimla_admin", "fileadmin1234");
  if (!$con) {  
    die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("dbcrimla_fileadmin", $con);
  
  $table = 'admin_content';
  $type = 'VARIABLE';
  $valuex = '';
  $count = 0;
  $date_time = date('Y-m-d H:d:s');
  $elem_id = 'document_field17';
  
  foreach ($default_values as $dtsn => $pdtsn) {
    $doc_type_id = null;
    $p_doc_type_id = null;
    $result = mysql_query("SELECT id FROM document_type WHERE short_name='".$dtsn."'");
    while($row = mysql_fetch_array($result)) {
      $doc_type_id = $row['id'];
      break;
    }
    $resultp = mysql_query("SELECT id FROM document_type WHERE short_name='".$pdtsn."'");
    while($row = mysql_fetch_array($resultp)) {
      $p_doc_type_id = $row['id'];
      break;
    }
    
    $format_params = mysql_real_escape_string(json_encode(array('parent' => $p_doc_type_id)));
    if ($doc_type_id && $p_doc_type_id) {
      $insert_query = "INSERT INTO ".$table." (code, value, type, format_params, document_type_id, created_at, updated_at) VALUES ('".$elem_id."', '".$valuex."', '".$type."', '".$format_params."', ".$doc_type_id.", '".$date_time."', '".$date_time."')";
      echo ++$count." (".$dtsn."): ".$insert_query.'<br/>';
      //mysql_query($insert_query);    
    }
  }
  
}


// execute.....
//readPHPFile();

//LoadAdminContentText();

//LoadAdminContentText2();

?>