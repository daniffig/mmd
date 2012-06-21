<?php

/**
 * Producto filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseProductoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'es_activo'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tipo_producto_id' => new sfWidgetFormPropelChoice(array('model' => 'TipoProducto', 'add_empty' => true)),
      'marca_id'         => new sfWidgetFormPropelChoice(array('model' => 'Marca', 'add_empty' => true)),
      'modelo'           => new sfWidgetFormFilterInput(),
      'precio'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'      => new sfWidgetFormFilterInput(),
      'stock_minimo'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'imagen'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'es_activo'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tipo_producto_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TipoProducto', 'column' => 'id')),
      'marca_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Marca', 'column' => 'id')),
      'modelo'           => new sfValidatorPass(array('required' => false)),
      'precio'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'descripcion'      => new sfValidatorPass(array('required' => false)),
      'stock_minimo'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'imagen'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Producto';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'es_activo'        => 'Boolean',
      'tipo_producto_id' => 'ForeignKey',
      'marca_id'         => 'ForeignKey',
      'modelo'           => 'Text',
      'precio'           => 'Number',
      'descripcion'      => 'Text',
      'stock_minimo'     => 'Number',
      'imagen'           => 'Text',
    );
  }
}
