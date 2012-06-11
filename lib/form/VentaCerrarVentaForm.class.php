<?php

/**
 * Venta form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class VentaCerrarVentaForm extends BaseVentaForm
{
  public function configure()
  {
    $this->setWidget('created_at', new sfWidgetFormInputHidden());
    $this->setWidget('created_by', new sfWidgetFormInputHidden());
    $this->setWidget('updated_at', new sfWidgetFormInputHidden());
    $this->setWidget('updated_by', new sfWidgetFormInputHidden());

    $this->setWidget('cliente_id', new sfWidgetFormPropelChoice(array('model' => 'Cliente', 'peer_method' => 'doSelectValidos')));

    $this->setWidget('medio_pago_id', new sfWidgetFormPropelChoice(array('model' => 'MedioPago', 'peer_method' => 'doSelectValidos')));

    $this->setWidget('sucursal_id', new sfWidgetFormInputHidden());

    $this->setWidget('es_finalizado', new sfWidgetFormInputHidden());
    $this->setDefault('es_finalizado', true);

    $this->setWidget('es_activo', new sfWidgetFormInputHidden());
  }
}
