<?php

require_once dirname(__FILE__).'/../lib/situacion_impositivaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/situacion_impositivaGeneratorHelper.class.php';

/**
 * situacion_impositiva actions.
 *
 * @package    mmd
 * @subpackage situacion_impositiva
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class situacion_impositivaActions extends autoSituacion_impositivaActions
{
  public function executeActivar()
  {
    $situacion_impositiva = $this->getRoute()->getObject();

    $situacion_impositiva->activar();
    
    $this->getUser()->setFlash('notice', 'La Situación Impositiva fue activada con éxito.');

    $this->redirect('@situacion_impositiva');
  }

  public function executeDesactivar()
  {
    $situacion_impositiva = $this->getRoute()->getObject();

    $situacion_impositiva->desactivar();

    $this->getUser()->setFlash('notice', 'La Situación Impositiva fue activada con éxito.');

    $this->redirect('@situacion_impositiva');
  }  
}
