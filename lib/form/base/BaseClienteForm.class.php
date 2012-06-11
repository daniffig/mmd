<?php

/**
 * Cliente form base class.
 *
 * @method Cliente getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseClienteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'tipo_documento_id' => new sfWidgetFormPropelChoice(array('model' => 'TipoDocumento', 'add_empty' => false)),
      'nro_documento'     => new sfWidgetFormInputText(),
      'apellido'          => new sfWidgetFormInputText(),
      'nombre'            => new sfWidgetFormInputText(),
      'telefono'          => new sfWidgetFormInputText(),
      'direccion'         => new sfWidgetFormInputText(),
      'cuit'              => new sfWidgetFormInputText(),
      'es_activo'         => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'tipo_documento_id' => new sfValidatorPropelChoice(array('model' => 'TipoDocumento', 'column' => 'id')),
      'nro_documento'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'apellido'          => new sfValidatorString(array('max_length' => 255)),
      'nombre'            => new sfValidatorString(array('max_length' => 255)),
      'telefono'          => new sfValidatorString(array('max_length' => 255)),
      'direccion'         => new sfValidatorString(array('max_length' => 255)),
      'cuit'              => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'es_activo'         => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Cliente', 'column' => array('nro_documento'))),
        new sfValidatorPropelUnique(array('model' => 'Cliente', 'column' => array('cuit'))),
      ))
    );

    $this->widgetSchema->setNameFormat('cliente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cliente';
  }


}
