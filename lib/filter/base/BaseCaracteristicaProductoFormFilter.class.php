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
    ));

    $this->setValidators(array(
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
      'producto_id'       => 'ForeignKey',
      'caracteristica_id' => 'ForeignKey',
    );
  }
}
