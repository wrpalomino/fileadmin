<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

// for production
//$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'prod', false);

// for development/testing
$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'dev', true);

sfContext::createInstance($configuration)->dispatch();
