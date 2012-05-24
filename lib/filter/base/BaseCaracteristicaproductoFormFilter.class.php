<?php

/**
 * Caracteristicaproducto filter form base class.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCaracteristicaproductoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('caracteristicaproducto_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Caracteristicaproducto';
  }

  public function getFields()
  {
    return array(
      'producto_id'       => 'ForeignKey',
      'caracteristica_id' => 'ForeignKey',
    );
  }
}
