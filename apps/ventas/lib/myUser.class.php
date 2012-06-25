<?php

class myUser extends sfGuardSecurityUser
{
  public function setVenta(Venta $venta)
  {
    $this->setAttribute('venta', $venta);
  }

  public function getVenta()
  {
    return $this->getAttribute('venta');
  }

  public function tieneVenta()
  {
    return $this->getVenta();
  }

  public function noTieneVenta()
  {
    return !$this->tieneVenta();
  }

  public function iniciarVenta()
  {
    if (!$this->tieneVenta())
    {    
      $this->setVenta(Venta::nuevaVentaActiva());

      return true;
    }

    return false;
  }

  public function agregarProducto(Producto $producto)
  {
    $this->getVenta()->agregarProducto($producto);
  }

  public function cerrarVenta()
  {
    //$this->setFlash('notice', 'Venta finalizada con éxito.');
    $this->setAttribute('venta', null);
  }

  public function cancelarVenta()
  {
    $this->getVenta()->cancelarVenta();
    $this->setAttribute('venta', null);
  }
}
