<?php

/**
 * usuario module configuration.
 *
 * @package    mmd
 * @subpackage usuario
 * @author     Your name here
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class usuarioGeneratorConfiguration extends BaseUsuarioGeneratorConfiguration
{
  public function getNewFieldsets()
  {
    return array('NONE' => array('sf_guard_group_id'));
  }
}
