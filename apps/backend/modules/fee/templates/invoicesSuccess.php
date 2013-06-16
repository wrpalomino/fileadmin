<div id="sf_admin_container">
  <table id="layout">
  <tr>
    <td>
      <?php include_partial($this->getModuleName().'/section_links', array('section_links' => $section_links, 'configuration' => $configuration, 'helper' => $helper)) ?>
    </td>
    <td align="right">
      <div id="sf_admin_content">
        <?php include_partial($this->getModuleName().'/links', array('links' => $links, 'configuration' => $configuration, 'helper' => $helper)) ?>
      </div>
    </td>
  </tr>  
  </table>
</div>