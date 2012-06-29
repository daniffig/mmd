<?php

require_once dirname(__FILE__).'/../lib/sucursalGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sucursalGeneratorHelper.class.php';

/**
 * sucursal actions.
 *
 * @package    mmd
 * @subpackage sucursal
 * @author     dvorak
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class sucursalActions extends autoSucursalActions
{
  // Acciones
  public function executeVerStock(sfWebRequest $request)
  {
    $sucursal = $this->getRoute()->getObject();

    $this->redirect('stock_producto_sucursal/verStockPorSucursal?sucursal_id=' . $sucursal->getId());
  }

  // Métodos reimplementados

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'Se agregó la Sucursal exitosamente.' : 'Se actualizó la Sucursal exitosamente.';

      $esNuevo = $form->getObject()->isNew();

      $Sucursal = $form->save();

      if ($esNuevo)
      {
        $productos = ProductoPeer::doSelect(new Criteria());

        foreach ($productos as $producto)
        {
          $stock_producto_sucursal = new StockProductoSucursal();

          $stock_producto_sucursal->setCreatedBy($this->getUser()->getGuardUser());
          $stock_producto_sucursal->setProducto($producto);
          $stock_producto_sucursal->setSucursal($Sucursal);
          $stock_producto_sucursal->setStockActual(0);

          $stock_producto_sucursal->save();
        }
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Sucursal)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' Puede agregar una nueva Sucursal a continuación.');

        $this->redirect('@sucursal_new');
      }
      else if ($request->hasParameter('_save_and_list'))
      {
        $this->getUser()->setFlash('notice', $notice);
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@sucursal');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'La Sucursal no fue guardada debido a algunos errores.', false);
    }
  }
}
