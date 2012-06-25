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
    
    $usuario = sfContext::getInstance()->getUser();
    if (!$producto = $this->getObject()->getProducto())
    {
      $producto = ProductoPeer::retrieveByPk($usuario->getAttribute('tmp_producto_id'));
    }

    $stock_disponible = $producto->getStockEnSucursalActiva();

    $this->getWidget('cantidad')->setAttribute('class', 'numeric');

    $this->getWidgetSchema()->setHelp('cantidad', 'Stock disponible: ' . $stock_disponible);

    $this->setValidator('cantidad', new sfValidatorInteger(array('min' => 1, 'max' => $stock_disponible), array('min' => 'Debe agregar como mínimo una unidad.', 'max' => 'No hay stock suficiente.')));
  }
}
