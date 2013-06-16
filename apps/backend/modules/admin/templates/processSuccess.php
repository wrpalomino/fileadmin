<?php use_helper('I18N', 'Date') ?>
<?php include_partial(sfContext::getInstance()->getModuleName().'/assets') ?>

<style>
  #innerDiv {
    height: 100%;
    width: 95%;
    text-align: center;
    vertical-align: middle;
    border: 1px solid;
    margin: 0 2%;
  }
</style>

<div id="sf_admin_container">
  <br/><br/>
  <div id="innerDiv">
    
<?php
switch ($task) {
  case 'chfinu':  case 'stficl':  case 'stfiro':
    
    if ($found) {
      echo '<form action="'.url_for('admin/changeFileNumber').'" method="POST">';
      echo '<table>';
      echo $form;
      echo '<tr><td colspan="2"><input type="submit" name="change_number" id="change_number" value=" Update " /></td></tr>';
      echo '</table>';
      echo '</form>';
    }
    
    break;
  default:
}
?>
    
 </div>
</div>
