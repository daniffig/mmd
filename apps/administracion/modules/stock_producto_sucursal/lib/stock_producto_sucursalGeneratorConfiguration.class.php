<?php

/**
 * stock_producto_sucursal module configuration.
 *
 * @package    mmd
 * @subpackage stock_producto_sucursal
 * @author     dvorak
 * @version    SVN: $Id: configuration.php 12474 2008-10-31 10:41:27Z fabien $
 */
class stock_producto_sucursalGeneratorConfiguration extends BaseStock_producto_sucursalGeneratorConfiguration
{
  /*public function getFilterDefaults()
  {
    $usuario = sfContext::getInstance()->getUser()->getGuardUser();

    $sucursal_id = $usuario->getSucursal()->getId();

    $filtros = array();

    $filtros['sucursal_id'] = $sucursal_id;

    return $filtros;    
  }*/
}
