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
}
