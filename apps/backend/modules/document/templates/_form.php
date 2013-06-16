<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<style>
  .imgHover .hover { 
    display: none;
    position: absolute;
    z-index: 2;
  }
  #removeSignature {
    cursor: pointer;
    background: #ffff00;
  }
</style>

<?php 
  //include('common/document_style.php');
  //include('common/document_style_print.php');
  if (!isset($helper->recipient)) $helper->recipient = '';      // the recipient of the email/fax
  
?>

<script type="text/javascript">
  $(window).load(function() 
  {
    // added by William, 05/03/2013: editable block
    /*$('.editable').editable('<?php echo url_for('document/saveInPlace')?>', {
      indicator : 'Saving...',
      tooltip   : 'Click to edit...'
    });*/
    $('.editableArea').editable('<?php echo url_for('document/saveInPlace')?>', {
      /*data: function(value, settings) {
        // Convert <br> to newline.
        var retval = value.replace(/<br[\s\/]?>/gi, '\n');
        return retval;
      },*/
      type      : 'textarea',
      cancel    : 'Cancel',
      submit    : 'OK',
      //indicator : '<img src="img/indicator.gif">'
      tooltip   : 'Click to edit...'
    });
    
    
    // added by William, 01/06/2013: inline edition of textareas
    saveinplace_url = '<?php echo url_for('document/saveInPlace')?>';
    $('.editableTextArea').each(function() {
      var button = $('<button class="etaButton">Update Text for Document Template</button>');
      var ta = $(this);
      button.click(function() {
        if (confirm("You are going to update the text for this document template!")) {
          var idx = ta.attr('id');
          var valuex = ta.val();
          $.post(saveinplace_url, {id: idx, value: valuex, type: 'VARIABLE'}, function(data) {})
          .success(function(data) { alert(data); })
          .error(function(data) { alert(data); });
        }
        return false;
      });
      button.insertAfter(this);
    });
    
    $.dynamicText();
 
    $('#emailButton').click(function() {
      verifyDocumentSaved('email');  // added by william, 17/05/2013: verify if document has been saved
      if (typeof attachment == 'undefined') attachment = '';
      fmt0 = (typeof fmt == 'undefined') ? '' : '?fmt=' + fmt;
      
      email_url = '<?php echo url_for('document/sendEmail')?>' + fmt0;
      $.when($("form input").attr("defaultValue", function() { return this.value; })).done(function () {
        $.when($.printPreview.loadPrintPreview(email_url, 'email', '<?php echo $helper->recipient?>', '<?php echo $helper->email_subject?>', attachment)).done(function () {
          $.fixPrintModalContent();
          //elayout_content = $('#print-modal-content').contents().find('div.pdfContainer').html();
          elayout_content = $('#print-modal-content').contents().find('html').html();
          $('#email-layout').val(elayout_content);
        });    
      });
      return false;
    });
    
    
    $('#faxButton').click(function() {
      verifyDocumentSaved('fax');  // added by william, 17/05/2013: verify if document has been saved
      fax_url = '<?php echo url_for('document/sendFax')?>';
      $.when($("form input").attr("defaultValue", function() { return this.value; })).done(function () {
        $.when($.printPreview.loadPrintPreview(fax_url, 'fax', '<?php echo $helper->fax_recipient?>', '<?php echo $helper->fax_subject?>')).done(function () {
          $.fixPrintModalContent();
          elayout_content = $('#print-modal-content').contents().find('html').html();
          $('#email-layout').val(elayout_content);
        });    
      });
      return false;
    });
    
    $(function() {               
      $('#previewButton').printPreview();     //Initialise print preview plugin

      // Add keybinding (not recommended for production use)
      /*$(document).bind('keydown', function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 80 && !$('#print-modal').length) {
          $.printPreview.loadPrintPreview();
          return false;
        }
      });*/
      return false;
    });
    
    
    // load signature
    if ( ($("#document_field9").length) && ($("#signature").length) ) {
      //$("#document_field9").chosen();
      //$("#document_field9").trigger("liszt:updated"); // force update for selected value, even if this is predefined
      
      $("#document_field9").change(function() {
        var src = '/images/signatures/signature'+$(this).val()+'.png';
        $("#signature").attr('src', src);
      });
      
      var src = '/images/signatures/signature'+$("#document_field9").val()+'.png';
      $("#signature").attr('src', src);
      
      var tooltipmenu = $(document.createElement('div'));
      tooltipmenu.attr("class", "hover"); 
      tooltipmenu.html('<a id="removeSignature">Remove Signature</a>');
      $("#signatureDiv").prepend(tooltipmenu);
      
      $(".imgHover").hover(
        function() {
          $(this).children("img").fadeTo(200, 0.25).end().children(".hover").show();
        }, 
        function() {
          $(this).children("img").fadeTo(200, 1).end().children(".hover").hide();
        }
      );
        
     $("#removeSignature").click(function() {
       if ($(this).text() == "Remove Signature") {
          $("#signature").attr('src', '/images/signatures/default.png');
          $(this).text("Add Signature");
       }
       else {
         $("#signature").attr('src', '/images/signatures/signature'+$("#document_field9").val()+'.png');
         $(this).text("Remove Signature");
       }
       return false;
     });
     
    }
    
    
    $('#documentform :input').each(function() { // save all initial values to check if they are changed
      $(this).data('initialValue', $(this).val()); 
    }); 
    
    <?php if (sfContext::getInstance()->getRequest()->getParameter('fmt')): ?>
      var fmt = '<?php echo sfContext::getInstance()->getRequest()->getParameter('fmt')?>';
      var attachment = '<?php echo $helper->attached_doc_name?>' + '.' + fmt;
      
      //$('#emailButton').click();  // do not show up the email layout automatically
    <?php endif; ?>
     
    <?php if ($helper->doc_exists != ''): // there is something to load ?> 
      if (confirm ("<?php echo $helper->doc_exists?>"))  {
        //alert('loading....');
        <?php if ($helper->doc_load == 'doc'): // load saved document if requested ?> 
          window.location.replace("<?php echo url_for($helper->getUrlForAction('edit'), array('id' => $helper->doc_exists_id))?>");
        <?php else: ?>
          window.location.replace("<?php echo url_for($helper->getUrlForAction('edit'), array('id' => $helper->doc_buffer_id))?>");
        <?php endif; ?>
      }
      else {
        $.when($.loadBuffer()).done(function () {
          verifyDocumentSaved('buffer', <?php echo $helper->doc_buffer_id?>);  // run the auto saving (buffer document)  
        });
      }
    <?php else: ?>
      $.when($.loadBuffer()).done(function () {
        verifyDocumentSaved('buffer', <?php echo $helper->doc_buffer_id?>);  // run the auto saving (buffer document)  
      });
    <?php endif; ?>
    
  });
</script>

<div class="sf_admin_form" id="sf_admin_form_doc">
  <?php echo form_tag_for($form, '@document_document', array('id' => 'documentform')) ?>
  
  <?php //foreach($form->getWidgetSchema()->getPositions() as $widgetName) echo $form[$widgetName]->renderError(); ?>
  
    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>
    
  <div class="pdfContainer">
    <?php echo $helper->get_partial_subfolder($helper->document_tpl_file, $helper->section, array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>
  
    <?php echo $form->renderHiddenFields() ?>
  
    <?php if ($helper->show_buttons): ?>
      <?php echo $helper->get_partial_subfolder('form_buttons', 'common', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    <?php endif; ?>
  
    <?php if ($helper->show_settings): ?>
      <?php echo $helper->get_partial_subfolder('form_settings', 'common', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    <?php endif; ?>
    <?php include('calendarSuccess.php'); ?>
  
    <?php //foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php //include_partial('document/form_fieldset', array('document' => $document, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset, 'num_tabs' => $num_tabs)) ?>
    <?php //endforeach; ?>
    
    <?php //include_partial('document/form_actions', array('document' => $document, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
    <input type="hidden" id="email-layout" name="email-layout" value="">
  </form>
</div>