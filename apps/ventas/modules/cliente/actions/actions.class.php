<?php

require_once dirname(__FILE__).'/../lib/clienteGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/clienteGeneratorHelper.class.php';

/**
 * cliente actions.
 *
 * @package    mmd
 * @subpackage cliente
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class clienteActions extends autoClienteActions
{
  public function executeActivar()
  {
    $cliente = $this->getRoute()->getObject();

    $cliente->activar();
    
    $this->getUser()->setFlash('notice', 'El Cliente fue activado con éxito.');

    $this->redirect('@cliente');
  }

  public function executeDesactivar()
  {
    $cliente = $this->getRoute()->getObject();

    $cliente->desactivar();

    $this->getUser()->setFlash('notice', 'El Cliente fue desactivado con éxito.');

    $this->redirect('@cliente');
  }  
}
