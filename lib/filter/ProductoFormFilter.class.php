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
    $this->setWidget('marca_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Marca', 'add_empty' => true, 'peer_method' => 'doSelectActivos', 'order_by' => array('Nombre', 'asc'))));

    $this->getWidget('modelo')->setOption('with_empty', false);
    $this->getWidget('descripcion')->setOption('with_empty', false);
  }
}
