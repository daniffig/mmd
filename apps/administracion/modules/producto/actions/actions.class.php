<?php

require_once dirname(__FILE__).'/../lib/productoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productoGeneratorHelper.class.php';

/**
 * producto actions.
 *
 * @package    mmd
 * @subpackage producto
 * @author     dvorak
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class productoActions extends autoProductoActions
{
  // Acciones
  public function executeVerStock(sfWebRequest $request)
  {
    $producto = $this->getRoute()->getObject();

    $request->setParameter('producto_id', $producto->getId());

    $this->forward('stock_producto_sucursal', 'verStockPorProducto');
  }

  // Métodos reimplementados


  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'Se agregó el Producto exitosamente.' : 'Se actualizó el Producto exitosamente.';

      $esNuevo = $form->getObject()->isNew();

      $Producto = $form->save();

      if ($esNuevo)
      {
        $sucursales = SucursalPeer::doSelect(new Criteria());

        foreach ($sucursales as $sucursal)
        {
          $stock_producto_sucursal = new StockProductoSucursal();

          $stock_producto_sucursal->setCreatedBy($this->getUser()->getGuardUser());
          $stock_producto_sucursal->setProducto($Producto);
          $stock_producto_sucursal->setSucursal($sucursal);
          $stock_producto_sucursal->setStockActual(0);

          $stock_producto_sucursal->save();
        }
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Producto)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' Puede agregar un nuevo Producto a continuación.');

        $this->redirect('@producto_new');
      }
      else if ($request->hasParameter('_save_and_list'))
      {
        $this->getUser()->setFlash('notice', $notice);
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);
      }

      $this->redirect('@producto');
    }
    else
    {
      $this->getUser()->setFlash('error', 'El Producto no fue guardado debido a algunos errores.', false);
    }
  }
}
