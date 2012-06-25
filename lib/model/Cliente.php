<?php


/**
 * Skeleton subclass for representing a row from the 'cliente' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jun 10 18:46:18 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Cliente extends BaseCliente {

  public function __toString()
  {
    return $this->getApellidoYNombre() . ' (' . $this->getTipoDocumento() . ' ' . $this->getNroDocumento() . ')';
  }

  public function puedoActivar()
  {
    return !$this->getEsActivo();
  }

  public function activar()
  {
    $this->setEsActivo(true);
    $this->save();
  }

  public function puedoDesactivar()
  {
    return !$this->puedoActivar();
  }

  public function desactivar()
  {
    $this->setEsActivo(false);
    $this->save();
  }

  public function getApellidoYNombre()
  {
    return $this->getApellido() . ', ' . $this->getNombre();
  }
} // Cliente
