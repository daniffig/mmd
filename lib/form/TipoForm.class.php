<?php

/**
 * Tipo form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class TipoForm extends BaseTipoForm
{
  public function configure()
  {
    $this->setWidget('tipo_padre_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Tipo')));
  }
}
