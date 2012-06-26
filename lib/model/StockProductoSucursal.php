<?php


/**
 * Skeleton subclass for representing a row from the 'stock_producto_sucursal' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu May 24 03:14:37 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class StockProductoSucursal extends BaseStockProductoSucursal {

  public function canEdit()
  {
    return $this->getProducto()->getEsActivo();
  }
} // StockProductoSucursal
