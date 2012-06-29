<?php

require_once dirname(__FILE__).'/../lib/stock_producto_sucursalGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/stock_producto_sucursalGeneratorHelper.class.php';

/**
 * stock_producto_sucursal actions.
 *
 * @package    mmd
 * @subpackage stock_producto_sucursal
 * @author     dvorak
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class stock_producto_sucursalActions extends autoStock_producto_sucursalActions
{
  // Acciones
  public function executeVerProducto(sfWebRequest $request)
  {
    $stock_producto_sucursal = $this->getRoute()->getObject();

    $this->redirect('producto/show?id=' . $stock_producto_sucursal->getProductoId());
  }

  // Filtros
  public function executeVerStock(sfWebRequest $request)
  {
    $filtros = $this->configuration->getFilterDefaults();

    $this->getUser()->setAttribute('stock_producto_sucursal.filters', $filtros, 'admin_module');

    $this->redirect('@stock_producto_sucursal');
  }

  public function executeVerStockPorProducto(sfWebRequest $request)
  {
    $filtros = $this->configuration->getFilterDefaults();

    $filtros['producto_id'] = $request->getParameter('producto_id');

    $this->getUser()->setAttribute('stock_producto_sucursal.filters', $filtros, 'admin_module');

    $this->redirect('@stock_producto_sucursal');
  }

  public function executeVerStockPorSucursal(sfWebRequest $request)
  {
    $filtros = $this->configuration->getFilterDefaults();

    $filtros['sucursal_id'] = $request->getParameter('sucursal_id');

    $this->getUser()->setAttribute('stock_producto_sucursal.filters', $filtros, 'admin_module');

    $this->redirect('@stock_producto_sucursal');
  }

  // Métodos reimplementados
}
