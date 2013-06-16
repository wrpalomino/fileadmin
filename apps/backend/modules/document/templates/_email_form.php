<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php 
  $preview = true;
  include('common/document_style.php'); 
?>

<script type="text/javascript">
  $(window).load(function() 
  {
    $.dynamicText();
    $('input[type="text"], textarea').attr('readonly','readonly');
  });
</script>

<div class="sf_admin_form" id="sf_admin_form_doc">  
  <?php echo $helper->get_partial_subfolder($helper->document_tpl_file, $helper->section, array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
</div>