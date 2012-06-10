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
    $this->setWidget('marca_id', new dcWidgetFormPropelChosenChoice(array('model' => 'Marca')));

    $caracteristica_id = new sfWidgetFormPropelChoice(array('model' => 'Caracteristica', 'multiple' => true, 'expanded' => true));

    $this->setWidget('caracteristica_id', new dcWidgetFormJQueryDependence(array(
      "widget" => $caracteristica_id,
      "observed_id" => "producto_tipo_id",
      "on_change" => array(get_class($this), "updateCaracteristicaWidgetCriteria"),
      "no_value_text" => 'No corresponde.'
    )));
  }

  public static function updateCaracteristicaWidgetCriteria($widget, $values)
  {
    $criteria = new Criteria();
    $criteria->add(CaracteristicaPeer::TIPO_ID, $values['producto_tipo_id']);

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
