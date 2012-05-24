<?php

/**
 * Stockproductosucursal filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseStockproductosucursalFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'sucursal_id' => new sfWidgetFormPropelChoice(array('model' => 'Sucursal', 'add_empty' => true)),
      'cantidad'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'sucursal_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Sucursal', 'column' => 'id')),
      'cantidad'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('stockproductosucursal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stockproductosucursal';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'producto_id' => 'ForeignKey',
      'sucursal_id' => 'ForeignKey',
      'cantidad'    => 'Number',
    );
  }
}
