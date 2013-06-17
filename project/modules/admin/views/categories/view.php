<?php
/* @var $this CategoriesController */
/* @var $model Categories */

$this->breadcrumbs=array(
	'Категории'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index')),
	array('label'=>'Добавить категорию', 'url'=>array('create')),
	array('label'=>'Редактировать категорию', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить категорию', 'url'=>'#',
        'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->id),
            'confirm'=>'Вы уверены, что хотите удалить данную категорию?'
        )
    ),
	//array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>Информация о категории #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		array(
            'name'=>'parent',
            'value'=>isset($model->Parent->name)?$model->Parent->name:'',
        ),
	),
)); ?>
