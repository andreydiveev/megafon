<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'Новости'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Список новостей', 'url'=>array('index')),
	array('label'=>'Добавить новость', 'url'=>array('create')),
	array('label'=>'Информация о новости', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Редактирование новости #<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>