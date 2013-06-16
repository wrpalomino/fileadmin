<?php

/**
 * Charge form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ChargeForm extends BaseChargeForm
{
  public function configure()
  {
    if (sfContext::getInstance()->getModuleName() == 'file') {
      $this->useFields(array('item', 'type_id', 'charge', 'comment', 'date', 'acts', 'section'));
      $this->widgetSchema['item']->setAttribute('style', 'width:30px');
      $this->widgetSchema['acts']->setAttribute('style', 'width:60px');
      $this->widgetSchema['section']->setAttribute('style', 'width:80px');
      $this->widgetSchema['type_id']->setAttribute('style', 'width:80px');
    }
    else {
      $this->widgetSchema['user_file_id']->setOption('method', 'getClientName');
    }
    
    //$this->setDefault('item', 1);
    $this->widgetSchema['item']->setAttribute('class', 'itemValue');
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
    
    // this formatting is applied only if form is called directly, without admin generator templates    
    $first = ($this->getOption('first') !== null) ? $this->getOption('first') : false;
    $custom_decorator = new ExtendedFormSchemaFormatter($this->getWidgetSchema(), array('header' => $first));
    $this->widgetSchema->addFormFormatter('Myformatter', $custom_decorator);
    $this->widgetSchema->setFormFormatterName('Myformatter');

  }
}
