<?php

require_once dirname(__FILE__).'/../lib/tipo_documentoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tipo_documentoGeneratorHelper.class.php';

/**
 * tipo_documento actions.
 *
 * @package    mmd
 * @subpackage tipo_documento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class tipo_documentoActions extends autoTipo_documentoActions
{
  public function executeActivar()
  {
    $tipo_documento = $this->getRoute()->getObject();

    $tipo_documento->activar();

    $this->getUser()->setFlash('notice', 'El Tipo de Producto fue activado con éxito.');

    $this->redirect('@tipo_documento');
  }

  public function executeDesactivar()
  {
    $tipo_documento = $this->getRoute()->getObject();

    $tipo_documento->desactivar();

    $this->getUser()->setFlash('notice', 'El Tipo de Producto fue desaactivado con éxito.');

    $this->redirect('@tipo_documento');
  }
}
