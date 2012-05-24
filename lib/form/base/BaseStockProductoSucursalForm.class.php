<?php

/**
 * StockProductoSucursal form base class.
 *
 * @method StockProductoSucursal getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStockProductoSucursalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'producto_id' => new sfWidgetFormInputHidden(),
      'sucursal_id' => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => false)),
      'cantidad'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'producto_id' => new sfValidatorPropelChoice(array('model' => 'Producto', 'column' => 'id', 'required' => false)),
      'sucursal_id' => new sfValidatorPropelChoice(array('model' => 'Sucursal', 'column' => 'id')),
      'cantidad'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('stock_producto_sucursal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StockProductoSucursal';
  }


}
