<?php

class AdminModule extends CWebModule
{
	public function init()
    {
        if(!Yii::app()->user->checkAccess('administrator')){
            throw new CHttpException(403, 'Forbidden');
        }

        $config = require dirname(__FILE__).DIRECTORY_SEPARATOR.'config/main.php';
        $this->configure($config);


		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
