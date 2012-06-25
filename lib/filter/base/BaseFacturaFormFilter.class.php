<?php

/**
 * Factura filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseFacturaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'venta_id'                => new sfWidgetFormPropelChoice(array('model' => 'Venta', 'add_empty' => true)),
      'tipo_factura_id'         => new sfWidgetFormPropelChoice(array('model' => 'TipoFactura', 'add_empty' => true)),
      'situacion_impositiva_id' => new sfWidgetFormPropelChoice(array('model' => 'SituacionImpositiva', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'venta_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Venta', 'column' => 'id')),
      'tipo_factura_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TipoFactura', 'column' => 'id')),
      'situacion_impositiva_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'SituacionImpositiva', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('factura_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Factura';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'venta_id'                => 'ForeignKey',
      'tipo_factura_id'         => 'ForeignKey',
      'situacion_impositiva_id' => 'ForeignKey',
    );
  }
}
