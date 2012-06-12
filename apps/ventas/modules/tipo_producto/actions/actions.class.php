<?php

require_once dirname(__FILE__).'/../lib/tipo_productoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tipo_productoGeneratorHelper.class.php';

/**
 * tipo_producto actions.
 *
 * @package    mmd
 * @subpackage tipo_producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class tipo_productoActions extends autoTipo_productoActions
{
  public function executeDesactivar()
  {
    if ($this->getRoute()->getObject()->puedenBorrarme())
    {
      $this->getRoute()->getObject()->setEsActivo(false);
      $this->getRoute()->getObject()->save();

      $this->getUser()->setFlash('notice', 'El Tipo de Producto fue desactivado con éxito.');
    }
    else
    {      
      $this->getUser()->setFlash('error', 'El Tipo de Producto tiene Productos o Características asociados.');
    }

    $this->redirect('@tipo_producto');
  }
}
