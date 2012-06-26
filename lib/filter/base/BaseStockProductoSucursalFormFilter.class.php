<?php

/**
 * StockProductoSucursal filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     dvorak
 */
abstract class BaseStockProductoSucursalFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_by'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_by'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'producto_id' => new sfWidgetFormPropelChoice(array('model' => 'Producto', 'add_empty' => true)),
      'sucursal_id' => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => true)),
      'cantidad'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_by'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_by'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'producto_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Producto', 'column' => 'id')),
      'sucursal_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Sucursal', 'column' => 'id')),
      'cantidad'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('stock_producto_sucursal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StockProductoSucursal';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'created_at'  => 'Date',
      'created_by'  => 'ForeignKey',
      'updated_at'  => 'Date',
      'updated_by'  => 'ForeignKey',
      'producto_id' => 'ForeignKey',
      'sucursal_id' => 'ForeignKey',
      'cantidad'    => 'Number',
    );
  }
}
