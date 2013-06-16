<?php

require_once dirname(__FILE__).'/../lib/smsGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/smsGeneratorHelper.class.php';

/**
 * sms actions.
 *
 * @package    fileadmin
 * @subpackage sms
 * @author     William Palomino
 * @version    3.0
 */
class smsActions extends autoSmsActions
{
  public function executeIndex(sfWebRequest $request)
  {    
    $request = $this->setMainFilter($request);
    parent::executeIndex($request); 
    $this->editPagerRedirection($request);
    
    $this->verifyClientFile('SMS');
  }
  
  public function executeNew(sfWebRequest $request)
  {
    if ($this->verifyUserFile('To create a new SMS select a file first!', 'shbx_custom_info', 0)) {
      $current_client = CommonObject::getSessionUserFileData('all');
      $sms = new ShortMessage();
      $user_file = Doctrine::getTable('UserFile')->find($current_client['last_file_id']);
      $sms->setUserFileId($user_file->getId());
      $sms->setUserId($this->getUser()->getGuardUser()->getId());
      
      // set the numbers
      $sms->setSmsFrom(str_replace(" ", "", $this->getUser()->getGuardUser()->getUserProfiles()->getMobile()));
      $client_profile = Doctrine::getTable('SfGuardUserProfile')->findBy('user_id', $current_client['id']);
      $to_number = isset($client_profile[0]) ? $client_profile[0]->getMobile() : "";
      $sms->setSmsTo(str_replace(" ", "", $to_number));
      
      //$sms->setUserId($user_file->getClientId());
      $this->short_message = $sms;
      $this->form = new ShortMessageForm($sms);
    }
  }
  
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()) {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $short_message = $form->save();
      } 
      catch (Doctrine_Validator_Exception $e) {
        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $short_message)));
      
      // added by William, 14/11/2012: to get the sms sent status
      if ($this->getUser()->hasFlash('notice')) $notice.= " And ".$this->getUser()->getFlash('notice');

      if ($request->hasParameter('_save_and_add')) {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');
        $this->redirect('@short_message_new');
      }
      else {
        $this->getUser()->setFlash('notice', $notice);

        if ($this->shadow_box) {
          $this->redirect(array('sf_route' => 'short_message_edit', 'shbx' => '2', 'sf_subject' => $short_message));
        }
        else {
          if (strtolower($this->getActionName()) == 'create') {
            $this->redirect(array('sf_route' => 'short_message_edit', 'create' => '1', 'sf_subject' => $short_message));
          }
          else {
            $this->redirect(array('sf_route' => 'short_message_edit', 'sf_subject' => $short_message));
          }
        }
       
      }
    }
    else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
}
