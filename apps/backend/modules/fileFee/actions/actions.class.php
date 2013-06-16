<?php

require_once dirname(__FILE__).'/../lib/fileFeeGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/fileFeeGeneratorHelper.class.php';

/**
 * fileFee actions.
 *
 * @package    fileadmin
 * @subpackage fileFee
 * @author     William Palomino
 * @version    3.0
 */
class fileFeeActions extends autoFileFeeActions
{
  public function preExecute()
  {
    parent::preExecute();
    
    // get the right form according to the code
    $code = isset($_GET['code']) ? $_GET['code'] : '';
    if ($code != '') sfContext::getInstance()->getUser()->setAttribute('fileFee_code', $code);
    else $code = sfContext::getInstance()->getUser()->getAttribute('fileFee_code', 'FEE');
    $this->helper->fileFee_code = $code;
  }
  
  public function executeIndex(sfWebRequest $request)
  {
    $request = $this->setMainFilter($request);
    parent::executeIndex($request);
    $this->editPagerRedirection($request);
  }
  
  
  public function executeInvoices(sfWebRequest $request)       
  {
    $this->setPagination($request);
    $this->helper->section_links_id = 'section_links2';
  }
  
  
  public function executeReceipts(sfWebRequest $request)       
  {
    $this->setPagination($request);
    $this->helper->section_links_id = 'section_links2';
  }
  
  
  /*protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $user_file = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $user_file)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@user_file_fileFee_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

                
        if ($this->shadow_box) {
          $this->redirect(array('sf_route' => 'user_file_fileFee_edit', 'shbx' => '2', 'sf_subject' => $user_file));
        }
        else {
          if (strtolower($this->getActionName()) == 'create') {
            //$this->redirect(array('sf_route' => 'user_file_fileFee_edit', 'create' => '1', 'sf_subject' => $user_file));
          }
          else {
            //$this->redirect(array('sf_route' => 'user_file_fileFee_edit', 'sf_subject' => $user_file));
          }
        }
          
                
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }*/

}
