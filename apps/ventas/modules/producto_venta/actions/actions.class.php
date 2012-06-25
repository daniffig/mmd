<?php

require_once dirname(__FILE__).'/../lib/producto_ventaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/producto_ventaGeneratorHelper.class.php';

/**
 * producto_venta actions.
 *
 * @package    mmd
 * @subpackage producto_venta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class producto_ventaActions extends autoProducto_ventaActions
{
  public function executeNew(sfWebRequest $request)
  {
    $producto = ProductoPeer::retrieveByPk($request->getParameter('producto_id'));

    $this->getUser()->setAttribute('tmp_producto_id', $producto->getId());

    $ProductoVenta = $this->getUser()->getVenta()->getInstanciaProductoVenta($producto);

    $this->ProductoVenta = $ProductoVenta;

    if (!$this->form = $this->getUser()->getAttribute('form'))
    {
      $this->form = new ProductoVentaForm($ProductoVenta);
    }
    else
    {
      $this->getUser()->setAttribute('form', null);
    }   
  }

  public function executeVerVentaActiva(sfWebRequest $request)
  {
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

    $this->ProductoVentas = $this->getUser()->getVenta()->getProductos();

    $this->setTemplate('index');
  }
  
  public function executeAgregarProducto()
  {
    $this->redirect('@producto');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $ProductoVenta = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $ProductoVenta)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@producto_venta_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@producto_venta');
      }
    }
    else
    {
      //$this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', true);

      $this->getUser()->setFlash('error', 'Debe ingresar un valor válido.');

      $this->getUser()->setAttribute('tmp_producto_form', $form);

      $this->redirect($this->generateUrl('producto_venta_agregar', array('producto_id' => $this->getUser()->getAttribute('tmp_producto_id'))));
    }
  }
}
