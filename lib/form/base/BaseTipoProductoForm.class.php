<?php

/**
 * TipoProducto form base class.
 *
 * @method TipoProducto getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     dvorak
 */
abstract class BaseTipoProductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'categoria_id' => new sfWidgetFormPropelChoice(array('model' => 'Categoria', 'add_empty' => true)),
      'nombre'       => new sfWidgetFormInputText(),
      'es_activo'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'categoria_id' => new sfValidatorPropelChoice(array('model' => 'Categoria', 'column' => 'id', 'required' => false)),
      'nombre'       => new sfValidatorString(array('max_length' => 255)),
      'es_activo'    => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'TipoProducto', 'column' => array('nombre')))
    );

    $this->widgetSchema->setNameFormat('tipo_producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoProducto';
  }


}
