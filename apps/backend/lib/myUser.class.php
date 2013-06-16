<?php

class myUser extends sfGuardSecurityUser
{
  // added by William, 04/02/2012
  public function getTextBetweenTags($string) 
  { 
    $string = str_replace('<table>','<table >', $string);
    $pieces = explode(' ', strip_tags($string, '<table><input><select><textarea>'));
    $tagname = strtolower(substr($pieces[0], 1));
    
    switch ($tagname) {
      case 'table':
        $string = str_replace(array('<input', '<select', '<textarea'), array('<input disabled', '<select disabled', '<textarea disabled'), $string);
        break;
      case 'input': 
        if (strpos($string, 'type="text"') !== false) {
            $init = strpos($string, 'value="');
            if ($init !== false) {
              $init = $init+strlen('value="');
              $end = strpos($string, '"', $init);
              $string = substr($string, $init, $end-$init);
            }
            else $string = '';
        }
        else {
            $string = str_replace('type=', 'disabled type=', $string);
        }
        break;
      case 'select':
        $pieces2 = explode('</select>', $string);
        if (strpos($pieces2[1], '<select') !== false) { // many selects -> probably date selection boxes         
          foreach ($pieces2 as $k => $v)  {
            $string0 = "";  
            if ($v != "") {
              $init = strpos($v, 'selected="selected">')+strlen('selected="selected">');
              $end = strpos($v, "</option>", $init);
              $string0 = substr($v, $init, $end-$init);
              $pieces2[$k]= $string0;
            }
            else unset($pieces2[$k]);
          }
          $string = implode('/', $pieces2);
        }
        else {  // one select box    
          $string = $pieces3 = explode('</option>', strip_tags($string, '<option>'));
          foreach ($pieces3 as $k => $v)  {
            $init = strpos($v, 'selected="selected">');
            if ($init !== false) {
              $init = $init + strlen('selected="selected">');
              $pieces3[$k]= '* '.substr($v, $init);
            }
            else unset($pieces3[$k]);
          }
          $string = implode('<br/>', $pieces3);
        }
        break;
      default:
        $string = strip_tags($string);
        break;
    }   
    return $string;
  }
  
  public function getTextBetweenSimpleTags($string, $tagname)
  {
    $dom = new domDocument('1.0', 'utf-8'); 
    // load the html into the object ***/ 
    @$dom->loadHTML($string); 
    //discard white space 
    $dom->preserveWhiteSpace = false;
    $hTwo = $dom->getElementsByTagName($tagname); // here u use your desired tag
    
    $value = str_replace('&nbsp', ' ', $hTwo->item(0)->nodeValue);
    //$value = $hTwo->item(0)->nodeValue;
    
    return $value;
  }
  
  
  public function renderX($field, $attributes = array())
  {
    if ($field->getParent()) {
      return $this->getTextBetweenTags($field->getParent()->getWidget()->renderField($field->getName(), $field->getValue(), $attributes, $field->getError()));
    }
    else {
      return $this->getTextBetweenTags($field->widget->render($field->getName(), $field->getValue(), $attributes, $field->getError()));
    }
  }
  
  // this fucntion returns a string containing the form to be emailed or displayed (it only works for one level of embed, may be upgraded to support many levels)
  public function renderPlainForm($form)
  {
    $plain_form = '';
    foreach ($form->getValues() as $k => $v) {
      if ($k != 'id') {
        if (is_array($v)) {
          $use_emebedded_form_label = ($form->hasEnbeddedForm($k)) ? true : false;
          foreach ($v as $k1 => $v1) {
            if ($k1 != 'id') {
              $label = (($use_emebedded_form_label)&&($form->getEmbeddedForm($k)->getWidget($k1)->getLabel()!= '')) ? $form->getEmbeddedForm($k)->getWidget($k1)->getLabel() : $k1;
              $label = ucfirst(str_replace(array('_', '*', '&nbsp'), array(' ', '', ''), $k1));
              $plain_form.= '<tr><td>'.$label.'</td><td>'.$v1.'</td></tr>';
              //$plain_form.= $label.': '.$v1.'<br/>';
            }
          }
        }
        else {
          $label = ($form->getWidget($k)->getLabel() != '') ? $form->getWidget($k)->getLabel() : $k;
          $label = ucfirst(str_replace(array('_', '*', '&nbsp'), array(' ', '', ''), $k));
          $plain_form.= '<tr><td>'.$label.'</td><td>'.$v.'</td></tr>';
          //$plain_form.= $label.': '.$v.'<br/>';
        }
      }
    }
    if ($plain_form != '') $plain_form = '<table>'.$plain_form.'</table>';
    
    return $plain_form;
  }
  
  public function phpMail($emails, $subject, $message_body, $headers=array())
  {
    if (strpos($message_body, '<html>') === false) {
      $message_body = '<html><head><title>'.$subject.'</title></head><body>'.$message_body.'</body></html>';
    }    
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Additional headers
    $headers .= 'To: '.$emails['to_name'].' <'.$emails['to_email'].'>' . "\r\n";
    $headers .= 'From: '.$emails['from_name'].'Cotton Master <'.$emails['from_email'].'>' . "\r\n";

    return mail($emails['to_email'], $subject, $message_body, $headers);
  }
  
  public function getRawAttribute($attr, $default, $encode=false)
  {
    $c_client = sfContext::getInstance()->getUser()->getAttribute($attr, $default);
    if ($c_client == $default) return $default;
    
    $arr = array();
    foreach ($c_client as $k => $v) $arr[$k] = $v;
    
    $arr = $this->getMainFilterFields($arr);
    if ($encode) {
      return json_encode($arr);
    }
    
    return $arr;
  }
  
  public function getMainFilterFields($arr, $object='client', $extra='')
  {
    if (isset($arr['id'])) {
      $file_id_found = false;
      $file = null;

      if ($object == 'client') {
        $user = Doctrine::getTable('SfGuardUser')->find($arr['id']);
        if ($user) {
          $arr['first_name'] = $user->getFirstName();
          $arr['last_name'] = $user->getLastName();

          if (isset($arr['last_file_id'])) {
            $file = Doctrine::getTable('UserFile')->find($arr['last_file_id']);
            if ($file) $file_id_found = true;
          }
          if (!$file_id_found) {
            $files = $user->getClientUserFiles();
            if (count($files)) $file = $files[count($files)-1];
          }
        }
      }
      else { // object = file
        $file = Doctrine::getTable('UserFile')->find($arr['id']);
        if ($file) {
          $file_id_found = true;
          
          $user = Doctrine::getTable('SfGuardUser')->find($file->getClientId());
          if ($user) {
            $arr['first_name'] = $user->getFirstName();
            $arr['last_name'] = $user->getLastName();
          }
        }
      }
        
      if (!empty($file)) {
        $arr['number'] = (int)$file->getNumber();
        $arr['informant'] = $file->getInformant()->obtainFullName();
        $arr['solicitor'] = $file->getSolicitor()->obtainFullName();

        $court_dates = $file->getFileCourtDates();
        if (count($court_dates)) {
          $court_date = $court_dates[count($court_dates)-1];  // last one?
          $arr['court'] = $court_date->getCourt()->getName();
          $arr['date'] = $court_date->getDate();
          $arr['listing'] = $court_date->getListing()->getName();
        }

        $charges = $file->getFileCharges();
        if (count($charges)) {
          $charge = $charges[count($charges)-1];  // last one?
          $arr['charge'] = $charge->getCharge();
        }
      }
      
      if ($extra != '') {
        $arr2 = array();
        foreach ($arr as $k => $v) $arr2[$k][$extra] = $v;
        return $arr2;
      }
    }

    return $arr;
  }
  
  
  function buildComplexQuery($search_text, $table_id, $connector='OR')
  {
    $search_text = preg_replace('/\s{2,}/',' ', $search_text);
    $words = explode(' ', trim($search_text));
    foreach ($words as $i => $word) $words[$i] = $table_id.'.first_name LIKE "%'.$word.'%" '.$connector.' '.$table_id.'.last_name LIKE "%'.$word.'%"';
    return '('.implode(' '.$connector.' ', $words).')';
  }
  
  
  function getBaseUrl($type='web')
  {
    $sf_request = sfContext::getInstance()->getRequest();
    if ($type == 'web') {  // web directory to access js, css, and other resource files
      return $sf_request->getUriPrefix().$sf_request->getRelativeUrlRoot().'/';
    }
    else {  // controller directory path to access the controller for the app.
      return $sf_request->getUriPrefix().$sf_request->getPathInfoPrefix().'/';
    }
  }
  
  
  function setSelectedMenuTab() 
  {
    $module = sfContext::getInstance()->getModuleName();
    switch($module) {
      case 'client':    case 'informant':     case 'court':     case 'barrister': 
      case 'fileFee':   case 'legal':         case 'agency':    case 'admin':   
      case 'todo':      case 'help':
        break;
      case 'file':      case 'user':          case 'institution':
        $module = 'admin'; 
        break;
      case 'charge':    case 'brief':         case 'prosecutor':
        $module = 'informant';
        break;
      case 'grant':     case 'compliance':
        $module = 'legal';
        break;
      case 'committalStream':
        $module = 'court';
        break;
      default:
        $module = 'admin';
        break;
    }
    
    return $module;
  }
  
  function setSelectedSubMenuTab($submenu_obj)
  {
    $selected = false;
    
    $action = sfContext::getInstance()->getActionName();
    $lnk_module = substr($submenu_obj['href'], 0, strpos($submenu_obj['href'], '/'));
    $module = sfContext::getInstance()->getModuleName();
      
    //echo $lnk_module;   //echo $action;
    if ($action == $submenu_obj['action'] )  {
      if ($submenu_obj['action'] == 'index') {        
        if ($module == $lnk_module) {
          $selected = true;
        }
      }
      else {
        $selected = true;
      }
    }
    
    // for extra default form's actions
    if (!$selected) {   
      if ( in_array($action, array('edit', 'new', 'create', 'update')) && ($submenu_obj['action'] == 'index') ) {
        if ($module == $lnk_module) {
          $selected = true;
        }
      }
    }
    
    // for modules with many submenus tabs filter by extra url var
    if (strpos($submenu_obj['href'], 'code')) {
      $module_prefix = ($module == 'agency') ? '' : sfContext::getInstance()->getModuleName().'_';
      $module_code = sfContext::getInstance()->getUser()->getAttribute($module_prefix.'code', null);
      //echo $module_code;
      
      $vars = array();
      parse_str(substr($submenu_obj['href'], strpos($submenu_obj['href'], 'code')), $vars);
      //foreach ($vars as $k => $v)  echo $k .'=>'. $v.'<br/>';
      if ($module_code != $vars['code']) {
        $selected = false;  // deselect the submenu tab
      }
    }
    
    return $selected;
  }
}
