<?php
  $helper->title = 'STATE GUILTY WORKSHEET';
  
  $helper->content_text = 'Before recommending that assistance be granted for a guilty plea, 
  practitioners MUST form the view that conviction is <span class="underline">likely to 
  result in</span>:
  <ol id="lower-roman" class="compact">
  <li>Imprisonment or</li>
  <li>ICO, or</li>
  <li>Suspended sentence or</li>
  <li>CBO with conviction requiring more than 200 hours of unpaid community work</li>
  <li>
    CBO with conviction but client is a special needs client: In serious or cmplex matters where the 
    defendant will have difficulty communicating his or her needs in respect of the rehabilitative aspects 
    of the order to the Court by reason of <span class="underline">psychiatric or intellectual disability
    </span> lack of education or difficulties in understanding the English language.
    <ol id="lower-alpha">
    <li>Outside scope of normal Duty Lawyer Services and</li>
    <li>Eligible person under Intellectually Disabled Persons Act, or receiving services from Approved 
    Mental Health Service</li>
    </ol>
  </li>
  </ol>
  <p>Full details of the charges, '.$form['field4']->renderRow().'&nbsp;or REFER TO CHARGE SHEETS<br/>'.
  $form['field17']->renderRow().'</p>
  <p>Full details of prior convictions, '.$form['field5']->renderRow().'&nbsp;or REFER TO FILE COPY OF PRIORS<br/>'.
  $form['field18']->renderRow().'</p>
  <p>'.$form['field6']->renderRow().'</p>
  </p>VLA anticipates that, save where the offences are extremely serious or mumerous, an applicant 
  <span class="underline">with no prior convictions will not ordinarily qualify for assistance</span> 
  under this guideline. VLA anticipates that matters <span class="underline">involving a breach of a 
  previous Court order</span> (except where the order involved is a lower level CBO and the breach is 
  constituted by non compliance) <span class="underline">will ordinarily qualify under this guideline
  </span></p>
  <p>OTHER'.$form['field19']->renderRow().'</p>';
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>