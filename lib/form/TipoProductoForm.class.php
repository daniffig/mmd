<?php

/**
 * TipoProducto form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class TipoProductoForm extends BaseTipoProductoForm
{
  public function configure()
  {
    $this->setWidget('categoria_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Categoria')));
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());

    // Validaciones
    $this->setValidator('nombre', new sfValidatorString(array(), array('required' => 'Requerido.')));
  }
}
