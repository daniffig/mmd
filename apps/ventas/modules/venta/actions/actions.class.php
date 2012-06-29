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
  public function preExecute()
  {$this->preExecute();
  }
  public function executeVerProductos(sfWebRequest $request)
  {
    $this->redirect($this->generateUrl('producto_venta_ver_productos', array('venta_id' => $this->getRoute()->getObject()->getId())));
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
    if ($this->getUser()->tieneVenta())
    {
      if ($this->getUser()->getVenta()->tieneProductos())
      {
        $this->Venta = $this->getUser()->getVenta();
        $this->form = new VentaCerrarVentaForm($this->Venta);
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

  public function executeRecuperarVenta()
  {
    $venta = $this->getRoute()->getObject();

    if ($this->getUser()->tieneVenta())
    {
      $this->getuser()->setFlash('error', 'Ud. ya tiene una Venta Activa. Debe cerrarla o cancelarla antes de continuar.');
    }
    else
    {
      $this->getUser()->recuperarVenta($venta);
    }

    $this->redirect('@venta');
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

  public function executeAnularVenta(sfWebRequest $request)
  {
    $venta = $this->getRoute()->getObject();

    if ($errores = $venta->anular())
    {
      $this->getUser()->setFlash('error', 'Ocurrió un error al anular la Venta.');      
    }
    else
    {
      $this->getUser()->setFlash('notice', 'Venta anulada con éxito.');
    }

    $this->redirect('@venta');
  }

  public function executeVerFactura(sfWebRequest $request)
  {
    $this->Venta = $this->getRoute()->getObject();

    $this->redirect($this->generateUrl('factura_show', array('sf_subject' => $this->Venta->getFactura())));

    //$this->ProductoVentas = $this->Venta->getProductoVentas();
    //$this->Cliente = $this->Venta->getCliente();
  }

  public function executeImprimirReporte(sfWebRequest $request)
  {
    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());
    }
    
    $criteria = $this->buildCriteria();
    $criteria->addAscendingOrderByColumn(VentaPeer::CREATED_AT);

    $this->Ventas = VentaPeer::doSelect($criteria);
    $this->fecha_inicial = $this->Ventas[0]->getFecha();
    $this->fecha_final = $this->Ventas[sizeof($this->Ventas) - 1]->getFecha();

    $this->setLayout(false);
  }

  public function executeVerVentas(sfWebRequest $request)
  {
    $this->setFilters($this->configuration->getFilterDefaults());

    $this->executeIndex($request);

    $this->setTemplate('index');
  }

  public function executeIndex(sfWebRequest $request)
  {
    $usuario = $this->getUser()->getGuardUser();

    $filtros = $this->getFilters();

    if ($this->getUser()->hasGroup('Empleados'))
    {
      $filtros['created_by'] = $usuario->getId();
      $filtros['es_activo'] = true;
    }

    if ($usuario = sfGuardUserPeer::retrieveByPk($request->getParameter('usuario_id')))
    {
      $this->setFilters($this->configuration->getFilterDefaults());
      $filtros = $this->getFilters();
      $filtros['created_by'] = $usuario->getId();
    }

    $this->getUser()->setAttribute('venta.filters', $filtros, 'admin_module');

    //$this->filters = $this->configuration->getFilterForm($filtros);

    //$this->getUser()->setAttribute('venta.filters', $filtros, 'admin_module');

    parent::executeIndex($request);
  }

  public function executeGenerarFactura(sfWebRequest $request, Venta $venta = null)
  {
    if (!$venta)
    {
      $venta = $this->getRoute()->getObject();
    }    

    $this->redirect('factura_generar_factura', array('venta_id' => $venta->getId()));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      if ($errores = $form->getObject()->cerrarVenta())
      {
        $mensaje_error = 'No hay stock suficiente de los siguientes productos:';

        foreach ($errores as $error)
        {
          $mensaje_error .= ' ' . $errores;
        }

        $mensaje_error .= '. La Venta no puede ser cerrada.';

        $this->getUser()->setFlash('error', $mensaje_error);//$errores);

        $this->redirect('@venta');
      }
      else
      {
        $notice = $form->getObject()->isNew() ? 'La Venta fue cerrada con éxito.' : 'The item was updated successfully.';

        // Esto hay que hacerlo de otra forma, pero no me voy a poner al leer toda la interface de sfForm ahora...
        $Venta = $form->save();
        $Venta->setEsFinalizado(true);
        $Venta->save();
        // Fin del código feo.

        $Venta = $form->getObject();

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

          $this->executeGenerarFactura($request, $Venta);
          //$this->redirect($this->generateUrl('venta_ver_factura', array('venta_id' => $Venta->getId())));
        }
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
