<?php

require_once dirname(__FILE__).'/../lib/committalStreamGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/committalStreamGeneratorHelper.class.php';

/**
 * committalStream actions.
 *
 * @package    fileadmin
 * @subpackage committalStream
 * @author     William Palomino
 * @version    3.0
 */
class committalStreamActions extends autoCommittalStreamActions
{
  public function preExecute() 
  {
    parent::preExecute();
    $this->section_links = $this->helper->getSectionLinks('committal_stream');
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
  
  
  public function executeNew(sfWebRequest $request)
  {
    if ($this->verifyUserFile('To create a Committal Stream select a File first!')) {
      $committal_stream = new CommittalStream();
      $committal_stream->setUserFileId(CommonObject::getSessionUserFileData('fileId'));
      $this->committal_stream = $committal_stream;
      $this->form = new CommittalStreamForm($committal_stream);
    }
    
  }

}
