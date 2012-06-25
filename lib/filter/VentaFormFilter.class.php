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
    $this->setWidget('created_at', new pmWidgetFormInputRange(array('from_input' => new mtWidgetFormInputDate(array('locale' => 'es', 'own_help' => null)), 'to_input' => new mtWidgetFormInputDate(array('locale' => 'es', 'own_help' => null)), 'template' => 'desde %from_input% hasta %to_input%')));

    $this->setWidget('cliente_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Cliente', 'peer_method' => 'doSelectActivos', 'add_empty' => true)));

    $this->setWidget('sucursal_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Sucursal', 'peer_method' => 'doSelectActivos', 'add_empty' => true)));

    $this->setWidget('medio_pago_id', new dcWidgetFormPropelChosenChoice(array('model' => 'MedioPago', 'peer_method' => 'doSelectActivos', 'add_empty' => true)));

    // Validaciones
    $this->setValidator('created_at', new pmValidatorInputRange(array('from_validator' => new mtValidatorDateString(), 'to_validator' => new mtValidatorDateString())));
  }
}
