<?php

/**
 * Producto filter form.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
class ProductoFormFilterVentas extends BaseProductoFormFilter
{
  public function configure()
  {
    $usuario = sfContext::getInstance()->getUser()->getGuardUser();

    $this->setWidget('tipo_producto_id', new dcWidgetFormPropelChosenChoice(array('model' => 'TipoProducto', 'add_empty' => true, 'peer_method' => 'doSelectActivos', 'order_by' => array('Nombre', 'asc'))));

    $this->setWidget('marca_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Marca', 'add_empty' => true, 'peer_method' => 'doSelectActivos', 'order_by' => array('Nombre', 'asc'))));

    $this->setWidget('precio', new sfWidgetFormInputHidden());

    $this->getWidget('modelo')->setOption('with_empty', false);
    $this->getWidget('descripcion')->setOption('with_empty', false);

    $this->setWidget('stock_minimo', new sfWidgetFormInputHidden());
    $this->setWidget('imagen', new sfWidgetFormInputHidden());
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());

    // Validaciones
    $this->setValidator('precio', new pmValidatorInputRange(array('required' => false, 'from_validator' => new sfValidatorNumber(), 'to_validator' => new sfValidatorNumber())));
  }
}
