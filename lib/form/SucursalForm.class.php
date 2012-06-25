<?php

/**
 * Sucursal form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class SucursalForm extends BaseSucursalForm
{
  public function configure()
  {
    // Widgets
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());
  }
 }
