<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    PhpProject1
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileForm extends BasesfGuardUserProfileForm
{
  public function configure()
  {
    $this->widgetSchema['state'] = new sfWidgetFormChoice(array(
      'choices'  => Doctrine_Core::getTable('sfGuardUserProfile')->getStates(),
      'expanded' => false,
    ));
    
    // fix some drop box displays
    $this->widgetSchema['related_user_id']->setOption('method', 'obtainFullName');
    
    
    /*if (  (sfContext::getInstance()->getModuleName() == 'prosecutor') &&
          !sfContext::getInstance()->getRequest()->getParameter('shbx') )
      {
      $this->widgetSchema['agency_id'] = new sfWidgetFormAjaxDoctrineChoice(array(
        'model' => $this->getRelatedModelName('Agency'), 
        'form_module' => 'prosecution', 
        'add_empty' => true,
        ));
    }*/
  } 
  
}
