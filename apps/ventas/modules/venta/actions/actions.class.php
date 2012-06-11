<?php

require_once dirname(__FILE__).'/../lib/ventaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ventaGeneratorHelper.class.php';

/**
 * venta actions.
 *
 * @package    mmd
 * @subpackage venta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class ventaActions extends autoVentaActions
{
  public function executeIniciarVenta()
  {
    if ($this->getUser()->tieneVenta())
    {
      $this->getUser()->setFlash('error', "Debe cancelar o cerrar la Venta Activa antes de iniciar una nueva.");
    }
    else
    {
      $this->getUser()->iniciarVenta();
      $this->getUser()->setFlash('notice', "Venta iniciada con éxito. Agregue Productos.");
    }

    $this->redirect('producto/index');
  }

  public function executeCerrarVenta()
  {
    // FALTA IMPLEMENTAR.
    $this->redirect('venta/index');
  }

  public function executeCancelarVenta()
  {
    // FALTA IMPLEMENTAR.
    $this->getUser()->cancelarVenta();
    $this->redirect('venta/index');    
  }
}
