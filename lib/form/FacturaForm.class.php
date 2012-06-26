<?php

/**
 * Factura form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class FacturaForm extends BaseFacturaForm
{
  public function configure()
  {
    // Widgets
    $this->setWidget('venta_id', new sfWidgetFormInputHidden());

    $this->setWidget('tipo_factura_id', new dcWidgetFormPropelChosenChoice(array('model' => 'TipoFactura', 'peer_method' => 'doSelectActivos')));

    $this->setWidget('nro_factura', new sfWidgetFormInputHidden());

    $this->setWidget('situacion_impositiva_id', new dcWidgetFormPropelChosenChoice(array('model' => 'SituacionImpositiva', 'peer_method' => 'doSelectActivos')));
  }
}
