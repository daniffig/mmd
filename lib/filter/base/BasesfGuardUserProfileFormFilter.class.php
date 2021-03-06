<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     dvorak
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'nombre'      => new sfWidgetFormFilterInput(),
      'apellido'    => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'sucursal_id' => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'nombre'      => new sfValidatorPass(array('required' => false)),
      'apellido'    => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'sucursal_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Sucursal', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_id'     => 'ForeignKey',
      'nombre'      => 'Text',
      'apellido'    => 'Text',
      'email'       => 'Text',
      'sucursal_id' => 'ForeignKey',
    );
  }
}
