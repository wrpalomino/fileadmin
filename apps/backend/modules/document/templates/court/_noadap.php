<?php
  $helper->title = "NOTICE TO ADDRESSEE AND APPLICATION";
  
  $helper->top_header_section = "<div style='float:right'>Court Ref: ".$form['field13']->renderRow()."</div>";
  
  $helper->header_section = "<div style='position:relative'>
    <b>BETWEEN:</b>".
    "<p>".$form['field10']->renderRow()."</p>-and-.<p>".$form['field4']->renderRow()."</p>
    <div style='position:absolute;left:500px;top:22px'>Informant<br/><br/><br/><br/>Defendant</div>
    </div>";
  
  $helper->low_content_text = '';
  
  $helper->declaration_text = '<p>To:&nbsp;'.$form['field14']->renderRow().'</p>
    <p>Of:&nbsp;&nbsp;'.$form['field15']->renderRow().'</p>
    <p>You may produce copies of any subpoenaed documents, unless the subpoena specifically requires 
    you to produce originals. A copy of a document may be –<br/>
    (a) a photocopy; or<br/>
    (b) in PDF format on a CD-Rom.</p>
    <p>You must complete the declaration below, attach it to the subpoena or a copy of the subpoena and
    return them with the documents or things you provide to the Court under the subpoena. If you declare 
    that the material you produce is copies of documents, the Prothonotary may, without furthernotice to 
    you, destroy the copies after the expiry of a period of four months from the conclusion of the proceeding 
    or, if the documents become exhibits in the proceeding, when they are no longer required in connection 
    with the proceeding, including on any appeal. If the material you produce to the Court is or includes 
    any original document, the Court will return all of the material to you at the address specified by you 
    in the Declaration below.</p>
    <p class="subtitle">DECLARATION BY ADDRESSEE (SUBPOENA RECIPIENT)</p>
    [Tick the relevant option below, provide your address as appropriate, sign and date]'
    .$form['field16']->renderRow();
 
  $helper->footer_section = '<p>
    Date: '.$form->getDocumentDate("d F Y", 'span', true, false).'
    <br/><br/><br/>Signature of Addressee: ___________________________________________
    <br/><br/><br/>Name of Addressee:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ___________________________________________
    </p>';
?>
<?php echo $helper->get_partial_subfolder('affswo', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>