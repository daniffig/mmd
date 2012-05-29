<?php

/**
 * Caracteristica filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCaracteristicaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipo_id'   => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
      'nombre'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'es_activo' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'tipo_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Tipo', 'column' => 'id')),
      'nombre'    => new sfValidatorPass(array('required' => false)),
      'es_activo' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('caracteristica_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Caracteristica';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'tipo_id'   => 'ForeignKey',
      'nombre'    => 'Text',
      'es_activo' => 'Boolean',
    );
  }
}
