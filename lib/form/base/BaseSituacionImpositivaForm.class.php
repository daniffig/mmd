<?php

/**
 * SituacionImpositiva form base class.
 *
 * @method SituacionImpositiva getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     dvorak
 */
abstract class BaseSituacionImpositivaForm extends BaseFormPropel
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
      new sfValidatorPropelUnique(array('model' => 'SituacionImpositiva', 'column' => array('nombre')))
    );

    $this->widgetSchema->setNameFormat('situacion_impositiva[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SituacionImpositiva';
  }


}
