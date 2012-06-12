<?php

require_once dirname(__FILE__).'/../lib/caracteristicaGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/caracteristicaGeneratorHelper.class.php';

/**
 * caracteristica actions.
 *
 * @package    mmd
 * @subpackage caracteristica
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class caracteristicaActions extends autoCaracteristicaActions
{
  public function executeDesactivar()
  {
    if ($this->getRoute()->getObject()->puedenBorrarme())
    {
      $this->getRoute()->getObject()->setEsActivo(false);
      $this->getRoute()->getObject()->save();

      $this->getUser()->setFlash('notice', 'La Característica fue desactivada con éxito.');
    }
    else
    {      
      $this->getUser()->setFlash('error', 'La Característica tiene Productos asociados.');
    }

    $this->redirect('@caracteristica');
  }
}
