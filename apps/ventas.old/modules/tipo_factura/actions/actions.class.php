<?php

require_once dirname(__FILE__).'/../lib/tipo_facturaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tipo_facturaGeneratorHelper.class.php';

/**
 * tipo_factura actions.
 *
 * @package    mmd
 * @subpackage tipo_factura
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class tipo_facturaActions extends autoTipo_facturaActions
{
  public function executeActivar()
  {
    $tipo_factura = $this->getRoute()->getObject();

    $tipo_factura->activar();
    
    $this->getUser()->setFlash('notice', 'El Tipo de Factura fue activado con éxito.');

    $this->redirect('@tipo_factura');
  }

  public function executeDesactivar()
  {
    $tipo_factura = $this->getRoute()->getObject();

    $tipo_factura->desactivar();

    $this->getUser()->setFlash('notice', 'El Tipo de Factura fue desactivado con éxito.');

    $this->redirect('@tipo_factura');
  }  
}
