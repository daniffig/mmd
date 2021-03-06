<?php

/**
 * TipoDocumento form base class.
 *
 * @method TipoDocumento getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     dvorak
 */
abstract class BaseTipoDocumentoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'nombre'    => new sfWidgetFormInputText(),
      'es_activo' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'nombre'    => new sfValidatorString(array('max_length' => 255)),
      'es_activo' => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'TipoDocumento', 'column' => array('nombre')))
    );

    $this->widgetSchema->setNameFormat('tipo_documento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoDocumento';
  }


}
