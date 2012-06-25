<?php

/**
 * Cliente filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseClienteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'tipo_documento_id' => new sfWidgetFormPropelChoice(array('model' => 'TipoDocumento', 'add_empty' => true)),
      'nro_documento'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellido'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono'          => new sfWidgetFormFilterInput(),
      'direccion'         => new sfWidgetFormFilterInput(),
      'cuit'              => new sfWidgetFormFilterInput(),
      'es_activo'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'tipo_documento_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TipoDocumento', 'column' => 'id')),
      'nro_documento'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'apellido'          => new sfValidatorPass(array('required' => false)),
      'nombre'            => new sfValidatorPass(array('required' => false)),
      'telefono'          => new sfValidatorPass(array('required' => false)),
      'direccion'         => new sfValidatorPass(array('required' => false)),
      'cuit'              => new sfValidatorPass(array('required' => false)),
      'es_activo'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('cliente_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cliente';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'tipo_documento_id' => 'ForeignKey',
      'nro_documento'     => 'Number',
      'apellido'          => 'Text',
      'nombre'            => 'Text',
      'telefono'          => 'Text',
      'direccion'         => 'Text',
      'cuit'              => 'Text',
      'es_activo'         => 'Boolean',
    );
  }
}
