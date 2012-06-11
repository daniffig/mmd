<?php

/**
 * Venta filter form.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
class VentaFormFilter extends BaseVentaFormFilter
{
  public function configure()
  {
    $this->setWidget('cliente_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Cliente', 'peer_method' => 'doSelectValidos', 'add_empty' => true)));

    $this->setWidget('medio_pago_id', new dcWidgetFormPropelChosenChoice(array('model' => 'MedioPago', 'peer_method' => 'doSelectValidos', 'add_empty' => true)));
  }
}
