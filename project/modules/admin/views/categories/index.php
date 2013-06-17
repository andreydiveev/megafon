<?php
/* @var $this CategoriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Редактирование',
);

$this->menu=array(
	array('label'=>'Добавить категорию', 'url'=>array('create')),
	//array('label'=>'Manage Categories', 'url'=>array('admin')),
);
?>

<h1>Категории</h1>

<?php $dataProvider = new CActiveDataProvider('Categories', array(
    'pagination'=>array(
        'pageSize'=>'10',
    ),
));

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns' => array(
        'id',
        'name',
        array(
            'name'=>'parent',
            'value'=>'isset($data->Parent->name)?$data->Parent->name:""',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
        ),
    ),
));?>
