<?php

/**
 * Caracteristicaproducto form base class.
 *
 * @method Caracteristicaproducto getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCaracteristicaproductoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'producto_id'       => new sfWidgetFormInputHidden(),
      'caracteristica_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'producto_id'       => new sfValidatorPropelChoice(array('model' => 'Producto', 'column' => 'id', 'required' => false)),
      'caracteristica_id' => new sfValidatorPropelChoice(array('model' => 'Caracteristica', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('caracteristicaproducto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Caracteristicaproducto';
  }


}
