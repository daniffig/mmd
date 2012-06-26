<?php

/**
 * Sucursal filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     dvorak
 */
abstract class BaseSucursalFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'domicilio' => new sfWidgetFormFilterInput(),
      'telefono'  => new sfWidgetFormFilterInput(),
      'es_activo' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'nombre'    => new sfValidatorPass(array('required' => false)),
      'domicilio' => new sfValidatorPass(array('required' => false)),
      'telefono'  => new sfValidatorPass(array('required' => false)),
      'es_activo' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('sucursal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sucursal';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'nombre'    => 'Text',
      'domicilio' => 'Text',
      'telefono'  => 'Text',
      'es_activo' => 'Boolean',
    );
  }
}
