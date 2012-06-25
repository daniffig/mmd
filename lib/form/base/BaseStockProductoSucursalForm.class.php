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
      'created_at'  => new sfWidgetFormDateTime(),
      'created_by'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'updated_at'  => new sfWidgetFormDateTime(),
      'updated_by'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'producto_id' => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => false)),
      'sucursal_id' => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => false)),
      'cantidad'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'created_by'  => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_by'  => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'producto_id' => new sfValidatorPropelChoice(array('model' => 'Producto', 'column' => 'id')),
      'sucursal_id' => new sfValidatorPropelChoice(array('model' => 'Sucursal', 'column' => 'id')),
      'cantidad'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'StockProductoSucursal', 'column' => array('producto_id', 'sucursal_id')))
    );

    $this->widgetSchema->setNameFormat('stock_producto_sucursal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StockProductoSucursal';
  }


}
