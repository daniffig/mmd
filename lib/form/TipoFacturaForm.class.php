<?php

/**
 * TipoFactura form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class TipoFacturaForm extends BaseTipoFacturaForm
{
  public function configure()
  {
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());
  }
}
