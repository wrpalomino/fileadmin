<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class="sf_admin_filter">
  <?php if ($form->hasGlobalErrors()): ?>
    <?php echo $form->renderGlobalErrors() ?>
  <?php endif; ?>

  <form action="<?php echo url_for('user_file_collection', array('action' => 'filter')) ?>" method="post">
    <table cellspacing="0" class="sf_admin_filter_table">
      <tfoot>
        <tr>
          
          <?php if ($only_filters): // added by William, 05/03/2012 ?>
          
          <td align="left">
            <?php echo $helper->linkToNew(array(  'params' =>   array(  ),  'class_suffix' => 'new',  'label' => 'New',)) ?>                     
          </td>
          <td>
            
          <?php else: ?>
          
          <td colspan="2">
            
          <?php endif; // end of added ?>
          
            <?php echo $form->renderHiddenFields() ?>
            <?php echo link_to(__('Reset', array(), 'sf_admin'), 'user_file_collection', array('action' => 'filter'), array('query_string' => '_reset', 'method' => 'post')) ?>
            <input type="submit" value="<?php echo __('Filter', array(), 'sf_admin') ?>" />
          </td>
        </tr>
      </tfoot>
      
      <?php $num_fields = 0?>  
      <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
        <?php $num_fields++?>
      <?php endforeach; ?>
      <?php $counter = 0?>
      
      
      <tbody>
      <tr>    
        
        <?php foreach ($configuration->getFormFilterFields($form) as $name => $field): ?>
        
          <?php $counter++?>
          <?php if ( ($counter == 1) || ($counter == (int)($num_fields/2)+1) ) echo '<td><table>' ?>
        
          <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
          <?php include_partial('file/filters_field', array(
            'name'       => $name,
            'attributes' => $field->getConfig('attributes', array()),
            'label'      => $field->getConfig('label'),
            'help'       => $field->getConfig('help'),
            'form'       => $form,
            'field'      => $field,
            'class'      => 'sf_admin_form_row sf_admin_'.strtolower($field->getType()).' sf_admin_filter_field_'.$name,
          )) ?>
        
          <?php if ( ($counter == $num_fields) || ($counter == (int)($num_fields/2)) ) echo '</table></td>' ?>
        
        <?php endforeach; ?>
      
      
      </tr>
      </tbody>
    </table>
  </form>
</div>
