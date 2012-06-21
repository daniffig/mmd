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

    if ($this->getObject()->getId())
    {
      $this->setDefault('categoria_id', $this->getObject()->getTipoProducto()->getCategoriaId());
    }

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

    $this->setValidator('caracteristica_id', new sfValidatorPass());

    $this->setWidget('imagen', new sfWidgetFormInputFileEditable(
          array (
            /*'template' => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',*/
            'file_src' => $this->getObject()->getImagenThumb(),
            'is_image' => true,
            'delete_label' => 'Seleccione para eliminar la imagen actual.')
          )
        );

        $this->setValidator('imagen', new sfValidatorFile(
          array (
            'required' => false,
            'max_size' => '2097152',
            'mime_types' => array ('image/jpeg', 'image/jpg', 'image/png', 'image/gif')),
          array ( 
            'invalid' => 'Archivo inválido.',
            'required' => 'Seleccione un archivo para subir.',
            'max_size' => 'El tamaño máximo es 2MB',
            'mime_types' => 'El archivo debe ser formato JPG, PNG o GIF.')
          )
        );

        $this->getWidgetSchema()->setHelp('imagen', "2MB máximo, archivos permitidos (jpeg, jpg, png, gif)");

        $this->setValidator('imagen_delete', new sfValidatorBoolean());

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
