<?php
  // added by William, 14/03/2013: to create cache files needed for this template
  $module_path = 'autoFile'.DIRECTORY_SEPARATOR.'actions'.DIRECTORY_SEPARATOR.'actions.class.php';
  $file_path = sfConfig::get('sf_cache_dir').DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'dev'.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$module_path;
  
  if (!file_exists($file_path)) {
    //$uris =  array($sf_request->getUriPrefix().url_for('file/index'));  // problem of permission denied
    $uris =  array('file/index');
    $b = new sfBrowser();
    foreach ($uris as $uri) $b->get($uri);
    
    $page = $_SERVER['PHP_SELF'];
    $sec = "0";
    header("Refresh: $sec; url=$page");
  }
?>

<fieldset id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
  <?php if ( ('NONE' != $fieldset) && ($num_tabs == 0) ): ?>
    <h2><?php echo __($fieldset, array(), 'messages') ?></h2>
  <?php endif; ?>

  <?php $num_fields = 0?>  
  <?php foreach ($fields as $name => $field): ?>
    <?php $num_fields++?>
  <?php endforeach; ?>
    
  <?php 
    $counter = 0;
    $num_cols = 1;
  ?>
  <table>
  <tr>  
  <?php foreach ($fields as $name => $field): ?>
    <?php $counter++?>
    <?php if ( ($counter == 1) || ($counter == (int)($num_fields/$num_cols)+1) ) echo '<td>' ?>
    <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
        
    <?php include_partial('file/form_field', array(
      'name'       => $name,
      'attributes' => $field->getConfig('attributes', array()),
      'label'      => $field->getConfig('label'),
      'help'       => $field->getConfig('help'),
      'form'       => $form,
      'field'      => $field,
      'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_form_field_'.$name,
    )) ?>
    <?php if ( ($counter == $num_fields) || ($counter == (int)($num_fields/$num_cols)) ) echo '</td>' ?>
    
  <?php endforeach; ?>
 </tr>   
 </table>
    
</fieldset>
