<div class="doc_container" id="doc_container">
  <!--<div class="doc_header"></div>
  <div class="doc_logo">
    < ?php echo image_tag($helper->logo, array('alt' => 'Logo', 'title' => 'Logo', 'class' => 'logo_img')); ?>
  </div>-->
  <div class="doc_section">
    <p><div align="center"><h2 class="larger_font">Memorandum to Barrister</h2></div></p>
    <?php echo $form['field17']->renderRow()?>
    <p>
      <?php echo $form['field9']->renderRow()?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php $form->getDocumentDate()?>
    </p>
  </div>
  <div class="doc_footer"></div>
</div>