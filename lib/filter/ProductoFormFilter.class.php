<?php

/**
 * Producto filter form.
 *
 * @package    mmd
 * @subpackage filter
 * @author     Your name here
 */
class ProductoFormFilter extends BaseProductoFormFilter
{
  public function configure()
  {
    $this->getWidget('modelo')->setOption('with_empty', false);
    $this->getWidget('descripcion')->setOption('with_empty', false);
  }
}
