<?php

/**
 * Categoria form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class CategoriaForm extends BaseCategoriaForm
{
  public function configure()
  {
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());

    // Validaciones
    $this->setValidator('nombre', new sfValidatorString(array(), array('required' => 'Requerido.')));
  }
}
