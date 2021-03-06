<?php


/**
 * Skeleton subclass for performing query and update operations on the 'cliente' table.
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
class ClientePeer extends BaseClientePeer {

	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
  {    
    $criteria->addAnd(self::ID, sfConfig::get('app_cliente_sin_seleccionar'), Criteria::NOT_EQUAL);

    return parent::doSelect($criteria, $con);    
  }

	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
  {
    $criteria->addAnd(self::ID, sfConfig::get('app_cliente_sin_seleccionar'), Criteria::NOT_EQUAL);

    return parent::doCount($criteria, $distinct, $con);     
  }

	public static function doSelectActivos(Criteria $criteria, PropelPDO $con = null)
  {
    if ($criteria === null)
    {
      $criteria = new Criteria();
    }

    $criteria->add(self::ES_ACTIVO, true);

    return self::doSelect($criteria, $con);    
  }

	public static function doCountActivos(Criteria $criteria, $distinct = false, PropelPDO $con = null)
  {
    if ($criteria === null)
    {
      $criteria = new Criteria();
    }

    $criteria->add(self::ES_ACTIVO, true);

    return self::doCount($criteria, $distinct, $con);     
  }
} // ClientePeer
