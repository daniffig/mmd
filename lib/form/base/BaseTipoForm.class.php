<?php

/**
 * Tipo form base class.
 *
 * @method Tipo getObject() Returns the current form's model object
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTipoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'nombre'             => new sfWidgetFormInputText(),
      'tipo_padre_id'      => new sfWidgetFormPropelChoice(array('model' => 'Tipo', 'add_empty' => true)),
      'tipo_producto_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Producto')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'nombre'             => new sfValidatorString(array('max_length' => 255)),
      'tipo_padre_id'      => new sfValidatorPropelChoice(array('model' => 'Tipo', 'column' => 'id', 'required' => false)),
      'tipo_producto_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Producto', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Tipo', 'column' => array('nombre')))
    );

    $this->widgetSchema->setNameFormat('tipo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tipo';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['tipo_producto_list']))
    {
      $values = array();
      foreach ($this->object->getTipoProductos() as $obj)
      {
        $values[] = $obj->getProductoId();
      }

      $this->setDefault('tipo_producto_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveTipoProductoList($con);
  }

  public function saveTipoProductoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tipo_producto_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(TipoproductoPeer::TIPO_ID, $this->object->getPrimaryKey());
    TipoproductoPeer::doDelete($c, $con);

    $values = $this->getValue('tipo_producto_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new TipoProducto();
        $obj->setTipoId($this->object->getPrimaryKey());
        $obj->setProductoId($value);
        $obj->save();
      }
    }
  }

}
