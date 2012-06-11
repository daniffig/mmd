<?php

require_once dirname(__FILE__).'/../lib/producto_ventaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/producto_ventaGeneratorHelper.class.php';

/**
 * producto_venta actions.
 *
 * @package    mmd
 * @subpackage producto_venta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class producto_ventaActions extends autoProducto_ventaActions
{
  public function executeNew(sfWebRequest $request)
  {
    $producto = ProductoPeer::retrieveByPk($request->getParameter('producto_id'));

    if ($this->ProductoVenta)
    {
      $this->ProductoVenta = $this->form->getObject();
    }
    else
    {
      $this->ProductoVenta = new ProductoVenta();
    }

    $this->ProductoVenta->setProducto($producto);
    $this->ProductoVenta->setVentaId($this->getUser()->getVenta()->getId());
    $this->ProductoVenta->setPrecioUnitario($producto->getPrecio());


    if ($this->form)
    {
      $this->form = $this->configuration->getForm();
    }
    else
    {
      $this->form = new ProductoVentaForm($this->ProductoVenta);
    }    
  }

  public function executeAgregarProducto()
  {
    $this->redirect('@producto');
  }
}
