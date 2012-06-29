<?php

require_once dirname(__FILE__).'/../lib/usuarioGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/usuarioGeneratorHelper.class.php';

/**
 * usuario actions.
 *
 * @package    mmd
 * @subpackage usuario
 * @author     dvorak
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class usuarioActions extends autoUsuarioActions
{
  // Acciones
  public function executeVerVentas(sfWebRequest $request)
  {
    $usuario = $this->getRoute()->getObject();

    if ($usuario->esEmpleado())
    {
      $this->redirect('venta/verVentasPorEmpleado?usuario_id=' . $usuario->getId());
    }
    else
    {
      $this->getUser()->setFlash('error', 'El Usuario seleccionado no pertenece al grupo de Empleados.');

      $this->redirect('@sf_guard_user');
    }
  }

  // Filtros
  public function executeVerEmpleados(sfWebRequest $request)
  {    
    $filtros = $this->configuration->getFilterDefaults();

    $filtros['sf_guard_group_list'] = sfConfig::get('app_grupo_empleados');

    $this->getUser()->setAttribute('usuario.filters', $filtros, 'admin_module');

    $this->redirect('@sf_guard_user');
  }
}
