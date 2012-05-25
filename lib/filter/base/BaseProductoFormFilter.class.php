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
      'marca_id'    => new sfWidgetFormPropelChoice(array('model' => 'Marca', 'add_empty' => true)),
      'modelo'      => new sfWidgetFormFilterInput(),
      'precio'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'marca_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Marca', 'column' => 'id')),
      'modelo'      => new sfValidatorPass(array('required' => false)),
      'precio'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'descripcion' => new sfValidatorPass(array('required' => false)),
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
      'marca_id'    => 'ForeignKey',
      'modelo'      => 'Text',
      'precio'      => 'Number',
      'descripcion' => 'Text',
    );
  }
}
