<?php use_helper('I18N', 'Date') ?>
<?php include_partial('document/assets') ?>

<?php include_partial('document/email_form', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper));?>
