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
    ));

    $this->setValidators(array(
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
      'producto_id' => 'ForeignKey',
      'tipo_id'     => 'ForeignKey',
    );
  }
}
