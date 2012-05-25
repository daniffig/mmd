<?php

/**
 * TipoProducto filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTipoProductoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id' => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => true)),
      'tipo_id'     => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'producto_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Producto', 'column' => 'id')),
      'tipo_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Tipo', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tipo_producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoProducto';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'producto_id' => 'ForeignKey',
      'tipo_id'     => 'ForeignKey',
    );
  }
}
