<?php

/**
 * Factura form base class.
 *
 * @method Factura getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     dvorak
 */
abstract class BaseFacturaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'venta_id'                => new sfWidgetFormPropelChoice(array('model' => 'Venta', 'add_empty' => false)),
      'tipo_factura_id'         => new sfWidgetFormPropelChoice(array('model' => 'TipoFactura', 'add_empty' => false)),
      'nro_factura'             => new sfWidgetFormInputText(),
      'situacion_impositiva_id' => new sfWidgetFormPropelChoice(array('model' => 'SituacionImpositiva', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'venta_id'                => new sfValidatorPropelChoice(array('model' => 'Venta', 'column' => 'id')),
      'tipo_factura_id'         => new sfValidatorPropelChoice(array('model' => 'TipoFactura', 'column' => 'id')),
      'nro_factura'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'situacion_impositiva_id' => new sfValidatorPropelChoice(array('model' => 'SituacionImpositiva', 'column' => 'id')),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Factura', 'column' => array('tipo_factura_id', 'nro_factura')))
    );

    $this->widgetSchema->setNameFormat('factura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Factura';
  }


}
