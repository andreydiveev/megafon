<?php

class CategoriesWidget extends CWidget{
    public function run() {

        $cs=Yii::app()->clientScript;
        $path = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.assets.css'));
        $cs->registerCssFile($path.'/jqcloud.css', CClientScript::POS_HEAD);

        $categories = Categories::model()->findAll();

        if($categories !== NULL){

            $this->render('application.views.widgets.categories.main', array(
                'categories' => $categories,
            ));
        }
    }
}