  public function getListParams()
  {
    return <?php echo $this->asPhp(isset($this->config['list']['params']) ? $this->config['list']['params'] : '%%'.implode('%% - %%', isset($this->config['list']['display']) ? $this->config['list']['display'] : $this->getAllFieldNames(false)).'%%') ?>;
<?php unset($this->config['list']['params']) ?>
  }

  public function getListLayout()
  {
    return '<?php echo isset($this->config['list']['layout']) ? $this->config['list']['layout'] : 'tabular' ?>';
<?php unset($this->config['list']['layout']) ?>
  }

  public function getListTitle()
  {
    return '<?php echo $this->escapeString(isset($this->config['list']['title']) ? $this->config['list']['title'] : sfInflector::humanize($this->getModuleName()).' List') ?>';
<?php unset($this->config['list']['title']) ?>
  }

  public function getEditTitle()
  {
    return '<?php echo $this->escapeString(isset($this->config['edit']['title']) ? $this->config['edit']['title'] : 'Edit '.sfInflector::humanize($this->getModuleName())) ?>';
<?php unset($this->config['edit']['title']) ?>
  }

  public function getNewTitle()
  {
    return '<?php echo $this->escapeString(isset($this->config['new']['title']) ? $this->config['new']['title'] : 'New '.sfInflector::humanize($this->getModuleName())) ?>';
<?php unset($this->config['new']['title']) ?>
  }

  public function getFilterDisplay()
  {
    return <?php echo $this->asPhp(isset($this->config['filter']['display']) ? $this->config['filter']['display'] : array()) ?>;
<?php unset($this->config['filter']['display']) ?>
  }

  public function getFormDisplay()
  {
    return <?php echo $this->asPhp(isset($this->config['form']['display']) ? $this->config['form']['display'] : array()) ?>;
<?php unset($this->config['form']['display']) ?>
  }

  public function getEditDisplay()
  {
    return <?php echo $this->asPhp(isset($this->config['edit']['display']) ? $this->config['edit']['display'] : array()) ?>;
<?php unset($this->config['edit']['display']) ?>
  }

  public function getNewDisplay()
  {
    return <?php echo $this->asPhp(isset($this->config['new']['display']) ? $this->config['new']['display'] : array()) ?>;
<?php unset($this->config['new']['display']) ?>
  }

  public function getListDisplay()
  {
<?php if (isset($this->config['list']['display'])): ?>
    return <?php echo $this->asPhp($this->config['list']['display']) ?>;
<?php elseif (isset($this->config['list']['hide'])): ?>
    return <?php echo $this->asPhp(array_diff($this->getAllFieldNames(false), $this->config['list']['hide'])) ?>;
<?php else: ?>
    return <?php echo $this->asPhp($this->getAllFieldNames(false)) ?>;
<?php endif; ?>
<?php unset($this->config['list']['display'], $this->config['list']['hide']) ?>
  }

  public function getFieldsDefault()
  {
    return array(
<?php foreach ($this->getDefaultFieldsConfiguration() as $name => $params): ?>
      '<?php echo $name ?>' => <?php echo $this->asPhp($params) ?>,
<?php endforeach; ?>
    );
  }

<?php foreach (array('list', 'filter', 'form', 'edit', 'ajaxedit', 'new', 'show') as $context): ?>
  public function getFields<?php echo ucfirst($context) ?>()
  {
    return array(
<?php foreach ($this->getFieldsConfiguration($context) as $name => $params): ?>
      '<?php echo $name ?>' => <?php echo $this->asPhp($params) ?>,
<?php endforeach; ?>
    );
  }

<?php endforeach; ?>

  

<?php /************************* added by William, 03/02/2012 **********************/ ?>
  
  public function getNewReturnTo()
  {
    return '<?php echo $this->escapeString(isset($this->config['new']['return_to']) ? $this->config['new']['return_to'] : 'edit') ?>';
<?php unset($this->config['new']['return_to']) ?>
  }

  public function getEditReturnTo()
  {
    return '<?php echo $this->escapeString(isset($this->config['edit']['return_to']) ? $this->config['edit']['return_to'] : 'edit') ?>';
<?php unset($this->config['edit']['return_to']) ?>
  }
  
  public function getAjaxeditTitle()
  {
    return '<?php echo $this->escapeString(isset($this->config['ajaxedit']['title']) ? $this->config['ajaxedit']['title'] : 'Edit '.sfInflector::humanize($this->getModuleName())) ?>';
<?php unset($this->config['ajaxedit']['title']) ?>
  }
  
  public function getAjaxeditDisplay()
  {
    return <?php echo $this->asPhp(isset($this->config['ajaxedit']['display']) ? $this->config['ajaxedit']['display'] : array()) ?>;
<?php unset($this->config['ajaxedit']['display']) ?>
  }
 
  public function getShowTitle()
  {
    return '<?php echo $this->escapeString(isset($this->config['show']['title']) ? $this->config['show']['title'] : 'Details of '.sfInflector::humanize($this->getModuleName())) ?>';
<?php unset($this->config['show']['title']) ?>
  }
  
  public function getShowDisplay()
  {
    return <?php echo $this->asPhp(isset($this->config['show']['display']) ? $this->config['show']['display'] : array()) ?>;
<?php unset($this->config['show']['display']) ?>
  }
  
  public function getForm2Title()
  {
    return '<?php echo $this->escapeString(isset($this->config['form2']['title']) ? $this->config['form2']['title'] : 'Details of '.sfInflector::humanize($this->getModuleName())) ?>';
<?php unset($this->config['form2']['title']) ?>
  }
  
  public function getForm2Display()
  {
    return <?php echo $this->asPhp(isset($this->config['form2']['display']) ? $this->config['form2']['display'] : array()) ?>;
<?php unset($this->config['form2']['display']) ?>
  }