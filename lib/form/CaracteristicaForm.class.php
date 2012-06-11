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
    $this->setWidget('categoria_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Categoria', 'add_empty' => true)));

    $tipo_id = new dcWidgetFormPropelChosenChoice(array('model' => 'Tipo'));

    $this->setWidget('tipo_id', new dcWidgetFormJQueryDependence(array(
      "widget" => $tipo_id,
      "observed_id" => "caracteristica_categoria_id",
      "on_change" => array(get_class($this), "updateTipoWidgetCriteria"),
      "no_value_text" => 'Seleccione una Categoría.'
    )));
  }

  public static function updateTipoWidgetCriteria($widget, $values)
  {
    $criteria = new Criteria();
    $criteria->add(TipoPeer::CATEGORIA_ID, $values['caracteristica_categoria_id']);

    if ($choices = TipoPeer::doSelect($criteria))
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
