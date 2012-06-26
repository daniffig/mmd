<?php

require_once dirname(__FILE__).'/../lib/facturaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/facturaGeneratorHelper.class.php';

/**
 * factura actions.
 *
 * @package    mmd
 * @subpackage factura
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class facturaActions extends autoFacturaActions
{
  public function executeGenerarFactura(sfWebRequest $request)
  {
    $this->Factura = new Factura();
    $this->Factura->setVenta(VentaPeer::retrieveByPk($request->getParameter('venta_id')));

    $this->form = new FacturaForm($this->Factura);

    $this->setTemplate('new');
  }
}
