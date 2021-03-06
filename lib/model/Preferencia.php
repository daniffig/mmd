<?php


/**
 * Skeleton subclass for representing a row from the 'preferencia' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Mon Jun 11 20:45:27 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Preferencia extends BasePreferencia {

  public function __toString()
  {
    return $this->getValor();
  }

  public static function get($preferencia)
  {
    $criteria = new Criteria();

    $criteria->add(PreferenciaPeer::NOMBRE, $preferencia);

    if (!$resultado = PreferenciaPeer::doSelectOne($criteria))
    {
      throw new Exception('No existe la Preferencia: ' . $preferencia);
    }

    return $resultado->getValor();
  }
} // Preferencia
