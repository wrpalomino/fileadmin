<?php   
  if (!isset($helper->cd_payment_field))  $helper->cd_payment_field = "$ ".$form['field6']->renderRow();
  if (!isset($helper->cd_div_style))      $helper->cd_div_style= "style='border:1px solid; width:96%; padding:1%'";
  
  $helper->title = "TAX INVOICE";
  
  $helper->bank_bsb_branch = "<li>BSB (Branch)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>".
          sfConfig::get("app_appowner_bankbsbbranch")."</b></li>";
  
  $helper->payment_fields = "
    GST ".$form['field12']->renderRow()."<br/>
    Total Bill $ ".$form['field9']->renderRow()."<br/>
    Amount received $ ".$form['field10']->renderRow()."<br/>
    <b>Balance due & payable</b> $ ".$form['field11']->renderRow();
?>
<?php echo $helper->get_partial_subfolder('trmoin', 'fee', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>