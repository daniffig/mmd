<?php

/**
 * TipoDocumento form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class TipoDocumentoForm extends BaseTipoDocumentoForm
{
  public function configure()
  {
    // Widget
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());
  }
}
