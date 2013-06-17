<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'Новости'=>array('index'),
	'Добавить новость',
);

$this->menu=array(
	array('label'=>'Список новостей', 'url'=>array('index')),
	//array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1>Добавить новость</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>