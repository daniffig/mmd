<?php

/**
 * ProductoVenta form base class.
 *
 * @method ProductoVenta getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProductoVentaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'producto_id'     => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => false)),
      'venta_id'        => new sfWidgetFormPropelChoice(array('model' => 'Venta', 'add_empty' => false)),
      'precio_unitario' => new sfWidgetFormInputText(),
      'cantidad'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'producto_id'     => new sfValidatorPropelChoice(array('model' => 'Producto', 'column' => 'id')),
      'venta_id'        => new sfValidatorPropelChoice(array('model' => 'Venta', 'column' => 'id')),
      'precio_unitario' => new sfValidatorNumber(),
      'cantidad'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('producto_venta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ProductoVenta';
  }


}
