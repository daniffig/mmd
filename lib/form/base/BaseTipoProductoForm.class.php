<?php

/**
 * TipoProducto form base class.
 *
 * @method TipoProducto getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTipoProductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id' => new sfWidgetFormInputHidden(),
      'tipo_id'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'producto_id' => new sfValidatorPropelChoice(array('model' => 'Producto', 'column' => 'id', 'required' => false)),
      'tipo_id'     => new sfValidatorPropelChoice(array('model' => 'Tipo', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tipo_producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoProducto';
  }


}
