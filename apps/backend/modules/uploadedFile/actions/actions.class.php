<?php

require_once dirname(__FILE__).'/../lib/uploadedFileGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/uploadedFileGeneratorHelper.class.php';

/**
 * uploadedFile actions.
 *
 * @package    fileadmin
 * @subpackage uploadedFile
 * @author     William Palomino
 * @version    3.0
 */
class uploadedFileActions extends autoUploadedFileActions
{ 
  public function executeIndex(sfWebRequest $request)
  {    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request); 
    
    $this->verifyClientFile('uploaded files');
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $current_client = $this->getUser()->getAttribute('client', null);
    if ( ($current_client === null) || ($current_client['last_file_id'] === null) ) {
      $this->getUser()->setFlash('shbx_custom_info', 'To upload a new file select a file first!');
      $this->redirect($this->getModuleName().'/index?edit_pager=0');
    }
    else {
      $file_att = new FileAttachement();
      $user_file = Doctrine::getTable('UserFile')->findOneBy('id', $current_client['last_file_id']);
      $file_att->setUserFileId($user_file->getId());
      $file_att->setUpdatedById($this->getUser()->getGuardUser()->getId());
      
      $this->file_attachement = $file_att;
      $this->form = new FileAttachementForm($file_att);
    }
  }
  
  
  public function executeList_email(sfWebRequest $request)
  {
    // get the relative path to the temp folder for uploads
    $dir_path = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'web'.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
    $file_name = 'none'; // no file selected
    
    /*// test only 
    $dir_path.= 'temp'.DIRECTORY_SEPARATOR;
    $file_name = 'example.pdf';*/
    
    $objid = ($request->getParameter('id')) ? $request->getParameter('id') : 0;
    $obj = Doctrine::getTable('FileAttachement')->find($objid);
    if ($obj) {
      $dir_path.= $obj->getUserFile()->getNumber().DIRECTORY_SEPARATOR;        
      $file_name = $obj->getDocumentFile();
    }
    
    $email_to = ($request->getParameter('email_to')) ? $request->getParameter('email_to') : sfConfig::get("app_server_emailto");
    $email_body = ($request->getParameter('email_body')) ? $request->getParameter('email_body') : 'none';
    $email_subject =($request->getParameter('email_subject')) ? $request->getParameter('email_subject') : 'Document';
    
    //read the content form a file (for testing purpose only)
    if (file_exists($dir_path.$file_name)) { // check if the file exists
      $message = $this->getMailer()->compose();
      $message->setSubject($email_subject);
      $message->setTo($email_to);
      $message->setFrom(array(sfConfig::get("app_server_emailfrom") => sfConfig::get("app_server_emailfromtitle")));
      $message->setBody($email_body, "text/html");
      $message->attach(Swift_Attachment::fromPath($dir_path.$file_name)); 
      if ($this->getMailer()->send($message)) {  
        die("Email with attached document was sent successfully!");
      }
      else {
        die("It was a problem sending the email, try again later!");
      }
    }
    else {
      die("The email could not be sent because document file ".$file_name." does not exist, please chek the file!");
    }
    return sfView::NONE;
  }
  
}
