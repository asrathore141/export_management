<?php
/**
* ColumnFilter extension for Yii.
*/
class ColumnFilter extends CWidget
{
	//Parameters passed
	private $_options = array(
	        'columns' => null,
	    );
    
	public function init()
	{

	}

	//Magic function for get parameters
	public function __get($name) {
		if(array_key_exists($name, $this->_options)) {
		    return $this->_options[$name];
		}
		return parent::__get($name);
	}

	//Magic function for setting parameters
	public function __set($name, $value) {
		if(array_key_exists($name, $this->_options)) {
		    return $this->_options[$name] = $value;
		}
		return parent::__set($name, $value);
	}

	//Register CSS and Jquery
	public function registerClientScript()
	{
		$bu = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/');
		$cs = Yii::app()->clientScript;
		//Intialize CSS
		$cs->registerCssFile($bu . '/css/colfilter.css?v1');
		//Intialize Jquery
		$cs->registerScriptFile($bu . '/js/colfilter.js?v2');
	}

	public function genFilter()
	{

		$hidden_cols = array();

		if ( array_key_exists ( 'hiddenCols', $_COOKIE ) ) {
			$hidden_cols = explode(",",$_COOKIE["hiddenCols"]);
		}
		echo "<ul class='colfilter'>\n";
		$i = 0;
		foreach($this->columns as $column)
		{
			
			$status = '';
			if ( !in_array( $column[1], $hidden_cols)){
				$status = 'checked="checked"';
			}
			
			$find = explode(".", $column[1]);
			echo '<li class="col_filter"><label><input data-column="'. $i .'" data-class="'. $find[0] .'"'. $status .' type="checkbox" class="colfilter_e">'.ucfirst($column[0])."</label></li>";

			$i++;
		}
		echo "</ul>\n";
	}

	//Runs after the widget is intialized
	public function run()
	{
	$this->registerClientScript();
	$this->genFilter();
	}
}

?>


