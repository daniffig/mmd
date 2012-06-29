<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUser.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfGuardUser extends PluginsfGuardUser
{
  public function puedoActivar()
  {
    return !$this->getIsActive();
  }

  public function activar()
  {
    $this->setIsActive(true);
    $this->save();
  }

  public function puedoDesactivar()
  {
    return !$this->puedoActivar();
  }

  public function desactivar()
  {
    $this->setIsActive(false);
    $this->save();
  }

  public function puedoVerVentas()
  {
    return $this->hasGroup('Empleados');
  }

  public function getSucursal()
  {
    return $this->getProfile()->getSucursal();
  }

  public function getGrupo()
  {
    if ($this->hasGroup('Empleados'))
    {
      return 'Empleados';
    }

    if ($this->hasGroup('Supervisores'))
    {
      return 'Supervisores';
    }

    if ($this->hasGroup('Administradores'))
    {
      return 'Administradores';
    }
  }

  // Condiciones
  public function esEmpleado()
  {
    return $this->hasGroup('Empleados');
  }
}
