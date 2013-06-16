<?php
  $helper->professional_fees = "<h3>3. <span class='underline'>Professional fees</span></h3>
  Costs will be calculated at the higher rate of the enclosed schedule or an hourly fee inclusive of 
  GST $ ".$form['field10']->renderRow().", with GST of $ ".$form['field16']->renderRow().". This will 
  be subject to the type of work undertaken and who it is performed by.<br/>
  Appearances at Court will incur a fee commensurate with the experience of the practitioner appearing 
  on your behalf unless specifically detailed as under paragraph 4. It is difficult to provide you with 
  an accurate estimate of the total of these costs. Professional costs will vary according to a number 
  of contingencies, including unexpected problems, the co-operation of other persons and other delays 
  beyond our control. Additional charges may also be incurred having proper regard to the complexity of 
  your matter, the difficulty, novelty or importance of any issue raised by your matter, the urgency with 
  which your matter must be dealt with, or extended availability of ourselves and staff to deal with your 
  matter.";
  
  $helper->disbursements = "<h3>4. <span class='underline'>Disbursements</span></h3>
  In addition to our professional fees, you will be required to pay for expenses we incur on your behalf 
  as your agent. These may include the costs of medical reports, interpreters fees or issuing and service 
  fees.<br/>
  If we need to engage an expert or consultant on your behalf you will also have to pay for these costs. 
  We will confirm these fees with you before we engage those services. If Court appearances are necessary 
  daily fees will be charged by the Lawyer/Counsel appearing on your behalf and also a daily fee for 
  provision of an instructor employed by our firm to assist him or her at Court<br/><br/>
  Counsel/Lawyers daily fees will be: $ ".$form['field12']->renderRow()."<br/>
  Instructors daily fees will be: $ ".$form['field13']->renderRow()."<br/>
  If those daily fees are not nominated in this agreement then they will remain to be agreed upon at a 
  later date and the fees until that further agreement will be commensurate with the practitioner 
  appearing on your behalf.";

?>

<?php echo $helper->get_partial_subfolder('falsod', 'fee', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>