<?php

/**
 * downloadPDF actions.
 *
 * @package    fileadmin
 * @subpackage downloadPdf
 * @author     William Palomino
 * @version    3.0
 */
class downloadPDFActions extends sfActions {

  /**
    * Executes index action
    *
    * @param sfRequest $request A request object
    */
  public function executeDownload(sfWebRequest $request) 
  {
    // decode the special characters in the file name
    $filename = html_entity_decode($request->getParameter('filename'));
    
    if (file_exists(sfConfig::get('sf_upload_dir') . '/' . $request->getParameter('directory') . '/' . $filename)) {  
      $response = $this->getContext()->getResponse();
      $response->clearHttpHeaders();
      $response->addCacheControlHttpHeader('Cache-control', 'must-revalidate, post-check=0, pre-check=0');
      $response->setContentType('application/octet-stream', TRUE);
      $response->setHttpHeader('Content-Transfer-Encoding', 'binary', TRUE);
      $response->setHttpHeader('Content-Disposition', 'attachment; filename="'.$filename.'"', TRUE);
      $response->sendHttpHeaders();
      readfile(sfConfig::get('sf_upload_dir') . '/' . $request->getParameter('directory') . '/' . $filename);
      return sfView::NONE;
    } 
    else {
      $this->forward404();
    }
  }

}
