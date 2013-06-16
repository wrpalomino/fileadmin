<?php
  $helper->title = '<h3>STATE & COMMONWEALTH COMMITTALS WORKSHEET</h3>';
  
  $DIV_TAB = '<div style="float:left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>';
  
  $helper->content_text = '<p class="subtitle">RELEVANT GUIDELINES</p>
  <p class="subtitle">
    -Guidelines 3.1 - 3.2 Appendix 2C Legal Aid Handbook<br/>
    -Guidelines 2(1) & 2(2) Appendix 2H Legal Aid Handbook<br/>
  </p>
  Committals in excess of 2 days must be forwarded to VLA for assessment
  <p class="important">TYPE OF AID SOUGHT</p>
  '.$DIV_TAB.$form['field4']->renderRow().'
  '.$DIV_TAB.$DIV_TAB.$form['field5']->renderRow().'
  <p class="important">ELIGIBILITY CRITERIA</p>
  '.$DIV_TAB.$form['field6']->renderRow().'
  <p>(i) The charge will be dealt with summarily ** (provide outline of reasons)</p>
  '.$DIV_TAB.$form['field7']->renderRow().'
  <p>(ii) Likely to identify an early plea ** (provide outline of reasons)</p>
  '.$DIV_TAB.$form['field8']->renderRow().'&nbsp;strong likelihood that an early plea will be identified
  <p>(iii) Cross-examination will lead to significant reduction in trial or plea ** (provide outline 
  of reasons)</p>
  '.$DIV_TAB.$form['field9']->renderRow().'
  <p>(iv) The defendant will be discharged at the committal ** (provide outline of reasons)</p>
  '.$DIV_TAB.$form['field10']->renderRow().'&nbsp;The evidence (or lack thereof) points to insufficient weight to 
  support conviction
  <br/><br/><p class="important">LIMITED ASSISTANCE</p>
  <p>'.$DIV_TAB.$form['field11']->renderRow().'&nbsp;A sexual assault case where aid is sought for limited 
  representation **(provide outline of reasons)</p>
  <div>
  <div style="float:left"><b>**BRIEF<br/>OUTLINE OF<br/>REASONS</b></div>
  <div style="float:right;width:82%">'.$form['field17']->renderRow().'</div>
  <div class="clear"></div><br/>
  </div>';
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>