<?php

/**
 * Factura form base class.
 *
 * @method Factura getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseFacturaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'venta_id'                => new sfWidgetFormPropelChoice(array('model' => 'Venta', 'add_empty' => false)),
      'tipo_factura_id'         => new sfWidgetFormPropelChoice(array('model' => 'TipoFactura', 'add_empty' => false)),
      'situacion_impositiva_id' => new sfWidgetFormPropelChoice(array('model' => 'SituacionImpositiva', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'venta_id'                => new sfValidatorPropelChoice(array('model' => 'Venta', 'column' => 'id')),
      'tipo_factura_id'         => new sfValidatorPropelChoice(array('model' => 'TipoFactura', 'column' => 'id')),
      'situacion_impositiva_id' => new sfValidatorPropelChoice(array('model' => 'SituacionImpositiva', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('factura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Factura';
  }


}
