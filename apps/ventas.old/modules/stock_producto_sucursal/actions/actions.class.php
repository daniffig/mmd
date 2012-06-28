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
  public function executeImprimirReporteStockMinimo(sfWebRequest $request)
  {
    $usuario = $this->getUser();

    $criteria = new Criteria();
    
    if (!$usuario->hasCredential('reportarStockMinimoTodos'))
    {
      $criteria->add(StockProductoSucursalPeer::SUCURSAL_ID, $usuario->getGuardUser()->getSucursalId());
    }

    $stocks_producto_sucursal = StockProductoSucursalPeer::doSelect($criteria);

    $this->StockMinimoProductosSucursal = array();

    foreach($stocks_producto_sucursal as $stock_producto_sucursal)
    {
      if ($stock_producto_sucursal->getCantidad() <= $stock_producto_sucursal->getProducto()->getStockMinimo())
      {
        $this->StockMinimoProductosSucursal[] = $stock_producto_sucursal;
      }
    }

    $this->setLayout(false);
  }

  /*public function executeReportarStockMinimo(sfWebRequest $request)
  {
    //$this->Pago = $this->getRoute()->getObject();

    $this->redirect('stock_producto_sucursal/imprimirReporteStockMinimo', array('sf_format' => 'pdf'));
  }*/
}
