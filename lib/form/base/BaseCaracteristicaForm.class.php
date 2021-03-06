<?php

/**
 * Caracteristica form base class.
 *
 * @method Caracteristica getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     dvorak
 */
abstract class BaseCaracteristicaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'tipo_producto_id' => new sfWidgetFormPropelChoice(array('model' => 'TipoProducto', 'add_empty' => false)),
      'nombre'           => new sfWidgetFormInputText(),
      'es_activo'        => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'tipo_producto_id' => new sfValidatorPropelChoice(array('model' => 'TipoProducto', 'column' => 'id')),
      'nombre'           => new sfValidatorString(array('max_length' => 255)),
      'es_activo'        => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Caracteristica', 'column' => array('nombre')))
    );

    $this->widgetSchema->setNameFormat('caracteristica[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Caracteristica';
  }


}
