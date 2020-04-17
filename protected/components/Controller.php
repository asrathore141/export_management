<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	public $gridmenu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
                'roles'=>array('admin'),
            ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('View','Admin','create', 'dashboard','update','index','vendorview','take','addcontainer','additems','completebooking','PartialView','new_request'),
				'roles'=>array('user'),
			),
            array('deny'),
           	parent::accessRules()
        );
	}

   protected function beforeAction($action)
   {
   		$app  = Yii::app();
		$file = eCareUtility::getMAC();
		$folder = Yii::getPathOfAlias('application.runtime');
		$configPath = $folder.DIRECTORY_SEPARATOR.$file.'.php';

		$urls = array(
			'Install',
			'Install/default/RenewLicence',
			'Install/default/step1',
			'Install/default/step2',
			'Install/default/step3'
		);

		if ( !file_exists($configPath) ){
			if ( !in_array( $app->request->getParam('r'), $urls) ) {
				return $app->request->redirect( Yii::app()->createUrl('/Install') );
			}
		}
		else {
			$lc = eCareUtility::Check();
			if ( $lc < 0 ) {
				return $app->request->redirect( Yii::app()->createUrl('/Install') );
			}
			if ( $lc ) {
				if ( $app->request->getParam('r') != 'Install/default/RenewLicence' ) {
					return $app->request->redirect( Yii::app()->createUrl('/Install/default/RenewLicence') );
				}
			}
		}

       return parent::beforeAction($action);
   }

}
