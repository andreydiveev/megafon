<?php

class NewsController extends Controller
{
    /**
     * @param null $id
     * @param null $viewmode
     * @param null $category_id
     */
    public function actionIndex($id = NULL, $viewmode = NULL, $category_id = NULL)
	{
        if($id !== NULL){
            $news_model = News::model()->findByPk((int)$id);

            if($news_model === NULL){
                $this->redirect('/site/404');
            }

            $this->render('page', array(
                'news' => $news_model,
            ));
        }else{

            $cs=Yii::app()->clientScript;
            $path = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.assets.js.news'));
            $cs->registerScriptFile($path.'/category_switcher.js', CClientScript::POS_HEAD);

            if(!empty($category_id))
                $viewmode = 'by_cat';

            $news_list = News::model()->findAll();

            if($viewmode == 'by_cat'){

                $criteria = new CDbCriteria;
                if(!empty($category_id)){
                    $criteria->condition = 'id = :cat_id';
                    $criteria->params = array(':cat_id' => (int)$category_id);
                }

                $categories = Categories::model()->findAll($criteria);

                $this->render('by_categories', array(
                    'news'      => $news_list,
                    'view_mode' => 'by_cat',
                    'categories' => $categories,
                ));
            }else{
                $this->render('list', array(
                    'news'      => $news_list,
                    'view_mode' => 'as_list',
                ));
            }
        }

	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
