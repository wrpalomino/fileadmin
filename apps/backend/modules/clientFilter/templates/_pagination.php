<div class="sf_admin_pagination">
  <a href="#" onclick="paginate(1); return false;">
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/first.png', array('alt' => __('First page', array(), 'sf_admin'), 'title' => __('First page', array(), 'sf_admin'))) ?>
  </a>

  <a href="#" onclick="paginate(<?php echo $pager->getPreviousPage()?>); return false;">
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/previous.png', array('alt' => __('Previous page', array(), 'sf_admin'), 'title' => __('Previous page', array(), 'sf_admin'))) ?>
  </a>

  <?php if (!isset($edit_pager)): ?>
  
  <?php foreach ($pager->getLinks() as $page): ?>
    <?php if ($page == $pager->getPage()): ?>
      <?php echo $page ?>
    <?php else: ?>
      <a href="#" onclick="paginate(<?php echo $page?>); return false;"><?php echo $page?></a>
    <?php endif; ?>
  <?php endforeach; ?>
  
  <?php endif; ?>

  <a href="#" onclick="paginate(<?php echo $pager->getNextPage()?>); return false;">
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/next.png', array('alt' => __('Next page', array(), 'sf_admin'), 'title' => __('Next page', array(), 'sf_admin'))) ?>
  </a>

  <a href="#" onclick="paginate(<?php echo $pager->getLastPage()?>); return false;">
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/last.png', array('alt' => __('Last page', array(), 'sf_admin'), 'title' => __('Last page', array(), 'sf_admin'))) ?>
  </a>
</div>