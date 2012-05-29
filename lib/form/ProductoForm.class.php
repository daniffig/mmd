<?php

/**
 * Producto form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class ProductoForm extends BaseProductoForm
{
  public function configure()
  {
    $this->setWidget('marca_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Marca')));
  }
}
