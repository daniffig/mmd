<?php

/**
 * CaracteristicaProducto form base class.
 *
 * @method CaracteristicaProducto getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     dvorak
 */
abstract class BaseCaracteristicaProductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'producto_id'       => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => false)),
      'caracteristica_id' => new sfWidgetFormPropelChoice(array('model' => 'Caracteristica', 'add_empty' => false)),
      'es_activo'         => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'producto_id'       => new sfValidatorPropelChoice(array('model' => 'Producto', 'column' => 'id')),
      'caracteristica_id' => new sfValidatorPropelChoice(array('model' => 'Caracteristica', 'column' => 'id')),
      'es_activo'         => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('caracteristica_producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CaracteristicaProducto';
  }


}
