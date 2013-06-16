<td>
  
  <?php // added by William, 12/02/2012 ?>
  [?php if ( (!isset($sort_headers)) || ($sort_headers) ): ?]
  
  <input type="checkbox" name="ids[]" value="[?php echo $<?php echo $this->getSingularName() ?>->getPrimaryKey() ?]" class="sf_admin_batch_checkbox" />
  
  [?php endif; ?]
  
</td>