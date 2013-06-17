<?php

class NewsController extends AdminController
{
    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'attachJQuery', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    /**
     * Saves photo at FS, saves path to the photo at database.
     *
     * @param $model
     * @param $prop
     * @param $file
     */
    protected function savePhotos(&$model, $prop, $file){

        $news_dir = 'files/news/'.$model->id;

        if (!file_exists($news_dir)) {
            mkdir($news_dir);
        }

        $type = News::imageAvailableTypes();

        $file_name = uniqid().'.'.$type[$file->type];
        $large_webpath = '/'.$news_dir.'/'.$file_name;
        $small_webpath = '/'.$news_dir.'/thumb_'.$file_name;

        $this->unlinkImg($model->large_image);
        $this->unlinkImg($model->small_image);

        Yii::app()->CPHPThumb;
        $large_path = Yii::getPathOfAlias('webroot').$large_webpath;
        $small_path = Yii::getPathOfAlias('webroot').$small_webpath;

        $image = PhpThumbFactory::create($file->tempName);
        $image->adaptiveResize(News::IMG_LARGE_WIDTH, News::IMG_LARGE_HEIGHT)->save($large_path);
        $image->adaptiveResize(News::IMG_SMALL_WIDTH, News::IMG_SMALL_HEIGHT)->save($small_path);

        $model->large_image = $large_webpath;
        $model->small_image = $small_webpath;
        $model->save();
    }

    /**
     * @param $model
     */
    protected function processImage(&$model){
        $file = CUploadedFile::getInstance($model, 'large_image');

        if(($file !== NULL) && !isset($file->tempName) && !empty($file->tempName)){

            list($width, $height) = getimagesize($file->tempName);

            if($width < News::IMG_LARGE_WIDTH && $height < News::IMG_LARGE_HEIGHT){
                $model->addError('large_image',
                    'Image must be least '.News::IMG_LARGE_WIDTH.'x'.News::IMG_LARGE_HEIGHT.' px.'
                );
            }
        }

        if(!$model->hasErrors() && $model->save()){
            if($file !== NULL){
                $this->savePhotos($model, 'large_image', $file);
            }

            $this->redirect(array('view','id'=>$model->id));
        }
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $cs=Yii::app()->clientScript;
        $path = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('admin.assets.js.news'));
        $cs->registerScriptFile($path.'/datepicker.js', CClientScript::POS_HEAD);

		$model=new News;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];

            if(time() < strtotime($model->date_created)){
                $model->addError('date_created', 'Нельзя использовать дату больше текущей.');
            }

            $this->processImage($model);
		}

        $this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $cs=Yii::app()->clientScript;
        $path = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('admin.assets.js.news'));
        $cs->registerScriptFile($path.'/datepicker.js', CClientScript::POS_HEAD);

		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];

            if(time() < strtotime($model->date_created)){
                $model->addError('date_created', 'Нельзя использовать дату больше текущей.');
            }

            $this->processImage($model);
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);

        $dir = Yii::getPathOfAlias('webroot.files.news.'.$model->id);


        $this->unlinkImg($model->large_image);
        $this->unlinkImg($model->small_image);


        if (is_dir($dir).'/' && Helper::is_dir_empty($dir)) {
            rmdir(Yii::getPathOfAlias('webroot.files.news.'.$model->id).'/');
        }

        $model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

    /**
     * @param $path
     * @return bool
     */
    protected function unlinkImg($path){

        $path = Yii::getPathOfAlias('webroot').$path;
        if(!in_array($path, array(News::IMG_LARGE_MOCK, News::IMG_SMALL_MOCK)) && file_exists($path) && !is_dir($path)){
            return unlink($path);
        }

        return FALSE;
    }


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('News');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function filterAttachJQuery($filterChain){
        Yii::app()->getClientScript()->registerCoreScript( 'jquery.ui' );

        $path = Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css';
        Yii::app()->clientScript->registerCssFile($path);

        $filterChain->run();
    }

}





