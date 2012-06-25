<?php

/**
 * SituacionImpositiva form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class SituacionImpositivaForm extends BaseSituacionImpositivaForm
{
  public function configure()
  {
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());
  }
}
