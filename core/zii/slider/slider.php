<?php
	/**
	* slider class file.
	*
	* @author Ovidiu Pop <matricks@webspider.ro>
	* @link http://www.webspider.ro/
	* @copyright Copyright &copy; 2011 Ovidiu Pop
	* Dual licensed under the MIT and GPL licenses:
	* http://www.opensource.org/licenses/mit-license.php
	* http://www.gnu.org/licenses/gpl.html
	*
	* slider - yii extension
	* - create a photo slideshow

	* To use slider:
	* Extract archive in your extensions folder
	* In the site root create a folder named "images" and copy content of image folder from archive

	* To include a slider in a page:
	* <?php $this->widget('extensions.slider.slider');?>
		
	* If you wish to customize your slider, you can set options:
		<?php
		$this->widget('ext.slider.slider', array(
			'container'=>'slideshow',
			'width'=>960, 
			'height'=>240, 
			'timeout'=>6000,
			'infos'=>true,
			'constrainImage'=>true,
			'images'=>array('01.jpg','02.jpg','03.jpg','04.jpg'),
			'alts'=>array('First description','Second description','Third description','Four description'),
			'defaultUrl'=>Yii::app()->request->hostInfo
			)
		);
		?>
	*/


class slider extends CWidget
{
	/** 
	* @var string $container - container class for slider
	*/
	public $container="slideshow";

	/** 
	* @var int $width - the width for container
	*/
	public $width=960;

	/** 
	* @var int $height - the height for container
	*/
	public $height=240;

	/** 
	* @var int $timeout - milisecond - time for a picture to remain visible until next picture is shown
	*/
	public $timeout=6000;

	/** 
	* @var bool $infos - true=>display info about picture, false=>don't display info about picture,
	* alt attribute of image will be shown over picture
	*/
	public $infos=true;

	/** 
	* @var array $images - array with filename of images. Don't need to be set full path. Only filename.
	* alt attribute of image will be shown over picture
	*/
	public $images = array('education_front.png','image1.jpg','image.jpg',);

	/** 
	* @var array $alts - array with alt attribute for images. These attributes will be used to display infos.
	*/
	public $alts = array('First description','Second description','Third description',);

	/** 
	* @var array $urls - array with anchors for images. You can set a destination for each picture.
	*/
	public $urls = array();

	/** 
	* @var string $defaultAlt - This string will be shown when an image hasn't a corespondent alt attribute, set in in $alts.
	*/
	public $defaultAlt='';

	/** 
	* @var string $defaultUrl - This url will be used when an image hasn't a corespondent url attribute, set in in $urls.
	*/
	public $defaultUrl='#';

	/** 
	* @var bool $sameToAll - If is set to true, the set of images will be taken from all folder and can be displayied in all pages (as a banner for example)
	* if is set to false, you must create a folder named by page id, and slider will use that folder
	*/
	public $sameToAll = true;//use same slider on all pages

	/** 
	* @var bool $constrainImage - If is set to true, all images will be resized to fill container of slider
	* if is set to false, you can't use info about every image
	*/
	public $constrainImage = true;//constrain image to fill space


	/** 
	* @var string $_imagePath - Path to folder where are images for slider 
	*/
	private $_imagePath;//path to images folder




	public function init()
	{
		if($this->sameToAll)
			$this->_imagePath = Yii::app()->request->hostInfo.Yii::app()->baseUrl.'/images/slider/all/';
		else
			$this->_imagePath = Yii::app()->request->hostInfo.Yii::app()->baseUrl.'/images/slider/'.$_GET['id'].'/';

		$this->defaultAlt = $this->defaultAlt ? $this->defaultAlt : '';
		$this->defaultUrl = $this->defaultUrl ? $this->defaultUrl : Yii::app()->request->hostInfo;
		
		//if use different size for images, infos will be automatically disabled
		if($this->constrainImage === false) 
			$this->infos = false;

		self::setContent();
		self::publishAssets();
		parent::init();
	}

	public function publishAssets()
	{
		$assets = dirname(__FILE__).'/assets';
		$baseUrl = Yii::app()->assetManager->publish($assets);

		if(is_dir($assets)){
			Yii::app()->clientScript->registerCssFile($baseUrl . '/slider.css');
			Yii::app()->clientScript->registerScriptFile($baseUrl . '/slider.js', CClientScript::POS_END);
			Yii::app()->clientScript->registerScriptFile($baseUrl . '/jquery.cycle.all.js', CClientScript::POS_END);

			Yii::app()->clientScript->registerScript( 'startSlider' , "startCycle(
				'$this->container', 
				'$this->width', 
				'$this->height',
				'$this->infos',
				'$this->timeout'
			)", CClientScript::POS_READY );

		}else 
			throw new Exception(404, 'slider - '.Yii::t('app', 'Eroare: Directorul de publicat nu exista.'));
	}



	private function setContent()
	{
		$items = '';

		foreach($this->images as $k => $img){
			$url = isset($this->urls[$k]) ? $this->urls[$k] : $this->defaultUrl;
			$alt = isset($this->alts[$k]) ? $this->alts[$k] : $this->defaultAlt;
			$src = $this->_imagePath.$img;
		
			$items .=  $this->render('_item', array('url'=>$url, 'src'=>$src, 'alt'=>$alt), true);
		}

		echo $this->render('container', array('items'=>$items), true);
	}
}