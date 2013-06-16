<?php
  $helper->title = "SUBPOENA";
  
  $helper->top_header_section = "<div style='float:right'>Court Ref: ".$form['field13']->renderRow()."</div>";
  
  $helper->header_section = "<div style='position:relative'>
    <b>BETWEEN:</b>".
    "<p>".$form['field10']->renderRow()."</p>-and-<p>".$form['field4']->renderRow()."</p>
    <div style='position:absolute;left:500px;top:22px'>Informant<br/><br/><br/><br/>Accused</div>
    </div>";
  
  $helper->declaration_text = '<p>To:&nbsp;'.$form['field14']->renderRow().'</p>
    <p>Of:&nbsp;&nbsp;'.$form['field15']->renderRow().'</p>
    <p>YOU ARE ORDERED<br/>'.$form['field16']->renderRow().'<i>*select one only of these three options</i></p>
    <p class="subtitle">Failure to comply with this subpoena without lawful excuse is a contempt of court and 
    may result in your arrest.</p>
    <p>The last date for service of this subpoena is: ______________________</p>
    <p>(See note 1)</p>
    <p class="subtitle">Please read Notes 1 to 13 at the end of this subpoena</p><br/><br/>';
  
  $helper->low_content_text = '<div style="float:left">Date: '.$form->getDocumentDate("d F Y", 'span', true, false).'</div>
    <div style="float:right;font-style:italic">[Seal of the Court]</div>
    <div class="clear"></div><br/>
    <table class="fax">
    <tr><td class="third">Issued at the request of :</td><td>'.$form['field4']->renderRow().'</td></tr>
    <tr><td>Whose address for service is: </td><td>'.$form['field8']->renderRow().'</td></tr>
    </table><br/><br/>';
  
  $helper->footer_section = '<p class="subtitle">A. Details of subpoena to attend to give evidence only</p>
    <p>Date time and place at which you must attend to give evidence:</p>
    Date:  ____________________<br/>
    Time:  ____________________<br/>
    Place: ____________________
    <p>You must continue to attend from day to day unless excused by the Court or the person authorised to 
    take evidence in this proceeding or until the hearing of the matter is completed.</p>
    <p>Alternatively, if notice of a later date is given to you by a member of the police or the Solicitor 
    for Public Prosecutions, you must attend on that day until you are excused from further attending.</p>
    
    <br/><p class="subtitle">B. Details of subpoena to produce only</p>
    <p>You must comply with this subpoena:</p>
    <p>(a) by attending to produce this subpoena or a copy of it and the documents or things specified in 
    the Schedule below at the date, time and place specified for attendance and production; or</p>
    <p>(b) by delivering or sending this subpoena or a copy of it and the documents or things specified in 
    the Schedule below to the Registrar at the address below so that they are received not less than three 
    days before the day specified for attendance and production (see Notes 5 to 9)</p>
    <p>Alternatively, if notice of a later date is given to you by a member of the police or the Solicitor 
    for Public Prosecutions, you must attend and produce the subpoena, or a copy of it, on that day until 
    you are excused from further attending.</p>
    <p>Date, time and place at which to attend to produce the subpoena or a copy of it and the documents or 
    things:</p>
    Date:  ____________________<br/>
    Time:  ____________________<br/>
    Place: ____________________
    <p>Address to which the subpoena (or copy) and documents or things may be delivered or sent:</p>
    <p>The Registrar<br/>'.$form['field5']->renderRow().'</p>
    <p class="centered subtitle">SCHEDULE</p>
    <p>The documents you must produce are as follows:</p>
    <p><i>[if insufficient space attach list]</i></p>
    <br/><br/><br/><br/><br/><br/>
    
    <br/><p class="subtitle">C. Details of subpoena both to attend to give evidence and to produce</p>
    <p>In so far as you are required by the subpoena to attend to give evidence, you must attend as 
    follows;</p>
    Date:  ____________________<br/>
    Time:  ____________________<br/>
    Place: ____________________
    <p>You must continue to attend from day to day unless excused by the Court or the person authorised 
    to take evidence in this proceeding or until the hearing of the matter is completed.</p>
    <p>Alternatively. if notice of a later day is given to you by the issuing party or that party’s 
    solicitor, you must attend on that day until you are excused from further attending.</p>
    <p>In so far as you are required by this subpoena to produce the subpoena or a copy of it and documents 
    or things you comply with this subpoena:</p>
    <p>(a) by attending to produce this subpoena or a copy of it and the documents or things specified in 
    the Schedule below at the date, time and place specified for attendance and production; or</p>
    <p>(b) by delivering or sending this subpoena or a copy of it and the documents or things specified in 
    the Schedule below to the Registrar at the address below so that they are received not less than three 
    days before the day specified for attendance and production (see Notes 5 to 9)</p>
    <p>Alternatively, if notice of a later date is given to you by a member of the police or the Solicitor 
    for Public Prosecutions, you must attend and produce the subpoena, or a copy of it, on that day until 
    you are excused from further attending.</p>
    <p>Date, time and place at which to attend to produce the subpoena or a copy of it and the documents or 
    things:</p>
    Date:  ____________________<br/>
    Time:  ____________________<br/>
    Place: ____________________
    <p>Address to which the subpoena(or copy) and documents or things may be delivered or sent:</p>
    <p>The Registrar<br/>'.$form['field5']->renderRow().'</p>
    <p class="centered subtitle">SCHEDULE</p>
    <p>The documents you must produce are as follows:</p>
    <p><i>[if insufficient space attach list]</i></p>
    <br/><br/><br/><br/><br/><br/>
    
    <p class="centered subtitle final_greetings">NOTES</p>
    <p class="subtitle">Last day for service</p>
    <p>1. Subject to Note 2, you need not comply with the subpoena unless it is served on you on or before 
    the day specified in the subpoena as the last day for service of the subpoena.</p>
    <p>2. Even if this subpoena has not been served personally on you, you must, nevertheless, comply with 
    its requirements, if you have, by the last day for service of the subpoena, actual knowledge of the 
    subpoena and of its requirements.</p>
    
    <br/><p class="subtitle">Addressee a corporation</p>
    <p>3. If the subpoena is addressed to a corporation, the corporation must comply with the subpoena by 
    its appropriate or proper officer.</p>
    
    <br/><p class="subtitle">Conduct money</p>
    <p>4. You need not comply with the subpoena in so far as it requires you to attend to give evidence 
    unless conduct money sufficient to meet your reasonable expenses of attending as required by the subpoena 
    is handed or tendered to you a reasonable time before the day on which your attendance is required.</p>
    
    <br/><p class="subtitle">Production to the the Registrar</p>
    <p>5. In so far as this subpoena requires production of the subpoena or a copy of it and a document or 
    thing, instead of attending to produce the subpoena or a copy of it and the document or thing, you may 
    comply with the subpoena by delivering or sending the subpoena or a copy of it and the document or thing 
    to the Registrar at the address specified in the subpoena for the purpose so that they are received not 
    less than three days before the day specified in the subpoena for attendance and production.</p>
    <p>6. If you object to a document or thing produced in response to this subpoena being inspected by any 
    party to the proceeding or any other person, you must, at the time of production, notify the Registrar 
    in writing of your objection and of the grounds of your objection.</p>
    <p>7. Unless the Court otherwise orders, if you do not object to a document or thing produced by you in 
    response to the subpoena being inspected by any party to the proceeding, the Registrar may the parties to 
    the proceeding to inspect the document or thing.</p>
    <p>8. If you produce more than one document or thing, you must, if requested by the Registrar, produce a 
    list of the documents or things produced.</p>
    <p>9. You may with the consent of the issuing party, produce a copy, instead of the original, of any 
    document that the subpoena requires you to produce.</p>
    
    <br/><p class="subtitle">Applications in relation to subpoena</p>
    <p>10. You have the right to apply to the Court-</p>
    <p>(a) for an order setting aside the subpoena (or part of it) and for relief in respect of the subpoena; 
    and</p>
    <p>(b) for an order with respect to your claim for privilege, public interest immunity or confidentiality 
    in relation to any document or thing the subject of the subpoena.</p>
    
    <br/><p class="subtitle">Loss or expense of compliance</p>
    <p>11. If you are not a party to a proceeding, you may apply to the Court for an order that the issuing 
    party pay an amount (in addition to conduct money and any witness’s expenses) in respect of the loss or 
    expense, including legal costs reasonably incurred in complying with the subpoena.</p>
    
    <br/><p class="subtitle">Contempt of court - arrest</p>
    <p>12. Failure to comply with a subpoena without lawful excuse is a contempt of court and may be dealt 
    with accordingly.</p>
    <p>13. Note 12 is without prejudice to any power of the Court under any Rules of the County Court 
    (including any Rules of the County Court providing for the arrest of an addressee who defaults in 
    attendance in accordance with a subpoena) or otherwise, to enforce compliance with a subpoena.</p>';
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>