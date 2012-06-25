<?php

require_once dirname(__FILE__).'/../lib/stock_producto_sucursalGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stock_producto_sucursalGeneratorHelper.class.php';

/**
 * stock_producto_sucursal actions.
 *
 * @package    mmd
 * @subpackage stock_producto_sucursal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class stock_producto_sucursalActions extends autoStock_producto_sucursalActions
{
  /*public function executeNew(sfWebRequest $request)
  {
    $producto = ProductoPeer::retrieveByPk($request->getParameter('producto_id'));

    $this->getUser()->setAttribute('tmp_producto_id', $producto->getId());

    $ProductoVenta = $this->getUser()->getVenta()->getInstanciaProductoVenta($producto);

    $this->ProductoVenta = $ProductoVenta;

    if (!$this->form = $this->getUser()->getAttribute('form'))
    {
      $this->form = new ProductoVentaForm($ProductoVenta);
    }
    else
    {
      $this->getUser()->setAttribute('form', null);
    }
  }*/

  public function executeAgregarStockProducto(sfWebRequest $request)
  {
    $Producto = ProductoPeer::retrieveByPk($this->getParameter('producto_id'));

    $this->form = new StockProductoSucursalAgregarForm();
    $this->StockProductoSucursal = $this->form->getObject();    
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $StockProductoSucursal = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $StockProductoSucursal)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@stock_producto_sucursal_new');
      }
      else if ($request->hasParameter('_save_and_list'))
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@stock_producto_sucursal');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'stock_producto_sucursal_edit', 'sf_subject' => $StockProductoSucursal));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
