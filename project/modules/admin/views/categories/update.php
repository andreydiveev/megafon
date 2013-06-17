<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Категории'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список категориц', 'url'=>array('index')),
	array('label'=>'Добавить категорию', 'url'=>array('create')),
	array('label'=>'Информация о категории', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>Редактирование категории #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>