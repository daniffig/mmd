<?php

require_once dirname(__FILE__).'/../lib/tipo_productoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/tipo_productoGeneratorHelper.class.php';

/**
 * tipo_producto actions.
 *
 * @package    mmd
 * @subpackage tipo_producto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class tipo_productoActions extends autoTipo_productoActions
{
  public function executeActivar()
  {
    $tipo_producto = $this->getRoute()->getObject();

    if ($tipo_producto->getCategoria()->getEsActivo())
    {
      $this->getRoute()->getObject()->activar();
      
      $this->getUser()->setFlash('notice', 'El Tipo de Producto fue activado con éxito.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'La Categoría del Tipo de Producto está desactivada.');
    }

    $this->redirect('@tipo_producto');
  }

  public function executeDesactivar()
  {
    $tipo_producto = $this->getRoute()->getObject();

    if ($tipo_producto->puedenDesactivarme())
    {
      $tipo_producto->desactivar();

      $this->getUser()->setFlash('notice', 'El Tipo de Producto fue desactivado con éxito.');
    }
    else
    {      
      $this->getUser()->setFlash('error', 'El Tipo de Producto tiene Productos asociados.');
    }

    $this->redirect('@tipo_producto');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $TipoProducto = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $TipoProducto)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@tipo_producto_new');
      }
      else if ($request->hasParameter('_save_and_list'))
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@tipo_producto');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@tipo_producto');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
