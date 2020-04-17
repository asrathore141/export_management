<?php

class InstallModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'Install.models.*',
			'Install.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{

		$file = eCareUtility::getMAC();
		$folder = Yii::getPathOfAlias('application.runtime');
		$configPath = $folder.DIRECTORY_SEPARATOR.$file.'.php';

		if(parent::beforeControllerAction($controller, $action))
		{

			if ( file_exists($configPath) ){
				if ( $action->id != 'RenewLicence' ) {
					return $controller->redirect( array('/site') );
				}
			}

			if ( $action->id == 'RenewLicence' ) {
				return true;
			}

			if ( $action->id != 'index' ) {
				if( !isset(Yii::app()->session['key']) ) {
					return $controller->redirect( array('/Install') );
				}
				else {
					return true;
				}
			}
			else {
				Yii::app()->session->remove('key');
			}
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
