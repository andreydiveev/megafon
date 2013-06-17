<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Новости',
);

$this->menu=array(
	array('label'=>'Добавить новость', 'url'=>array('create')),
);
?>

<h1>Новости</h1>

<?php

$dataProvider = new CActiveDataProvider('News', array(
    'pagination'=>array(
        'pageSize'=>'3',
    ),
));

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        array(
            'name' => 'category.name',
            'value'=> '$data->category->name',
            'header'=> 'Название категории',
        ),
        'date_created',
        'title',
        'short_description',
        array(
            'name'=>'text',
            'value'=>'Helper::cutStr($data->text, 256)',
        ),
        array(
            'name'=>'small_image',
            'value'=>'CHtml::image($data->small_image)',
            'type' => 'raw',
        ),
        'author.name',
        array(
            'header'=>'Операции',
            'class'=>'CButtonColumn',
        ),
    ),
));

?>
