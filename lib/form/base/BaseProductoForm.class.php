<?php

/**
 * Producto form base class.
 *
 * @method Producto getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseProductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'tipo_producto_id' => new sfWidgetFormPropelChoice(array('model' => 'TipoProducto', 'add_empty' => true)),
      'marca_id'         => new sfWidgetFormPropelChoice(array('model' => 'Marca', 'add_empty' => false)),
      'modelo'           => new sfWidgetFormInputText(),
      'precio'           => new sfWidgetFormInputText(),
      'descripcion'      => new sfWidgetFormTextarea(),
      'es_activo'        => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'tipo_producto_id' => new sfValidatorPropelChoice(array('model' => 'TipoProducto', 'column' => 'id', 'required' => false)),
      'marca_id'         => new sfValidatorPropelChoice(array('model' => 'Marca', 'column' => 'id')),
      'modelo'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'precio'           => new sfValidatorNumber(),
      'descripcion'      => new sfValidatorString(array('required' => false)),
      'es_activo'        => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Producto', 'column' => array('modelo')))
    );

    $this->widgetSchema->setNameFormat('producto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producto';
  }


}
