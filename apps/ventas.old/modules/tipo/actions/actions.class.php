<?php

require_once dirname(__FILE__).'/../lib/tipoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tipoGeneratorHelper.class.php';

/**
 * tipo actions.
 *
 * @package    mmd
 * @subpackage tipo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class tipoActions extends autoTipoActions
{
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if (!$this->getRoute()->getObject()->getTiposHijos())
    {
      if ($this->getRoute()->getObject()->puedenBorrarme())
      {
       $this->getRoute()->getObject()->setEsActivo(false);
       $this->getRoute()->getObject()->save();

       $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
      }
      else
      {
       $this->getUser()->setFlash('error', 'El Tipo tiene Productos asociados.');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'El Tipo tiene Tipos hijos.');
    }
    

    $this->redirect('@tipo');
  }
}
