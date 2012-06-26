<?php

/**
 * ProductoVenta filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     dvorak
 */
abstract class BaseProductoVentaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id'     => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => true)),
      'venta_id'        => new sfWidgetFormPropelChoice(array('model' => 'Venta', 'add_empty' => true)),
      'precio_unitario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'producto_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Producto', 'column' => 'id')),
      'venta_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Venta', 'column' => 'id')),
      'precio_unitario' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('producto_venta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductoVenta';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'producto_id'     => 'ForeignKey',
      'venta_id'        => 'ForeignKey',
      'precio_unitario' => 'Number',
      'cantidad'        => 'Number',
    );
  }
}
