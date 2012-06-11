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
  public function executeAgregarProducto()
  {
    $this->redirect('@producto');
  }

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

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $ProductoVenta = $form->save();

      $venta = $ProductoVenta->getVenta();

      if (($producto_venta_anterior = $venta->getProductoVenta($ProductoVenta)) && $producto_venta_anterior != $ProductoVenta)
      {
        $ProductoVenta->setCantidad($ProductoVenta->getCantidad() + $producto_venta_anterior->getCantidad());

        $producto_venta_anterior->delete();
      }
      
      $ProductoVenta->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $ProductoVenta)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@producto_venta_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@producto_venta');

        // $this->redirect(array('sf_route' => 'producto_venta_edit', 'sf_subject' => $ProductoVenta));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
