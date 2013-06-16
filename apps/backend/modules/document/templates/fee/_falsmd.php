<?php
  $helper->professional_fees = "<h3>3. <span class='underline'>Professional fees</span></h3>
  We will charge you a lump sum fee of $ ".$form['field12']->renderRow()."<br/>
  You will also have to pay GST of $ ".$form['field13']->renderRow()."<br/>".$form['field17']->renderRow();
  
  /*This amount includes your representation at Court and is calculated on the matter resolving and requiring 
  only one appearance.<br/>
  If there are any subsequent days of appearance the charge will be $ ".$form['field10']->renderRow()." 
  + GST of $ ".$form['field16']->renderRow()." per day";*/

?>

<?php echo $helper->get_partial_subfolder('falsod', 'fee', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>