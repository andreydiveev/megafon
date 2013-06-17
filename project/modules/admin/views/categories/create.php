<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Категории'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index')),
	//array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>Добавить категорию</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>