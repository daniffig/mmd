<?php

/**
 * Caracteristica form.
 *
 * @package    mmd
 * @subpackage form
 * @author     Your name here
 */
class CaracteristicaForm extends BaseCaracteristicaForm
{
  public function configure()
  {
    $this->setWidget('categoria_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Categoria', 'add_empty' => false)));

    $tipo_producto_id = new dcWidgetFormChosenChoice(array('choices' => array()));

    $this->setWidget('tipo_producto_id', new dcWidgetFormJQueryDependence(array(
      "widget" => $tipo_producto_id,
      "observed_id" => "caracteristica_categoria_id",
      "on_change" => array(get_class($this), "updateTipoProductoWidgetCriteria"),
      "no_value_text" => 'Seleccione una Categoría.'
    )));

    $this->validatorSchema->setOption('allow_extra_fields', true);
  }

  public static function updateTipoProductoWidgetCriteria($widget, $values)
  {
    $criteria = new Criteria();
    $criteria->add(TipoProductoPeer::CATEGORIA_ID, $values['caracteristica_categoria_id']);

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
}
