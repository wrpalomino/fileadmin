<script>
$().ready(function() {  
  //$('#user_file_client_id').change(function(){
    //changeHref();  
  //});
  changeHref();
});


function loadClientDetails()
{
  //alert("Handler for .click() called.");
  var action_urlx = '<?php echo url_for('file/loadClientDetails')?>';
  var client_idx = $('#user_file_client_id').val();
  $.post(action_urlx, {client_id: client_idx}, function (data) {
    if (data == 'none')  alert('please select a client!');
    else {
      $.each(data, function(i, item) {
        if ($('#'+i).length) {
          if (item === false) {
            $('#'+i).removeAttr("checked");
          }
          else $('#'+i).val(item);
        }
      });
    }
  }, "json");
}
</script>

<?php $action = sfcontext::getInstance()->getActionName(); ?>
<div style="float:right">
  <?php echo link_to("Load Client's Details", 'file/'.$action.'?user_id=0', array("id" => "client_load", "onclick" => "loadClientDetails(); return false")) ?>
</div>