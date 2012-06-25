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
    //$this->setWidget('venta_id', new sfWidgetFormInputHidden());
    //$this->setDefault('venta_id', $this->getObject()->getVentaId());

    $this->setDefault('venta_id', $this->getObject()->getVentaId());

    $this->setWidget('venta_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Venta', 'peer_method' => 'doSelectActivos')));


    $this->setWidget('tipo_factura_id', new dcWidgetFormPropelChosenChoice(array('model' => 'TipoFactura', 'peer_method' => 'doSelectActivos')));

    $this->setWidget('situacion_impositiva_id', new dcWidgetFormPropelChosenChoice(array('model' => 'SituacionImpositiva', 'peer_method' => 'doSelectActivos')));

    $this->setWidget('es_activo', new sfWidgetFormInputHidden());

    // Validaciones
    
    $this->setValidator('venta_id', new sfValidatorPass());
  }
}
