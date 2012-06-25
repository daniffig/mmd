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

    $this->Venta = VentaPeer::doSelectFinalizadasByUsuario();

    $this->setTemplate('index');
  }

  public function executeVerMisVentasActivas(sfWebRequest $request)
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

    $this->Venta = VentaPeer::doSelectActivasByUsuario();

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
      //$this->getUser()->setFlash('notice', "Venta iniciada con éxito. Agregue Productos.");
      $this->getUser()->setFlash('notice_detail', array('algo' => 'otro'));
    }

    $this->redirect('producto/index');
  }

  public function executeCerrarVenta()
  {
    if ($this->getUser()->tieneVenta())
    {
      if ($this->getUser()->getVenta()->tieneProductos())
      {
        $this->Venta = $this->getUser()->getVenta();
        $this->form = new VentaForm($this->Venta);//new VentaCerrarVentaForm($this->Venta);

        $this->setTemplate('cerrarVenta');
        //$this->configuration->form = new VentaForm($this->getUser()->getVenta());
        //$this->Venta = $this->getUser()->getVenta();
        //$this->redirect($this->generateUrl('venta_new', array('sf_subject' => $this->getUser()->getVenta())));
      }
      else
      {
        $this->getUser()->setFlash('error', "Debe agregar Productos a la Venta antes de poder cerrarla.");
        $this->redirect('@producto');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', "Ud. no tiene ninguna Venta Activa.");
      $this->redirect('@producto');
    }
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

    $this->redirect('@producto');
  }

  public function executeVerFactura(sfWebRequest $request)
  {
    $this->Venta = $this->getRoute()->getObject();
    $this->ProductoVentas = $this->Venta->getProductoVentas();
    $this->Cliente = $this->Venta->getCliente();
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      if ($errores = $form->getObject()->cerrarVenta())
      {
        $this->getUser()->setFlash('error_detail', array('algo', 'algo2'));//$errores);

        $this->redirect('@venta');
      }
      else
      {
        $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

        // Esto hay que hacerlo de otra forma, pero no me voy a poner al leer toda la interface de sfForm ahora...
        $Venta = $form->save();
        $Venta->setEsFinalizado(true);
        $Venta->save();
        // Fin del código feo.

        $this->getUser()->cerrarVenta();

        $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Venta)));

        if ($request->hasParameter('_save_and_add'))
        {
          $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

          $this->redirect('@venta_new');
        }
        else
        {
          $this->getUser()->setFlash('notice', $notice);

          $this->redirect('@venta');
        }
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
