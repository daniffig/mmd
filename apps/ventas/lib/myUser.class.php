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

  public function iniciarVenta()
  {
    if (!$this->tieneVenta())
    {
      $this->setVenta(new Venta());

      return true;
    }

    return false;
  }

  public function cerrarVenta()
  {
    // FALTA IMPLEMENTAR.
    return true;
  }

  public function cancelarVenta()
  {
    $this->setAttribute('venta', null);
  }

}
