<?php

/**
 * Caracteristica filter form.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
class CaracteristicaFormFilter extends BaseCaracteristicaFormFilter
{
  public function configure()
  {
    $this->setWidget('tipo_producto_id', new dcWidgetFormPropelChosenChoice(array('model' => 'TipoProducto', 'peer_method' => 'doSelectActivos', 'add_empty' => true)));
  }
}
