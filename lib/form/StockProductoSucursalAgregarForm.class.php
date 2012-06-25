<?php

/**
 * StockProductoSucursal form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class StockProductoSucursalAgregarForm extends BaseStockProductoSucursalForm
{
  public function configure()
  {
    $this->setWidget('created_at', new sfWidgetFormInputHidden());
    $this->setWidget('created_by', new sfWidgetFormInputHidden());
    $this->setWidget('updated_at', new sfWidgetFormInputHidden());
    $this->setWidget('updated_by', new sfWidgetFormInputHidden());
    $this->setWidget('producto_id', new sfWidgetFormInputHidden());
    $this->setWidget('sucursal_id', new sfWidgetFormInputHidden());

    $usuario = sfContext::getInstance()->getUser()->getGuardUser();

    $this->setDefault('updated_by', $usuario->getId());

    //$this->getWidget('cantidad')->attributesToHtml(array('class' => 'esNumerico'));
    $this->setDefault('cantidad', $this->getObject()->getCantidad());
    //$this->getWidgetSchema()->setHelp('cantidad', 'Debe especificar un valor mayor o igual a cero.');

    $this->setValidator('cantidad', new sfValidatorInteger(array('min' => 0), array('required' => 'Requerido.', 'invalid' => 'Valor inválido.', 'min' => 'Debe especificar un valor mayor o igual a cero.')));
  }
}
