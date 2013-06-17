<?php

/**
 * Common Object Model.
 *
 * @package    fileadmin
 * @subpackage model
 * @author     William Palomino
 * @version    3.0
 */
class CommonObject extends sfDoctrineRecord
{
  static public $default_values = array(
      'adlefm' => array("", "Your matter is listed for the above date.\ndDFSA"),
      'adlege' => array("", "Your matter has been adjourned to the above date"),
      'apcomf' => array("", "We refer to your conversation with us about your upcoming appointment\nWe confirm that you are booked in for the following date and time:"),
      'apmabd' => array("", "Please ring and make an appointment to see me.\nPlease bring the following with you to the appointment:"),
      'cccole' => array("", "We received an order for costs in relation to this matter."),
      );
  
  static public function retrieveDefaultValues($doc)
  {
    return (isset(self::$default_values[$doc])) ? self::$default_values[$doc] : null; 
  }
  
  
  static public function checkFileCourtDatesState()
  {
    $current_client = sfContext::getInstance()->getUser()->getAttribute('client', null);
    if ($current_client['last_file_id'] !== null) {
      $userFile = Doctrine::getTable('UserFile')->find($current_client['last_file_id']);
      if ($userFile)  {
        $msg = $userFile->getCourtDatesState();
        if ($msg != '') sfContext::getInstance()->getUser()->setFlash('custom_info', $msg, false);
      }
    }
  }
  
  
  static public function getSessionUserFileData($info='fileObj')
  {
    $result = null;
    $current_client = sfContext::getInstance()->getUser()->getAttribute('client', null);
 
    if ($current_client !== null) {
      switch ($info) {
        case 'fileId':
          $result = $current_client['last_file_id'];
          break;
        case 'clientId':
          $result = $current_client['id'];
          break;
        case 'userObj':
          $result = ($current_client['id']) ? Doctrine::getTable('SfGuardUser')->find($current_client['id']) : null;
          break;
        case 'all':
          $result = $current_client;
          break;
        default:
          $result = ($current_client['last_file_id']) ? Doctrine::getTable('UserFile')->find($current_client['last_file_id']) : null;
      }
    }
        
    return $result;
  }
  
  
  static function CountForThisUserFile($object)
  {
    $count = 0;
   
    $file_id = self::getSessionUserFileData('fileId');
    if ($file_id) {
      $q = Doctrine_Query::create()
            ->select('COUNT(*)')
            ->from($object)
            ->where('user_file_id = ?', $file_id);
      $total = $q->execute(array(), Doctrine_Core::HYDRATE_NONE);
      $count = $total[0][0];
    }    
    return $count;
  }
  
}
?>
