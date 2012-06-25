<?php

require_once dirname(__FILE__).'/../lib/sucursalGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sucursalGeneratorHelper.class.php';

/**
 * sucursal actions.
 *
 * @package    mmd
 * @subpackage sucursal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class sucursalActions extends autoSucursalActions
{
  public function executeActivar()
  {
    $sucursal = $this->getRoute()->getObject();

    $sucursal->activar();
    
    $this->getUser()->setFlash('notice', 'La Sucursal fue activada con éxito.');

    $this->redirect('@sucursal');
  }

  public function executeDesactivar()
  {
    $sucursal = $this->getRoute()->getObject();

    if ($sucursal->puedenDesactivarme())
    {
      $sucursal->desactivar();

      $this->getUser()->setFlash('notice', 'La Sucursal fue desactivada con éxito.');
    }
    else
    {      
      $this->getUser()->setFlash('error', 'La Sucursal tiene Usuarios o Stock asociados.');
    }

    $this->redirect('@sucursal');
  }  
}
