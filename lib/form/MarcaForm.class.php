<?php

/**
 * Marca form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 *     $this->widgetSchema['nombre'] = new sfWidgetFormInputText(array(), array('class' => 'btn'));
 */
class MarcaForm extends BaseMarcaForm
{
  public function configure()
  {
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());

    // Validaciones
    $this->setValidator('nombre', new sfValidatorString(array(), array('required' => 'Requerido.')));
  }
}
