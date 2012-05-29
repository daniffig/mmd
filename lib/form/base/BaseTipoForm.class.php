<?php

/**
 * Tipo form base class.
 *
 * @method Tipo getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTipoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'nombre'        => new sfWidgetFormInputText(),
      'tipo_padre_id' => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
      'es_activo'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'nombre'        => new sfValidatorString(array('max_length' => 255)),
      'tipo_padre_id' => new sfValidatorPropelChoice(array('model' => 'Tipo', 'column' => 'id', 'required' => false)),
      'es_activo'     => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Tipo', 'column' => array('nombre')))
    );

    $this->widgetSchema->setNameFormat('tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tipo';
  }


}
