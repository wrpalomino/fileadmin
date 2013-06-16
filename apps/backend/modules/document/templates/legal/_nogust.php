<?php
  $helper->title = 'STATE NOT GUILTY WORKSHEET';
  
  $helper->content_text = 'Before recommending that assistance be granted for a not guilty plea, 
  practitioners MUST form the view that
  <ol class="compact">
    <li>The client has a reasonable prospect of acquittal on the most serious charge,
    <br/>AND</li>
    <li>The <span class="underline">likely</span> penalty if convicted on all or any of the charges 
    would be fines in excess of $750</li>
  </ol>
  <p class="subtitle">1. Whether a reasonable prospect of acquittal:</p>
  <p>Full details of the charges, '.$form['field4']->renderRow().'&nbsp;or REFER TO CHARGE SHEETS<br/>'.
  $form['field17']->renderRow().'</p>
  <p>Client’s instructions<br/>'.$form['field18']->renderRow().'</p>
  <p>Strengths or Weakness of crown case<br/>'.$form['field19']->renderRow().'</p>
  <p>The basis of the Defence & Availability and strength of evidence supporting the defence case
  <br/>'.$form['field20']->renderRow().'</p>
  <p>Weaknesses of the defence case<br/>'.$form['field5']->renderRow().'</p>
  <p class="underline">Admissibility of crown case</p>'.$form['field6']->renderRow().'
  <p class="subtitle">2. Likely Penalty<br.>'.$form['field7']->renderRow();
?>
<?php echo $helper->get_partial_subfolder('appeal', 'legal', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>