<script type="text/javascript">
  $(window).load(function() 
  {
    var resend = false;
    <?php 
      //if ($sf_user->getRawAttribute('client', null, true) != ''): 
      if ($sf_user->getAttribute('main_filter0', null) === null):
    ?>
        displayDataMainFilter($.toJSON(<?php echo htmlspecialchars_decode($sf_user->getRawAttribute('client', null, true), ENT_QUOTES)?>));
        if ($('#client_up_form_filters_number').val() != '')  resend = true;
    <?php endif; ?>
    
    // load cloned file data
    var new_file_number = $.urlParam('new_file_number');
    if (new_file_number) {
      $('#client_up_form_filters_number').val(new_file_number);
      resend = true;
    }
    
    /*var resend = '< ?php echo $resend; ?>';*/
    //if (resend != '') {
    if (resend) {
      
      $.loadingPopUp();
      
      //alert("resend");
      $('#client_filter').append("<input type='hidden' name='resend' value='resend' />");
      // resend only the file number, delete all other values, search must be based only on file number
      $(':input','#client_filter')
      .not(':button, :submit, :reset, :hidden, #client_up_form_filters_number')
      .val('');
      
      $("#mf_filter").click();
      
      
      
    }
    
    $('#client_up_form_filters_date').val(reformatDate('dd-mm-yy', $('#client_up_form_filters_date').val()));
    $('#client_up_form_filters_date').mask("99-99-9999");
    $('#client_up_form_filters_date').attr('title', "Enter date format: 09-09-2012");
  });
</script>

<form action="<?php echo url_for($current_url) ?>" method="post" id="client_filter">
<div class="clientFilterForm">
  <?php echo $form->render(); ?>
</div>
<div class="clientFilterButtons">
  <input type="hidden" id="filtered" name="filtered" value="1" />
  <input type="hidden" id="page0" name="page0" value="" />
  <br/><br/>&nbsp;&nbsp;<input type="submit" id="mf_filter" name="mf_filter" value=" Filter " />
  <br/><br/>&nbsp;&nbsp;<input type="submit" id="mf_reset" name="mf_reset" value=" Reset " />
</div>
<div class="clear"></div>
</form>

<?php if (sfContext::getInstance()->getUser()->getAttribute('main_filter0' , null)): ?>
  <table id="mainFilterPagination">
  <tr>
    <td <?php if ($pager->getNbResults() > 0): ?>class="notice"<?php else: ?>class="info"<?php endif; ?>>    
      <?php // added by William, 02/03/2013: show pagination or not ?>
      <?php $pagination = isset($helper->pagination) ? $helper->pagination : $pager->haveToPaginate() ?>
      <?php if ($pagination): ?>
        <?php include_partial('clientFilter/pagination', array('pager' => $pager)) ?>
      <?php endif; ?>
      <?php echo format_number_choice('[0] no file found|[1] 1 file found|(1,+Inf] %1% files found', array('%1%' => $pager->getNbResults()), $pager->getNbResults(), 'sf_admin') ?>
      <?php if ($pagination): ?>
        <?php echo __('(page %%page%%/%%nb_pages%%)  .', array('%%page%%' => $pager->getPage(), '%%nb_pages%%' => $pager->getLastPage()), 'sf_admin') ?>
      <?php endif; ?>
    </td>
    <td class="fileStatus">
      <?php if ($sf_user->hasFlash('file_status')): ?>
        <div class="info"><?php echo __($sf_user->getFlash('file_status'), array(), 'sf_admin') ?></div>
      <?php endif; ?>
    </td>
  </tr>
  </table>
<?php endif; ?>