<?php

/**
 * Cliente form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class ClienteForm extends BaseClienteForm
{
  public function configure()
  {
    // Widgets
    $this->setWidget('tipo_documento_id', new dcWidgetFormPropelChosenChoice(array('model' => 'TipoDocumento', 'peer_method' => 'doSelectActivos')));
    $this->setWidget('es_activo', new sfWidgetFormInputHidden());

    // Validaciones
    $this->setValidator('nro_documento', new sfValidatorInteger(array(), array('required' => 'Requerido.', 'invalid' => 'Valor inválido.')));
    $this->setValidator('apellido', new sfValidatorString(array(), array('required' => 'Requerido.', 'invalid' => 'Valor inválido.')));
    $this->setValidator('nombre', new sfValidatorString(array(), array('required' => 'Requerido.', 'invalid' => 'Valor inválido.')));
    //$this->setValidator('cuit', new sfValidatorString(array('min_length' => 12, 'max_length' => 14), array('min_length' => 'CUIL/CUIT demasiado corto.', 'max_length' => 'CUIT/CUIL demasiado largo.')));

    // Ayudas
    $this->getWidgetSchema()->setHelp('nro_documento', 'Formato: 12345678');
    $this->getWidgetSchema()->setHelp('cuit', 'Formato: 12-12345678-1');

    // Restricciones
    $this->getWidget('nro_documento')->setAttribute('class', 'positive-integer');
  }
}
