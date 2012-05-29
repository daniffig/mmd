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
      'id'          => new sfWidgetFormInputHidden(),
      'producto_id' => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => false)),
      'tipo_id'     => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => false)),
      'es_activo'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'producto_id' => new sfValidatorPropelChoice(array('model' => 'Producto', 'column' => 'id')),
      'tipo_id'     => new sfValidatorPropelChoice(array('model' => 'Tipo', 'column' => 'id')),
      'es_activo'   => new sfValidatorBoolean(),
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
