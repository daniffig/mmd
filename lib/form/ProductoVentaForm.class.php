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
  }
}
