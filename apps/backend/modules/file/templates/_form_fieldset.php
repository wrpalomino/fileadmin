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
    $num_cols = (($fieldset == 'Court Dates') || ($fieldset == 'Charges') || ($fieldset == 'Instructions') ) ? 1 : 2;
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
      'label'      => null,
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
