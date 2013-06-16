<?php

class ClerkValidatorSchema extends sfValidatorSchema
{
  protected function configure($options = array(), $messages = array())
  {
    //$this->addMessage('last_name', 'Last Name is required.');
    //$this->addMessage('first_name', 'First Name is required.');
    //$this->addMessage('email_address', 'Email Addres is required.');
    

    /*foreach ($this->getFields() as $name => $field) {
      if ($this->validatorSchema[$name]->getOption('required')) {
        $label = ($this->widgetSchema[$name]->getLabel() != '') ? $this->widgetSchema[$name]->getLabel() : str_replace('_', ' ', ucfirst($name));
        $this->addMessage($name, $label.' is required.');
      }
    }*/
    
  }
 
  protected function doClean($values)
  {
    $verify_required_fields = false;
    foreach($values as $key => $value) {
      if ($key == 'sfGuardUserProfiles') {
        foreach ($values[$key] as $k1 => $value1) {
          if ( ($value1 != NULL) && ($key != 'username') && ($key != 'id') ) {
            $verify_required_fields = true;
            break;
          }
        }
      }
      else if ( ($value != NULL) && ($key != 'username') && ($key != 'groups_list') && ($key != 'id') ) {
        $verify_required_fields = true;
      }
      
      if ($verify_required_fields) break;
    }
    
    $errorSchema = new sfValidatorErrorSchema($this);
    if ($verify_required_fields) {
      foreach ($values as $key => $value) {
        $errorSchemaLocal = new sfValidatorErrorSchema($this);
        
        if ($value == NULL) {
          $errorSchemaLocal->addError(new sfValidatorError($this, 'required'), $key);
        }
        
        // some error for this embedded-form
        if (count($errorSchemaLocal)) {
          $errorSchema->addError($errorSchemaLocal, (string) $key);
        }
      }
    }
    else { // no data filled, remove all empty values
      foreach ($values as $key => $value) {
        unset($values[$key]);
      }
    }
    
    foreach ($errorSchema as $k => $v)  echo $k.' =>'. $v;
 
    // throws the error for the main form
    if (count($errorSchema)) {
      throw new sfValidatorErrorSchema($this, $errorSchema);
    }
 
    return $values;
  }
}
?>
