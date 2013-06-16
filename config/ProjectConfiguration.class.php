<?php

/* This project is using a customized theme (zafire) to the admin generator; 
 * therefore consider some adds and changes inside the \lib\vendor\symfony\lib folder:
 *   added file: \lib\vendor\symfony\lib\generator\zafireGeneratorConfiguration.class.php
 *   added folder: \lib\vendor\symfony\lib\plugins\sfDoctrinePlugin\data\generator\sfDoctrineModule\zafire
 *   modified file: \lib\vendor\symfony\lib\autoload\sfCoreAutoload.class.php
 * and, to fix a Symfony bug:
 *   modified file: \lib\vendor\symfony\lib\plugins\sfDoctrinePlugin\lib\form\sfFormDoctrine.class.php
 * finally some fixes on the plugins
 *   modified file: \plugins\sfDependentSelectPlugin\lib\widget\sfWidgetFormDependentSelect.class.php
 *   modified file: \web\sfDependentSelectPlugin\js\SelectDependiente.js & SelectDependiente.min.js
 *  */

//require_once 'C://wamp//symfony//lib/autoload/sfCoreAutoload.class.php';
require_once(dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php');

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins(array(
      'sfDoctrinePlugin', 
      'sfDoctrineGuardPlugin'
    ));
    $this->enablePlugins('sfJqueryReloadedPlugin');
    $this->enablePlugins('sfDependentSelectPlugin');
    $this->enablePlugins('ahDoctrineEasyEmbeddedRelationsPlugin');
    $this->enablePlugins('sfTCPDFPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
  }
}
