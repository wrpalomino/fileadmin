<?php

/**
 * ShortMessageTemplate form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ShortMessageTemplateForm extends BaseShortMessageTemplateForm
{
  public function configure()
  {
    $limit_characters = array(
        'onKeyDown' => "limitText(this, 160)",
        'onKeyUp' => "limitText(this, 160)"
        );
    
    $this->widgetSchema['message'] = new sfWidgetFormTextarea(array(), array_merge(array('cols' => 60), $limit_characters));
    //$this->widgetSchema->setHelp('template', '<span class="help"><a href="backend_dev.php/smsTemplate?edit_pager=0">Create Template</a></span>');
    
    // adding asterisk for required fields
    $this->setAsteriskForRequiredFields();
  }
}
