<?php

/**
 * Venta filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseVentaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_by'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_by'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'cliente_id'    => new sfWidgetFormPropelChoice(array('model' => 'Cliente', 'add_empty' => true)),
      'sucursal_id'   => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => true)),
      'medio_pago_id' => new sfWidgetFormPropelChoice(array('model' => 'MedioPago', 'add_empty' => true)),
      'es_finalizado' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'es_activo'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_by'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_by'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'cliente_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Cliente', 'column' => 'id')),
      'sucursal_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Sucursal', 'column' => 'id')),
      'medio_pago_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MedioPago', 'column' => 'id')),
      'es_finalizado' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'es_activo'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('venta_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Venta';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'created_at'    => 'Date',
      'created_by'    => 'ForeignKey',
      'updated_at'    => 'Date',
      'updated_by'    => 'ForeignKey',
      'cliente_id'    => 'ForeignKey',
      'sucursal_id'   => 'ForeignKey',
      'medio_pago_id' => 'ForeignKey',
      'es_finalizado' => 'Boolean',
      'es_activo'     => 'Boolean',
    );
  }
}
