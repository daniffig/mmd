<?php


/**
 * Skeleton subclass for representing a row from the 'Marca' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu May 24 02:53:51 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Marca extends BaseMarca {

  public function __toString()
  {
    return $this->getNombre();
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

  public function getCantidadProductosActivos()
  {
    $criteria = new Criteria();
    $criteria->add(ProductoPeer::ES_ACTIVO, true);

    return $this->countProductos($criteria);
  }

  public function puedenDesactivarme()
  {
    return $this->getCantidadProductosActivos() == 0;
  }

} // Marca
