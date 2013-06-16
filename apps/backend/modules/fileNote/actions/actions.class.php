<?php

require_once dirname(__FILE__).'/../lib/fileNoteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/fileNoteGeneratorHelper.class.php';

/**
 * fileNote actions.
 *
 * @package    fileadmin
 * @subpackage fileNote
 * @author     William Palomino
 * @version    3.0
 */
class fileNoteActions extends autoFileNoteActions
{
  public function executeIndex(sfWebRequest $request)
  {    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
      
    $this->verifyClientFile('Saved Documents');
    /*$current_client = $this->getUser()->getAttribute('client', null);
    if ($current_client === null) {
      echo "<script>alert('No file selected, please select a file!')</script>";
    }
    else if ($current_client['last_file_id'] === null) {
      echo "<script>alert('Selected client does not have a file, please create a file!')</script>";
    }*/
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $current_client = $this->getUser()->getAttribute('client', null);
    if ( ($current_client === null) || ($current_client['last_file_id'] === null) ) {
      $this->redirect($this->getModuleName().'/index?edit_pager=0');
    }
    else {
      $file_note = new FileNote();
      $user_file = Doctrine::getTable('UserFile')->findOneBy('id', $current_client['last_file_id']);
      $file_note->setUserFileId($user_file->getId());
      $this->file_note = $file_note;
      $this->form = new FileNoteForm($file_note);
    }
    
  }
}
