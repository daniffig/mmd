<?php

/**
 * StockProductoSucursal form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class StockProductoSucursalForm extends BaseStockProductoSucursalForm
{
  public function configure()
  {
    $this->setWidget('created_at', new sfWidgetFormInputHidden());
    $this->setWidget('created_by', new sfWidgetFormInputHidden());
    $this->setWidget('updated_at', new sfWidgetFormInputHidden());
    $this->setWidget('updated_by', new sfWidgetFormInputHidden());

    $usuario = sfContext::getInstance()->getUser()->getGuardUser();

    if ($this->getObject()->isNew())
    {
      $this->setDefault('created_by', $usuario->getId());
      $this->setDefault('sucursal_id', $usuario->getProfile()->getSucursalId());
    }
    else
    {
      $this->setDefault('updated_by', $usuario->getId());
    }

    $this->setWidget('producto_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Producto')));

    if ($usuario->hasGroup('Administradores'))
    {
      $this->setWidget('sucursal_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Sucursal')));
    }
    else
    {
      $this->setWidget('sucursal_id', new sfWidgetFormInputHidden());
    }

    $this->setDefault('cantidad', 0);
    $this->getWidgetSchema()->setHelp('cantidad', 'Debe especificar un valor mayor o igual a cero.');

    $this->setValidator('cantidad', new sfValidatorInteger(array('min' => 0), array('required' => 'Requerido.', 'invalid' => 'Valor inválido.', 'min' => 'Debe especificar un valor mayor o igual a cero.')));
  }
}
