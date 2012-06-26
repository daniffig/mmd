<?php

/**
 * Producto form base class.
 *
 * @method Producto getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     dvorak
 */
abstract class BaseProductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'es_activo'        => new sfWidgetFormInputCheckbox(),
      'tipo_producto_id' => new sfWidgetFormPropelChoice(array('model' => 'TipoProducto', 'add_empty' => false)),
      'marca_id'         => new sfWidgetFormPropelChoice(array('model' => 'Marca', 'add_empty' => false)),
      'modelo'           => new sfWidgetFormInputText(),
      'precio'           => new sfWidgetFormInputText(),
      'descripcion'      => new sfWidgetFormTextarea(),
      'stock_minimo'     => new sfWidgetFormInputText(),
      'imagen'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'es_activo'        => new sfValidatorBoolean(array('required' => false)),
      'tipo_producto_id' => new sfValidatorPropelChoice(array('model' => 'TipoProducto', 'column' => 'id')),
      'marca_id'         => new sfValidatorPropelChoice(array('model' => 'Marca', 'column' => 'id')),
      'modelo'           => new sfValidatorString(array('max_length' => 255)),
      'precio'           => new sfValidatorNumber(),
      'descripcion'      => new sfValidatorString(array('required' => false)),
      'stock_minimo'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'imagen'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Producto', 'column' => array('marca_id', 'modelo')))
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
