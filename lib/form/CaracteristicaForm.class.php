<?php

/**
 * Caracteristica form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class CaracteristicaForm extends BaseCaracteristicaForm
{
  public function configure()
  {
    $this->setWidget('tipo_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Tipo')));
  }
}
