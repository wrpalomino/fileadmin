<?php use_helper('I18N', 'Date') ?>
<?php include_partial(sfContext::getInstance()->getModuleName().'/assets') ?>

<script type="text/javascript">
  $(document).ready(function () {
    $("input[name='send_to']").change(function() { 
      var new_address = $("input[name='send_to']:checked").val();
      $.post('<?php echo url_for('client/correspondence')?>', { caddress: new_address }, function() {})
        //.success(function() { alert("new corresponce address set successfully!"); })
        //.error(function() { alert("error setting new corresponce address!"); });
    });
    
    // execute at the beginning too!
    var new_address = $("input[name='send_to']:checked").val();
    $.post('<?php echo url_for('client/correspondence')?>', { caddress: new_address }, function() {})
  });
</script>

<div id="sf_admin_container">
  <table id="layout2">
  <tr>
    <td>
      <?php include_partial($this->getModuleName().'/section_links', array('section_links' => $section_links, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </td>
    <td align="right">
      <div id="sf_admin_content">
        <?php include_partial($this->getModuleName().'/links', array('links' => $links, 'configuration' => $configuration, 'helper' => $helper)) ?>
      </div>
      <div id="sf_admin_extra_content">
        <?php foreach ($send_to_radios as $send): ?>
          <div class="sf_admin_radio">
            <input type="radio" id="<?php echo $send['value'] ?>" name="send_to" value="<?php echo $send['value'] ?>" <?php if (isset($send['checked'])) echo 'checked="'.$send['checked'].'"'?> /> 
            <label for="<?php echo $send['value'] ?>"><?php echo $send['text'] ?></label>
          </div>
        <?php endforeach; ?>
        <!--<a href="#">Other Address Location</a>-->
      </div>
    </td>
  </tr>  
  </table>
  
  <?php if ($mode == 'browse'): ?>
  <div id="sf_admin_footer">
    <?php include_partial(sfContext::getInstance()->getModuleName().'/common_pager', array('helper' => $helper, 'pager' => $pager, 'edit_pager' => $edit_pager)) ?>
  </div>
  <?php endif; ?>
  
</div>
