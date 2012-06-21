<?php

/**
 * TipoProducto filter form.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
class TipoProductoFormFilter extends BaseTipoProductoFormFilter
{
  public function configure()
  {
    $this->setWidget('categoria_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Categoria', 'peer_method' => 'doSelectActivos', 'add_empty' => true)));
  }
}
