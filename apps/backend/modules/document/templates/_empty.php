<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php //include('common/document_style.php'); ?>

<div class="sf_admin_form">
  <div class="doc_container" id="doc_container">
    <div class="doc_header">
      <p class="warning">NO TEMPLATE FOR THIS DOCUMENT TYPE</p>
    </div>
    <div class="doc_logo">
      <?php echo image_tag($helper->logo, array('alt' => 'Logo', 'title' => 'Logo', 'class' => 'logo_img')); ?>
    </div>
    <div class="doc_section">
      <textarea name="address" class="doc_field" rows="30" style="width:100%"></textarea>
    </div>
    <div class="doc_footer"></div>
  </div>
</div>