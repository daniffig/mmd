<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     dvorak
 */
abstract class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'nombre'      => new sfWidgetFormInputText(),
      'apellido'    => new sfWidgetFormInputText(),
      'email'       => new sfWidgetFormInputText(),
      'sucursal_id' => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'nombre'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'apellido'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'sucursal_id' => new sfValidatorPropelChoice(array('model' => 'Sucursal', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }


}
