[?php

/**
 * <?php echo $this->getModuleName() ?> module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage <?php echo $this->getModuleName()."\n" ?>
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class Base<?php echo ucfirst($this->getModuleName()) ?>GeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? '<?php echo $this->params['route_prefix'] ?>' : '<?php echo $this->params['route_prefix'] ?>_'.$action;
  }
  
  // added by William
  
  // link to show view
  public function linkToShow($object, $params)
  {
    return '<li class="sf_admin_action_show">'.link_to(__($params['label'], array(), 'sf_admin'), $this->fixUrlForAction('show', $object), $object).'</li>';
  }
  
  // link to search mode
  public function linkToSearchMode($object, $params)
  {
    return '<a href="'.url_for('<?php echo $this->getModuleName()?>/index?mode=search').'">Search Mode</a>';
  }
  
  
  // not sure for what these are
  protected $actionUrl = '@<?php echo $this->getUrlForAction('list') ?>';
  public function getActionUrl()
  {
    return $this->actionUrl;
  }
  public function setActionUrl($action_url)
  {
    $this->actionUrl = $action_url;
  }
  

  // return empty arrays as default, these methods must be redefined in the modules
  function getPageLinks()
  { 
    return array();
  }
  
  function getSectionLinks($section)
  {
    return array();
  }
  
  
  // added by William, 17/05/2013: some new vars
  public $formlist = false;                      // to show form with list next to it
  public $section_links_id = 'section_links';    // to show section list in one colum only
}
