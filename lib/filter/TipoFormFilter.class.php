<?php

/**
 * Tipo filter form.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
class TipoFormFilter extends BaseTipoFormFilter
{
  public function configure()
  {
    $this->setWidget('tipo_padre_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Tipo', 'add_empty' => true, 'peer_method' => 'doSelectActivos', 'order_by' => array('Nombre', 'asc'))));
  }
}
