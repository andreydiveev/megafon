<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'Новости' => array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список новостей',   'url'=>array('index')),
	array('label'=>'Добавить новость',  'url'=>array('create')),
	array('label'=>'Редактировать новость',  'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить новость',   'url'=>'#',
        'linkOptions' => array(
            'submit' => array('delete','id'=>$model->id),
            'confirm'=> 'Вы уверены, что хотите удалить эту новость?'
        )
    ),
	//array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1>Информация о новости #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
            'name'=>'category_id',
            'value'=>$model->category->name,
        ),
		'date_created',
        'title',
		'short_description',
		'text',
		'small_image',
		'large_image',
        array(
            'name'=>'author_id',
            'value'=>$model->author->name,
        ),
	),
)); ?>
