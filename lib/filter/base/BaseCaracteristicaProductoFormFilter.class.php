<?php

/**
 * CaracteristicaProducto filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCaracteristicaProductoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id'       => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => true)),
      'caracteristica_id' => new sfWidgetFormPropelChoice(array('model' => 'Caracteristica', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'producto_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Producto', 'column' => 'id')),
      'caracteristica_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Caracteristica', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('caracteristica_producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CaracteristicaProducto';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'producto_id'       => 'ForeignKey',
      'caracteristica_id' => 'ForeignKey',
    );
  }
}
