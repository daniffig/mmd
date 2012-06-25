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
    if (!$this->Venta = VentaPeer::retrieveByPk($request->getParameter('venta_id')))
    {
      $this->Venta = $this->getRoute()->getObject();
    }

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

          $this->redirect($this->generateUrl('venta_ver_factura', array('venta_id' => $Venta->getId())));
        }
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
