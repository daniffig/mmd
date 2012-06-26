<?php

/**
 * CaracteristicaProducto filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     dvorak
 */
abstract class BaseCaracteristicaProductoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id'       => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => true)),
      'caracteristica_id' => new sfWidgetFormPropelChoice(array('model' => 'Caracteristica', 'add_empty' => true)),
      'es_activo'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'producto_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Producto', 'column' => 'id')),
      'caracteristica_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Caracteristica', 'column' => 'id')),
      'es_activo'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
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
      'es_activo'         => 'Boolean',
    );
  }
}
