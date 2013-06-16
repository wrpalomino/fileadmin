<?php
 $helper->title = "AFFIDAVIT/DECLARATION OF SERVICE";

 $helper->aff_text = ""; 
 $helper->sworn_text = "SWORN/ DECLARED";
 $helper->sign_text = "[name, address and title of person taking affidavit who is duly authorised under 
   Section 123c of the Evidence Act 1958 or under section 107A of the Evidence Act if witnessing a Statutory 
   declaration ]";
 $helper->declaration_text = "<br/>
 I (full name) ..........................................................................<br/>
 Of (address)............................................................................
 <ul class='compact'>
 <li>make oath and say/declare that I served a copy of the (document)......................</li>
 <li>on (name of person served)............................................................</li>
 </ul>
 By:
 <ul class='compact nested'>
 <li>leaving it with *him/her personally at (address)......................................</li>
 <li>delivering it to his/her place of residence to (name).................................<br/>
 a person apparently above the age of 16 years and residing there<br/>
 at (address)..............................................................................</li>
 <li>delivering it to his/her place of business at (address) ..............................<br/>
 to (name)............................................................. a person apparently above the 
 age of 16 years and apparently in charge of that business or employed in the office of that business</li>
 <li>posting it by prepaid ordinary post at (address)......................................<br/>
 in an envelope address to *him/her at *his/her address for service<br/>
 at (address)..............................................................................</li>
 <li>leaving it at *sending it by post to the registered office of the corporation<br/>
 at (address)..............................................................................<br/>
 on (day of the week) ................. the.......... day of ........................ 20...<br/>
 at .................. a.m./p.m.</li>
 </ul>";
 
 $helper->low_content_text = "<p>".$helper->sworn_text." at _________________________<br/>
 In the State of Victoria on .../.../20... ".str_repeat("&nbsp;", 28)."_______________________________<br/>
 ".str_repeat("&nbsp;", 86)."Signature of person making affidavit</p>";
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>