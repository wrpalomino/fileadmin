<?php
  $helper->show_head_fields = false;
  
  $helper->post_text = "
    <p class='important'>Please fill in the fees details on the Courts/Results/Solicitor tab screen.</p>
    Solicitor with carriage is to fill in the fee details on the Solicitor tab regardless of who did 
    the appearance.
    <p class='subtitle'>VLA FUNDED MATTER</p>
    Then you will need to click on the following boxes;<br/>
    VLA - ".$form['field11']->renderRow()."<br/>
    Paid - ".$form['field12']->renderRow()."<br/>
    Needs invoicing - ".$form['field13']->renderRow()."<br/><br/>
    This then puts the matter in the “Find files needing invoicing” report for the support staff to 
    invoice appropriately.<br/>
    You will also need to fill in the “Date filled out” box.
    <p class='subtitle'>PRIVATELY FUNDED MATTER</p>
    Solicitor with carriage is to fill in the fee details on the Solicitor tab regardless of who did 
    the appearance.<br/>
    <ol id='lower-alpha'>
    <li>fill in the “Total Amount” field at the top (this is the full amount that is going to be invoiced 
    including disbursements, counsel fees etc)</li>
    <li>fill in the barrister fee (if applicable)</li>
    <li>fill in if any disbursements</li>
    <li>fill in the preparation fee</li>
    <li>fill in the appearance fee</li>
    <li>fill in “No” to VLA?</li>
    <li>fill in “yes or no” to PAID?</li>
    <li>fill in “yes or no” to needs invoicing?</li>
    </ol>
    <b>(b - h must add up to the “Total Amount”)</b><br/><br/>
    
    <p class='important'>Files where money is in trust</p>
    If it is a trust matter then there is money is sitting in the trust account so the answer to Paid 
    is “No” (this will be changed to “Yes” when we can actually remove the money from trust into the 
    office account). You will still need to mark the Needs Invoicing as “Yes” so that the matter is 
    added to the “files to be invoiced” report.<br/><br/>
    
    <p class='important'><i>Support staff responsibility</i></p>
    The support staff need to check the needing invoices function regularly (Fees/Files needing 
    invoicing button).<br/>
    They will then go t go through and fill in the Invoiced, Received and Paid tabs accordingly and 
    mark the Needs Invoicing tab as Invoiced so it drops off the list.";
?>
<?php echo $helper->get_partial_subfolder('adlefm', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>