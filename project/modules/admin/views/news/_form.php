<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'enctype'=>'multipart/form-data',
    ),
)); ?>

    <p class="note">Поля с символом <span class="required">*</span> обязательны для заполнения.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
        <?=$form->DropDownList($model,'category_id',Categories::getList()); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_created'); ?>
		<?php echo $form->textField($model,'date_created', array('class'=>'date', 'autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'date_created'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>1024)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'short_description'); ?>
		<?php echo $form->textField($model,'short_description',array('size'=>60,'maxlength'=>1024)); ?>
		<?php echo $form->error($model,'short_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_id'); ?>
        <?=$form->DropDownList($model, 'author_id', User::getList()); ?>
		<?php echo $form->error($model,'author_id'); ?>
	</div>

    <div class="row">
        <?php echo CHtml::fileField('News[large_image]', '', array('size' => '100','style'=>'width:200px;')); ?>
        <?php echo CHtml::submitButton('Добавить.'); ?>
        <input type="hidden" value="<?=Yii::app()->request->csrfToken?>" name="YII_CSRF_TOKEN">
        <input type="hidden" name="News[large_image]">
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->