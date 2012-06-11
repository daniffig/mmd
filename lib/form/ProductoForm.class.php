<?php

/**
 * Producto form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class ProductoForm extends BaseProductoForm
{
  public function configure()
  {
    $this->setWidget('categoria_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Categoria', 'add_empty' => false)));

    $tipo_id = new dcWidgetFormChosenChoice(array('choices' => array()));

    $this->setWidget('tipo_producto_id', new dcWidgetFormJQueryDependence(array(
      "widget" => $tipo_id,
      "observed_id" => "producto_categoria_id",
      "on_change" => array(get_class($this), "updateTipoProductoWidgetCriteria"),
      "no_value_text" => 'Seleccione una Categoría.'
    )));

    $this->setWidget('marca_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Marca', 'add_empty' => false)));

    $caracteristica_id = new sfWidgetFormChoice(array('choices' => array(), 'multiple' => true, 'expanded' => true));

    $this->setWidget('caracteristica_id', new dcWidgetFormJQueryDependence(array(
      "widget" => $caracteristica_id,
      "observed_id" => "producto_tipo_producto_id",
      "on_change" => array(get_class($this), "updateCaracteristicaWidgetCriteria"),
      "no_value_text" => 'Seleccione un Tipo de Producto.'
    )));

    $this->setValidator('caracteristica', new sfValidatorPropelChoice(array('model' => 'Caracteristica', 'multiple' => true, 'required' => false)));

    $this->validatorSchema->setOption('allow_extra_fields', true);
  }

  public static function updateTipoProductoWidgetCriteria($widget, $values)
  {
    $criteria = new Criteria();
    $criteria->add(TipoProductoPeer::CATEGORIA_ID, $values['producto_categoria_id']);

    if ($choices = TipoProductoPeer::doSelectChoices($criteria))
    {
      $widget->getOption("widget")->setAttribute("hidden", false);
      $widget->getOption("widget")->setOption("choices", $choices);
    }
    else
    {
      $widget->getOption("widget")->setAttribute("hidden", true);
    }
  }

  public static function updateCaracteristicaWidgetCriteria($widget, $values)
  {
    $criteria = new Criteria();
    $criteria->add(CaracteristicaPeer::TIPO_PRODUCTO_ID, $values['producto_tipo_producto_id']);

    if ($choices = CaracteristicaPeer::doSelect($criteria))
    {
      $widget->getOption("widget")->setAttribute("hidden", false);
      $widget->getOption("widget")->setOption("choices", $choices);
    }
    else
    {
      $widget->getOption("widget")->setAttribute("hidden", true);
    }
  }
}
