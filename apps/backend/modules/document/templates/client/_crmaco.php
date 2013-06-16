<?php
  $helper->preface_text = "We have been told that you are willing to write a character reference for 
    our client.<br/><br/>
    Your reference <span class='important'>must</span><br/>
    <ol>
      <li>Be addressed 'To the Sentencing Magistrate'.</li>
      <li>Be signed and dated.</li>
      <li>Show that you know what the Defendant has been charged with.<br/>example: 'I know John 
        has been charged for drink driving'</li>
    </ol>
    You can also include the following;
    <ol>
      <li>How long you have known the person.</li>
      <li>How you came to meet them.</li>
      <li>Your opinion of their personality.</li>
      <li>Any positive things you can say about their behaviour, activities etc.</li>
      <li>Anything else you think is relevant.</li>
    </ol>
    There is some much more detailed advice about writing character references on the following pages.<br/>
    Please contact us if you have any questions about the content of the character reference that you 
    are writing.";
?>
<?php echo $helper->get_partial_subfolder('crgunc', 'client', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>