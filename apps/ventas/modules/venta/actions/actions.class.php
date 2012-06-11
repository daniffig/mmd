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
    if ($this->getUser()->tieneVenta())
    {
      $this->Venta = $this->getUser()->getVenta();
      $this->form = new VentaCerrarVentaForm($this->Venta);

      $this->setTemplate('cerrarVenta');
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

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Venta = $form->save();

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
        // Esta línea que sigue puede ser MUY importante para mejorar el código.
        // $this->redirect(array('sf_route' => 'venta_edit', 'sf_subject' => $Venta));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
