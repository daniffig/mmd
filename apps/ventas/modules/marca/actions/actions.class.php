<?php

require_once dirname(__FILE__).'/../lib/marcaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/marcaGeneratorHelper.class.php';

/** (!$request->getParameter('marca[es_activo]')) && $this->Marca->getEsActivo() && $this->Marca->puedenBorrarme()) || !$this->Marca->getEsActivo() || $request->getParameter('marca[es_activo]')
 *
 * marca actions.
 *
 * @package    mmd
 * @subpackage marca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class marcaActions extends autoMarcaActions
{
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    if ($this->getRoute()->getObject()->puedenBorrarme())
    {
      $this->getRoute()->getObject()->setEsActivo(false);
      $this->getRoute()->getObject()->save();

      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'La Marca tiene Productos asociados.');
    }

    $this->redirect('@marca');
  }
  
  public function executeUpdate(sfWebRequest $request)
  {

    $this->Marca = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->Marca);
    $arregloParametros = $request->getParameter('marca');
	
    if((!isset($arregloParametros['es_activo']) && $this->Marca->getEsActivo() && $this->Marca->puedenBorrarme()) || !$this->Marca->getEsActivo() || isset($arregloParametros['es_activo']))
    {
      $this->processForm($request, $this->form);
    }
    else
    {
      $this->getUser()->setFlash('error', 'La Marca tiene Productos asociados.');
      $this->redirect(array('sf_route' => 'marca_edit', 'sf_subject' => $this->Marca));
    }
    $this->setTemplate('edit');
  }
  
}
