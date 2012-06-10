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
      'tipo_id'     => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
      'marca_id'    => new sfWidgetFormPropelChoice(array('model' => 'Marca', 'add_empty' => true)),
      'modelo'      => new sfWidgetFormFilterInput(),
      'precio'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion' => new sfWidgetFormFilterInput(),
      'es_activo'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'tipo_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Tipo', 'column' => 'id')),
      'marca_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Marca', 'column' => 'id')),
      'modelo'      => new sfValidatorPass(array('required' => false)),
      'precio'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'descripcion' => new sfValidatorPass(array('required' => false)),
      'es_activo'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
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
      'id'          => 'Number',
      'tipo_id'     => 'ForeignKey',
      'marca_id'    => 'ForeignKey',
      'modelo'      => 'Text',
      'precio'      => 'Number',
      'descripcion' => 'Text',
      'es_activo'   => 'Boolean',
    );
  }
}
