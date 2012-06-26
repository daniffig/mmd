<?php

/**
 * TipoProducto filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     dvorak
 */
abstract class BaseTipoProductoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'categoria_id' => new sfWidgetFormPropelChoice(array('model' => 'Categoria', 'add_empty' => true)),
      'nombre'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'es_activo'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'categoria_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Categoria', 'column' => 'id')),
      'nombre'       => new sfValidatorPass(array('required' => false)),
      'es_activo'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('tipo_producto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoProducto';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'categoria_id' => 'ForeignKey',
      'nombre'       => 'Text',
      'es_activo'    => 'Boolean',
    );
  }
}
