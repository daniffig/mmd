<?php

require_once dirname(__FILE__).'/../lib/productoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/productoGeneratorHelper.class.php';

/**
 * producto actions.
 *
 * @package    mmd
 * @subpackage producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class productoActions extends autoProductoActions
{
  public function executeVerDetalles(sfWebRequest $request)
  {
    $this->producto = $this->getRoute()->getObject();
  }

  public function executeAgregarProductoVenta(sfWebRequest $request)
  {
    if ($this->getUser()->tieneVenta())
    {
      $this->redirect($this->generateUrl('agregar_producto_venta', array('producto_id' => $this->getRoute()->getObject()->getId())));
    }
    else
    {
      $this->getUser()->setFlash('error', 'Ud. no tiene ninguna Venta Activa.');
      
      $this->redirect('@producto');
    }
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->setEsActivo(false);
    $this->getRoute()->getObject()->save();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@producto');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Producto = $form->save();

      $caracteristica_id = $form->getValue('caracteristica_id');

      print_r($form->getValues());

      foreach ($form->getValue('caracteristica_id') as $caracteristica_id)
      {
        $caracteristica_producto = new CaracteristicaProducto();

        $caracteristica_producto->setProducto($Producto);
        $caracteristica_producto->setCaracteristicaId($caracteristica_id);

        $caracteristica_producto->save();

        print_r($caracteristica_producto);  
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Producto)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@producto_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'producto_edit', 'sf_subject' => $Producto));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
