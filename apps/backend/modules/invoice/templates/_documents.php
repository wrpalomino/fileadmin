<?php 
  $invoice_id = $invoice->getId();
  $invoice_type_id = $invoice->getTypeId();
  switch ($invoice_type_id) {
    case 1: $doc = "stdinv"; break;
    case 2: $doc = "nstinv"; break;
    case 3: $doc = "trmoin"; break;
    case 4: $doc = "trnmin"; break;
    default: $doc = "trmoin"; break;
  }
?>
<ul style="width:120px">
  <li><a href="#" onclick="openBox('document/new?doc=<?php echo $doc?>&invoice_id=<?php echo $invoice_id?>')"><?php echo $invoice->getInvoiceType()->getValue()?></a></li>
</ul>