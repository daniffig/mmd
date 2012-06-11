<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sf_guard_user_id' => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'nombre'           => new sfWidgetFormFilterInput(),
      'apellido'         => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'sf_guard_user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'nombre'           => new sfValidatorPass(array('required' => false)),
      'apellido'         => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
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
      'id'               => 'Number',
      'sf_guard_user_id' => 'ForeignKey',
      'nombre'           => 'Text',
      'apellido'         => 'Text',
      'email'            => 'Text',
    );
  }
}
