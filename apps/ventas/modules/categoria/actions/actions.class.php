<?php

require_once dirname(__FILE__).'/../lib/categoriaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/categoriaGeneratorHelper.class.php';

/**
 * categoria actions.
 *
 * @package    mmd
 * @subpackage categoria
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class categoriaActions extends autoCategoriaActions
{
  public function executeActivar()
  {
    $this->getRoute()->getObject()->activar();
    
    $this->getUser()->setFlash('notice', 'La Categoría fue activada con éxito.');

    $this->redirect('@categoria');
  }

  public function executeDesactivar()
  {
    if ($this->getRoute()->getObject()->puedenDesactivarme())
    {
      $this->getRoute()->getObject()->desactivar();

      $this->getUser()->setFlash('notice', 'La Categoría fue desactivada con éxito.');
    }
    else
    {      
      $this->getUser()->setFlash('error', 'La Categoría tiene Tipos de Producto asociados.');
    }

    $this->redirect('@categoria');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Categoria = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Categoria)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@categoria_new');
      }
      else if ($request->hasParameter('_save_and_list'))
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@categoria');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@categoria');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
