<?php

class DefaultController extends Controller
{

	public $layout='//layouts/installer';

	public function accessRules()
	{
		return array(
            array('allow',
                'users'=>array('*'),
            )
        );
	}

	public function config() {
		$config = require(dirname(__FILE__).'/../config/settings.php');
		return $config;
	}

	private $_assetsUrl;
	public function getAssetsUrl()
	{
	    if ($this->_assetsUrl === null)
	        $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
	            Yii::getPathOfAlias('Install.assets') );
	    return $this->_assetsUrl;
	}

	public function actionIndex()
	{
		$config = $this->config();
        $config['error'] = 0;

        $a = require_once(Yii::getPathOfAlias('LC').'.php');
		$s = CMap::mergeArray( eCareUtility::formatOut($a), array());
		if(isset($_POST['serial'])){
			if ( in_array($_POST['serial'], $s) ) {
				Yii::app()->session['key'] = $_POST['serial'];
				return $this->redirect( array('/Install/default/step1') );
			}
			$config['error'] = 'Invalid Key';
		}

		$this->render( 'index', array('config' => $config ));
	}

	public function actionStep1()
	{
		$folders = $this->getFoldersWritable();

		$writables = array();

		clearstatcache();

		foreach($folders as $path) {
		if (is_writable($path) === true)
			$writables[] = true;
			else
			$writables[] = false;
		}

		if (count($folders) === count($writables)) {
			$folders = array_combine($folders, $folders);
		}

		$this->render('step1', array('folders'=>$folders));
	}

	public function actionStep2()
	{
		$config = $this->config();
        $config['error'] = 0;

		$model = new ConfigForm();
        if(isset($_POST['ConfigForm']) === true) {
            $model->attributes=$_POST['ConfigForm'];
			$photo_file = $this->uploadFile( $model, 'licence');
			if ( !empty($photo_file) ) {

				$lines   = file_get_contents($photo_file);
				$lic     = eCareUtility::formatOut($lines);
				$lic_obj = json_decode( $lic );

				if ( !$lic_obj ) {
					$config['error'] = 'Invalid Licence File';
					return $this->render('step2', array('model'=>$model,'config'=>$config));
				}

				if ( $this->is_sucks($lic_obj->expiry) ) {
					$config['error'] = 'Licence Expired';
				}
				else {
					return $this->redirect( array('/Install/default/step3') );
				}
			}
        }
		return $this->render('step2', array('model'=>$model,'config'=>$config));
	}

	public function actionRenewLicence()
	{
		$config = $this->config();
        $config['error'] = 0;

		$model = new ConfigForm();
        if(isset($_POST['ConfigForm']) === true) {
            $model->attributes=$_POST['ConfigForm'];
			$photo_file = $this->uploadFile( $model, 'licence');
			if ( !empty($photo_file) ) {

				$lines   = file_get_contents($photo_file);
				$lic     = eCareUtility::formatOut($lines);
				$lic_obj = json_decode( $lic );

				if ( !$lic_obj ) {
					$config['error'] = 'Invalid Licence File';
					return $this->render('renew_licence', array('model'=>$model,'config'=>$config));
				}

				if ( $this->is_sucks($lic_obj->expiry) ) {
					$config['error'] = 'Licence Expired';
				}
				else {
					return $this->redirect( array('/sites') );
				}
			}
        }

		return $this->render('renew_licence', array('model'=>$model,'config'=>$config));
	}

	public function actionStep3()
	{
		$model  = new ConfigForm();
		$config = $this->config();

        if(isset($_POST['ConfigForm']) === true) {
        	$model->attributes=$_POST['ConfigForm'];

        	$User = new User;
        	$User->attributes = $_POST['ConfigForm'];
        	$User->creation_date = date('Y-m-d H:i:s');

			if ( !$User->save() ) {
				var_dump($User->getErrors());
				die;
			}

        	$this->letsDone();
        	return $this->redirect( array('/site') );
        }

        $config['error'] = 0;
		$this->render( 'step3', array('model'=>$model,'config' => $config ));
	}

    protected function getFoldersWritable() {
        return array(
            Yii::getPathOfAlias('webroot.assets'),
            Yii::getPathOfAlias('application.runtime'),
        );
    }

    protected function letsDone() {
    	$file = eCareUtility::getMAC();
		$folder = Yii::getPathOfAlias('application.runtime');
    	$content = '<?php return array("install"=>0,"key"=>"'. Yii::app()->session['key'] .'"); ?>';
		$configPath = $folder.DIRECTORY_SEPARATOR.$file.'.php';

		file_put_contents($configPath, $content);
    }

	private function uploadFile ( $model, $field ) {
		$file = CUploadedFile::getInstance($model, $field);
		if ( !empty($file) ) {
			$folder = Yii::getPathOfAlias('application.runtime');
			$file->saveAs("$folder/system.runtime");
			return "$folder/system.runtime";
		}
		return;
	}

	private function is_sucks( $date1 ){
		$todays_date = date("d-m-Y");
		$today   = strtotime($todays_date);
		$ex_date = strtotime($date1);

		if ($ex_date > $today) {
			return 0;
		} else {
			return 1;
		}
	}

}
