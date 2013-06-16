<?php

/**
 * file module configuration.
 *
 * @package    PhpProject1
 * @subpackage file
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class fileGeneratorConfiguration extends BaseFileGeneratorConfiguration
{
  
  public function getPagerMaxPerPage()
  {
    if ($max = sfContext::getInstance()->getUser()->getAttribute('file.max_per_page'))
      return $max;
    else
      return parent::getPagerMaxPerPage();
  }
  
  public function getFormFields(sfForm $form, $context)
  {
    $config = $this->getConfig();
    $method = sprintf('get%sDisplay', ucfirst($context));
    
    if (!$fieldsets = $this->$method()) {
      $fieldsets = $this->getFormDisplay();
    }
    
    if ($fieldsets) {
  
      // added by William, 17/04/2012: this must be configurated to work for all forms
      if ( isset($fieldsets['Court Dates']) || isset($fieldsets['Charges']) ) {
        foreach ($form->getWidgetSchema()->getPositions() as $k => $v) {
          if ($v == 'FileCourtDates') {
            $fieldsets['Court Dates'][1] = $fieldsets['Court Dates'][0];
            $fieldsets['Court Dates'][0] = 'FileCourtDates';
          }
          if ($v == 'FileCharges') {
            $fieldsets['Charges'][1] = $fieldsets['Charges'][0];
            $fieldsets['Charges'][0] = 'FileCharges';
          }
        }        
      }
      // end of added by William
      
      $fields = array();

      // with fieldsets?
      if (!is_array(reset($fieldsets))) {
        $fieldsets = array('NONE' => $fieldsets);
      }

      foreach ($fieldsets as $fieldset => $names) {
        if (!$names) {
          continue;
        }
        $fields[$fieldset] = array();

        foreach ($names as $name) {
          list($name, $flag) = sfModelGeneratorConfigurationField::splitFieldWithFlag($name);
          if (!isset($this->configuration[$context]['fields'][$name])) {
            $this->configuration[$context]['fields'][$name] = new sfModelGeneratorConfigurationField($name, array_merge(
              isset($config['default'][$name]) ? $config['default'][$name] : array(),
              isset($config['form'][$name]) ? $config['form'][$name] : array(),
              isset($config[$context][$name]) ? $config[$context][$name] : array(),
              array('is_real' => false, 'type' => 'Text', 'flag' => $flag)
            ));
          }

          $field = $this->configuration[$context]['fields'][$name];
          $field->setFlag($flag);
          $fields[$fieldset][$name] = $field;
        }
      }

      return $fields;
    }

    $fields = array();
    foreach ($form->getWidgetSchema()->getPositions() as $name) {
      $fields[$name] = new sfModelGeneratorConfigurationField($name, array_merge(
        array('type' => 'Text'),
        isset($config['default'][$name]) ? $config['default'][$name] : array(),
        isset($config['form'][$name]) ? $config['form'][$name] : array(),
        isset($config[$context][$name]) ? $config[$context][$name] : array(),
        array('is_real' => false)
      ));
    }

    return array('NONE' => $fields);
  }
  
}