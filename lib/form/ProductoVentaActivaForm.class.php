<?php

/**
 * ProductoVenta form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class ProductoVentaActivaForm extends BaseProductoVentaForm
{
  public function configure()
  {
    //$this->setWidget('producto_id', new sfWidgetFormInputHidden());
    $this->setDefault('producto_id', $this->getValue('producto_id'));

    //$this->setWidget('venta_id', new sfWidgetFormInputHidden());
    //$this->setDefault('venta_id', $this->getValue('venta_id'));

    //$this->setWidget('precio_unitario', new sfWidgetFormInputHidden());
    $this->setDefault('precio_unitario', $this->getValue('precio_unitario'));

    //$stock_disponible = 'Stock disponible: ' . $this->getObject()->getProducto()->getStockEnSucursalActiva(); 

    //$this->getWidgetSchema()->setHelp('cantidad', $stock_disponible);
  }
}
