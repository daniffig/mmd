<?php

require_once dirname(__FILE__).'/../lib/ventaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ventaGeneratorHelper.class.php';

/**
 * venta actions.
 *
 * @package    mmd
 * @subpackage venta
 * @author     dvorak
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class ventaActions extends autoVentaActions
{
  // Filtros
  public function executeVerVentas(sfWebRequest $request)
  {
    $filtros = $this->configuration->getFilterDefaults();

    $this->getUser()->setAttribute('venta.filters', $filtros, 'admin_module');

    $this->redirect('@venta');
  }

  public function executeVerVentasPorEmpleado(sfWebRequest $request)
  {
    $filtros = $this->configuration->getFilterDefaults();

    $filtros['created_by'] = $request->getParameter('usuario_id');

    $this->getUser()->setAttribute('venta.filters', $filtros, 'admin_module');

    $this->redirect('@venta');
  }
}
