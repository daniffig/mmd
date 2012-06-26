<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfPropelPlugin');
    $this->enablePlugins('dcReloadedFormExtraPlugin');
    $this->enablePlugins('pmPropelGeneratorPlugin');
    $this->enablePlugins('sfGuardPlugin');
    $this->enablePlugins('pmPropelGeneratorPlugin');
    $this->enablePlugins('sfImageTransformPlugin');
    $this->enablePlugins('pmPDFKitPlugin');
  }
}
