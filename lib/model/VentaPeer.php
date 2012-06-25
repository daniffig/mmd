<?php


/**
 * Skeleton subclass for performing query and update operations on the 'venta' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jun 10 21:12:29 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class VentaPeer extends BaseVentaPeer {

	public static function doSelectByUsuario(Criteria $criteria = null, PropelPDO $con = null)
  {
    if ($criteria === null)
    {
      $criteria = new Criteria();
    }

    $criteria->add(self::CREATED_BY, sfContext::getInstance()->getUser()->getGuardUser()->getId());
    $criteria->add(self::ES_ACTIVO, true);

    return self::doSelect($criteria, $con);    
  }
} // VentaPeer
