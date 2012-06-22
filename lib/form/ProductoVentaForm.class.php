<?php

/**
 * ProductoVenta form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class ProductoVentaForm extends BaseProductoVentaForm
{
  public function configure()
  {
    $this->setWidget('producto_id', new sfWidgetFormInputHidden());
    $this->setWidget('venta_id', new sfWidgetFormInputHidden());
    $this->setWidget('precio_unitario', new sfWidgetFormInputHidden());

    //$stock_disponible = $this->getObject()->getProducto()->getStockEnSucursalActiva();

    //$this->getWidgetSchema()->setHelp('cantidad', 'Stock disponible: ' . $stock_disponible);

    $this->setValidator('cantidad', new sfValidatorInteger(array('min' => 1, 'max' => '10'), array('min' => 'Debe agregar como mínimo una unidad.', 'max' => 'No hay stock suficiente.')));
  }
}
