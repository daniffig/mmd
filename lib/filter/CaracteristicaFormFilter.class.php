<?php

/**
 * Caracteristica filter form.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
class CaracteristicaFormFilter extends BaseCaracteristicaFormFilter
{
  public function configure()
  {
    $this->setWidget('tipo_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Tipo', 'add_empty' => true, 'peer_method' => 'doSelectActivos')));
  }
}
