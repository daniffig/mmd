<?php

/**
 * Venta form base class.
 *
 * @method Venta getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseVentaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'fecha'         => new sfWidgetFormDate(),
      'created_at'    => new sfWidgetFormDateTime(),
      'created_by'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'updated_at'    => new sfWidgetFormDateTime(),
      'updated_by'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'sucursal_id'   => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => true)),
      'medio_pago_id' => new sfWidgetFormPropelChoice(array('model' => 'MedioPago', 'add_empty' => false)),
      'es_finalizado' => new sfWidgetFormInputCheckbox(),
      'es_activo'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'fecha'         => new sfValidatorDate(),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'created_by'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_by'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'sucursal_id'   => new sfValidatorPropelChoice(array('model' => 'Sucursal', 'column' => 'id', 'required' => false)),
      'medio_pago_id' => new sfValidatorPropelChoice(array('model' => 'MedioPago', 'column' => 'id')),
      'es_finalizado' => new sfValidatorBoolean(),
      'es_activo'     => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('venta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Venta';
  }


}
