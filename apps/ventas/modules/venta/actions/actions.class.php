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
  public function executeVerMisVentas(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $criteria = new Criteria();
    $this->Venta = VentaPeer::doSelect($criteria);

    $this->setTemplate('index');
  }

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
  }

  public function executeCancelarVenta()
  {
    if ($this->getUser()->tieneVenta())
    {
      $this->getUser()->cancelarVenta();
      $this->getUser()->setFlash('notice', "Venta cancelada con éxito.");
    }
    else
    {
      $this->getUser()->setFlash('error', "Ud. no tiene ninguna Venta Activa.");
    }

    $this->redirect('producto/index');
  }
}
