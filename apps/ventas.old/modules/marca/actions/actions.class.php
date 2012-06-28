<?php

require_once dirname(__FILE__).'/../lib/marcaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/marcaGeneratorHelper.class.php';

/** (!$request->getParameter('marca[es_activo]')) && $this->Marca->getEsActivo() && $this->Marca->puedenBorrarme()) || !$this->Marca->getEsActivo() || $request->getParameter('marca[es_activo]')
 *
 * marca actions.
 *
 * @package    mmd
 * @subpackage marca
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class marcaActions extends autoMarcaActions
{
  public function executeActivar()
  {
    $this->getRoute()->getObject()->activar();
    
    $this->getUser()->setFlash('notice', 'La Marca fue activada con éxito.');

    $this->redirect('@marca');
  }

  public function executeDesactivar()
  {
    if ($this->getRoute()->getObject()->puedenDesactivarme())
    {
      $this->getRoute()->getObject()->desactivar();

      $this->getUser()->setFlash('notice', 'La Marca fue desactivada con éxito.');
    }
    else
    {      
      $this->getUser()->setFlash('error', 'La Marca tiene Productos asociados.');
    }

    $this->redirect('@marca');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Marca = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Marca)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@marca_new');
      }
      else if ($request->hasParameter('_save_and_list'))
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@marca');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect('@marca');
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
