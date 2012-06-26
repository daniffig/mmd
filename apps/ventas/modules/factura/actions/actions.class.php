<?php

require_once dirname(__FILE__).'/../lib/facturaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/facturaGeneratorHelper.class.php';

/**
 * factura actions.
 *
 * @package    mmd
 * @subpackage factura
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class facturaActions extends autoFacturaActions
{
  public function executeGenerarFactura(sfWebRequest $request)
  {
    $this->Factura = new Factura();
    $this->Factura->setVenta(VentaPeer::retrieveByPk($request->getParameter('venta_id')));

    $this->form = new FacturaForm($this->Factura);

    $this->setTemplate('new');
  }

  public function executeVerFactura(sfWebRequest $request)
  {
    if (!$this->Venta = VentaPeer::retrieveByPk($request->getParameter('venta_id')))
    {
      $this->Factura = $this->getRoute()->getObject();
      $this->Venta = $this->Factura->getVenta();
    }
    else
    {
      $this->Factura = $this->Venta->getFactura();
    }

    $this->Sucursal = $this->Venta->getSucursal();
    $this->ProductoVentas = $this->Venta->getProductoVentas();
    $this->Cliente = $this->Venta->getCliente();
  }

  public function executeImprimirFactura(sfWebRequest $request)
  {
    if (!$this->Venta = VentaPeer::retrieveByPk($request->getParameter('venta_id')))
    {
      $this->Factura = $this->getRoute()->getObject();
      $this->Venta = $this->Factura->getVenta();
    }
    else
    {
      $this->Factura = $this->Venta->getFactura();
    }

    $this->Sucursal = $this->Venta->getSucursal();
    $this->ProductoVentas = $this->Venta->getProductoVentas();
    $this->Cliente = $this->Venta->getCliente();

    $this->setLayout(false);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Factura = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Factura)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@factura_new');
      }
      else if ($request->hasParameter('_save_and_list'))
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@factura');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect($this->generateUrl('venta_ver_factura', array('venta_id' => $Factura->getVenta()->getId())));

        //$this->executeVerFactura($request);

        //$this->redirect(array('sf_route' => 'factura_edit', 'sf_subject' => $Factura));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
