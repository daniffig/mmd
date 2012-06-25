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
  public function executeActivar()
  {
    $tipo_producto = $this->getRoute()->getObject();

    if ($tipo_producto->getCategoria()->getEsActivo())
    {
      $this->getRoute()->getObject()->activar();
      
      $this->getUser()->setFlash('notice', 'El Tipo de Producto fue activado con éxito.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'La Categoría del Tipo de Producto está desactivada.');
    }

    $this->redirect('@tipo_producto');
  }

  public function executeDesactivar()
  {
    $tipo_producto = $this->getRoute()->getObject();

    if ($tipo_producto->puedenDesactivarme())
    {
      $tipo_producto->desactivar();

      $this->getUser()->setFlash('notice', 'El Tipo de Producto fue desactivado con éxito.');
    }
    else
    {      
      $this->getUser()->setFlash('error', 'El Tipo de Producto tiene Productos asociados.');
    }

    $this->redirect('@tipo_producto');
  }
}
