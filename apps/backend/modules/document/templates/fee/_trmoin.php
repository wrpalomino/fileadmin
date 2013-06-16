<?php
  if (!isset($helper->cd_payment_field))  $helper->cd_payment_field = "";
  if (!isset($helper->cd_div_style))    $helper->cd_div_style= "style='width:96%; padding:1%'";
  
  if (!isset($helper->title))           $helper->title = "TRUST INVOICE";
  if (!isset($helper->abn))             $helper->abn = sfConfig::get("app_appowner_abn");
  if (!isset($helper->ref_number))      $helper->ref_number = "";
  if (!isset($helper->bank_acc_name))   $helper->bank_acc_name = sfConfig::get("app_appowner_bankaccountname");
  if (!isset($helper->bank_bsb_branch)) $helper->bank_bsb_branch = "";
  
  if (!isset($helper->payment_fields)) $helper->payment_fields = "
    Total Fees $ ".$form['field9']->renderRow()."<br/>
    Amount to pay from trust $ ".$form['field10']->renderRow()."<br/>
    <span class='important'>Balance due and payable</span> $ ".$form['field11']->renderRow()."<br/>
    Amount remaining in trust $ ".$form['field12']->renderRow();
  
  if (!isset($helper->post_text)) 
    $helper->post_text = "<div style='border:1px solid; width:96%; padding:1%'>
      <b>TERMS STRICTLY 14 DAYS NET</b><br/>
      Payment is due upon your receipt of this account. Interest may be charged under Section 88 of 
      the Supreme Court Act on any amount not paid after one month</div>
      Bank details for electronic transfer:
      <ul style='font-wight:bold'>
        <li>Bank Account:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".$helper->bank_acc_name."</b></li>
        ".$helper->bank_bsb_branch."
        <li>Account Number: ".$form['field3']->renderRow()."</li>
      </ul>
      Please include your reference number <b>(".$helper->ref_number.")</b> then phone us to confirm the payment.";
?>

<div class="doc_container" id="doc_container">
  <div class="doc_header">
    Reference: <?php echo $form['field1']->renderRow() ?><br/>
  </div>
  <div class="doc_logo">
    <?php echo image_tag($helper->logo, array('alt' => 'Logo', 'title' => 'Logo', 'class' => 'logo_img')); ?>
  </div>
  <div class="doc_section">
    <div style="border: 1px solid; float: left; width: 60%; padding: 1%; height: 105px">
      <?php echo $form['field4']->renderRow() ?><br/>
      <?php echo $form['field5']->renderRow() ?>
    </div>
    <div style="border: 1px solid; float: left; width: 34%; text-align: center; padding: 1%; height: 105px">
      <div class="larger_font"><?php echo $helper->title?></div>
      &nbsp;&nbsp;#&nbsp;<?php echo $form['field2']->renderRow() ?><br/>
      <p><?php $form->getDocumentDate()?></p>
      <b><?php echo $helper->abn?></b>
    </div>
    <div style="height:15px; clear: both"></div>
    
    <div style="border:1px solid; width:96%; padding:1%; height:24px">
      <div style="float:left;"><b>&nbsp;&nbsp;Description</b></div>
      <div style="float:right; text-align:center"><b>Amount&nbsp;&nbsp;&nbsp;</b></div>
    </div>
    <div <?php echo $helper->cd_div_style ?>>
      <div style="float:left;">
        <p>
          <?php echo $form['field7']->renderRow() ?>
          <?php echo $form['field8']->renderRow() ?>
        </p>
        <?php echo $form['field17']->renderRow() ?><br/>
      </div>
      <div style="float:right; text-align:center"><br/><br/><br/><?php echo $helper->cd_payment_field ?></div>
    </div>
    
  </div>
  
  <div class="doc_section">
    <div style="border: 1px solid; width: 96%; text-align: right; padding: 1%">
      <?php echo  $helper->payment_fields?>
    </div>
    <?php echo $helper->post_text?>      
  </div>
  
  <div class="doc_footer">
    <br/>
    <p>
    If you have any concerns about our fees, services or this invoice please raise them with us. In the event that we can not resolve the enquiry to your
    satisfaction then you may take any of the following actions;
    *Seek a costs review by the Taxing Master under Division 7 of Part 3.4 of the Legal Profession Act 2004 ("the Act") within 60 days after the bill is given to
    you or the law practice requests payment of costs or you pay the costs (whichever is earlier or earliest).
    *You may seek a costs review outside the 60 day time limit. The Taxing Master will not deal with the review if we can establish that to do so would cause
    unfair prejudice to us;
    *Apply to VCAT to set aside this agreement under section 3.4.32 of the Act; or
    *Make a complaint to the Legal Services Commissioner under chapter 4 of the Act within 60 days after the legal costs were payable or, if an itemised bill
    was requested in respect of those costs, within 30 days after the request was complied with.
    *You may be able to make a complaint to the Legal Services Commissioner up to 4 months after the end of the period referred to. This is provided that you
    can satisfy the Commissioner that there was a reasonable cause for the delay in making the complaint, and legal proceedings have not been
    commenced for the recovery or review of the legal costs that are the subject of the complaint
    </p>
  </div>
</div>