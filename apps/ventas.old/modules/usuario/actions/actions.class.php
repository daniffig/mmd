<?php

require_once dirname(__FILE__).'/../lib/usuarioGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/usuarioGeneratorHelper.class.php';

/**
 * usuario actions.
 *
 * @package    mmd
 * @subpackage usuario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class usuarioActions extends autoUsuarioActions
{
  public function executeActivar(sfWebRequest $request)
  {
    $usuario = $this->getRoute()->getObject();

    $usuario->activar();
    
    $this->getUser()->setFlash('notice', 'El Usuario fue activado con éxito.');

    $this->redirect('@sf_guard_user');
  }

  public function executeDesactivar(sfWebRequest $request)
  {
    $usuario = $this->getRoute()->getObject();

    $usuario->desactivar();

    $this->getUser()->setFlash('notice', 'El Usuario fue desactivado con éxito.');

    $this->redirect('@sf_guard_user');
  }

  public function executeVerEmpleados(sfWebRequest $request)
  {
    $this->setFilters($this->configuration->getFilterDefaults());

    $this->getUser()->setAttribute('usuario.filters', array('sf_guard_user_group_list' => array(sfConfig::get('app_grupo_empleados'))), 'admin_module');

    $this->executeIndex($request);

    $this->setTemplate('index');
  }

  public function executeVerUsuarios(sfWebRequest $request)
  {
    $this->setFilters($this->configuration->getFilterDefaults());

    $this->executeIndex($request);

    $this->setTemplate('index');
  }

  /*public function executeIndex(sfWebRequest $request)
  {
    $usuario = $this->getUser();

    $filtros = array();

    if ($usuario->hasCredential('administrarAdministradores')
    
  }*/

  public function executeVerVentas(sfWebRequest $request)
  {
    $usuario = $this->getRoute()->getObject();

    $this->redirect($this->generateUrl('venta_ver_ventas_por_empleado', array('usuario_id' => $usuario->getId())));
  }

  public function executeIndex(sfWebRequest $request)
  {
    $usuario = $this->getUser();

    if ($this->getUser()->hasGroup('Empleados') or $usuario = sfGuardUserPeer::retrieveByPk($request->getParameter('usuario_id')))
    {
      $this->getUser()->setAttribute('venta.filters', array('created_by' => $usuario->getId()), 'admin_module');
    }    

    parent::executeIndex($request);
  }
}
