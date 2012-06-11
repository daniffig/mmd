<?php

/**
 * ProductoVenta filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
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
      'es_activo'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'producto_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Producto', 'column' => 'id')),
      'venta_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Venta', 'column' => 'id')),
      'precio_unitario' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cantidad'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'es_activo'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
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
      'es_activo'       => 'Boolean',
    );
  }
}
