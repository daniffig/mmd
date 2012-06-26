<?php

/**
 * Producto filter form.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
class ProductoFormFilter extends BaseProductoFormFilter
{
  public function configure()
  {
    $usuario = sfContext::getInstance()->getUser()->getGuardUser();

    $this->setWidget('tipo_producto_id', new dcWidgetFormPropelChosenChoice(array('model' => 'TipoProducto', 'add_empty' => true, 'peer_method' => 'doSelectActivos', 'order_by' => array('Nombre', 'asc'))));

    $this->setWidget('marca_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Marca', 'add_empty' => true, 'peer_method' => 'doSelectActivos', 'order_by' => array('Nombre', 'asc'))));

    //$this->setWidget('precio', new pmWidgetFormInputRange(array('from_input' => new sfWidgetFormInputText(), 'to_input' => new sfWidgetFormInputText(), 'template' => 'desde %from_input% hasta %to_input%')));

    $this->setWidget('precio', new sfWidgetFormInputHidden());

    $this->getWidget('modelo')->setOption('with_empty', false);
    $this->getWidget('descripcion')->setOption('with_empty', false);

    $this->getWidget('stock_minimo')->setAttribute('class', 'numeric');

    $this->setWidget('imagen', new sfWidgetFormInputHidden());

    // Validaciones
    $this->setValidator('precio', new pmValidatorInputRange(array('required' => false, 'from_validator' => new sfValidatorNumber(), 'to_validator' => new sfValidatorNumber())));
  }
}
